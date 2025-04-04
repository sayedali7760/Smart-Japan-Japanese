<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mt_Accounts extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['ecomm_login'])) {
            redirect('login');
        }
        $this->load->model('general_settings/Mt_model', 'MModel');
    }
    public function show_mt_create()
    {
        $data['title'] = 'MT Account';
        $data['subtitle'] = 'Create MT5 Account';
        $data['template'] = 'modules/mt/add_account';
        $this->load->view('template/dashboard_template', $data);
    }
    public function show_live_account()
    {
        $data['title'] = 'MT Accounts';
        $data['subtitle'] = 'Live Accounts';
        $data['details_data'] = $this->MModel->get_live_accounts($data);
        $data['template'] = 'modules/mt/show_live_accounts';
        $this->load->view('template/dashboard_template', $data);
    }
    public function my_mt_details()
    {
        $data['title'] = 'MT Account';
        $data['subtitle'] = 'MT5 Account Details';
        $client_id = $this->session->userdata('id');
        $data['details_data'] = $this->MModel->get_my_mt_details($client_id);
        $data['template'] = 'modules/mt/my_mt_details';
        $this->load->view('template/dashboard_template', $data);
    }

    public function show_demo_account()
    {
        $data['title'] = 'MT Accounts';
        $data['subtitle'] = 'Demo Accounts';
        $data['details_data'] = $this->MModel->get_demo_accounts($data);
        $data['template'] = 'modules/mt/show_demo_accounts';
        $this->load->view('template/dashboard_template', $data);
    }
    public function create_live_account()
    {
        $data = [];
        $view = $this->load->view('modules/general_settings/create_live', $data, TRUE);
        echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
        return;
    }
    public function create_demo_account()
    {
        $data = [];
        $view = $this->load->view('modules/general_settings/create_demo', $data, TRUE);
        echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
        return;
    }
    public function create_live_server()
    {

        $client_id = $this->session->userdata('id');
        $user_details = $this->MModel->get_clientdata($client_id);
        $fullname = $user_details['name'];

        $query = $this->db->select('*')
            ->from('accounts')
            ->where('user_id', $client_id)
            ->where('server', 'Live')
            ->get()
            ->result();

        if (count($query) >= 3) {
            echo json_encode(array('status' => 2));
            return;
        } else {
            $mtAmount = 0;
            $mtLeverage = 400;

            require_once(APPPATH . 'MT/mt5_api/mt5_api.php');
            try {
                $instance = new MTWebAPI();
                $response = $instance->Connect(LIVE_IP, LIVE_PORT, LIVE_TIMEOUT, LIVE_LOGIN, LIVE_PASSWORD);
                if ($response !== MTRetCode::MT_RET_OK) {
                    echo "Failed to connect to MetaTrader 5 server. Error code: " . $response;
                } else {


                    $query = $this->db->select_max('login')
                        ->from('accounts')
                        ->where('server', 'Live')
                        ->where('LENGTH(login) =', 5)
                        ->get()
                        ->row();
                    //Account not creating then check the login is already exist or not
                    $maxLogin = isset($query->login) ? $query->login : 0;
                    $newLogin = $maxLogin + 1;

                    $new_user = $instance->UserCreate();
                    $new_user->Email = $user_details['email'];
                    $new_user->MainPassword = RandString();
                    $new_user->InvestPassword = RandString();
                    $new_user->Group = 'SSC\JAPAN\SSC-JAPAN-VIP-USD-B';
                    $new_user->ZipCode = '';
                    $new_user->Country = $user_details['country'];
                    $new_user->State = '';
                    $new_user->City = '';
                    $new_user->Address = '';
                    $new_user->Login = $newLogin;
                    $new_user->Phone = $user_details['phone'];
                    $new_user->Name = $fullname;
                    $new_user->PhonePassword = RandString();
                    $new_user->Leverage = $mtLeverage;

                    $instance->UserAdd($new_user, $user_server);
                    $new_user->Login = $user_server->Login;
                    $result = $instance->TradeBalance($new_user->Login, MTEnDealAction::DEAL_BALANCE, $mtAmount, 'Web Deposit', $ticket);

                    $data_user_array = array(
                        'login' => $new_user->Login,
                        'user_id' => $client_id,
                        'main_password' => $new_user->MainPassword,
                        'invest_password' => $new_user->InvestPassword,
                        'phone_password' => $new_user->PhonePassword,
                        'currency' => 'USD',
                        'leverage' => $new_user->Leverage,
                        'server' => 'Live',
                        'balance' => $mtAmount,
                        'name' => 'mt5',
                        'group' => $new_user->Group,
                        'info' => $new_user->Login,
                        'type' => 'live',
                    );

                    if ($this->MModel->insert_live($data_user_array)) {

                        // $mailto = $user_details['email'];
                        // $subject = 'MT5 Live Accont Details';
                        // $mail_data['name'] = $fullname;
                        // $mail_data['login'] = $new_user->Login;
                        // $mail_data['main_password'] = $new_user->MainPassword;
                        // $mail_data['invest_password'] = $new_user->InvestPassword;
                        // $mail_data['phone_password'] = $new_user->PhonePassword;
                        // $mailcontent =  $this->load->view('mail_templates/authentication_mt5_email', $mail_data, true);
                        // $cc = "";
                        // send_smtp_mailer($subject, $mailto, $mailcontent, $cc);

                        echo json_encode(array('status' => 1));
                        return;
                    } else {
                        echo json_encode(array('status' => 2));
                        return;
                    }
                }
            } catch (Exception $e) {
                echo "An error occurred: " . $e->getMessage();
            }
        }
    }
    public function create_demo_server()
    {
        // require_once(APPPATH . 'MT/mt5_api/mt5_api.php');
        // try {
        //     $instance = new MTWebAPI();
        //     $response = $instance->Connect(DEMO_IP, DEMO_PORT, DEMO_TIMEOUT, DEMO_LOGIN, DEMO_PASSWORD);
        //     if ($response !== MTRetCode::MT_RET_OK) {
        //         echo "Failed to connect to MetaTrader 5 server. Error code: " . $response;
        //         die;
        //     } else {
        //     }
        // } catch (Exception $e) {
        //     echo "An error occurred: " . $e->getMessage();
        //     die;
        // }

        // $data['client_data'] = $this->MDashboard->get_userdata($user_id);
        // $demo_account = $this->MModel->get_demoaccount_client($client_id);
        // $account_details = [];
        // foreach ($demo_account as $row) {
        //     $instance->UserAccountGet($row->login, $demo_user_server);
        //     $account_details[$row->login] = array('login' => $demo_user_server->Login, 'Balance' => $demo_user_server->Balance, 'Profit' => $demo_user_server->Profit);
        // }


        $client_id = $this->session->userdata('id');
        $user_details = $this->MModel->get_clientdata($client_id);
        $fullname = $user_details['name'];

        $query = $this->db->select('*')
            ->from('accounts')
            ->where('user_id', $client_id)
            ->where('server', 'Demo')
            ->get()
            ->result();

        if (count($query) >= 3) {
            echo json_encode(array('status' => 2));
            return;
        } else {
            $mtAmount = 10000;
            $mtLeverage = 400;
            require_once(APPPATH . 'MT/mt5_api/mt5_api.php');
            try {
                $instance = new MTWebAPI();
                $response = $instance->Connect(DEMO_IP, DEMO_PORT, DEMO_TIMEOUT, DEMO_LOGIN, DEMO_PASSWORD);
                if ($response !== MTRetCode::MT_RET_OK) {
                    echo "Failed to connect to MetaTrader 5 server. Error code: " . $response;
                } else {
                    $new_user = $instance->UserCreate();
                    $new_user->Email = $user_details['email'];
                    $new_user->MainPassword = RandString();
                    $new_user->InvestPassword = RandString();
                    $new_user->Group = 'demo\JAPAN\SSC-JAPAN-VIP-USD-B-new';
                    $new_user->ZipCode = '';
                    $new_user->Country = $user_details['country'];
                    $new_user->State = '';
                    $new_user->City = '';
                    $new_user->Address = '';
                    $new_user->Phone = $user_details['phone'];
                    $new_user->Name = $fullname;
                    $new_user->PhonePassword = RandString();
                    $new_user->Leverage = $mtLeverage;

                    $instance->UserAdd($new_user, $user_server);
                    $new_user->Login = $user_server->Login;
                    $result = $instance->TradeBalance($new_user->Login, MTEnDealAction::DEAL_BALANCE, $mtAmount, 'Web Deposit', $ticket);

                    $data_user_array = array(
                        'login' => $new_user->Login,
                        'user_id' => $client_id,
                        'main_password' => $new_user->MainPassword,
                        'invest_password' => $new_user->InvestPassword,
                        'phone_password' => $new_user->PhonePassword,
                        'leverage' => $new_user->Leverage,
                        'currency' => 'USD',
                        'server' => 'Demo',
                        'balance' => $mtAmount,
                        'name' => 'mt5',
                        'group' => $new_user->Group,
                        'info' => $new_user->Login,
                        'type' => 'demo',
                    );


                    if ($this->MModel->insert_demo($data_user_array)) {

                        $mailto = $user_details['email'];
                        $subject = 'MT5 Demo Accont Details';
                        $mail_data['name'] = $fullname;
                        $mail_data['login'] = $new_user->Login;
                        $mail_data['main_password'] = $new_user->MainPassword;
                        $mail_data['invest_password'] = $new_user->InvestPassword;
                        $mail_data['phone_password'] = $new_user->PhonePassword;
                        $mailcontent =  $this->load->view('mail_templates/authentication_mt5_email', $mail_data, true);
                        $cc = "";
                        send_smtp_mailer($subject, $mailto, $mailcontent, $cc);

                        echo json_encode(array('status' => 1));
                        return;
                    } else {
                        echo json_encode(array('status' => 2));
                        return;
                    }
                }
            } catch (Exception $e) {
                echo "An error occurred: " . $e->getMessage();
            }
        }
    }
    public function add_group()
    {
        $data['title'] = 'Mt Groups';
        $data['subtitle'] = 'Add Group';
        $data['currency_data'] = $this->MModel->get_currency();
        $data['template'] = 'modules/mt/add_group';
        $this->load->view('template/dashboard_template', $data);
    }
    public function save_group()
    {
        $name = $this->input->post('name');
        $currency = $this->input->post('currency');
        $description = $this->input->post('description');
        $data_array = array(
            'name' => $name,
            'currency' => $currency,
            'description' => $description,
        );
        if ($this->MModel->insert_group($data_array)) {
            echo json_encode(array('status' => 1));
            return;
        } else {
            echo json_encode(array('status' => 2));
            return;
        }
    }
    public function show_group()
    {
        $data['title'] = 'Mt Groups';
        $data['subtitle'] = 'Show Group';
        $data['details_data'] = $this->MModel->get_group();
        $data['template'] = 'modules/mt/show_group';
        $this->load->view('template/dashboard_template', $data);
    }
    public function change_group_status()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data = array('is_active' => $status);
        if ($this->MModel->update_group_status($id, $data)) {
            echo json_encode(array('status' => 1));
            return;
        } else {
            echo json_encode(array('status' => 2));
            return;
        }
    }
    public function edit_group()
    {
        $id = $this->input->post('group_id');
        $data['group_data'] = $this->MModel->get_group_data($id);
        $data['currency_data'] = $this->MModel->get_currency();
        $view = $this->load->view('modules/mt/edit_group', $data, TRUE);
        echo json_encode(array('status' => 1, 'view' => $view));
        return;
    }
    public function update_group()
    {
        $id = $this->input->post('group_id');
        $name = $this->input->post('name');
        $currency = $this->input->post('currency');
        $description = $this->input->post('description');
        $data_array = array(
            'name' => $name,
            'currency' => $currency,
            'description' => $description,
        );
        if ($this->MModel->update_group($id, $data_array)) {
            echo json_encode(array('status' => 1));
            return;
        } else {
            echo json_encode(array('status' => 2));
            return;
        }
    }

    public function send_mail()
    {

        $mailto = 'seyad@smartfx.com';
        $subject = 'MT5 Demo Accont Details';
        $data_user_array['name'] = 'Seyad Ali';
        $mailcontent =  $this->load->view('mail_templates/authentication_mt5_email', $data_user_array, true);
        $cc = "";
        send_smtp_mailer($subject, $mailto, $mailcontent, $cc);
        dev_export("Mail Sent");
        die;
    }
}
