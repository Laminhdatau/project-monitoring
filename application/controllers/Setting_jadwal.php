<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting_jadwal extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title']	=	"Setting Jadwal";
		$data['prodi']	=	$this->ModelSettingJadwal->getProdi();
		$data['kelas']	=	$this->ModelMasterData->getKelas();
		$data['semester']	=	$this->ModelMasterData->getSemester();
		$data['mk']		=	$this->ModelMasterData->getMataKuliah();
		$data['dosen']	=	$this->ModelDosen->getAll();
		$data['jadwal']	=	$this->ModelSettingJadwal->getAll();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('admin/setting_jadwal',$data);
		$this->load->view('templates/footer',$data);
	}

	public function getMatKul()
	{
		$id	=	$this->input->post('id_prodi');
		$data	=	$this->ModelSettingJadwal->getMatKul($id);
		echo json_encode($data);
	}

	public function getById($id)
	{
		$data = $this->ModelSettingJadwal->getById($id);

		$result = array(
			'data' => $data
		);

		echo json_encode($result);
	}

	public function new()
	{
		$data = array(
			'id_mata_kuliah'	=>	$this->input->post('id_mata_kuliah'),
			'id_dosen'			=>	$this->input->post('id_dosen'),
			'id_semester'		=>	$this->input->post('id_semester'),
			'id_kelas'			=>	$this->input->post('id_kelas')
		);

		$runtime = $this->ModelSettingJadwal->newJadwal($data);

		if ($runtime == true) {
				$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasi Melakukan Verifikasi.');
		}else {
				$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Melakukan Verifikasi.');
			
		}
		redirect('setting_jadwal');
	}

	public function hapus($id)
	{
		$hapus = $this->ModelSettingJadwal->deleteJadwal($id);

		if ($hapus == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Menghapus Settingan Jadwal.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Menghapus Settingan Jadwal.');
		}
		redirect('setting_jadwal');
	}
}
