<?php

class ModelVerifikasi extends CI_Model
{
	public function getAll()
	{
		return $this->db->select('a.id_kehadiran,d.nama as nama_dosen,c.mata_kuliah,f.nama_lengkap as nama_keting, a.date_created')
			->from('tbl_kehadiran a')
			->join('tbl_keting e','a.nim = e.nim','left')
			->join('tbl_jadwal b','a.id_jadwal = b.id_jadwal','left')
			->join('tbl_mst_mata_kuliah c','b.id_mata_kuliah = c.id_mata_kuliah','left')
			->join('tbl_mst_dosen d','b.id_dosen = d.id_dosen','left')
			->join('tbl_mst_mahasiswa g','g.nim = e.nim','left')
			->join('tbl_mst_biodata f','f.nik = g.nik','left')
			->where_not_in('a.is_verify',"1")
			->get()
			->result();
	}

	public function getBy($id)
	{
		return $this->db->select('a.id_kehadiran,a.hadir,a.izin,a.sakit,a.alfa,a.foto,a.keterangan,d.nama as nama_dosen,c.mata_kuliah,f.nama_lengkap as nama_keting,DATE_FORMAT(a.date_created, "%d-%m-%Y, %H:%i") as waktu ')
			->from('tbl_kehadiran a')
			->join('tbl_keting e','a.nim = e.nim','left')
			->join('tbl_jadwal b','a.id_jadwal = b.id_jadwal','left')
			->join('tbl_mst_mata_kuliah c','b.id_mata_kuliah = c.id_mata_kuliah','left')
			->join('tbl_mst_dosen d','b.id_dosen = d.id_dosen','left')
			->join('tbl_mst_mahasiswa g','g.nim = e.nim','left')
			->join('tbl_mst_biodata f','f.nik = g.nik','left')
			->where('a.id_kehadiran',$id)
			->get()
			->row();
	}

	public function updateVerifikasi($id,$data)
	{
		$this->db->where('id_kehadiran', $id);
		$this->db->update('tbl_kehadiran', $data);

		return true;		
	}
}
