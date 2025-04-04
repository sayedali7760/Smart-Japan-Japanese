<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['ecomm_login'])) {
            redirect('login');
        }
        $this->load->model('Transactions_model', 'TModel');
        $this->load->model('general_settings/Mt_model', 'Mt_model');
    }
    public function view_succesfull_deposit()
    {
        if ($this->session->userdata['template_type'] != 1) {
            redirect('error');
        }
        $data['title'] = 'Transactions';
        $data['subtitle'] = 'Successful Deposits';
        $data['deposit_data'] = $this->TModel->view_succesfull_deposit();
        $data['template'] = 'modules/transactions/view_deposit';
        $this->load->view('template/dashboard_template', $data);
    }
    public function deposit_client_account()
    {
        $data['title'] = 'Transactions';
        $data['subtitle'] = 'Deposit';
        $client_id = $this->session->userdata('id');
        $data['account_details'] = $this->Mt_model->view_client_accounts($client_id);
        $data['template'] = 'modules/transactions/client_deposit';
        $this->load->view('template/dashboard_template', $data);
    }
    public function withdraw_client_account()
    {
        $data['title'] = 'Transactions';
        $data['subtitle'] = 'Withdraw';
        $client_id = $this->session->userdata('id');
        $data['account_details'] = $this->Mt_model->view_client_accounts($client_id);
        $data['template'] = 'modules/transactions/client_withdraw';
        $this->load->view('template/dashboard_template', $data);
    }
    public function transfer_client_account()
    {
        $data['title'] = 'Transactions';
        $data['subtitle'] = 'Transfer';
        $client_id = $this->session->userdata('id');
        $data['account_details'] = $this->Mt_model->view_client_accounts($client_id);
        $data['template'] = 'modules/transactions/client_transfer';
        $this->load->view('template/dashboard_template', $data);
    }
    public function get_mtaccount_details()
    {
        $account = $this->input->post('account');

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
        $instance->UserAccountGet($account, $account_details);
        $account_data['Equity'] = number_format($account_details->Equity, 2);
        $account_data['MarginFree'] = number_format($account_details->MarginFree, 2);
        $account_data['MarginLeverage'] = number_format($account_details->MarginLeverage, 2);
        $account_data['Balance'] = number_format($account_details->Balance, 2);

        echo json_encode(array('status' => 1, 'account_data' => $account_data));
        return;

        // $mt_demo_accounts[$row->login] = array('login' => $demo_user_server->Login, 'Balance' => $demo_user_server->Balance, 'Profit' => $demo_user_server->Profit);
    }
    public function transfer_client_save()
    {

        $from_account = $this->input->post('account');
        $to_account = $this->input->post('to_account');
        $amount = $this->input->post('amount');
        $client_id = $this->session->userdata('id');

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
        $instance->UserAccountGet($from_account, $from_account_details);
        $instance->UserAccountGet($to_account, $to_account_details);

        $from_account_data['Equity'] = $from_account_details->Equity;
        // $from_account_data['MarginFree'] = $from_account_details->MarginFree;
        // $from_account_data['MarginLeverage'] = $from_account_details->MarginLeverage;
        // $from_account_data['Balance'] = $from_account_details->Balance;
        // $mtAmount_from = $from_account_data['Balance'] - $amount;
        $result = $instance->TradeBalance($from_account, MTEnDealAction::DEAL_BALANCE,  -$amount, 'Web Transfer', $ticket);
        // $to_account_data['Equity'] = $to_account_details->Equity;
        // $to_account_data['MarginFree'] = $to_account_details->MarginFree;
        // $to_account_data['MarginLeverage'] = $to_account_details->MarginLeverage;
        // $to_account_data['Balance'] = $to_account_details->Balance;
        // $mtAmount_to = $to_account_data['Balance'] + $amount;
        $result = $instance->TradeBalance($to_account, MTEnDealAction::DEAL_BALANCE,  $amount, 'Web Transfer', $ticket);

        if ($amount >= $from_account_data['Equity']) {
            echo json_encode(array('status' => 3));
            return;
        }

        $deposit_transfer = array(
            'user_id' => $client_id,
            'type' => 'own deposit',
            'method' => 'own transfer',
            'account_id' => $from_account,
            'opt_account_id' => $to_account,
            'amount' => $amount,
            'status' => 'success',
            'status_finished' => 'approved',
            'comment' => 'Own Transfer',
        );
        $withdraw_transfer = array(
            'user_id' => $client_id,
            'type' => 'own withdrawal',
            'method' => 'own transfer',
            'account_id' => $to_account,
            'opt_account_id' => $from_account,
            'amount' => $amount,
            'status' => 'success',
            'status_finished' => 'approved',
            'comment' => 'Own Transfer',
        );

        if ($this->TModel->insert_transaction($deposit_transfer)) {
            $this->TModel->insert_transaction($withdraw_transfer);
            echo json_encode(array('status' => 1));
            return;
        } else {
            echo json_encode(array('status' => 0));
            return;
        }
    }
    public function withdraw_client_save()
    {
        $account = $this->input->post('account');
        $method = $this->input->post('method');
        $currency = $this->input->post('currency');
        $amount = $this->input->post('amount');
        $client_id = $this->session->userdata('id');

        if ($method == 1) {
            $method_name = 'nexus';
        } else if ($method == 2) {
            $method_name = 'sticpay';
        } else if ($method == 3) {
            $method_name = 'bank';
        }
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
        $instance->UserAccountGet($account, $account_details);
        $account_data['Equity'] = $account_details->Equity;
        $account_data['MarginFree'] = $account_details->MarginFree;
        $account_data['MarginLeverage'] = $account_details->MarginLeverage;
        $account_data['Balance'] = $account_details->Balance;

        if ($amount >= $account_data['Equity']) {
            echo json_encode(array('status' => 3));
            return;
        }

        $withdrawal = array(
            'user_id' => $client_id,
            'type' => 'withdraw',
            'method' => $method_name,
            'account_id' => $account,
            'currency' => $currency,
            'amount' => $amount,
            'amount_finished' => $amount,
            'status' => 'new',
            'status_finished' => 'approved',
            'comment' => 'Withdrawal',
            'wallet_address' => '',
            'nexus_status' => '',
        );

        if ($this->TModel->insert_transaction($withdrawal)) {
            $mtAmount = $account_data['Equity'] - $amount;
            $login = $account;
            $result = $instance->TradeBalance($login, MTEnDealAction::DEAL_BALANCE,  $mtAmount, 'Nexus', $ticket);
            echo json_encode(array('status' => 1));
            return;
        } else {
            echo json_encode(array('status' => 0));
            return;
        }
    }
    public function deposit_client_save()
    {
        $account = $this->input->post('account');
        $method = $this->input->post('method');
        $currency = $this->input->post('currency');
        $client_id = $this->session->userdata('id');
        // Nexus Pay
        if ($method == 1) {

            $data_array = array(
                'user_id' => $client_id,
                'type' =>  'deposit',
                'method' => 'nexus',
                'account_id' => $account,
                'currency' => 'USD',
                'amount' => 0,
                'status' => 'pending',
                'status_finished' => 'approved',
                'comment' => 'Deposit [nexus]',
                'wallet_address' => '',
                'nexus_status' => '',
            );
            if ($this->TModel->insert_transaction($data_array)) {
                $last_id = $this->db->insert_id();
                $transaction_id = '' . $last_id . '';
                $payment_route_id = "37c01844-5512-4f91-94a2-54e1ad70e12b";

                $url = 'https://vakotrade-nexus.cryptosrvc.com/graphql';

                $query = 'query ($network: String, $currency_id: String!, $reference: String, $payment_route_id: String!) {
                    deposit_address_crypto(network: $network, currency_id: $currency_id, reference: $reference, payment_route_id: $payment_route_id) {
                    deposit_address_crypto_id
                    currency_id
                    address
                    address_tag_type
                    address_tag_value
                    network
                    created_at
                    updated_at
                    }}';
                $variables = [
                    "currency_id" => "USDT",
                    "network" => "Tron",
                    "reference" => $transaction_id,
                    "payment_route_id" => $payment_route_id
                ];

                $data = json_encode([
                    "query" => $query,
                    "variables" => $variables
                ]);

                $headers = [
                    "Authorization: Bearer eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6ImFlNzljYWJiYWNjYjgzYmUwN2FiMDk3YzU4MjEyMjliIn0.eyJhcGlfa2V5X2lkIjoiYWFkMWI3MjctYjYzMy00MjFmLTlkMmUtMTdjNzdhYzM2OGMzIiwic3ViIjoiYjY4MWUwY2ItYWZlNi00OGNkLTgyNjUtM2Y4MjNiNzdiYzg5Iiwicm9sZSI6InRyYWRlciIsImV4Y2hhbmdlIjoiTkVYVVNWNCIsImlzcyI6Imh0dHBzOi8vdmFrb3RyYWRlLW5leHVzLmNyeXB0b3NydmMuY29tIiwiaWF0IjoxNzM1ODAyNjQ3LCJleHAiOjE3NjczMTIwMDB9.ugPj_9BtBO2SFlNwpiMS3So6uViTG9rH7CrKUFvp-guJhwFEGpO4oXt2XHHZWcQS32l8MOATzwiGZ8Q96--Xd-3LbtGtuDQ8VIVbvkzSWr9TLd21O61rr13oLWQWaw4YyLfQ_34Y4KGY8YDoVgehueOdfJ4yT-r-4ZNdZ97RqToaAOZvzdIbcsKFt3rB5qLs3Rgi3QcqU1ass1PLLVSMnqPi_ZXj-LFp0lRJqDZX0ITyF4biwMT_5MV87U0IMjWsGxpdnr26SEMbqGMkRAMjOMNjlnL117A8FHklO8h_EqRUnGalYi04aDUBBDjpwpmRZwIx9GHIXxE-4TCGqfbMm3Eyh8SqIUktwHVLkydw7jH5FBjOsjqV9JAr_Zz9UkhYraZOcEeDHOll5t1DlZuS1szS5lN_sWagPQRAOkml2Zjw3BoUqljrVrCer4rg_-eSwUycNUMaEAj_tVU7WwwoJ1S9-IVjCe0FFZMyUZlLLHxA5rLLlJU1lk2fBA-aqaxukUkF-G2gd0vCh6AZU_KwReJa438aMoz3xu-2uBk8CFCexuntVjXwKibbuzFbd-n1ZEQtAFq2OK0y-IeXX1hZbk3m7SS6sNJs_xKMzImvFJfLSyFsueNd1F3apRT2KkRwcoZpaskOQU9lBQnzvXYz4ru_c1QJJ8j8KH4ml5OelG0",
                    "Content-Type: application/json"
                ];

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $response = curl_exec($ch);
                curl_close($ch);

                $result_data = json_decode($response, true);
                $wallet_address = $result_data['data']['deposit_address_crypto']['address'];
                $data_update_array = array('wallet_address' => $wallet_address, 'nexus_status' => 1);
                $result = $this->TModel->update_transaction($data_update_array, $transaction_id);
                //$wallet_address = 'TRFDGHHSHJHJSUUJSKJKJDKLKS';
                echo json_encode(array('status' => 1, 'wallet_address' => $wallet_address));
                return;
                // $wallet_address = 'TRFDGHHSHJHJSUUJSKJKJDKLKS';
                // echo json_encode(array('status' => 1, 'wallet_address' => $wallet_address));
                // return;
            } else {
                echo json_encode(array('status' => 0));
                return;
            }
            //     $transaction_id = "test-123"; // Get this dynamically
            //     $payment_route_id = "37c01844-5512-4f91-94a2-54e1ad70e12b";

            //     $url = 'https://vakotrade-nexus.cryptosrvc.com/graphql';

            //     $query = 'query ($network: String, $currency_id: String!, $reference: String, $payment_route_id: String!) {
            //     deposit_address_crypto(network: $network, currency_id: $currency_id, reference: $reference, payment_route_id: $payment_route_id) {
            //     deposit_address_crypto_id
            //     currency_id
            //     address
            //     address_tag_type
            //     address_tag_value
            //     network
            //     created_at
            //     updated_at
            //     }}';
            //     $variables = [
            //         "currency_id" => "USDT",
            //         "network" => "Tron",
            //         "reference" => $transaction_id,
            //         "payment_route_id" => $payment_route_id
            //     ];

            //     $data = json_encode([
            //         "query" => $query,
            //         "variables" => $variables
            //     ]);

            //     $headers = [
            //         "Authorization: Bearer eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6ImFlNzljYWJiYWNjYjgzYmUwN2FiMDk3YzU4MjEyMjliIn0.eyJhcGlfa2V5X2lkIjoiYWFkMWI3MjctYjYzMy00MjFmLTlkMmUtMTdjNzdhYzM2OGMzIiwic3ViIjoiYjY4MWUwY2ItYWZlNi00OGNkLTgyNjUtM2Y4MjNiNzdiYzg5Iiwicm9sZSI6InRyYWRlciIsImV4Y2hhbmdlIjoiTkVYVVNWNCIsImlzcyI6Imh0dHBzOi8vdmFrb3RyYWRlLW5leHVzLmNyeXB0b3NydmMuY29tIiwiaWF0IjoxNzM1ODAyNjQ3LCJleHAiOjE3NjczMTIwMDB9.ugPj_9BtBO2SFlNwpiMS3So6uViTG9rH7CrKUFvp-guJhwFEGpO4oXt2XHHZWcQS32l8MOATzwiGZ8Q96--Xd-3LbtGtuDQ8VIVbvkzSWr9TLd21O61rr13oLWQWaw4YyLfQ_34Y4KGY8YDoVgehueOdfJ4yT-r-4ZNdZ97RqToaAOZvzdIbcsKFt3rB5qLs3Rgi3QcqU1ass1PLLVSMnqPi_ZXj-LFp0lRJqDZX0ITyF4biwMT_5MV87U0IMjWsGxpdnr26SEMbqGMkRAMjOMNjlnL117A8FHklO8h_EqRUnGalYi04aDUBBDjpwpmRZwIx9GHIXxE-4TCGqfbMm3Eyh8SqIUktwHVLkydw7jH5FBjOsjqV9JAr_Zz9UkhYraZOcEeDHOll5t1DlZuS1szS5lN_sWagPQRAOkml2Zjw3BoUqljrVrCer4rg_-eSwUycNUMaEAj_tVU7WwwoJ1S9-IVjCe0FFZMyUZlLLHxA5rLLlJU1lk2fBA-aqaxukUkF-G2gd0vCh6AZU_KwReJa438aMoz3xu-2uBk8CFCexuntVjXwKibbuzFbd-n1ZEQtAFq2OK0y-IeXX1hZbk3m7SS6sNJs_xKMzImvFJfLSyFsueNd1F3apRT2KkRwcoZpaskOQU9lBQnzvXYz4ru_c1QJJ8j8KH4ml5OelG0",
            //         "Content-Type: application/json"
            //     ];

            //     $ch = curl_init();
            //     curl_setopt($ch, CURLOPT_URL, $url);
            //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //     curl_setopt($ch, CURLOPT_POST, true);
            //     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            //     $response = curl_exec($ch);
            //     curl_close($ch);

            //     $result_data = json_decode($response, true);
            //     $wallet_address = $result_data['data']['deposit_address_crypto']['address'];
            // $wallet_address = 'TRFDGHHSHJHJSUUJSKJKJDKLKS';
            // echo json_encode(array('status' => 1, 'wallet_address' => $wallet_address));
            // return;
            // Debugging or logging
            //log_message('info', 'GraphQL Response: ' . print_r($result, true));

            // Send JSON response
            //echo json_encode($result);
        }
        // SticPay
        if ($method == 2) {
        }
        // if ($this->MModel->insert_group($data_array)) {
        //     echo json_encode(array('status' => 1));
        //     return;
        // } else {
        //     echo json_encode(array('status' => 2));
        //     return;
        // }
    }
    public function view_withdrawal()
    {
        if ($this->session->userdata['template_type'] != 1) {
            redirect('error');
        }
        $data['title'] = 'Transactions';
        $data['subtitle'] = 'Successful Withdrawals';
        $data['withdraw_data'] = $this->TModel->get_success_withdraw_details();
        $data['template'] = 'modules/transactions/view_withdraw';
        $this->load->view('template/dashboard_template', $data);
    }
    public function my_transaction_details()
    {
        $data['title'] = 'Reports';
        $data['subtitle'] = 'My Transactions';
        $client_id = $this->session->userdata('id');
        $data['transaction_data'] = $this->TModel->get_transaction_details($client_id);
        $data['template'] = 'modules/transactions/show_transaction_history';
        $this->load->view('template/dashboard_template', $data);
    }
    public function internal_transactions()
    {
        if ($this->session->userdata['template_type'] != 1) {
            redirect('error');
        }
        $data['title'] = 'Transactions';
        $data['subtitle'] = 'Internal Transfers';
        $data['transfer_data'] = $this->TModel->get_success_internal_transfers();
        $data['template'] = 'modules/transactions/internal_transfer';
        $this->load->view('template/dashboard_template', $data);
    }

    public function pending_deposits()
    {
        if ($this->session->userdata['template_type'] != 1) {
            redirect('error');
        }
        $data['title'] = 'Transactions';
        $data['subtitle'] = 'Pending Deposits';
        $data['pending_data'] = $this->TModel->get_pending_deposit_details();
        $data['template'] = 'modules/transactions/pending_transactions';
        $this->load->view('template/dashboard_template', $data);
    }
    public function pending_withdrawal()
    {
        if ($this->session->userdata['template_type'] != 1) {
            redirect('error');
        }
        $data['title'] = 'Transactions';
        $data['subtitle'] = 'Pending Withdrawals';
        $data['pending_data'] = $this->TModel->get_pending_withdraw_details();
        $data['template'] = 'modules/transactions/pending_withdraw';
        $this->load->view('template/dashboard_template', $data);
    }
    public function rejected_transactions()
    {
        if ($this->session->userdata['template_type'] != 1) {
            redirect('error');
        }
        $data['title'] = 'Transactions';
        $data['subtitle'] = 'Rejected Transactions';
        $data['rejected_data'] = $this->TModel->get_rejected_transaction_details();
        $data['template'] = 'modules/transactions/rejected_transactions';
        $this->load->view('template/dashboard_template', $data);
    }
    public function approve_deposit()
    {
        if ($this->session->userdata['template_type'] != 1) {
            redirect('error');
        }
        $transaction_id = $this->input->post('transaction_id');
        $data = array('status' => 'success', 'status_finished' => 'approved');
        if ($this->TModel->approve_deposit($data, $transaction_id)) {
            echo json_encode(array('status' => 1));
            return;
        } else {
            return false;
        }
    }
    public function reject_deposit()
    {
        if ($this->session->userdata['template_type'] != 1) {
            redirect('error');
        }
        $transaction_id = $this->input->post('transaction_id');
        $data = array('status' => 'success', 'status_finished' => 'declined');
        if ($this->TModel->reject_deposit($data, $transaction_id)) {
            echo json_encode(array('status' => 1));
            return;
        } else {
            return false;
        }
    }
    public function reject_withdraw()
    {
        if ($this->session->userdata['template_type'] != 1) {
            redirect('error');
        }
        $transaction_id = $this->input->post('transaction_id');
        $data = array('status_finished' => 'declined');
        if ($this->TModel->reject_withdraw($data, $transaction_id)) {
            echo json_encode(array('status' => 1));
            return;
        } else {
            return false;
        }
    }
    public function process_deposit()
    {
        if ($this->session->userdata['template_type'] != 1) {
            redirect('error');
        }
        $transaction_id = $this->input->post('transaction_id');
        $data = array('status' => 'success', 'status_finished' => 'closed', 'date_modified' => date('Y-m-d H:i:s'));
        if ($this->TModel->process_deposit($data, $transaction_id)) {

            $transaction_data = $this->TModel->get_transactions_unique($transaction_id);
            $mtAmount = $transaction_data['amount'];
            require_once(APPPATH . 'MT/mt5_api/mt5_api.php');
            $instance = new MTWebAPI();
            // $response = $instance->Connect(LIVE_IP, LIVE_PORT, LIVE_TIMEOUT, LIVE_LOGIN, LIVE_PASSWORD);
            $response = $instance->Connect(DEMO_IP, DEMO_PORT, DEMO_TIMEOUT, DEMO_LOGIN, DEMO_PASSWORD);
            if ($response !== MTRetCode::MT_RET_OK) {
                // echo "Failed to connect to MetaTrader 5 server. Error code: " . $response;
                echo json_encode(array('status' => 2));
                return;
            } else {
                $mtAmount = $transaction_data['amount'];
                // $login = $transaction_data['login'];
                $login = 1105391;
                $result = $instance->TradeBalance($login, MTEnDealAction::DEAL_BALANCE,  $mtAmount, 'Nexus', $ticket);
                echo json_encode(array('status' => 1));
                return;
            }
        } else {
            echo json_encode(array('status' => 2));
            return;
        }
    }
    public function process_withdraw()
    {
        if ($this->session->userdata['template_type'] != 1) {
            redirect('error');
        }
        $transaction_id = $this->input->post('transaction_id');
        $data = array('status_finished' => 'closed');
        if ($this->TModel->process_withdraw($data, $transaction_id)) {

            $transaction_data = $this->TModel->get_transactions_unique($transaction_id);
            $mtAmount = $transaction_data['amount'];
            require_once(APPPATH . 'MT/mt5_api/mt5_api.php');
            $instance = new MTWebAPI();
            // $response = $instance->Connect(LIVE_IP, LIVE_PORT, LIVE_TIMEOUT, LIVE_LOGIN, LIVE_PASSWORD);
            $response = $instance->Connect(DEMO_IP, DEMO_PORT, DEMO_TIMEOUT, DEMO_LOGIN, DEMO_PASSWORD);
            if ($response !== MTRetCode::MT_RET_OK) {
                // echo "Failed to connect to MetaTrader 5 server. Error code: " . $response;
                echo json_encode(array('status' => 2));
                return;
            } else {
                $mtAmount = $transaction_data['amount'];
                // $login = $transaction_data['login'];
                $login = 1105391;
                $result = $instance->TradeBalance($login, MTEnDealAction::DEAL_BALANCE,  -$mtAmount, 'Nexus', $ticket);
                echo json_encode(array('status' => 1));
                return;
            }
        } else {
            echo json_encode(array('status' => 2));
            return;
        }
    }
}
