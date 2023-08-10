<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keting extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title']	=	"Ketua Tingkat";
		$data['prodi']	=	$this->ModelKeting->getProdi();
		$data['kelas']	=	$this->ModelKeting->getKelas();
		$data['semester']	=	$this->ModelKeting->getSemester();
		$data['keting']	=	$this->ModelKeting->getAll();
		$data['mahasiswa']	=	$this->ModelKeting->getMhs();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('admin/biodata_user/keting', $data);
		$this->load->view('templates/footer', $data);
	}


	public function cariKeting()
	{
		$search_term = $this->input->post('search_term');
		$result = $this->ModelKeting->getSearch($search_term);
		header('Content-Type: application/json');
		echo json_encode($result);
	}

	public function getById($id)
	{
		$data = $this->ModelKeting->getById($id);

		$result = array(
			'data' => $data
		);

		echo json_encode($result);
	}


	public function new()
	{
		$data = array(
			'nim' => $this->input->post('nim')
		);
		
		$tambah = false; // Inisialisasi variabel tambah
		
		if (!empty($data['nim'])) {
			$tambah = $this->ModelKeting->newKeting($data);
		}
	
		if ($tambah == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Menambahakan Ketua Tingkat Baru.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Menambahakan Ketua Tingkat Baru.');
		}
		
		redirect('biodata_user/keting');
	}



	public function hapus($id)
	{
		$hapus = $this->ModelKeting->deleteKeting($id);

		if ($hapus == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Menghapus Data Ketua Tingkat.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Menghapus Data Ketua Tingkat.');
		}
		redirect('biodata_user/keting');
	}
}
