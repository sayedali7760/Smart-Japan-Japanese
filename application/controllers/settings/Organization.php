<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Organization extends CI_Controller
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
        $this->load->model('general_settings/Organization_model', 'OModel');
    }
    public function organization_show()
    {

        $data['title'] = 'General';
        $data['subtitle'] = 'Distributors';
        $data['details_data'] = $this->OModel->get_details($data);
        $data['template'] = 'modules/general_settings/organization/show_organization';
        $this->load->view('template/dashboard_template', $data);
    }

    public function organization_add()
    {

        $data['title'] = 'General';
        $data['subtitle'] = 'Add Distributors';
        $data['template'] = 'modules/general_settings/organization/add_organization';
        $this->load->view('template/dashboard_template', $data);
    }
    public function organization_save()
    {
        $organization = $this->input->post('organization');
        $mail = $this->input->post('mail');
        $mobile = $this->input->post('mobile');
        $data = array('name' => $organization, 'mail_id' => $mail, 'mobile' => $mobile);
        $qry = $this->db->get_where('organization', "name like '$organization'");
        if ($qry->num_rows() > 0) {
            echo json_encode(array('status' => 0, 'view' => $this->load->view('modules/general_settings/organization/add_organization', $data, TRUE)));
            return;
        } else {
            if ($this->OModel->insert($data)) {
                echo json_encode(array('status' => 1, 'view' => $this->load->view('modules/general_settings/organization/add_organization', $data, TRUE)));
                return;
            } else {
                return false;
            }
        }
    }
    public function edit_organization()
    {
        if ($this->input->is_ajax_request() == 1) {
            $onload = $this->input->post('load');
            $data['organization_id'] = $this->input->post('organization_id');
            $data['name'] = $this->input->post('name');
            $data['mail_id'] = $this->input->post('mail_id');
            $data['mobile'] = $this->input->post('mobile');

            if ($onload == 1) {
                $view = $this->load->view('modules/general_settings/organization/edit_organization', $data, TRUE);
                echo json_encode(array('status' => 1, 'message' => 'Data Loaded', 'view' => $view));
                return;
            }
        } else {
            $this->load->view(ERROR_500);
        }
    }
    public function update_organization()
    {
        $organization_id = $this->input->post('organization_id');
        $organization = $this->input->post('organization');
        $mail = $this->input->post('mail');
        $mobile = $this->input->post('mobile');
        $data = array('name' => $organization, 'mail_id' => $mail, 'mobile' => $mobile);
        $qry = $this->db->get_where('organization', "name like '$organization' and organization_id!=$organization_id");
        if ($qry->num_rows() > 0) {
            echo json_encode(array('status' => 0, 'view' => $this->load->view('modules/general_settings/organization/edit_organization', $data, TRUE)));
            return;
        } else {
            if ($this->OModel->update($data, $organization_id)) {
                echo json_encode(array('status' => 1, 'view' => $this->load->view('modules/general_settings/organization/edit_organization', $data, TRUE)));
                return;
            } else {
                return false;
            }
        }
    }
    public function change_status()
    {
        $organization_id = $this->input->post('organization_id');
        $status = $this->input->post('status');
        $data = array('is_active' => $status);
        if ($this->OModel->change_status($data, $organization_id)) {
            echo json_encode(array('status' => 1, 'view' => $this->load->view('modules/general_settings/organization/show_organization', $data, TRUE)));
            return;
        } else {
            return false;
        }
    }
}
