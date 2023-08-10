<?php

class ModelBiodata extends CI_Model
{


	public function getAll()
	{
		return $this->db->get('tbl_mst_biodata')->result();
	}

	public function getById($id)
	{
		return $this->db->select('*')
			->from('tbl_mst_biodata')
			->where('id_biodata', $id)
			->get()
			->row();
	}

	public function newBiodata($data)

	{
		$this->db->set('id_biodata', 'uuid()', false);
		$this->db->insert('tbl_mst_biodata', $data);

		return true;
	}

	public function editBiodata($id, $data)
	{
		$this->db->where('id_biodata', $id);
		$this->db->update('tbl_mst_biodata', $data);

		return true;
	}

	public function deleteBiodata($id)
	{
		$this->db->where('id_biodata', $id);
		$this->db->delete('tbl_mst_biodata');

		return true;
	}
}
