<?php

class ModelAbsensi extends CI_Model
{
	public function getStatus()
	{
		return $this->db->get('tbl_mst_status_kehadiran')->result();
	}

	public function getJadwal($kelas,$semester)
	{
		return $this->db->select('a.id_jadwal,b.mata_kuliah,c.nama')
			->from('tbl_jadwal a')
			->join('tbl_mst_mata_kuliah b','a.id_mata_kuliah = b.id_mata_kuliah','left')
			->join('tbl_mst_dosen c','a.id_dosen = c.id_dosen','left')
			->where('a.id_kelas',$kelas)
			->where('a.id_semester',$semester)
			->get()
			->result();
	}

	public function newAbsen($data)
	{
		return $this->db->insert('tbl_kehadiran',$data);
	}
}
