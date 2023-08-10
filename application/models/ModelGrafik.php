<?php

class ModelGrafik extends CI_Model
{
	public function getById($id)
	{
		return $this->db->query('SELECT 
		k.*,j.id_jadwal,mk.mata_kuliah,p.prodi,s.semester,b.nama_lengkap,d.nama as nama_dosen,c.kelas,m.nim,
		SUM(k.hadir+k.izin+k.sakit + k.alfa) as jumlah_mahasiswa
	FROM 
		tbl_kehadiran k
		JOIN tbl_keting m ON m.nim = k.nim
		JOIN tbl_jadwal j ON j.id_jadwal = k.id_jadwal
		JOIN tbl_mst_mata_kuliah mk ON mk.id_mata_kuliah = j.id_mata_kuliah
		JOIN tbl_mst_dosen d ON d.id_dosen = j.id_dosen
		JOIN tbl_mst_prodi p ON p.id_prodi = d.id_prodi
		JOIN tbl_mst_kelas c ON c.id_kelas = j.id_kelas
		JOIN tbl_mst_semester s ON s.id_semester = j.id_semester
		JOIN tbl_mst_mahasiswa mhs ON mhs.nim = m.nim
		JOIN tbl_mst_biodata b ON b.nik = mhs.nik
        where k.id_kehadiran="' . $id . '"
        and k.is_verify="1"
	GROUP BY k.id_kehadiran,m.nim,p.id_prodi, s.id_semester, c.id_kelas
    ORDER BY day(k.date_created)=day(now());')->row();
	}

	public function getAllKehadiranByNim($nim)
	{
		return $this->db->query('SELECT 
		k.*,j.id_jadwal,mk.mata_kuliah,p.prodi,s.semester,b.nama_lengkap,d.nama as nama_dosen,c.kelas,m.nim,
		SUM(k.hadir+k.izin+k.sakit + k.alfa) as jumlah_mahasiswa
	FROM 
		tbl_kehadiran k
		JOIN tbl_keting m ON m.nim = k.nim
		JOIN tbl_jadwal j ON j.id_jadwal = k.id_jadwal
		JOIN tbl_mst_mata_kuliah mk ON mk.id_mata_kuliah = j.id_mata_kuliah
		JOIN tbl_mst_dosen d ON d.id_dosen = j.id_dosen
		JOIN tbl_mst_prodi p ON p.id_prodi = d.id_prodi
		JOIN tbl_mst_kelas c ON c.id_kelas = j.id_kelas
		JOIN tbl_mst_semester s ON s.id_semester = j.id_semester
		JOIN tbl_mst_mahasiswa mhs ON mhs.nim = m.nim
		JOIN tbl_mst_biodata b ON b.nik = mhs.nik
		where m.nim="' . $nim . '"
	GROUP BY m.nim,k.id_kehadiran,p.id_prodi, s.id_semester, c.id_kelas;')->result();
	}


	public function getAllKehadiranMhs()
	{
		return $this->db->query('SELECT 
		k.*,j.id_jadwal,mk.mata_kuliah,p.prodi,s.semester,b.nama_lengkap,d.nama as nama_dosen,c.kelas,m.nim,
		SUM(k.hadir+k.izin+k.sakit + k.alfa) as jumlah_mahasiswa
	FROM 
		tbl_kehadiran k
		JOIN tbl_keting m ON m.nim = k.nim
		JOIN tbl_jadwal j ON j.id_jadwal = k.id_jadwal
		JOIN tbl_mst_mata_kuliah mk ON mk.id_mata_kuliah = j.id_mata_kuliah
		JOIN tbl_mst_dosen d ON d.id_dosen = j.id_dosen
		JOIN tbl_mst_prodi p ON p.id_prodi = d.id_prodi
		JOIN tbl_mst_kelas c ON c.id_kelas = j.id_kelas
		JOIN tbl_mst_semester s ON s.id_semester = j.id_semester
		JOIN tbl_mst_mahasiswa mhs ON mhs.nim = m.nim
		JOIN tbl_mst_biodata b ON b.nik = mhs.nik
	GROUP BY m.nim,k.id_kehadiran,p.id_prodi, s.id_semester, c.id_kelas;')->result();
	}



	// public function getByNim($nim)
	// {
	// 	return $this->db->query('SELECT * 
	// 	FROM tbl_kehadiran
	// 	where nim="' . $nim . '"')->result();
	// }


	// public function getAllKehadiranMhs()
	// {
	// 	return $this->db->query('SELECT * 
	// 	FROM tbl_kehadiran
	// 	')->result();
	// }
}
