<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function index()
    {
        if ($this->session->userdata('username')) {
            $this->load->view('vdashboard');
        } else {
            $this->load->view('vlogin');
        }
    }
}
