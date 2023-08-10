<?php

class ModelSettingJadwal extends CI_Model
{
	public function getProdi()
	{
		return $this->db->get('tbl_mst_prodi')->result();
	}

	public function getMatKul($id)
	{
		return $this->db->where('id_prodi',$id)->get('tbl_mst_mata_kuliah')->result();
	}

	public function getAll()
	{
		return $this->db->select('a.id_jadwal, b.id_mata_kuliah,b.mata_kuliah, c.nama as nama_dosen, d.semester, e.kelas, f.prodi')
				->from('tbl_jadwal a')
				->join('tbl_mst_mata_kuliah b', 'a.id_mata_kuliah = b.id_mata_kuliah','left')
				->join('tbl_mst_dosen c', 'a.id_dosen = c.id_dosen','left')
				->join('tbl_mst_semester d', 'a.id_semester = d.id_semester','left')
				->join('tbl_mst_kelas e', 'a.id_kelas = e.id_kelas','left')
				->join('tbl_mst_prodi f', 'b.id_prodi = f.id_prodi', 'left')
				->get()
				->result();
	}

	public function getById($id)
	{
		return $this->db->select('a.*,b.id_prodi')
			->from('tbl_jadwal a')
			->join('tbl_mst_mata_kuliah b','a.id_mata_kuliah = b.id_mata_kuliah','left')
			->where('a.id_jadwal',$id)
			->get()
			->result();
	}

	public function newJadwal($data)
	{
		$this->db->insert('tbl_jadwal',$data);
		
		return true;
	}

	public function deleteJadwal($id)
	{
		$this->db->where('id_jadwal', $id);
		$this->db->delete('tbl_jadwal');

		return true;
	}
}
