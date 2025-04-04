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
class Organization_model extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
    }
    public function get_details()
    {
        $this->db->from('organization');
        $this->db->order_by('name', "asc");
        $query = $this->db->get()->result();
        return $query;
    }
    public function insert($data)
    {
        if ($this->db->insert('organization', $data)) {
            return TRUE;
        }
    }
    public function update($data, $organization_id)
    {
        $this->db->update('organization', $data, 'organization_id=' . $organization_id . '');
        return true;
    }
    public function change_status($data, $organization_id)
    {
        $this->db->update('organization', $data, 'organization_id=' . $organization_id . '');
        return true;
    }
}
