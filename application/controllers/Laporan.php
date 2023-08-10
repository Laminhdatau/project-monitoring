<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title']	=	"Laporan";
		$data['verifikasi']	=	$this->ModelLaporan->getAll();
		// var_dump($data);die;
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('viewer/laporan',$data);
		$this->load->view('templates/footer',$data);
	}
}
