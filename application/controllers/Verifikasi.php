<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title']	=	"Verifikasi";
		$data['verifikasi']	=	$this->ModelVerifikasi->getAll();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('kaprodi/verifikasi',$data);
		$this->load->view('templates/footer',$data);
	}

	public function getById($id)
	{
		$data = $this->ModelVerifikasi->getBy($id);

		$result = array(
			'data' => $data
		);

		echo json_encode($result);
	}

	public function verifikasiAbsen()
	{
		$id = $this->input->post('id');

		$data = array(
			'is_verify' => "1"
		);

		$runtime = $this->ModelVerifikasi->updateVerifikasi($id,$data);

		if ($runtime == true) {
				$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasi Melakukan Verifikasi.');
		}else {
				$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Melakukan Verifikasi.');
			
		}
		redirect('verifikasi');
	}

}
