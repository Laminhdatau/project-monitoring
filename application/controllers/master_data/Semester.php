<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Semester extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title']		=	"Semester";
		$data['semester']	=	$this->ModelMasterData->getSemester();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('admin/master_data/semester',$data);
		$this->load->view('templates/footer',$data);
	}	

	public function new()
	{
		$data = array(
			'semester'	=>  $this->input->post('semester')
		);

		$tambah = $this->ModelMasterData->newSemester($data);

		if ($tambah == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Menambahakan Semester Baru.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Menambahakan Semester Baru.');
		}
		redirect('master_data/semester');
	}

	public function hapus($id)
	{
		$hapus = $this->ModelMasterData->deleteSemester($id);

		if ($hapus == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Menghapus Data Semester.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Menghapus Data Semester.');
		}
		redirect('master_data/semester');
	}
}
