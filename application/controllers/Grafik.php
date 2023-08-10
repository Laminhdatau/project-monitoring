<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Grafik extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->nim = $this->session->userdata('nim');
	}


	public function indexMhs()
	{
		$data['title']	=	"Grafik";
		$data['data']	=	$this->ModelGrafik->getAllKehadiranMhs();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('grafik/grafikmahasiswa', $data);
		$this->load->view('templates/footer', $data);
	}


	public function indexForMhs()
	{
		$data['title']	=	"Grafik";
		$data['data']	=	$this->ModelGrafik->getAllKehadiranByNim($this->nim);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('grafik/grafikmahasiswa', $data);
		$this->load->view('templates/footer', $data);
	}

	public function getGrafikById($id)
	{

		$data = $this->ModelGrafik->getById($id);

		$grafik_data = [
			'hadir' => $data->hadir,
			'izin' => $data->izin,
			'sakit' => $data->sakit,
			'alfa' => $data->alfa
		];

		// Kirim data dalam format JSON
		header('Content-Type: application/json');
		echo json_encode($grafik_data);
	}


	public function indexDosen()
	{
		$data['title']	=	"Grafik";
		$data['grafik']	=	$this->ModelGrafik->getAll();
		// var_dump($data);die;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('grafik/grafikdosen', $data);
		$this->load->view('templates/footer', $data);
	}
}
