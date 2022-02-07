<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('pembelian_model', 'suplier_model', 'barang_model'));
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['pembelian'] = $this->pembelian_model->getAllData();
        $this->load->view('transaksi/vpembelian', $data);
    }

    public function add()
    {
        $data['barang'] = $this->barang_model->getAllData();
        $data['suplier'] = $this->suplier_model->getAllData();
        $this->load->view('transaksi/vpembelian_add', $data);
    }

    function saveData()
    {
        $pembelian            = $this->input->post('pembelian');
        $pembelian_detail      = $this->input->post('pembelian_detail');

        $this->pembelian_model->saveData($pembelian, $pembelian_detail);
    }

    function delete($idData)
    {
        if (isset($idData)) {
            $this->pembelian_model->deleteData($idData);
        }
        return "Data Berhasil Di Delete";
    }





    function getMaxIdPembelian()
    {
        $id_pembelian   = $this->pembelian_model->getIdData();
        echo $id_pembelian;
    }

    function getPembelianDetail()
    {
        $id_pembelian    = $this->input->post('id_pembelian');
        $data['pembelian'] = $this->pembelian_model->getPembelianById($id_pembelian);
        echo json_encode($data);
    }
}
