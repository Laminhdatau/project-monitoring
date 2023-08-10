<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title']		=	"Kelas";
		$data['prodi']	=	$this->ModelMasterData->getKelas();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('admin/master_data/kelas',$data);
		$this->load->view('templates/footer',$data);
	}	

	public function new()
	{
		$data = array(
			'kelas'	=>  $this->input->post('kelas')
		);

		$tambah = $this->ModelMasterData->newKelas($data);

		if ($tambah == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Menambahakan Semester Baru.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Menambahakan Semester Baru.');
		}
		redirect('master_data/kelas');
	}

	public function hapus($id)
	{
		$hapus = $this->ModelMasterData->deleteKelas($id);

		if ($hapus == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Menghapus Data Semester.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Menghapus Data Semester.');
		}
		redirect('master_data/kelas');
	}
}
