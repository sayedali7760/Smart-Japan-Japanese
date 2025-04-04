<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['ecomm_login'])) {
            redirect('login');
        }
        $this->load->model('Dashboard_model', 'MDashboard');
        $this->load->model('general_settings/Client_crm_model', 'CModel');
        $this->load->model('general_settings/Mt_model', 'MModel');
    }
    public function index()
    {

        $data['title'] = 'Home';
        $data['subtitle'] = 'Dashboard';
        $type = $this->session->userdata['template_type'];
        if ($type == 1) {
            $data['transaction_details'] = $this->MDashboard->get_transaction_history();
            $data['deposit_total'] = $this->MDashboard->get_deposit_total();
            $data['withdrawal_total'] = $this->MDashboard->get_withdraw_total();
            $data['template'] = 'dashboard';
        }
        if ($type == 2) {
            $id = $this->session->userdata['id'];
            $data['client_document_data'] = $this->CModel->get_documents_details($id);

            require_once(APPPATH . 'MT/mt5_api/mt5_api.php');
            try {
                $instance = new MTWebAPI();
                $response = $instance->Connect(DEMO_IP, DEMO_PORT, DEMO_TIMEOUT, DEMO_LOGIN, DEMO_PASSWORD);
                if ($response !== MTRetCode::MT_RET_OK) {
                    echo "Failed to connect to MetaTrader 5 server. Error code: " . $response;
                } else {
                }
            } catch (Exception $e) {
                echo "An error occurred: " . $e->getMessage();
            }
            $demo_account = $this->MModel->get_mt_demo_account_details($id);
            $mt_demo_accounts = [];
            foreach ($demo_account as $row) {
                $instance->UserAccountGet($row->login, $demo_user_server);
                $mt_demo_accounts[$row->login] = array('login' => $demo_user_server->Login, 'Balance' => $demo_user_server->Balance, 'Profit' => $demo_user_server->Profit);
            }

            $response = $instance->Connect(LIVE_IP, LIVE_PORT, LIVE_TIMEOUT, LIVE_LOGIN, LIVE_PASSWORD);
            $live_account = $this->MModel->get_mt_live_account_details($id);
            $mt_live_accounts = [];
            foreach ($live_account as $rows) {
                $instance->UserAccountGet($rows->login, $live_user_server);
                $mt_live_accounts[$rows->login] = array('login' => $live_user_server->Login, 'Balance' => $live_user_server->Balance, 'Profit' => $live_user_server->Profit);
            }


            $data['mt_demo_accounts'] = $mt_demo_accounts;
            $data['mt_live_accounts'] = $mt_live_accounts;
            $data['template'] = 'dashboard_client';
        }
        $this->load->view('template/dashboard_template', $data);
    }
    public function settings()
    {
        if ($this->session->userdata('position') != 1) {
            redirect('login');
        }
        $breadcrumb = array(
            0 => array('title' => 'Home', 'status' => 0, 'link' => base_url('home')),
            1 => array('title' => 'General Settings', 'status' => 1),
        );
        $data['breadcrumb'] = bread_crump_maker($breadcrumb);
        $data['subtitle'] = 'Settings';
        $data['template'] = 'modules/general_settings/settings';
        $this->load->view('template/dashboard_template', $data);
    }
}
