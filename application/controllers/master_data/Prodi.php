<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prodi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title']		=	"Prodi";
		$data['prodi']	=	$this->ModelMasterData->getProdi();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('admin/master_data/prodi',$data);
		$this->load->view('templates/footer',$data);
	}	

	public function new()
	{
		$data = array(
			'prodi'	=>  $this->input->post('prodi')
		);

		$tambah = $this->ModelMasterData->newProdi($data);

		if ($tambah == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Menambahakan Semester Baru.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Menambahakan Semester Baru.');
		}
		redirect('master_data/prodi');
	}

	public function hapus($id)
	{
		$hapus = $this->ModelMasterData->deleteProdi($id);

		if ($hapus == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Menghapus Data Semester.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Menghapus Data Semester.');
		}
		redirect('master_data/prodi');
	}
}
