<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client_crm extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['ecomm_login'])) {
            redirect('login');
        }
        $this->load->model('general_settings/Client_crm_model', 'CModel');
    }
    public function my_profile()
    {

        $data['title'] = 'Client';
        $data['subtitle'] = 'My Profile';
        $id = $this->session->userdata['id'];
        $data['user_data'] = $this->CModel->get_details($id);
        $data['documents_data'] = $this->CModel->get_documents_details($id);
        $count_query = $this->db->get_where('documents', "client_id=$id");
        $data['count_qry'] = $count_query->num_rows();
        $data['template'] = 'modules/general_settings/my_profile';
        $this->load->view('template/dashboard_template', $data);
    }
    public function update_doc_status()
    {
        $client_id = $this->input->post('client_id');
        $doc_id = $this->input->post('doc_id');
        $status = $this->input->post('status');
        if ($doc_id == 1) {
            $data['eid_status'] = $status;
        }
        if ($doc_id == 2) {
            $data['pass_status'] = $status;
        }
        if ($doc_id == 3) {
            $data['bank_status'] = $status;
        }
        if ($doc_id == 4) {
            $data['others_status'] = $status;
        }
        if ($this->CModel->update_document_status($client_id, $data)) {
            echo json_encode(array('status' => 1));
            return;
        } else {
            return false;
        }
    }
    public function activate_client()
    {
        $client_id = $this->input->post('client_id');
        $data['account_verify'] = 1;
        if ($this->CModel->activate_client($client_id, $data)) {
            echo json_encode(array('status' => 1));
            return;
        } else {
            return false;
        }
    }
    public function client_verification()
    {
        $data['title'] = 'Client';
        $data['subtitle'] = 'Client Verify';
        $data['client_data'] = $this->CModel->get_notverified_clients();
        $data['template'] = 'modules/general_settings/show_notverified_client';
        $this->load->view('template/dashboard_template', $data);
    }
    public function update_password()
    {
        $id = $this->session->userdata['id'];
        $password = md5($this->input->post('password'));
        $data = array('password' => $password);
        if ($this->CModel->update_password($id, $data)) {
            echo json_encode(array('status' => 1));
            return;
        } else {
            return false;
        }
    }
    public function update_thumbnail()
    {
        $id = $this->session->userdata['id'];
        $uploadPath = 'uploads';

        $file_id = 'avatar';
        $files_id = $this->fileUpload($uploadPath, $file_id);
        $data['file'] = $files_id;
        if ($this->CModel->thumbnail_update($data, $id)) {
            echo json_encode(array('status' => 1));
            return;
        } else {
            echo json_encode(array('status' => 0));
            return;
        }
    }
    public function upload_doc()
    {
        $id = $this->session->userdata['id'];
        $data['client_id'] = $id;
        $uploadPath = 'uploads';

        $file_id = 'files_id';
        $files_id = $this->fileUpload($uploadPath, $file_id);
        if ($files_id != null) {
            $data['eid'] = $files_id;
            $data['eid_status'] = 1;
        }
        $file_pass = 'files_pass';
        $files_pass = $this->fileUpload($uploadPath, $file_pass);
        if ($files_pass != null) {
            $data['passport'] = $files_pass;
            $data['pass_status'] = 1;
        }
        $file_stmt = 'files_bank';
        $files_stmt = $this->fileUpload($uploadPath, $file_stmt);
        if ($files_stmt != null) {
            $data['bank'] = $files_stmt;
            $data['bank_status'] = 1;
        }
        $file_others = 'files_other';
        $files_others = $this->fileUpload($uploadPath, $file_others);
        if ($files_others != null) {
            $data['others'] = $files_others;
            $data['others_status'] = 1;
        }

        $count_qry = $this->db->get_where('documents', "client_id=$id");
        if ($count_qry->num_rows() > 0) {
            if ($this->CModel->upload_document_update($data, $id)) {
                echo json_encode(array('status' => 1, 'message' => 'Document Updated successfully.', 'view' => $this->load->view('modules/general_settings/my_profile', $data, TRUE)));
                return;
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Failed to update document.'));
                return;
            }
        } else {
            if ($this->CModel->doc_upload($data)) {
                echo json_encode(array('status' => 1, 'message' => 'Document Updated successfully.', 'view' => $this->load->view('modules/general_settings/my_profile', $data, TRUE)));
                return;
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Failed to save document.'));
                return;
            }
        }
    }


    public function fileUpload($uploadPath, $uploadfile = '')
    {
        $uploadData = array(); // Store uploaded file names

        if (!isset($_FILES[$uploadfile])) {
            log_message('error', "File input {$uploadfile} not found in \$_FILES array.");
            return null;
        }

        $filesCount = count($_FILES[$uploadfile]['name']);

        if ($filesCount > 0) {
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|doc|docx|pdf';
            $this->load->library('upload', $config);

            for ($i = 0; $i < $filesCount; $i++) {
                if (!empty($_FILES[$uploadfile]['name'][$i])) {
                    $_FILES['file']['name'] = $_FILES[$uploadfile]['name'][$i];
                    $_FILES['file']['type'] = $_FILES[$uploadfile]['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES[$uploadfile]['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES[$uploadfile]['error'][$i];
                    $_FILES['file']['size'] = $_FILES[$uploadfile]['size'][$i];

                    if ($this->upload->do_upload('file')) {
                        $fileData = $this->upload->data();
                        $uploadData[] = $fileData['file_name'];
                    } else {
                        log_message('error', "File upload failed: " . $this->upload->display_errors());
                    }
                }
            }
        }

        return !empty($uploadData) ? implode(',', $uploadData) : null;
    }
}
