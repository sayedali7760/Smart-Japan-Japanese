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
class Client_model extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
    }

    public function insert($data)
    {
        if ($this->db->insert('clients', $data)) {
            return TRUE;
        }
    }

    public function get_details()
    {
        $this->db->select('c.*, d.account_verify');
        $this->db->from('clients AS c');
        $this->db->join('documents AS d', 'd.client_id = c.id', 'left');
        $this->db->order_by('c.id', "desc");

        $query = $this->db->get()->result();
        return $query;
    }

    public function get_client_details($client_id)
    {
        $query = $this->db->select('C.*')
            ->from('clients as C')
            ->where('C.id', $client_id)
            ->get()
            ->row_array();
        return $query;
    }

    public function change_status($data, $client_id)
    {
        $this->db->update('clients', $data, 'id=' . $client_id . '');
        return true;
    }

    public function get_countries()
    {
        $this->db->from('country');
        $this->db->order_by('country_name', "asc");
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_client_document_details($client_id)
    {
        $this->db->from('documents');
        $this->db->where('client_id', $client_id);
        $query = $this->db->get()->row_array();
        return $query;
    }
}
