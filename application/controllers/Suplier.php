<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Suplier extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('suplier_model'));
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['suplier'] = $this->suplier_model->getAllData();
        $this->load->view('master/vsuplier', $data);
    }

    public function add()
    {
        $this->load->view('master/vsuplier_add');
    }

    public function saveData()
    {
        $data = $this->input->post('suplier');
        $this->suplier_model->saveData($data);
        print_r($this->input->post());
    }

    function edit($idData)
    {
        if (isset($idData)) {
            $data['suplier'] = $this->suplier_model->getDataById($idData);
        }
        $this->load->view('master/vsuplier_edit', $data);
    }

    public function updateData($idData)
    {
        $suplier = $this->input->post('suplier');
        $this->suplier_model->updateData($idData, $suplier);
        print_r($this->input->post());
    }

    function delete($idData)
    {
        if (isset($idData)) {
            $this->suplier_model->deleteData($idData);
        }
        return "Data Berhasil Di Delete";
    }
}
