<?php

class ModelUser extends CI_Model
{
	public function getRole()
	{
		return $this->db->get('tbl_mst_role')->result();
	}

	public function getAll()
	{
		return $this->db->select('a.id_user, a.username, b.role, IF(a.id_role = "2", d.nama_lengkap,c.nama) AS nama')
			->from('tbl_user a')
			->join('tbl_mst_role b', 'a.id_role = b.id_role', 'left')
			->join('tbl_mst_dosen c', 'a.id_biodata = c.id_dosen', 'left')
			->join('tbl_mst_biodata d', 'd.id_biodata = a.id_biodata', 'left')
			->join('tbl_mst_mahasiswa e', 'e.nik = d.nik', 'left')
			->join('tbl_keting f', 'f.nim = e.nim', 'left')
			->get()
			->result();
	}

	public function getBiodata($id)
	{
		if ($id == 2) {
			return $this->db->select('b.id_biodata as id, b.nama_lengkap as nama')->from('tbl_keting a
			,tbl_mst_biodata b
			,tbl_mst_mahasiswa c
			')
			->where('b.nik=c.nik')
			->where('a.nim=c.nim')
			->get()->result();
		} else { 
			return $this->db->select('a.id_dosen as id, a.nama')->from('tbl_mst_dosen a')->get()->result();
		}
	}

	public function newUser($data)
	{
		$this->db->insert('tbl_user', $data);

		return true;
	}

	public function deleteUser($id)
	{
		$this->db->where('id_user', $id);
		$this->db->delete('tbl_user');

		return true;
	}
}
