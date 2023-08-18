<?php

class ModelPeriode extends CI_Model
{
	public function getPeriode()
	{
		return $this->db->query('select a.id_periode,concat(a.tahun_mulai,"-",a.tahun_selesai)as periode,a.status from tbl_mst_periode a order by id_periode')->result();
	}


	function cekAda()
	{
		return $this->db->query("select r.id_periode as ada
		from tbl_mst_periode a
		,tbl_rekap_kehadiran r 
		where r.id_periode=a.id_periode;")->row();
	}

	public function newPeriode($data)
	{
		$this->db->insert('tbl_mst_periode', $data);

		return true;
	}

	public function updatePeriode($id, $data)
	{
		$this->db->trans_start();

		// Jika data yang akan diubah memiliki status 1
		if (isset($data['status']) && $data['status'] === '1') {
			// Set status 0 untuk semua baris
			$this->db->update('tbl_mst_periode', array('status' => '0'));
		}

		// Update data
		$this->db->where('id_periode', $id);
		$this->db->update('tbl_mst_periode', $data);

		$this->db->trans_complete();

		return $this->db->trans_status();
	}



	public function deletePeriode($id)
	{
		$this->db->where('id_periode', $id);
		$this->db->delete('tbl_mst_periode');

		return true;
	}
}
