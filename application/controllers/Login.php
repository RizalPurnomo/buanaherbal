<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function index()
	{
		if ($this->session->userdata('username')) {
			$this->load->view('vdashboard');
		} else {
			$this->load->view('vlogin');
		}
	}

	public function logins()
	{
		date_default_timezone_set('Asia/Jakarta');
		$username = $this->input->post('username');
		$password = $this->input->post('password');


		$userdata = $this->user_model->getValidUser($username, md5($password));
		if ($userdata) {
			$this->session->set_userdata($userdata[0]);
			$login = array(
				"last_login" => date("Y-m-d H:i:s")
			);
			$this->user_model->updateLastLogin($username, $login, 'user');
			redirect('dashboard');
		} else {
			redirect('login');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		// $this->session->unset_userdata('username');
		// $_SESSION = [];
		redirect('login');
	}
}
