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

    public function saveData($data)
    {
        $this->db->insert('customer', $data);
    }

    public function getDataById($idData)
    {
        $query = "SELECT * FROM customer WHERE id_customer='$idData'";
        $sql = $this->db->query($query);
        return $sql->result_array();
    }

    public function updateData($id, $data)
    {
        $this->db->where('id_customer', $id);
        $this->db->update('customer', $data);
        return  "Data " . $id . " Berhasil Diupdate";
    }

    public function deleteData($id)
    {
        $this->db->where('id_customer', $id);
        $this->db->delete('customer');
    }
}
