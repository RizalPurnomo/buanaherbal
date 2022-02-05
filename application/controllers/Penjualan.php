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
        $data['barang'] = $this->barang_model->getAllData();
        $data['customer'] = $this->customer_model->getAllData();
        $this->load->view('transaksi/vpenjualan_add', $data);
    }
}
