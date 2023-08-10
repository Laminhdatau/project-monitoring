<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->nim =  $this->session->userdata('nim');
		$this->uyes = $this->session->userdata('kelas');
		$this->ayas = $this->session->userdata('semester');
	}

	public function index()
	{
		$data['title']	=	"Laporan";
		$data['status']	=	$this->ModelAbsensi->getStatus();
		$data['dosen']	=	$this->ModelAbsensi->getJadwal($this->uyes, $this->ayas);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('mhs/absensi', $data);
		$this->load->view('templates/footer', $data);
	}

	public function new()
	{
		$upload_path = './uploads/';

		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = 'jpg|png|jpeg|gif|';
		$config['max_size'] = 4096; // 
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('foto')) {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Melakukan Upload Foto.');
		} else {

			$data = array(
				'id_jadwal' 				=> $this->input->post('id_jadwal'),
				'nim'						=> $this->nim,
				'hadir'						=> $this->input->post('hadir'),
				'izin'						=> $this->input->post('izin'),
				'sakit'						=> $this->input->post('sakit'),
				'alfa'						=> $this->input->post('alfa'),
				'id_status_kehadiran'		=> $this->input->post('id_status'),
				'keterangan'				=> $this->input->post('keterangan'),
				'foto'						=> $this->upload->data('file_name'),
				'is_verify'					=> '0',
				'date_created'				=> date('Y-m-d H:i:s')
			);
			var_dump($data);

			$absenlah = $this->ModelAbsensi->newAbsen($data);

			if ($absenlah == true) {
				$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Melakukan Absensi.');
			} else {
				$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Melakukan Absensi.');
			}
		}
		redirect('absensi');
	}
}
