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

    public function saveData($data)
    {
        $this->db->insert('suplier', $data);
    }

    public function getDataById($idData)
    {
        $query = "SELECT * FROM suplier WHERE id_suplier='$idData'";
        $sql = $this->db->query($query);
        return $sql->result_array();
    }

    public function updateData($id, $data)
    {
        $this->db->where('id_suplier', $id);
        $this->db->update('suplier', $data);
        return  "Data " . $id . " Berhasil Diupdate";
    }

    public function deleteData($id)
    {
        $this->db->where('id_suplier', $id);
        $this->db->delete('suplier');
    }
}
