<?php

class ModelMahasiswa extends CI_Model
{

	public function getProdi()
	{
		return $this->db->get('tbl_mst_prodi')->result();
	}

	public function getBiodata()
	{
		return $this->db->get('tbl_mst_biodata')->result();
	}

	public function getKelas()
	{
		return $this->db->get('tbl_mst_kelas')->result();
	}

	public function getSemester()
	{
		return $this->db->get('tbl_mst_semester')->result();
	}
	public function getAll()
	{
		return $this->db->select('a.*,b.*,c.prodi,d.semester,e.kelas')
			->from('tbl_mst_mahasiswa a')
			->join('tbl_mst_biodata b', 'b.nik=a.nik', 'left')
			->join('tbl_mst_prodi c', 'c.id_prodi=a.id_prodi', 'left')
			->join('tbl_mst_semester d', 'd.id_semester=a.id_semester', 'left')
			->join('tbl_mst_kelas e', 'e.id_kelas=a.id_kelas', 'left')
			->get()
			->result();
	}

	public function getById($id,$idb)
	{
		return $this->db->select('a.*,b.*,c.prodi,d.semester,e.kelas')
			->from('tbl_mst_mahasiswa a')
			->join('tbl_mst_biodata b', 'b.nik=a.nik', 'left')
			->join('tbl_mst_prodi c', 'c.id_prodi=a.id_prodi', 'left')
			->join('tbl_mst_semester d', 'd.id_semester=a.id_semester', 'left')
			->join('tbl_mst_kelas e', 'e.id_kelas=a.id_kelas', 'left')
			->where('a.id_mahasiswa', $id)
			->where('b.id_biodata', $idb)
			->get()
			->row();
	}

	public function newMahasiswa($data)
	{
		$this->db->set('id_mahasiswa', 'uuid()', false);
		$this->db->insert('tbl_mst_mahasiswa', $data);
		return true;
	}

	public function editMahasiswa($id, $data)
	{
		$this->db->where('id_mahasiswa', $id);
		$this->db->update('tbl_mst_mahasiswa', $data);

		return true;
	}

	public function deleteMahasiswa($id)
	{
		$this->db->where('id_mahasiswa', $id);
		$this->db->delete('tbl_mst_mahasiswa');

		return true;
	}
}
