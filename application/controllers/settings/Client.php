<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['ecomm_login'])) {
            redirect('login');
        }
        $this->load->model('general_settings/Client_model', 'CModel');
    }
    public function show_client()
    {

        $data['title'] = 'Client';
        $data['subtitle'] = 'Client List';
        $data['details_data'] = $this->CModel->get_details($data);
        $data['template'] = 'modules/clients/show_client';
        $this->load->view('template/dashboard_template', $data);
    }


    public function change_status()
    {
        $client_id = $this->input->post('id');
        $status = $this->input->post('status');
        $data = array('is_active' => $status);
        if ($this->CModel->change_status($data, $client_id)) {
            echo json_encode(array('status' => 1));
            return;
        } else {
            return false;
        }
    }
}
