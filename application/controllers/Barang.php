<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('barang_model'));
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['barang'] = $this->barang_model->getAllData();
        $this->load->view('master/vbarang', $data);
    }

    public function add()
    {
        $data['kategori'] = $this->barang_model->getAllKategori();
        $this->load->view('master/vbarang_add', $data);
    }

    public function saveData()
    {
        $data = $this->input->post('barang');
        $this->barang_model->saveData($data);
        print_r($this->input->post());
    }

    function edit($idData)
    {
        if (isset($idData)) {
            $data['kategori'] = $this->barang_model->getAllKategori();
            $data['barang'] = $this->barang_model->getDataById($idData);
        }
        // print_r($data);
        $this->load->view('master/vbarang_edit', $data);
    }

    public function updateData($idData)
    {
        $barang = $this->input->post('barang');
        $this->barang_model->updateData($idData, $barang);
        print_r($this->input->post());
    }

    function delete($idData)
    {
        if (isset($idData)) {
            $this->barang_model->deleteData($idData);
        }
        return "Data Berhasil Di Delete";
    }
}
