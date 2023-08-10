<?php

class ModelLaporan extends CI_Model
{
	public function getAll()
	{
		return $this->db->select('f.semester, d.nama as nama_dosen,c.mata_kuliah,COUNT(a.id_kehadiran) as jumlah_kehadiran')
			->from('tbl_kehadiran a')
			->join('tbl_keting e','a.nim = e.nim','left')
			->join('tbl_jadwal b','a.id_jadwal = b.id_jadwal','left')
			->join('tbl_mst_mata_kuliah c','b.id_mata_kuliah = c.id_mata_kuliah','left')
			->join('tbl_mst_semester f', 'b.id_semester = f.id_semester', 'left')
			->join('tbl_mst_dosen d','b.id_dosen = d.id_dosen','left')
			->where_not_in('a.is_verify',"0")
			->group_by('f.semester, d.nama, c.mata_kuliah')
			->get()
			->result();
	}
}
