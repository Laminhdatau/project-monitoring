<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title']	=	"Mahasiswa";
		$data['prodi']	=	$this->ModelMahasiswa->getProdi();
		$data['kelas']	=	$this->ModelMahasiswa->getKelas();
		$data['semester']	=	$this->ModelMahasiswa->getSemester();
		$data['mahasiswa']	=	$this->ModelMahasiswa->getAll();
		$data['biodata']	=	$this->ModelMahasiswa->getBiodata();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('admin/master_data/mahasiswa', $data);
		$this->load->view('templates/footer', $data);
	}

	public function getById($id, $idb)
	{
		$data = $this->ModelMahasiswa->getById($id, $idb);

		$result = array(
			'data' => $data
		);

		echo json_encode($result);
	}

	public function new()
	{
		$data = array(
			'nim'			=> $this->input->post('nim'),
			'nik'			=> $this->input->post('nik'),
			'id_prodi'		=> $this->input->post('id_prodi'),
			'id_semester'	=> $this->input->post('id_semester'),
			'id_kelas'		=> $this->input->post('id_kelas')
		);

		// var_dump($data);

		$tambah = $this->ModelMahasiswa->newMahasiswa($data);


		$bio	=	array(
			'nik'			=> $this->input->post('nik'),
			'nama_lengkap'	=> $this->input->post('nama'),
			'alamat'	=> $this->input->post('alamat'),
			'jk'	=> $this->input->post('jk')
		);



		$tambio = $this->ModelBiodata->newBiodata($bio);



		if ($tambah == true && $tambio == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Menambahakan Mahasiswa Baru.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Menambahakan Mahasiswa Baru.');
		}
		redirect('master_data/mahasiswa');
	}

	public function edit()
	{
		$id = $this->input->post('idm');
		$idb = $this->input->post('idb');

		$data	=	array(
			'nim'	=> $this->input->post('nim_edit'),
			'nik'	=> $this->input->post('nik_edit'),
			'id_semester'	=> $this->input->post('id_semester_edit'),
			'id_prodi'	=> $this->input->post('id_prodi_edit'),
			'id_kelas'	=> $this->input->post('id_kelas_edit'),
		);
	
		$rubah = $this->ModelMahasiswa->editMahasiswa($id, $data);

		$bio	=	array(
			'nik'	=> $this->input->post('nik_edit'),
			'nama_lengkap'	=> $this->input->post('nama_edit'),
			'alamat'	=> $this->input->post('alamat_edit'),
			'jk'	=> $this->input->post('jk_edit')
		);
		
		$rubio = $this->ModelBiodata->editBiodata($idb, $bio);
		if ($rubah == true && $rubio == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Memperbarui Data Mahasiswa.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Memperbarui Data Mahasiswa.');
		}
		redirect('master_data/mahasiswa');
	}

	public function hapus($id)
	{
		$hapus = $this->ModelMahasiswa->deleteMahasiswa($id);
		if ($hapus == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Menghapus Data Mahasiswa.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Menghapus Data Mahasiswa.');
		}
		redirect('master_data/mahasiswa');
	}
}
