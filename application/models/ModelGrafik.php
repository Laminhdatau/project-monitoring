<?php

class ModelGrafik extends CI_Model
{
	public function getPertemuan()
	{
		return $this->db->get('tbl_pertemuan')->result();
	}

	public function getListPertemuan($idp = null, $bln = null)
	{
		$conditions = [];

		if ($idp != null) {
			$conditions[] = "pertemuan = '" . $idp . "'";
		}

		if ($bln != null) {
			$conditions[] = "MONTH(date_created) = '" . $bln . "'";
		}

		$whereClause = "";
		if (!empty($conditions)) {
			$whereClause = "WHERE " . implode(" AND ", $conditions);
		}

		$query = "SELECT * FROM v_per_pertemuan " . $whereClause;

		return $this->db->query($query)->result();
	}


	public function getById($id)
	{
		return $this->db->query('SELECT
		k.id_kehadiran,
				k.nim,
				b.nama_lengkap,
				k.date_created,
				d.id_dosen,
				j.id_jadwal,
				j.id_semester,
				j.id_kelas,
				c.kelas,
				p.id_periode,
				mk.mata_kuliah,
				d.nama,
				concat(p.tahun_mulai ,"-",p.tahun_selesai)as tahun_ajaran,
				k.hadir,k.izin,k.sakit,k.alfa,sum(k.hadir+k.izin+k.sakit+k.alfa) as total_mahasiswa
				
			FROM
				tbl_kehadiran k
				JOIN tbl_keting m ON m.nim = k.nim
				JOIN tbl_jadwal j ON j.id_jadwal = k.id_jadwal
				JOIN tbl_mst_dosen d ON d.id_dosen = j.id_dosen
				JOIN tbl_mst_kelas c ON c.id_kelas = j.id_kelas
				JOIN tbl_rekap_kehadiran r on r.id_kehadiran=k.id_kehadiran
				JOIN tbl_mst_periode p on p.id_periode=r.id_periode
				JOIN tbl_mst_mata_kuliah mk on mk.id_mata_kuliah=j.id_mata_kuliah
				JOIN tbl_mst_mahasiswa mh on mh.nim=m.nim
				JOIN tbl_mst_biodata b on b.nik=mh.nik
			WHERE
				k.is_verify = "1"
				and p.status="1"
				and k.id_kehadiran="' . $id . '"

			GROUP BY
				k.nim,
				d.id_dosen,
				j.id_jadwal,
				j.id_semester,
				j.id_kelas,
				p.id_periode,
				k.id_kehadiran
				ORDER BY k.nim,j.id_semester,j.id_kelas')->row();
	}




	public function getAllKehadiranMhs()
	{
		return $this->db->query('SELECT
		k.id_kehadiran,
				k.nim,
				b.nama_lengkap,
				k.date_created,
				d.id_dosen,
				j.id_jadwal,
				j.id_semester,
				sm.semester,
				j.id_kelas,
				c.kelas,
				p.id_periode,
				mk.mata_kuliah,
				d.nama,
				concat(p.tahun_mulai ,"-",p.tahun_selesai)as tahun_ajaran,
				k.hadir,k.izin,k.sakit,k.alfa,sum(k.hadir+k.izin+k.sakit+k.alfa) as jumlah_mahasiswa
				
			FROM
				tbl_kehadiran k
				JOIN tbl_keting m ON m.nim = k.nim
				JOIN tbl_jadwal j ON j.id_jadwal = k.id_jadwal
				JOIN tbl_mst_dosen d ON d.id_dosen = j.id_dosen
				JOIN tbl_mst_kelas c ON c.id_kelas = j.id_kelas
				JOIN tbl_rekap_kehadiran r on r.id_kehadiran=k.id_kehadiran
				JOIN tbl_mst_periode p on p.id_periode=r.id_periode
				JOIN tbl_mst_mata_kuliah mk on mk.id_mata_kuliah=j.id_mata_kuliah
				JOIN tbl_mst_mahasiswa mh on mh.nim=m.nim
				JOIN tbl_mst_biodata b on b.nik=mh.nik
				JOIN tbl_mst_semester sm on sm.id_semester=j.id_semester
			WHERE
				k.is_verify = "1"
				and p.status="1"
			GROUP BY
				k.nim,
				d.id_dosen,
				j.id_jadwal,
				j.id_semester,
				j.id_kelas,
				p.id_periode,
				k.id_kehadiran
				ORDER BY k.nim,j.id_semester,j.id_kelas;')->result();
	}


	public function getAllKehadiranDosen()
	{
		return $this->db->query('SELECT
		k.nim,
        b.nama_lengkap,
		d.id_dosen,
        j.id_jadwal,
        j.id_semester,
		s.semester,
        j.id_kelas,
        c.kelas,
        p.id_periode,
        j.id_mata_kuliah,
        mk.mata_kuliah,
        d.nama,
        concat(p.tahun_mulai ,"-",p.tahun_selesai)as tahun_ajaran,
		COUNT(CASE WHEN k.id_status_kehadiran = "1" THEN 1 ELSE NULL END) as hadir,
		COUNT(CASE WHEN k.id_status_kehadiran = "2" THEN 1 ELSE NULL END) as alpa
	FROM
		tbl_kehadiran k
		JOIN tbl_keting m ON m.nim = k.nim
		JOIN tbl_jadwal j ON j.id_jadwal = k.id_jadwal
		JOIN tbl_mst_dosen d ON d.id_dosen = j.id_dosen
		JOIN tbl_mst_kelas c ON c.id_kelas = j.id_kelas
        JOIN tbl_rekap_kehadiran r on r.id_kehadiran=k.id_kehadiran
        JOIN tbl_mst_periode p on p.id_periode=r.id_periode
        JOIN tbl_mst_mata_kuliah mk on mk.id_mata_kuliah=j.id_mata_kuliah
        JOIN tbl_mst_mahasiswa mh on mh.nim=m.nim
        JOIN tbl_mst_biodata b on b.nik=mh.nik
        JOIN tbl_mst_semester s on s.id_semester=j.id_semester
	WHERE
		k.is_verify = "1"
        and p.status="1"
	GROUP BY
		k.nim,
		d.id_dosen,
        j.id_jadwal,
        j.id_semester,
        j.id_mata_kuliah,
        j.id_kelas,
        p.id_periode;')->result();
	}


	public function getKehadiranDosenById($mk, $id)
	{
		return $this->db->query('SELECT
		k.nim,
		d.id_dosen,
		d.nama,
        j.id_jadwal,
        j.id_mata_kuliah,
        j.id_semester,
        j.id_kelas,
        p.id_periode,
        concat(p.tahun_mulai ,"-",p.tahun_selesai)as tahun_ajaran,
		COUNT(CASE WHEN k.id_status_kehadiran = "1" THEN 1 ELSE NULL END) as hadir,
		COUNT(CASE WHEN k.id_status_kehadiran = "2" THEN 1 ELSE NULL END) as alpa
	FROM
		tbl_kehadiran k
		JOIN tbl_keting m ON m.nim = k.nim
		JOIN tbl_jadwal j ON j.id_jadwal = k.id_jadwal
		JOIN tbl_mst_dosen d ON d.id_dosen = j.id_dosen
		JOIN tbl_mst_kelas c ON c.id_kelas = j.id_kelas
        JOIN tbl_rekap_kehadiran r on r.id_kehadiran=k.id_kehadiran
        JOIN tbl_mst_periode p on p.id_periode=r.id_periode
	WHERE
		k.is_verify = "1"
        and p.status="1"
		and m.nim="' . $id . '"
		and j.id_mata_kuliah="' . $mk . '"
	GROUP BY
		k.nim,
		d.id_dosen,
        j.id_jadwal,
        j.id_mata_kuliah,
        j.id_semester,
        j.id_kelas,
        p.id_periode;')->row();
	}



	public function getAllKehadiranDosenByDosen($id)
	{
		return $this->db->query('SELECT
		k.nim,
        b.nama_lengkap,
		d.id_dosen,
        j.id_jadwal,
        j.id_semester,
s.semester,
        j.id_kelas,
        c.kelas,
        p.id_periode,
        mk.mata_kuliah,
        d.nama,
        concat(p.tahun_mulai ,"-",p.tahun_selesai)as tahun_ajaran,
		COUNT(CASE WHEN k.id_status_kehadiran = "1" THEN 1 ELSE NULL END) as hadir,
		COUNT(CASE WHEN k.id_status_kehadiran = "2" THEN 1 ELSE NULL END) as alpa
        
	FROM
		tbl_kehadiran k
		JOIN tbl_keting m ON m.nim = k.nim
		JOIN tbl_jadwal j ON j.id_jadwal = k.id_jadwal
		JOIN tbl_mst_dosen d ON d.id_dosen = j.id_dosen
		JOIN tbl_mst_kelas c ON c.id_kelas = j.id_kelas
        JOIN tbl_rekap_kehadiran r on r.id_kehadiran=k.id_kehadiran
        JOIN tbl_mst_periode p on p.id_periode=r.id_periode
        JOIN tbl_mst_mata_kuliah mk on mk.id_mata_kuliah=j.id_mata_kuliah
        JOIN tbl_mst_mahasiswa mh on mh.nim=m.nim
        JOIN tbl_mst_biodata b on b.nik=mh.nik
        JOIN tbl_mst_semester s on s.id_semester=j.id_semester
	WHERE
		k.is_verify = "1"
        and p.status="1"
		and d.id_dosen="' . $id . '"
	GROUP BY
		k.nim,
		d.id_dosen,
        j.id_jadwal,
        j.id_semester,
        j.id_kelas,
        p.id_periode;')->result();
	}
}
