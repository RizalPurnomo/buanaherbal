<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Suplier_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllData()
    {
        $sql = "SELECT * FROM suplier order by id_suplier desc";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }
}
