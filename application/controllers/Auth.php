<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		redirect('auth/login');
	}

	public function login()
	{
		$this->load->view('auth/login');
	}

	public function proses()
	{
		$username	=	$this->input->post('username');
		$password	=	MD5($this->input->post('password'));

		$cekEmail = $this->db->where('username', $username)->from('tbl_user')->get()->row();

		if ($cekEmail == true) {
			if ($cekEmail->password == $password) {

				if ($cekEmail->id_role == 2) {
					
					$getDataUser = $this->db->select('c.id_biodata,c.nama_lengkap as nama, b.*, a.nim')
						->from('tbl_keting a')
						->join('tbl_mst_mahasiswa b', 'b.nim = a.nim', 'left')
						->join('tbl_mst_biodata c', 'b.nik = c.nik', 'left')
						->where('c.id_biodata', $cekEmail->id_biodata)
						->get()
						->row();

					$data_session = array(
						'username' => $cekEmail->username,
						'nama'	=> $getDataUser->nama,
						'nim'	=> $getDataUser->nim,
						'id_biodata' => $cekEmail->id_biodata,
						'id_role' => $cekEmail->id_role,
						'semester'	=>	$getDataUser->id_semester,
						'kelas'	=>	$getDataUser->id_kelas,
					);
					$this->session->set_userdata($data_session);
				} else {
					$getDataUser = $this->db->where('id_dosen', $cekEmail->id_biodata)->get('tbl_mst_dosen')->row();
					$data_session = array(
						'username' => $cekEmail->username,
						'nama'	=> $getDataUser->nama,
						'nidn'	=> $getDataUser->nidn,
						'id_biodata' => "-",
						'id_role' => $cekEmail->id_role,
						'semester'	=>	"-",
						'kelas'	=>	"-",
					);
					$this->session->set_userdata($data_session);
				}

				redirect('dashboard');
			} else {
				$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Password Yang Anda Masukan Tidak Sesuai.');
				redirect('auth/login');
			}
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Username Tidak Ditemukan.');
			redirect('auth/login');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('id_biodata');
		$this->session->unset_userdata('id_role');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('nim');
		$this->session->unset_userdata('semester');
		$this->session->unset_userdata('kelas');
		$this->session->sess_destroy();
		redirect('auth/login');
	}
}
