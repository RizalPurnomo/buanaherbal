<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('customer_model'));
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['customer'] = $this->customer_model->getAllData();
        $this->load->view('master/vcustomer', $data);
    }

    public function add()
    {
        $this->load->view('master/vcustomer_add');
    }

    public function saveData()
    {
        $data = $this->input->post('customer');
        $this->customer_model->saveData($data);
        print_r($this->input->post());
    }

    function edit($idData)
    {
        if (isset($idData)) {
            $data['customer'] = $this->customer_model->getDataById($idData);
        }
        $this->load->view('master/vcustomer_edit', $data);
    }

    public function updateData($idData)
    {
        $customer = $this->input->post('customer');
        $this->customer_model->updateData($idData, $customer);
        print_r($this->input->post());
    }

    function delete($idData)
    {
        if (isset($idData)) {
            $this->customer_model->deleteData($idData);
        }
        return "Data Berhasil Di Delete";
    }
}
