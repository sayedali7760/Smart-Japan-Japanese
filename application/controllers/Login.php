<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('general_settings/Client_crm_model', 'CModel');
    }
    public function index()
    {
        if (isset($this->session->userdata['ecomm_login']) && ($this->session->userdata['ecomm_login'] == TRUE)) {
            redirect('home');
        } else {
            $this->load->view('login/login');
        }
    }
    public function admin_login()
    {
        if (isset($this->session->userdata['ecomm_login']) && ($this->session->userdata['ecomm_login'] == TRUE)) {
            redirect('home');
        } else {
            $this->load->view('login/admin_login');
        }
    }
    public function error()
    {
        $this->load->view('template/error-404');
    }

    public function loginaction()
    {

        $username = $this->input->post('username');
        $position = $this->input->post('position');
        $password = md5($this->input->post('password'));

        if ($position == 1) {
            $qr = $this->db->select('C.*')
                ->from('clients as C')
                ->where('C.email', $username)
                ->where('C.password', $password)
                ->where('C.is_active', 1)
                ->get();
        } else {
            $qr = $this->db->select('U.*,R.role_id,R.description')
                ->from('user_details as U')
                ->where('U.email', $username)
                ->where('U.password', $password)
                ->where('U.is_active', 1)
                ->join('user_roles as R', 'U.position = R.role_id', 'left')
                ->get();
        }

        if ($qr->num_rows() > 0) {
            $session_data = $qr->row_array();
            $session_data['ecomm_login'] = true;
            if ($session_data['is_active'] == 0) {
                echo json_encode(array('status' => 2));
                return;
            }
            $this->session->set_userdata($session_data);
            if ($this->input->post("remember") == '1') {
                setcookie("ecomm_username", $username, time() + (10 * 365 * 24 * 60 * 60));
                setcookie("ecomm_password", $password, time() + (10 * 365 * 24 * 60 * 60));
            } else {
                if (isset($_COOKIE["ecomm_username"])) {
                    setcookie("ecomm_username", "");
                }
                if (isset($_COOKIE["ecomm_password"])) {
                    setcookie("ecomm_password", "");
                }
            }
            echo json_encode(array('status' => 1));
            return;
        } else {
            echo json_encode(array('status' => 0));
            return;
        }
    }
    public function google_login()
    {

        if (!empty($_POST['credential'])) {
            require 'third_party/vendor/autoload.php';
            $id_token = $_POST['credential'];
            $CLIENT_ID = BM_GOOGLE_CLIENT_ID;
            $client = new Google_Client(['client_id' => $CLIENT_ID]);
            $payload = $client->verifyIdToken($id_token);
            if ($payload) {
                $user_email = $payload['email'];
                $qr = $this->db->select('U.*,R.*')
                    ->from('user_details as U')
                    ->where('U.username', $user_email)
                    ->join('user_roles as R', 'U.position = R.role_id', 'left')
                    ->get();

                if ($qr->num_rows() > 0) {
                    $session_data = $qr->row_array();
                    $session_data['ecomm_login'] = true;
                    $this->session->set_userdata($session_data);
                    if ($this->input->post("remember") == '1') {
                        setcookie("ecomm_username", $username, time() + (10 * 365 * 24 * 60 * 60));
                        setcookie("ecomm_password", $password, time() + (10 * 365 * 24 * 60 * 60));
                    } else {
                        if (isset($_COOKIE["ecomm_username"])) {
                            setcookie("ecomm_username", "");
                        }
                        if (isset($_COOKIE["ecomm_password"])) {
                            setcookie("ecomm_password", "");
                        }
                    }
                    redirect('home');
                } else {

                    $data['value'] = 0;
                    $data['message'] = 'Access denied from Google or Invalid Google Login.';
                    $this->load->view('login/login', $data);
                }
            } else {
                $data['goole_login_error'] = "Access denied from Google or Invalid Google Login.";
            }
            $data['value'] = 0;
            $data['message'] = 'Access denied from Google or Invalid Google Login.';
            $this->load->view('login/login', $data);
        } else {
            redirect();
        }
    }
    public function forgot_password_check()
    {
        $email = $this->input->post('email');
        $qr = $this->db->select('U.*,R.*')
            ->from('user_details as U')
            ->where('U.username', $email)
            ->join('user_roles as R', 'U.position = R.role_id', 'left')
            ->get();
        if ($qr->num_rows() > 0) {
            $data = array(
                'forgot_pass_flag' => 1
            );
            $this->db->where('username', $email);
            $this->db->update('user_details', $data);

            $encrypted_mail_id = base64_encode($email);
            $data['email'] = $email;
            $data['forgot_password_link'] = base_url() . 'update-forgot-password?email_id=' . $encrypted_mail_id;

            $subject = "Forgot Password";
            $mailto = $email;
            $mailcontent =  $this->load->view('modules/mail_templates/forgot_password_mail_template', $data, true);

            $cc = "";

            send_smtp_mailer($subject, $mailto, $mailcontent, $cc);

            $data[] = '';
            echo json_encode(array('status' => 1, 'view' => $this->load->view('login/login', $data, TRUE)));
            return;
        } else {
            $data[] = '';
            echo json_encode(array('status' => 2, 'view' => $this->load->view('login/login', $data, TRUE)));
            return;
        }
    }
    public function change_password_user()
    {
        $data['email_id'] = base64_decode($this->input->get('email_id'));
        $pass_flag_details = $this->db->select('forgot_pass_flag')
            ->from('user_details')
            ->where('username', $data['email_id'])
            ->get()
            ->result();
        $result = json_decode(json_encode($pass_flag_details), true);
        $data['current_flag'] = $result[0]['forgot_pass_flag'];
        $this->load->view('login/forgot_password', $data);
    }
    public function update_password()
    {
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        $data = array(
            'password' => $password,
            'forgot_pass_flag' => 0
        );
        $this->db->where('username', $email);
        $this->db->update('user_details', $data);
        $subject = "Password changed successfully";
        $mailto = $email;
        $data['email'] = $email;
        $mailcontent =  $this->load->view('modules/mail_templates/password_changed_mail_template', $data, true);

        $cc = "";

        send_smtp_mailer($subject, $mailto, $mailcontent, $cc);

        $data[] = '';
        echo json_encode(array('status' => 1, 'view' => $this->load->view('login/forgot_password', $data, TRUE)));
        return;
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function signup()
    {
        $this->load->view('login/signup');
    }

    public function register()
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        $phno = $this->input->post('phno');

        $uuid_data = random_bytes(16);
        $uuid_data[6] = chr(ord($uuid_data[6]) & 0x0f | 0x40);
        $uuid_data[8] = chr(ord($uuid_data[8]) & 0x3f | 0x80);
        $uuid =  vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($uuid_data), 4));
        $qry = $this->db->get_where('clients', "email like '$email'");
        if ($qry->num_rows() > 0) {
            echo json_encode(array('status' => 2));
            return;
        } else {
            $user_data = array('uid' => $uuid, 'name' => $name, 'email' => $email, 'file' => 'abc.jpg', 'brand' =>  'smartfxcfd.com', 'password' => $password, 'phone' => $phno);
            if ($this->CModel->add_client($user_data)) {
                $mailto = $email;
                $subject = 'Account Created Successfully';
                $data_user_array['name'] = $name;
                $data_user_array['name'] = 'Seyad Ali';
                $mailcontent =  $this->load->view('mail_templates/authentication_mt5_email', $data_user_array, true);
                $cc = "";
                send_smtp_mailer($subject, $mailto, $mailcontent, $cc);

                echo json_encode(array('status' => 1));
                return;
            } else {
                echo json_encode(array('status' => 0));
                return;
            }
        }
    }
}
