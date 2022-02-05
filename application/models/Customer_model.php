<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllData()
    {
        $sql = "SELECT * FROM customer order by id_customer desc";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }
}
