<?php
defined('BASEPATH') or exit('No direct script access allowed');

class penjualan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('penjualan_model', 'customer_model', 'barang_model'));
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['penjualan'] = $this->penjualan_model->getAllData();
        $this->load->view('transaksi/vpenjualan', $data);
    }

    public function add()
    {
        $data['barang'] = $this->barang_model->getBarangReady();
        $data['customer'] = $this->customer_model->getAllData();
        $this->load->view('transaksi/vpenjualan_add', $data);
    }

    function saveData()
    {
        $penjualan            = $this->input->post('penjualan');
        $penjualan_detail      = $this->input->post('penjualan_detail');
        $pembelian_detail      = $this->input->post('pembelian_detail');

        $this->penjualan_model->saveData($penjualan, $penjualan_detail, $pembelian_detail);
    }


    function delete($idData)
    {
        if (isset($idData)) {
            $this->penjualan_model->deleteData($idData);
        }
        return "Data Berhasil Di Delete";
    }

    function getMaxIdPenjualan()
    {
        $id_penjualan   = $this->penjualan_model->getIdData();
        echo $id_penjualan;
    }

    function getPenjualanDetail()
    {
        $id_penjualan    = $this->input->post('id_penjualan');
        $data['penjualan'] = $this->penjualan_model->getPenjualanById($id_penjualan);
        echo json_encode($data);
    }
}
