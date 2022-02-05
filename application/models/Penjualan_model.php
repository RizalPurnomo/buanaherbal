<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllData()
    {
        $sql = "SELECT * FROM penjualan a
            INNER JOIN users b ON a.id_user=b.id_user
            INNER JOIN customer c ON c.id_customer=a.id_customer
            ORDER BY a.id_penjualan DESC";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }
}
