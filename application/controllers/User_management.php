<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_management extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title']	=	"User Management";
		$data['role']	=	$this->ModelUser->getRole();
		$data['user']	=	$this->ModelUser->getAll();
		// var_dump($data);
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('admin/user',$data);
		$this->load->view('templates/footer',$data);
	}

	public function getBiodata()
	{
		$id	=	$this->input->post('id_role');	
		$data	=	$this->ModelUser->getBiodata($id);
		echo json_encode($data);
	}

	public function new()
	{
		$data = array(
			'username'	=>	$this->input->post('username'),
			'password'			=>	MD5($this->input->post('password')),
			'id_role'		=>	$this->input->post('id_role'),
			'id_biodata'			=>	$this->input->post('id_biodata')
		);

		$runtime = $this->ModelUser->newUser($data);

		if ($runtime == true) {
				$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasi Melakukan Verifikasi.');
		}else {
				$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Melakukan Verifikasi.');
			
		}
		redirect('user_management');
	}

	public function hapus($id)
	{
		$hapus = $this->ModelUser->deleteUser($id);

		if ($hapus == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Menghapus Settingan Jadwal.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Menghapus Settingan Jadwal.');
		}
		redirect('user_management');
	}
}
