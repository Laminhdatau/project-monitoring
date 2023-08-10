<?php

class ModelDosen extends CI_Model
{
	public function getProdi()
	{
		return $this->db->get('tbl_mst_prodi')->result();
	}

	public function getAll()
	{
		return $this->db->select('a.*,b.prodi')
			->from('tbl_mst_dosen a')
			->join('tbl_mst_prodi b','a.id_prodi = b.id_prodi','left')
			->get()
			->result();
	}

	public function getById($id)
	{
		return $this->db->select('a.*,b.prodi')
			->from('tbl_mst_dosen a')
			->join('tbl_mst_prodi b','a.id_prodi = b.id_prodi','left')
			->where('a.id_dosen',$id)
			->get()
			->row();
	}

	public function newDosen($data)
	{
		$this->db->insert('tbl_mst_dosen',$data);

		return true;
	}

	public function editDosen($id, $data)
	{
		$this->db->where('id_dosen', $id);
		$this->db->update('tbl_mst_dosen', $data);

		return true;
	}

	public function deleteDosen($id)
	{
		$this->db->where('id_dosen', $id);
		$this->db->delete('tbl_mst_dosen');

		return true;
	}
}
