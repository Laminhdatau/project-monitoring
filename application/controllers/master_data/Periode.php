<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Periode extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title']		=	"Periode";
		$data['periode']	=	$this->ModelPeriode->getPeriode();
		$data['cek']	=	$this->ModelPeriode->cekAda();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('admin/master_data/periode', $data);
		$this->load->view('templates/footer', $data);
	}

	public function new()
	{
		$data = array(
			'tahun_mulai'	=>  $this->input->post('tahunMulai'),
			'tahun_selesai'	=>  $this->input->post('tahunSelesai'),
			'status'	=>  '0'
		);

		$tambah = $this->ModelPeriode->newPeriode($data);

		if ($tambah == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Menambahakan Periode Baru.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Menambahakan Periode Baru.');
		}
		redirect('master_data/periode');
	}

	public function updateStatus()
{
    $id = $this->input->post('id_periode');
    $newStatus = $this->input->post('status');

    $data = array(
        'status' => $newStatus
    );

    $result = $this->ModelPeriode->updatePeriode($id, $data);

    if ($result) {
        echo json_encode(array('status' => 'success', 'newStatus' => $newStatus));
    } else {
        echo json_encode(array('status' => 'error'));
    }
}




	public function hapus($id)
	{
		$hapus = $this->ModelPeriode->deletePeriode($id);

		if ($hapus == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Menghapus Data Periode.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Menghapus Data Periode.');
		}
		redirect('master_data/periode');
	}
}
