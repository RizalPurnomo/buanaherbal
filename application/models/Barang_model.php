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
        $sql = "SELECT SUM(b.qty_masuk) AS jumMasuk,SUM(b.qty_keluars) AS jumKeluar,SUM(b.qty_opname) AS jumOpname,(SUM(b.qty_masuk)-SUM(b.qty_keluars)+SUM(b.qty_opname))AS stocks,a.* FROM barang a
            LEFT JOIN pembelian_detail b ON a.id_barang=b.id_barang
            GROUP BY a.id_barang
            ORDER BY a.id_barang DESC";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getBarangReady()
    {
        $sql = "SELECT (a.qty_masuk - a.qty_keluars + a.qty_opname) AS stocks,b.*,c.*,a.* FROM pembelian_detail a
            INNER JOIN barang b ON a.id_barang=b.id_barang
            INNER JOIN pembelian c ON a.id_pembelian=c.id_pembelian
            WHERE  (a.qty_masuk - a.qty_keluars + a.qty_opname)>0
            ORDER BY a.id_barang,c.tgl_pembelian DESC";
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


    //--------KATEGORI------------
    public function getAllKategori()
    {
        $sql = "SELECT * FROM kategori";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }
}
