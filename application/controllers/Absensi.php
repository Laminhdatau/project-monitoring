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
		$data['periode']	=	$this->ModelAbsensi->getPeriode();
		$data['jumlah'] = $this->ModelAbsensi->getJumlahMahasiswa($this->nim);
		$data['dosen']	=	$this->ModelAbsensi->getDosenPengampuhKu($this->uyes, $this->ayas);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('mhs/absensi', $data);
		$this->load->view('templates/footer', $data);
	}


	public function getMataKuliahku()
	{
		$dosenId = $this->input->post('dosen');
		$kelasId = $this->uyes; 
		$semesterId = $this->ayas; 

		$jadwal = $this->ModelAbsensi->getJadwal($kelasId, $semesterId, $dosenId);
		echo json_encode($jadwal);
	}





	public function new()
	{
		$upload_path = './uploads/';

		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = 'jpg|png|jpeg|gif|';
		$config['max_size'] = 4096;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('foto')) {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Melakukan Upload Foto.');
		} else {

			$data = array(
				'id_kehadiran' 				=> $this->input->post('id_kehadiran'),
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

			$rekap = array(
				'id_periode'            => $this->input->post('id_periode')
			);


			$this->db->trans_start();

			$this->ModelAbsensi->newAbsen($data);
			$id_kehadiran = $this->db->insert_id();

			$rekap['id_kehadiran'] = $id_kehadiran;
			$this->ModelAbsensi->newRekap($rekap);

			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Melakukan Absensi.');
			} else {
				$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Melakukan Absensi.');
			}
		}
		redirect('absensi');
	}
}
