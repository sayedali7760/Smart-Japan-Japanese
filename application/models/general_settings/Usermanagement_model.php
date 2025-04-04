<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of caste_model
 *
 * @author Seyad ali N
 */
class Usermanagement_model extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
    }
    public function insert($data)
    {
        if ($this->db->insert('user_details', $data)) {
            return TRUE;
        }
    }
    public function update($data, $user_id)
    {
        $this->db->update('user_details', $data, 'id=' . $user_id . '');
        return true;
    }
    public function update_client($data, $client_id)
    {
        $this->db->update('clients', $data, 'id=' . $client_id . '');
        return true;
    }
    public function get_details()
    {
        //$query = $this->db->get('user_details')->result();
        $query = $this->db->select('U.*,R.description')
            ->from('user_details as U')
            // ->where('resumes.resume_id', $last_id)
            ->join('user_roles as R', 'U.position = R.role_id', 'left')
            ->get()
            ->result();
        return $query;
    }
    public function get_user_details($user_id)
    {
        $query = $this->db->select('U.*,R.description')
            ->from('user_details as U')
            ->where('U.id', $user_id)
            ->join('user_roles as R', 'U.position = R.role_id', 'left')
            ->get()
            ->row_array();
        return $query;
    }
    public function get_institution()
    {
        $query = $this->db->select('*')
            ->from('institution as I')
            ->where('I.is_active', 1)
            ->order_by('I.name', 'ASC')
            ->get()
            ->result();
        return $query;
    }
    public function get_user_role()
    {
        $query = $this->db->get_where('user_roles', array('is_active' => 1))->result();
        return $query;
    }
    public function change_status($data, $id)
    {
        $this->db->update('user_details', $data, 'id=' . $id . '');
        return true;
    }
    public function update_user_password($data, $user_id)
    {
        $this->db->update('user_details', $data, 'id=' . $user_id . '');
        return true;
    }
}
