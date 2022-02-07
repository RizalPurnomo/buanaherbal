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

    public function getIdData()
    {
        $idData = "";
        $sql = "SELECT MAX(id_penjualan) AS maxdata FROM penjualan";
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

    public function getPenjualanById($id_penjualan)
    {
        $sql = "SELECT * FROM penjualan_detail a
            INNER JOIN barang b on a.id_barang=b.id_barang WHERE id_penjualan='$id_penjualan'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getDataRange($tglAwal, $tglAkhir)
    {
        $sql = "SELECT * FROM penjualan a
            INNER JOIN penjualan_detail b ON a.id_penjualan=b.id_penjualan 
            INNER JOIN barang c ON c.id_barang=b.id_barang    
            INNER JOIN customer d on d.id_customer=a.id_customer
            WHERE tgl_penjualan BETWEEN '$tglAwal' AND '$tglAkhir'
            ORDER BY a.tgl_penjualan DESC";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function saveData($penjualan, $penjualan_detail, $pembelian_detail)
    {
        $this->db->trans_start();

        $this->db->insert('penjualan', $penjualan);
        for ($i = 0; $i < count($penjualan_detail); $i++) {
            $this->db->insert('penjualan_detail', $penjualan_detail[$i]);
        }
        for ($i = 0; $i < count($pembelian_detail); $i++) {
            $id_pembelian_detail = $pembelian_detail[$i]['id_pembelian_detail'];
            $qty_keluar = $pembelian_detail[$i]['qty_keluars'];

            $this->db->query("UPDATE pembelian_detail set qty_keluars = qty_keluars + '$qty_keluar'  where id_pembelian_detail='$id_pembelian_detail'");
        }

        $this->db->trans_complete();
    }

    public function deleteData($id)
    {
        $this->db->trans_begin();
        //get barang by id pengeluaran
        $penjualan = $this->db->query("SELECT * FROM penjualan a
            INNER JOIN penjualan_detail b ON a.id_penjualan = b.id_penjualan
            WHERE a.id_penjualan='$id'")->result_array();
        for ($i = 0; $i < count($penjualan); $i++) {

            $brg_hapus = $penjualan[$i]['qty_keluar'];
            $id_pembelian_detail = $penjualan[$i]['id_pembelian_detail'];

            //update tambah pembelian 
            $this->db->query("UPDATE pembelian_detail SET qty_keluars = qty_keluars-'$brg_hapus' WHERE id_pembelian_detail='$id_pembelian_detail'");

            //hapus penjualan detail
            $this->db->query("DELETE FROM penjualan_detail WHERE id_pembelian_detail='$id_pembelian_detail'");
        }
        //hapus penerimaan
        $this->db->query("DELETE FROM penjualan WHERE id_penjualan='$id'");

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return "Gagal";
        } else {
            $this->db->trans_commit();
            return "Berhasil";

            // return $brgHapus;
        }
    }
}
