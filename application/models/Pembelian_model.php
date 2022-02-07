<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllData()
    {
        $sql = "SELECT * FROM pembelian a
            INNER JOIN users b ON a.id_user=b.id_user
            INNER JOIN suplier c ON c.id_suplier=a.id_suplier
            ORDER BY a.id_pembelian DESC";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getIdData()
    {
        $idData = "";
        $sql = "SELECT MAX(id_pembelian) AS maxdata FROM pembelian";
        $qry = $this->db->query($sql)->result_array();
        $maxData = $qry[0]['maxdata'];
        if (empty($maxData)) {
            $idData = "1";
        } else {
            $maxData++;
            $idData = $maxData;
        }
        return $idData;
    }

    public function getPembelianById($id_pembelian)
    {
        $sql = "SELECT * FROM pembelian_detail a
            INNER JOIN barang b on a.id_barang=b.id_barang WHERE id_pembelian='$id_pembelian'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function saveData($pembelian, $pembelian_detail)
    {
        $this->db->trans_start();

        $this->db->insert('pembelian', $pembelian);
        for ($i = 0; $i < count($pembelian_detail); $i++) {
            $this->db->insert('pembelian_detail', $pembelian_detail[$i]);
        }

        $this->db->trans_complete();
    }

    public function deleteData($id)
    {
        $this->db->where('id_pembelian', $id);
        $this->db->delete('pembelian');
    }
}
