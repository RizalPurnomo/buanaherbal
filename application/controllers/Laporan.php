<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('penjualan_model'));
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
    }

    public function index()
    {
    }

    function penjualan()
    {
        if (!empty($_POST)) {
            $tglAwal = date('Y-m-d', strtotime($_POST['datepicker']));
            $tglAkhir = date('Y-m-d', strtotime($_POST['datepicker2']));
            $data['tglAwal'] = $tglAwal;
            $data['tglAkhir'] = $tglAkhir;
            if ($_POST['proses'] == 'proses') {
                $data['penjualan'] = $this->penjualan_model->getDataRange($tglAwal, $tglAkhir);
                $this->load->view('laporan/vpenjualan', $data);
            } else {
                $data['penjualan'] = $this->penjualan_model->getDataRange($tglAwal, $tglAkhir);
                $this->load->view('laporan/vpenjualan', $data);
            }
        } else {
            $today = date("Y-m-d");
            $tglAwal = date('Y-m-01', strtotime($today));
            $tglAkhir = date('Y-m-t', strtotime($today));
            $data['tglAwal'] = $tglAwal;
            $data['tglAkhir'] = $tglAkhir;
            $data['penjualan'] = $this->penjualan_model->getDataRange($tglAwal, $tglAkhir);
            $this->load->view('laporan/vpenjualan', $data);
        }
    }
}
