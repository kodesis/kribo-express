<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Booking extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function list_booking()
    {
        return $this->db->from('booking b')->join('customer c', 'b.customer_id = c.id')->order_by('b.id', 'DESC')->get()->result();
    }

    public function insert_batch($data)
    {
        return $this->db->insert_batch('booking', $data);
    }

    public function updateBooking($id, $data)
    {
        return $this->db->where('Id', $id)->update('booking', $data);
    }

    public function is_available($awb)
    {
        $this->queryId($awb);

        return $this->db->get('booking')->num_rows();
    }

    public function detailAwb($awb)
    {
        $this->queryId($awb);

        return $this->db->get('booking')->row_array();
    }

    private function queryId($awb)
    {
        $this->db->where('awb', $awb);
    }

    public function insert_batch_detail_awb($data)
    {
        return $this->db->insert_batch('awb_detail', $data);
    }

    public function delete_detail_awb($id)
    {
        return $this->db->where('awb_id', $id)->delete('awb_detail');
    }

    public function detailItemAwb($id)
    {
        return $this->db->where('awb_id', $id)->get('awb_detail')->result();
    }

    public function list_detail_awb()
    {
        // return $this->db->order_by('slug', 'ASC')->get('awb_detail')->result();

        return $this->db->from('awb_detail ad')->join('booking b', 'ad.awb_id = b.Id', 'left')->order_by('slug', 'ASC')->get()->result();
    }

    public function updateAwbDetail($slug, $data)
    {
        return $this->db->where('slug', $slug)->update('awb_detail', $data);
    }

    public function list_driver()
    {
        return $this->db->where('role_id', '4')->get('user')->result();
    }

    public function getItemAwb($slug)
    {
        return $this->db->where('slug', $slug)->get('awb_detail')->row_array();
    }

    public function cekItemAwb($slug)
    {
        return $this->db->where('slug', $slug)->get('awb_detail')->num_rows();
    }

    public function countItem($keyword)
    {
        if ($keyword) {
            $this->db->like('a.slug', $keyword);
            $this->db->or_like('nama_customer', $keyword);
            $this->db->or_like('alamat_pickup', $keyword);
        }
        return $this->db->select('*, a.slug as slug_item')->from('awb_detail a')->join('booking b', 'a.awb_id = b.Id', 'left')->join('customer c', 'b.customer_id = c.id', 'left')->count_all_results();
    }

    public function listItemAwbPaginate($limit, $from, $keyword)
    {
        if ($keyword) {
            $this->db->like('a.slug', $keyword);
            $this->db->or_like('nama_customer', $keyword);
            $this->db->or_like('alamat_pickup', $keyword);
        }
        return $this->db->select('*, a.slug as slug_item')->from('awb_detail a')->join('booking b', 'a.awb_id = b.Id', 'left')->join('customer c', 'b.customer_id = c.id', 'left')->limit($limit, $from)->get()->result();
    }

    public function dashboard()
    {
        $this->db->select("
        SUM(CASE WHEN status_tracking = 1 THEN 1 ELSE 0 END) AS 'status_1',
        SUM(CASE WHEN status_tracking = 2 THEN 1 ELSE 0 END) AS 'status_2',
        SUM(CASE WHEN status_tracking = 3 THEN 1 ELSE 0 END) AS 'status_3',
        SUM(CASE WHEN status_tracking = 4 THEN 1 ELSE 0 END) AS 'status_4' ");

        return $this->db->from('awb_detail')->get()->row_array();
    }
}
