<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllData()
    {
        $sql = "SELECT * FROM barang order by id_barang desc";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getBarangReady()
    {
        $sql = "SELECT * FROM pembelian_detail a
            INNER JOIN barang b ON a.id_barang=b.id_barang
            WHERE  (a.qty_masuk - a.qty_keluars + a.qty_opname)>0";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }



    public function saveData($data)
    {
        $this->db->insert('barang', $data);
    }

    public function getDataById($idData)
    {
        $query = "SELECT * FROM barang WHERE id_barang='$idData'";
        $sql = $this->db->query($query);
        return $sql->result_array();
    }

    public function updateData($id, $data)
    {
        $this->db->where('id_barang', $id);
        $this->db->update('barang', $data);
        return  "Data " . $id . " Berhasil Diupdate";
    }

    public function deleteData($id)
    {
        $this->db->where('id_barang', $id);
        $this->db->delete('barang');
    }
}
