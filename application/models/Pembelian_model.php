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
            INNER JOIN USER b ON a.id_user=b.id_user
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

    public function saveData($data, $tabel)
    {
        $this->db->insert($tabel, $data);
    }
}
