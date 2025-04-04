<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_management extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['ecomm_login'])) {
            redirect('login');
        }
        if ($this->session->userdata['template_type'] != 1) {
            redirect('error');
        }
        $this->load->model('general_settings/Usermanagement_model', 'UMModel');
        $this->load->model('general_settings/Client_model', 'CModel');
    }



    public function user_add()
    {
        $data['title'] = 'Authentication';
        $data['subtitle'] = 'Add User';
        $data['user_role'] = $this->UMModel->get_user_role();
        $data['template'] = 'modules/general_settings/add_user';
        $this->load->view('template/dashboard_template', $data);
    }

    public function client_add()
    {
        $data['title'] = 'Client';
        $data['subtitle'] = 'Add Client';
        $data['countries'] = $this->CModel->get_countries();
        $data['user_role'] = $this->UMModel->get_user_role();
        $data['template'] = 'modules/general_settings/add_client';
        $this->load->view('template/dashboard_template', $data);
    }

    public function save_client()
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $country = $this->input->post('country');
        $password = md5($this->input->post('password'));

        $uploadPath = 'uploads';
        $uploadfile = 'avatar';
        $images = '';
        $filename = $this->fileUpload($uploadPath, $uploadfile);
        $avatar = $filename;

        $uuid_data = random_bytes(16);
        $uuid_data[6] = chr(ord($uuid_data[6]) & 0x0f | 0x40); // Set version 4
        $uuid_data[8] = chr(ord($uuid_data[8]) & 0x3f | 0x80); // Set variant
        $uuid =  vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($uuid_data), 4));

        $data = array('name' => $name, 'uid' => $uuid, 'country' => $country, 'phone' => $phone, 'email' => $email, 'file' => $avatar, 'password' => $password);
        $qry = $this->db->get_where('clients', "email like '$email'");
        if ($qry->num_rows() > 0) {
            echo json_encode(array('status' => 0, 'view' => $this->load->view('modules/general_settings/add_client', $data, TRUE)));
            return;
        } else {
            if ($this->CModel->insert($data)) {
                echo json_encode(array('status' => 1, 'view' => $this->load->view('modules/general_settings/add_client', $data, TRUE)));
                return;
            } else {
                return false;
            }
        }
    }

    public function client_list()
    {
        $data['title'] = 'Client';
        $data['subtitle'] = 'Client List';
        $data['client_data'] = $this->CModel->get_details();
        $data['template'] = 'modules/general_settings/show_client';
        $this->load->view('template/dashboard_template', $data);
    }

    public function change_user_password()
    {
        $user_id = $this->session->userdata('id');
        $data = array('password' => md5($this->input->post('password')));
        if ($this->UMModel->update_user_password($data, $user_id)) {
            echo json_encode(array('status' => 1, 'view' => $this->load->view('modules/general_settings/user_profile', $data, TRUE)));
            return;
        } else {
            return false;
        }
    }
    public function edit_client()
    {
        if ($this->input->is_ajax_request() == 1) {
            $onload =  $this->input->post('load');
            $client_id = $this->input->post('client_id');

            if ($onload == 1) {
                $client_data_raw = $this->CModel->get_client_details($client_id);
                $data['document_details'] = $this->CModel->get_client_document_details($client_id);
                $data['client_id'] = $client_id;
                $data['client_data'] = $client_data_raw;
                $data['countries'] = $this->CModel->get_countries();
                $data['subtitle'] = 'Update - ' . $client_data_raw['name'];
                $resultArray = json_decode(json_encode($data['client_data']), true);

                $view = $this->load->view('modules/general_settings/edit_client', $data, TRUE);
                echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
                return;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }

    public function user_list()
    {
        $data['title'] = 'Authentication';
        $data['subtitle'] = 'User List';
        $data['user_data'] = $this->UMModel->get_details($data);
        $data['template'] = 'modules/general_settings/show_user';
        $this->load->view('template/dashboard_template', $data);
    }

    public function save_user()
    {
        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $email = $this->input->post('email');
        $position = $this->input->post('position');
        $password = md5($this->input->post('password'));

        $uploadPath = 'uploads';
        $uploadfile = 'avatar';
        $images = '';
        $filename = $this->fileUpload($uploadPath, $uploadfile);
        $avatar = $filename;


        $data = array('fname' => $fname, 'lname' => $lname, 'email' => $email, 'file' => $avatar, 'position' => $position, 'password' => $password);
        $qry = $this->db->get_where('user_details', "email like '$email'");
        if ($qry->num_rows() > 0) {
            echo json_encode(array('status' => 0, 'view' => $this->load->view('modules/general_settings/add_user', $data, TRUE)));
            return;
        } else {
            if ($this->UMModel->insert($data)) {
                echo json_encode(array('status' => 1, 'view' => $this->load->view('modules/general_settings/add_user', $data, TRUE)));
                return;
            } else {
                return false;
            }
        }
    }
    public function edit_user()
    {
        if ($this->input->is_ajax_request() == 1) {
            $onload =  $this->input->post('load');
            $user_id = $this->input->post('user_id');
            if ($onload == 1) {
                $user_data_raw = $this->UMModel->get_user_details($user_id);
                $data['user_id'] = $user_id;
                $data['user_data'] = $user_data_raw;
                $data['subtitle'] = 'Update - ' . $user_data_raw['email'];
                $data['user_role'] = $this->UMModel->get_user_role();
                $resultArray = json_decode(json_encode($data['user_data']), true);
                $data['current_user_role'] = $resultArray['position'];

                $view = $this->load->view('modules/general_settings/edit_user', $data, TRUE);
                echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
                return;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function edit_profile_self()
    {
        $user_id = $this->session->userdata('id');
        $user_data_raw = $this->UMModel->get_user_details($user_id);
        $data['user_data'] = $user_data_raw;
        $data['user_id'] = $user_id;
        $data['user_role'] = $this->UMModel->get_user_role();
        $data['title'] = 'Authentication';
        $data['subtitle'] = 'My Profile';
        $resultArray = json_decode(json_encode($data['user_data']), true);
        $data['current_user_role'] = $resultArray['position'];
        $data['template'] = 'modules/general_settings/user_profile';
        $this->load->view('template/dashboard_template', $data);
    }
    public function update_client()
    {
        $client_id = $this->input->post('client_id');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $country = $this->input->post('country');
        $phone = $this->input->post('phone');
        $not_enrypted_pass = $this->input->post('password');


        $uploadPath = 'uploads';
        $uploadfile = 'avatar';
        $images = '';
        $filename = $this->fileUpload($uploadPath, $uploadfile);
        $avatar = $filename;

        $data = array('name' => $name, 'email' => $email, 'country' => $country, 'phone' => $phone);
        $qry = $this->db->get_where('clients', "email LIKE '$email' AND id != '$client_id'");
        if ($not_enrypted_pass != '') {
            $password = md5($not_enrypted_pass);
            $data['password'] = $password;
        }
        if ($avatar != '') {
            $data['file'] = $avatar;
        }
        if ($qry->num_rows() > 0) {
            echo json_encode(array('status' => 0, 'view' => $this->load->view('modules/general_settings/edit_client', $data, TRUE)));
            return;
        } else {
            if ($this->UMModel->update_client($data, $client_id)) {
                echo json_encode(array('status' => 1, 'view' => $this->load->view('modules/general_settings/edit_client', $data, TRUE)));
                return;
            } else {
                return false;
            }
        }
    }
    public function update_user()
    {
        $user_id = $this->input->post('user_id');
        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $email = $this->input->post('email');
        $position = $this->input->post('position');
        $not_enrypted_pass = $this->input->post('password');
        $password = md5($not_enrypted_pass);

        $uploadPath = 'uploads';
        $uploadfile = 'avatar';
        $images = '';
        $filename = $this->fileUpload($uploadPath, $uploadfile);
        $avatar = $filename;

        $data = array('fname' => $fname, 'lname' => $lname, 'email' => $email);
        if ($position != '') {
            $data['position'] = $position;
        }
        if ($not_enrypted_pass  != '') {
            $data['password'] = $password;
        }
        if ($avatar != '') {
            $data['file'] = $avatar;
        }
        if ($this->UMModel->update($data, $user_id)) {
            echo json_encode(array('status' => 1, 'view' => $this->load->view('modules/general_settings/edit_user', $data, TRUE)));
            return;
        } else {
            return false;
        }
    }
    public function change_status()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data = array('is_active' => $status);
        if ($this->UMModel->change_status($data, $id)) {
            echo json_encode(array('status' => 1, 'view' => $this->load->view('modules/general_settings/show_user', $data, TRUE)));
            return;
        } else {
            return false;
        }
    }
    public function fileUpload($uploadPath, $uploadfile = '')
    {
        $uploadData = "";
        $images = "";
        if ($uploadfile == '')
            $uploadfile = 'files';

        $filesCount = count($_FILES[$uploadfile]['name']);
        if ($filesCount > 0) {
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|doc|docx|pdf';
            $this->load->library('upload', $config);
            for ($i = 0; $i < $filesCount; $i++) {
                $_FILES['file']['name']     = $_FILES[$uploadfile]['name'][$i];
                $_FILES['file']['type']     = $_FILES[$uploadfile]['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES[$uploadfile]['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES[$uploadfile]['error'][$i];
                $_FILES['file']['size']     = $_FILES[$uploadfile]['size'][$i];


                if ($this->upload->do_upload('file')) {

                    $fileData = $this->upload->data();
                    //print_r($fileData);
                    $images .= $fileData['file_name'];
                } else {
                    return $images;
                }
            }
        }
        $this->session->set_flashdata('uploaded_file', $images);
        return $images;
    }
}
