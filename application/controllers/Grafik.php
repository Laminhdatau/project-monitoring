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
		$bulan = [
			[
				'id_bulan' => 1,
				'bulan' => 'Januari'
			],
			[
				'id_bulan' => 2,
				'bulan' => 'Februari'
			],
			[
				'id_bulan' => 3,
				'bulan' => 'Maret'
			],
			[
				'id_bulan' => 4,
				'bulan' => 'April'
			],
			[
				'id_bulan' => 5,
				'bulan' => 'Mei'
			],
			[
				'id_bulan' => 6,
				'bulan' => 'Juni'
			],
			[
				'id_bulan' => 7,
				'bulan' => 'Juli'
			],
			[
				'id_bulan' => 8,
				'bulan' => 'Agustus'
			],
			[
				'id_bulan' => 9,
				'bulan' => 'September'
			],
			[
				'id_bulan' => 10,
				'bulan' => 'Oktober'
			],
			[
				'id_bulan' => 11,
				'bulan' => 'November'
			],
			[
				'id_bulan' => 12,
				'bulan' => 'Desember'
			]
		];




		$data['bulan']	= $bulan;

		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('grafik/grafikmahasiswa', $data);
		$this->load->view('templates/footer', $data);
	}


	public function getRekapByPertemuan()
	{
		$id = $this->input->post('idpertemuan');
		$bln = $this->input->post('bulan');

		$data = $this->ModelGrafik->getListPertemuan($id, $bln);

		// Buat response JSON
		$response = [
			'data' => $data,
			'message' => 'Data retrieved successfully'
		];

		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function getRekapMK()
	{
		$dosen = $this->input->post('dosen');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		$data = $this->ModelGrafik->rekapMk($dosen, $bulan,$tahun);

		  // Menggunakan header JSON
		  header('Content-Type: application/json');

		  // Mengembalikan data dalam format JSON
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
		$bulan = [
			[
				'id_bulan' => 1,
				'bulan' => 'Januari'
			],
			[
				'id_bulan' => 2,
				'bulan' => 'Februari'
			],
			[
				'id_bulan' => 3,
				'bulan' => 'Maret'
			],
			[
				'id_bulan' => 4,
				'bulan' => 'April'
			],
			[
				'id_bulan' => 5,
				'bulan' => 'Mei'
			],
			[
				'id_bulan' => 6,
				'bulan' => 'Juni'
			],
			[
				'id_bulan' => 7,
				'bulan' => 'Juli'
			],
			[
				'id_bulan' => 8,
				'bulan' => 'Agustus'
			],
			[
				'id_bulan' => 9,
				'bulan' => 'September'
			],
			[
				'id_bulan' => 10,
				'bulan' => 'Oktober'
			],
			[
				'id_bulan' => 11,
				'bulan' => 'November'
			],
			[
				'id_bulan' => 12,
				'bulan' => 'Desember'
			]
		];



		$tahun_mulai = 2022;
		$tahun_sekarang = date('Y');

		$tahun = [];
		for ($i = $tahun_mulai; $i <= $tahun_sekarang; $i++) {
			$tahun[] = [
				'id_tahun' => $i,
				'tahun' => $i
			];
		}



		$data['tahun'] = $tahun;
		$data['bulan']	= $bulan;
		$data['dosen']=$this->ModelGrafik->getDosen();
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
