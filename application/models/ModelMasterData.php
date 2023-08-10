<?php

class ModelMasterData extends CI_Model
{
	public function getProdi()
	{
		return $this->db->get('tbl_mst_prodi')->result();
	}

	public function newProdi($data)
	{
		$this->db->insert('tbl_mst_prodi',$data);

		return true;
	}

	public function deleteProdi($id)
	{
		$this->db->where('id_prodi', $id);
		$this->db->delete('tbl_mst_prodi');

		return true;
	}

	public function getKelas()
	{
		return $this->db->get('tbl_mst_kelas')->result();
	}

	public function newKelas($data)
	{
		$this->db->insert('tbl_mst_kelas',$data);

		return true;
	}

	public function deleteKelas($id)
	{
		$this->db->where('id_kelas', $id);
		$this->db->delete('tbl_mst_kelas');

		return true;
	}

	public function getSemester()
	{
		return $this->db->get('tbl_mst_semester')->result();
	}

	public function newSemester($data)
	{
		$this->db->insert('tbl_mst_semester',$data);

		return true;
	}

	public function deleteSemester($id)
	{
		$this->db->where('id_semester', $id);
		$this->db->delete('tbl_mst_semester');

		return true;
	}

	public function getStatusKehadiran()
	{
		return $this->db->get('tbl_mst_status_kehadiran')->result();
	}

	public function newStatusKehadiran($data)
	{
		$this->db->insert('tbl_mst_status_kehadiran',$data);

		return true;
	}

	public function deleteStatusKehadiran($id)
	{
		$this->db->where('id_status_kehadiran', $id);
		$this->db->delete('tbl_mst_status_kehadiran');

		return true;
	}

	public function getMataKuliah()
	{
		return $this->db->select('a.*,b.prodi')->from('tbl_mst_mata_kuliah a')->join('tbl_mst_prodi b', 'a.id_prodi = b.id_prodi', 'left')->get()->result();
	}

	public function newMataKuliah($data)
	{
		$this->db->insert('tbl_mst_mata_kuliah',$data);

		return true;
	}

	public function deleteMataKuliah($id)
	{
		$this->db->where('id_mata_kuliah', $id);
		$this->db->delete('tbl_mst_mata_kuliah');

		return true;
	}
}
