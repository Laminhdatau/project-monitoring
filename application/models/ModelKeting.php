<?php

class ModelKeting extends CI_Model
{
	public function getProdi()
	{
		return $this->db->get('tbl_mst_prodi')->result();
	}

	public function getKelas()
	{
		return $this->db->get('tbl_mst_kelas')->result();
	}

	public function getSemester()
	{
		return $this->db->get('tbl_mst_semester')->result();
	}

	public function getMhs()
	{
		return $this->db->select('a.nim,b.nama_lengkap as nama,c.prodi,d.semester,e.kelas')
			->from('tbl_mst_mahasiswa a')
			->join('tbl_mst_biodata b', 'b.nik=a.nik', 'left')
			->join('tbl_mst_prodi c', 'c.id_prodi=a.id_prodi', 'left')
			->join('tbl_mst_semester d', 'd.id_semester=a.id_semester', 'left')
			->join('tbl_mst_kelas e', 'e.id_kelas=a.id_kelas', 'left')
			->get()
			->result();
	}

	public function getSearch($search_term)
	{
		$result = $this->db->select('e.*, c.semester, d.kelas, f.nama_lengkap as nama, b.id_prodi, e.id_semester, e.id_kelas')
			->from('tbl_mst_mahasiswa e')
			->join('tbl_mst_biodata f', 'f.nik = e.nik', 'left')
			->join('tbl_mst_prodi b', 'e.id_prodi = b.id_prodi', 'left')
			->join('tbl_mst_semester c', 'e.id_semester = c.id_semester', 'left')
			->join('tbl_mst_kelas d', 'e.id_kelas = d.id_kelas', 'left')
			->group_start()
			->like('e.nim', $search_term)
			->or_like('f.nama_lengkap', $search_term)
			->group_end()
			->get()
			->row();

		if ($result) {
			$additional_data = $this->db->select('e.id_prodi, e.id_semester, e.id_kelas, f.nama_lengkap as nama')
				->from('tbl_mst_mahasiswa e')
				->join('tbl_mst_biodata f', 'f.nik = e.nik', 'left')
				->join('tbl_keting k', 'e.nim = k.nim', 'left')
				->where('e.nim', $result->nim)
				->where('k.nim IS NULL')
				->get()
				->row();


			if ($additional_data) { 
				$result->nama = $additional_data->nama;
				$result->id_prodi = $additional_data->id_prodi;
				$result->id_semester = $additional_data->id_semester;
				$result->id_kelas = $additional_data->id_kelas;
			} else {
				$result->nama = null;
				$result->id_prodi = null;
				$result->id_semester = null;
				$result->id_kelas = null;
			}
		}

		return $result;
	}



	public function getAll()
	{
		return $this->db->select('a.*, b.prodi, c.semester, d.kelas,e.nik,f.nama_lengkap as nama')
			->from('tbl_keting a')
			->join('tbl_mst_mahasiswa e', 'e.nim = a.nim', 'left')
			->join('tbl_mst_biodata f', 'f.nik = e.nik', 'left')
			->join('tbl_mst_prodi b', 'e.id_prodi = b.id_prodi', 'left')
			->join('tbl_mst_semester c', 'e.id_semester = c.id_semester', 'left')
			->join('tbl_mst_kelas d', 'e.id_kelas = d.id_kelas', 'left')
			->get()
			->result();
	}

	public function getById($id)
	{
		return $this->db->select('a.*, b.prodi, c.semester, d.kelas,e.nik,f.nama_lengkap as nama')
			->from('tbl_keting a')
			->join('tbl_mst_mahasiswa e', 'e.nim = a.nim', 'left')
			->join('tbl_mst_biodata f', 'f.nik = e.nik', 'left')
			->join('tbl_mst_prodi b', 'e.id_prodi = b.id_prodi', 'left')
			->join('tbl_mst_semester c', 'e.id_semester = c.id_semester', 'left')
			->join('tbl_mst_kelas d', 'e.id_kelas = d.id_kelas', 'left')
			->where('a.nim', $id)
			->get()
			->row();
	}

	public function newKeting($data)
	{
		$this->db->insert('tbl_keting', $data);
		return true;
	}

	public function newJumlahMhs($data)
	{
		$this->db->insert('tbl_jumlah_mahasiswa', $data);
		return true;
	}

	public function editKeting($id, $data)
	{
		$this->db->where('nim', $id);
		$this->db->update('tbl_keting', $data);

		return true;
	}

	public function deleteKeting($id)
	{
		$this->db->where('nim', $id);
		$this->db->delete('tbl_keting');

		return true;
	}
}
