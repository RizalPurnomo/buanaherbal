<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('user_model'));
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['user'] = $this->user_model->getAllData();
        $this->load->view('master/vuser', $data);
    }

    public function add()
    {
        $this->load->view('master/vuser_add');
    }

    public function saveData()
    {
        $data = $this->input->post('user');
        $this->user_model->saveData($data, 'user');
        print_r($this->input->post());
    }

    function edit($idData)
    {
        if (isset($idData)) {
            $data['user'] = $this->user_model->getDataById($idData);
        }
        // print_r($data);
        $this->load->view('master/vuser_edit', $data);
    }

    public function updateData($idData)
    {
        $user = $this->input->post('user');
        $this->user_model->updateData($idData, $user, 'user');
        print_r($this->input->post());
    }

    function delete($idData)
    {
        if (isset($idData)) {
            $this->user_model->deleteData($idData, "user");
        }
        return "Data Berhasil Di Delete";
    }

    public function resetPassword($idData)
    {
        $user = $this->input->post('user');
        $this->user_model->updateData($idData, $user, 'user');
        print_r($this->input->post());
    }
}
