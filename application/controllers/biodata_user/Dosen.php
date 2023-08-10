<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title']	=	"Dosen";
		$data['prodi']	=	$this->ModelDosen->getProdi();
		$data['dosen']	=	$this->ModelDosen->getAll();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('admin/biodata_user/dosen',$data);
		$this->load->view('templates/footer',$data);
	}	
	
	public function getById($id)
	{
		$data = $this->ModelDosen->getById($id);

		$result = array(
			'data' => $data
		);

		echo json_encode($result);
	}

	public function new()
	{
		$data = array(
			'nidn'			=> $this->input->post('nidn'),
			'nama'			=> $this->input->post('nama'),
			'alamat'		=> $this->input->post('alamat'),
			'notelp'		=> $this->input->post('nope'),
			'id_prodi'		=> $this->input->post('id_prodi')
		);

		$tambah = $this->ModelDosen->newDosen($data);

		if ($tambah == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Menambahakan Dosen Baru.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Menambahakan Dosen Baru.');
		}
		redirect('biodata_user/dosen');
	}

	public function edit()
	{
		$id	=	$this->input->post('id_edit');
		$data = array(
			'nidn'			=> $this->input->post('nidn_edit'),
			'nama'			=> $this->input->post('nama_edit'),
			'alamat'		=> $this->input->post('alamat_edit'),
			'notelp'		=> $this->input->post('nope_edit'),
			'id_prodi'		=> $this->input->post('id_prodi_edit')
		);
		
		$rubah = $this->ModelDosen->editDosen($id,$data);

		if ($rubah == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Memperbarui Data Dosen.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Memperbarui Data Dosen.');
		}
		redirect('biodata_user/dosen');
	}

	public function hapus($id)
	{
		$hapus = $this->ModelDosen->deleteDosen($id);

		if ($hapus == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Menghapus Data Dosen.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Menghapus Data Dosen.');
		}
		redirect('biodata_user/dosen');
	}
}
