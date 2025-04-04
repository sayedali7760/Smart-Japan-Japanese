<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // if (!isset($this->session->userdata['bmhr_login'])) {
        //     redirect('login');
        // }
        $this->load->model('Report_model', 'RModel');
        $this->load->model('general_settings/Usermanagement_model', 'UMModel');
        $this->load->model('requisition/Requisition_model', 'RQModel');
    }
    public function settings()
    {
        $breadcrumb = array(
            0 => array('title' => 'Home', 'status' => 0, 'link' => base_url('home')),
            1 => array('title' => 'Reports', 'status' => 1),
        );
        $data['breadcrumb'] = bread_crump_maker($breadcrumb);
        $data['subtitle'] = 'Reports';
        $data['template'] = 'modules/reports/settings';
        $this->load->view('template/dashboard_template', $data);
    }
    public function requisition_show()
    {
        $data['subtitle'] = 'Requisition Details';
        $data['institution'] = $this->UMModel->get_institution();
        $data['positions_data'] = $this->RQModel->get_positions();
        echo json_encode(array('view' => $this->load->view('modules/reports/requisition_show', $data, true)));
        return;
    }
    public function resume_report_show()
    {
        $data['subtitle'] = 'Resume Details';
        $data['institution'] = $this->UMModel->get_institution();
        $data['positions_data'] = $this->RQModel->get_positions();
        echo json_encode(array('view' => $this->load->view('modules/reports/resume_report_show', $data, true)));
        return;
    }
    public function interview_schedule_report_show()
    {
        $data['subtitle'] = 'Interview Scheduled';
        $data['institution'] = $this->UMModel->get_institution();
        $data['positions_data'] = $this->RQModel->get_positions();
        echo json_encode(array('view' => $this->load->view('modules/reports/interview_schedule_report_show', $data, true)));
        return;
    }
    public function md_approve_report_show()
    {
        $data['subtitle'] = 'Md Approve/Rejected';
        $data['institution'] = $this->UMModel->get_institution();
        $data['positions_data'] = $this->RQModel->get_positions();
        echo json_encode(array('view' => $this->load->view('modules/reports/md_approve_report_show', $data, true)));
        return;
    }
    public function requisition_show_pdf()
    {
        $institution = $this->input->post('inst_id');
        $position = $this->input->post('req_for');
        $details_data = $this->RModel->get_requisition($institution, $position);
        if (!empty($details_data)) {

            $data['details_data'] = $details_data;
            $data['user_name'] = $this->session->userdata('user_name');
            $user_id = $this->session->userdata('id');
            $data['title'] = 'Requisition Details';
            $data['bread_crumps'] = 'Reports > Requisition Details';
            $data['filename_report'] = "report_pdf/requisition_details_" . $user_id . ".pdf";
            $data['viewname'] = 'modules/reports/requisition_pdf';
            $data['collection_date'] =  date('d/M/Y');
            $filename = $this->get_pdf_report($data);
            echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
        } else {
            echo json_encode(array('status' => 3, 'message' => 'No Data Available.'));
        }
    }
    public function resume_show_pdf()
    {
        $position = $this->input->post('req_for');
        $details_data = $this->RModel->get_resume_details($position);
        if (!empty($details_data)) {

            $data['details_data'] = $details_data;
            $data['user_name'] = $this->session->userdata('user_name');
            $user_id = $this->session->userdata('id');
            $data['title'] = 'Resume Details';
            $data['bread_crumps'] = 'Reports > Resume Details';
            $data['filename_report'] = "report_pdf/resume_details_" . $user_id . ".pdf";
            $data['viewname'] = 'modules/reports/resume_pdf';
            $data['collection_date'] =  date('d/M/Y');
            $filename = $this->get_pdf_report($data);
            echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
        } else {
            echo json_encode(array('status' => 3, 'message' => 'No Data Available.'));
        }
    }
    public function interview_schedule_pdf()
    {
        $position = $this->input->post('req_for');
        $institution = $this->input->post('inst_id');
        $details_data = $this->RModel->get_interview_scheduled_details($institution, $position);
        if (!empty($details_data)) {

            $data['details_data'] = $details_data;
            $data['user_name'] = $this->session->userdata('user_name');
            $user_id = $this->session->userdata('id');
            $data['title'] = 'Interview Scheduled Details';
            $data['bread_crumps'] = 'Reports > Interview Scheduled Details';
            $data['filename_report'] = "report_pdf/interview_scheduled_" . $user_id . ".pdf";
            $data['viewname'] = 'modules/reports/interview_scheduled_pdf';
            $data['collection_date'] =  date('d/M/Y');
            $filename = $this->get_pdf_report($data);
            echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
        } else {
            echo json_encode(array('status' => 3, 'message' => 'No Data Available.'));
        }
    }
    public function md_approve_pdf()
    {
        $status = $this->input->post('status');
        $institution = $this->input->post('inst_id');
        $details_data = $this->RModel->get_md_approve_details($institution, $status);
        if (!empty($details_data)) {

            $data['details_data'] = $details_data;
            $data['user_name'] = $this->session->userdata('user_name');
            $user_id = $this->session->userdata('id');
            $data['title'] = 'Md Approve/Reject Details';
            $data['bread_crumps'] = 'Reports > Md Approve/Reject Details';
            $data['filename_report'] = "report_pdf/md_approve_reject_" . $user_id . ".pdf";
            $data['viewname'] = 'modules/reports/md_approve_reject_pdf';
            $data['collection_date'] =  date('d/M/Y');
            $filename = $this->get_pdf_report($data);
            echo json_encode(array('status' => 1, 'message' => $filename . '?' . time()));
        } else {
            echo json_encode(array('status' => 3, 'message' => 'No Data Available.'));
        }
    }

    private function get_pdf_report($data, $orntn = 'P')
    {

        $pdfFilePath = FCPATH . $data['filename_report'];
        ini_set('max_execution_time', 1200);
        ini_set('memory_limit', '32000M');
        ini_set("pcre.backtrack_limit", "5000000");
        $this->load->library('pdf');
        if ($orntn == 'L')
            $pdf = $this->pdf->load_wide(array('mode' => 'utf-8', 'format' => [310, 380], 'orientation' => 'L'));
        else $pdf = $this->pdf->load();
        $html = $this->load->view($data['viewname'], $data, true);
        $pdf->WriteHTML($html);
        $pdf->Output($pdfFilePath, \Mpdf\Output\Destination::FILE);
        return base_url($data['filename_report']);
    }
}
