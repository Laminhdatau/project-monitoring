<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Status_kehadiran extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title']	=	"Status Kehadiran";
		$data['status']	=	$this->ModelMasterData->getStatusKehadiran();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('admin/master_data/statuskehadiran',$data);
		$this->load->view('templates/footer',$data);
	}	

	public function new()
	{
		$data = array(
			'status_kehadiran'	=>  $this->input->post('status_kehadiran')
		);

		$tambah = $this->ModelMasterData->newStatusKehadiran($data);

		if ($tambah == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Menambahakan Status Kehadiran Baru.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Menambahakan Status Kehadiran Baru.');
		}
		redirect('master_data/status_kehadiran');
	}

	public function hapus($id)
	{
		$hapus = $this->ModelMasterData->deleteStatusKehadiran($id);

		if ($hapus == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Menghapus Data Status Kehadiran.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Menghapus Data Status Kehadiran.');
		}
		redirect('master_data/status_kehadiran');
	}
}
