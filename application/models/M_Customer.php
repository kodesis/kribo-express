<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Customer extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function list_customer()
    {
        return $this->db->order_by('nama_customer', 'ASC')->get('customer')->result();
    }

    public function insert($data)
    {
        return $this->db->insert('customer', $data);
    }

    public function update($data, $old_slug)
    {
        $this->db->where('slug', $old_slug);
        return $this->db->update('customer', $data);
    }

    public function show($id)
    {
        return $this->db->where('slug', $id)->get('customer')->row_array();
    }

    public function is_available($id)
    {
        return $this->db->where('slug', $id)->get('customer')->num_rows();
    }

    public function count($keyword)
    {
        if ($keyword) {
            $this->db->group_start(); // Mulai grup kondisi
            $this->db->like('nama_customer', $keyword);
            $this->db->or_like('alamat_customer', $keyword);
            $this->db->group_end(); // Akhiri grup kondisi
        }

        return $this->db->from('customer')->count_all_results();
    }

    public function listCustomerPaginate($limit, $from, $keyword)
    {
        if ($keyword) {
            $this->db->group_start(); // Mulai grup kondisi
            $this->db->like('nama_customer', $keyword);
            $this->db->or_like('alamat_customer', $keyword);
            $this->db->group_end(); // Akhiri grup kondisi
        }

        return $this->db->from('customer')->order_by('nama_customer', 'ASC')->limit($limit, $from)->get()->result();
    }
}
