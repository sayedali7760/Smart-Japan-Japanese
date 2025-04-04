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
class Mt_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_my_mt_details($id)
    {
        $this->db->select('a.*');
        $this->db->from('accounts AS a');
        $this->db->where('a.user_id', $id);
        $query = $this->db->get()->result();
        return $query;
    }
    public function view_client_accounts($id)
    {
        $this->db->select('a.*');
        $this->db->from('accounts AS a');
        $this->db->where('a.user_id', $id);
        $this->db->where('a.server', 'Demo');
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_live_accounts()
    {
        $this->db->select('a.*, c.name');
        $this->db->from('accounts AS a');
        $this->db->join('clients AS c', 'c.id = a.user_id', 'left');
        $this->db->where('a.server', 'Live');
        $this->db->order_by('a.user_id', "desc");
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_demo_accounts()
    {
        $this->db->select('a.*, c.name');
        $this->db->from('accounts AS a');
        $this->db->join('clients AS c', 'c.id = a.user_id', 'left');
        $this->db->where('a.server', 'Demo');
        $this->db->order_by('a.user_id', "desc");
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_mt_demo_account_details($id)
    {
        $this->db->select('a.*');
        $this->db->from('accounts AS a');
        $this->db->where('a.server', 'Demo');
        $this->db->where('a.user_id', $id);
        $this->db->order_by('a.user_id', "desc");
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_mt_live_account_details($id)
    {
        $this->db->select('a.*');
        $this->db->from('accounts AS a');
        $this->db->where('a.server', 'Live');
        $this->db->where('a.user_id', $id);
        $this->db->order_by('a.user_id', "desc");
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_demoaccount_client($client_id)
    {
        $this->db->select('a.*');
        $this->db->from('accounts AS a');
        $this->db->where('a.server', 'Demo');
        $this->db->where('a.user_id', $client_id);
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_clientdata($client_id)
    {
        $this->db->select('c.*');
        $this->db->from('clients AS c');
        $this->db->where('c.id', $client_id);
        $query = $this->db->get()->row_array();
        return $query;
    }
    public function insert_demo($data_user_array)
    {
        if ($this->db->insert('accounts', $data_user_array)) {
            return true;
        }
    }
    public function insert_live($data_user_array)
    {
        if ($this->db->insert('accounts', $data_user_array)) {
            return true;
        }
    }
    public function get_currency()
    {
        $this->db->select('c.*');
        $this->db->from('currency AS c');
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_group()
    {
        $this->db->select('g.*');
        $this->db->from('mt_groups AS g');
        $query = $this->db->get()->result();
        return $query;
    }
    public function insert_group($data_array)
    {
        if ($this->db->insert('mt_groups', $data_array)) {
            return true;
        }
    }
    public function update_group_status($id, $data)
    {
        $this->db->update('mt_groups', $data, 'id=' . $id . '');
        return true;
    }
    public function get_group_data($id)
    {
        $this->db->select('g.*');
        $this->db->from('mt_groups AS g');
        $this->db->where('g.id', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }
    public function update_group($id, $data)
    {
        $this->db->update('mt_groups', $data, 'id=' . $id . '');
        return true;
    }
}
