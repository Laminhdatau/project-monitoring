<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mata_kuliah extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title']		=	"Mata Kuliah";
		$data['prodi']		=	$this->ModelMasterData->getProdi();
		$data['matakuliah']	=	$this->ModelMasterData->getMataKuliah();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('admin/master_data/matakuliah',$data);
		$this->load->view('templates/footer',$data);
	}	

	public function new()
	{
		$data = array(
			'mata_kuliah'	=>  $this->input->post('mata_kuliah'),
			'id_prodi'		=>	$this->input->post('id_prodi')
		);

		$tambah = $this->ModelMasterData->newMataKuliah($data);

		if ($tambah == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Menambahakan Mata Kuliah Baru.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Menambahakan Mata Kuliah Baru.');
		}
		redirect('master_data/mata_kuliah');
	}

	public function hapus($id)
	{
		$hapus = $this->ModelMasterData->deleteMataKuliah($id);

		if ($hapus == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Menghapus Data Mata Kuliah.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Menghapus Data Mata Kuliah.');
		}
		redirect('master_data/mata_kuliah');
	}
}
