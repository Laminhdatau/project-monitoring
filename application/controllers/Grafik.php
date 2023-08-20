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
		$data['title']	=	"Grafik Mahasiswa";
		$data['data']	=	$this->ModelGrafik->getAllKehadiranMhs();
		$data['pertemuan']	= $this->ModelGrafik->getPertemuan();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('grafik/grafikmahasiswa', $data);
		$this->load->view('templates/footer', $data);
	}

	public function getRekapByPertemuan()
	{

		$id = $this->input->post('idpertemuan');
		$data = $this->ModelGrafik->getListPertemuan($id);
		echo json_encode($data);
	}


	public function getGrafikById($id)
	{
		$data = $this->ModelGrafik->getById($id);
		$grafik_data = [
			'hadir' => $data->hadir,
			'izin' => $data->izin,
			'sakit' => $data->sakit,
			'alfa' => $data->alfa,
			'ta' => $data->tahun_ajaran
		];
		header('Content-Type: application/json');
		echo json_encode($grafik_data);
	}


	public function indexDosen()
	{
		$data['title']	=	"Grafik Dosen";
		$data['grafik']	=	$this->ModelGrafik->getAllKehadiranDosen();
		$data['pertemuan']	= $this->ModelGrafik->getPertemuan();

		// var_dump($data);die;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('grafik/grafikdsn', $data);
		$this->load->view('templates/footer', $data);
	}

	public function getKehadiranDosenById($id, $nim)
	{

		$data = $this->ModelGrafik->getKehadiranDosenById($id, $nim);
		$grafik_data = [
			'hadir' => $data->hadir,
			'alpa' => $data->alpa,
			'ta' => $data->tahun_ajaran

		];
		header('Content-Type: application/json');
		echo json_encode($grafik_data);
	}


	public function indexForDosen()
	{
		$data['title']	=	"Grafik Dosen";
		$id = $this->session->userdata('id_biodata');

		$data['grafik']	=	$this->ModelGrafik->getAllKehadiranDosenByDosen($id);
		$data['pertemuan']	= $this->ModelGrafik->getPertemuan();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('grafik/grafikdosen', $data);
		$this->load->view('templates/footer', $data);
	}
}
