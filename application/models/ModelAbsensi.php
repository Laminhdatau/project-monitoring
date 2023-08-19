<?php

class ModelAbsensi extends CI_Model
{

	public function getJumlahMahasiswa($nim)
	{
		$this->db->select('jumlah_mahasiswa');
		$this->db->where('nim_keting', $nim);
		$query = $this->db->get('tbl_jumlah_mahasiswa');

		if ($query->num_rows() > 0) {
			return $query->row()->jumlah_mahasiswa;
		} else {
			return 0;
		}
	}

	public function getDosenPengampuhKu($sm, $kls)
	{
		return $this->db->query('SELECT d.id_dosen,d.nama FROM tbl_mst_dosen d
		, tbl_jadwal j
		where d.id_dosen=j.id_dosen
		and j.id_semester="' . $sm . '"
		and j.id_kelas="' . $kls . '"
		GROUP BY d.id_dosen')->result();
	}

	public function getStatus()
	{
		return $this->db->get('tbl_mst_status_kehadiran')->result();
	}

	public function getPeriode()
	{
		return $this->db->query('SELECT p.id_periode,concat(p.tahun_mulai,"-",p.tahun_selesai)as periode
		FROM tbl_mst_periode p 
		WHERE p.status="1"')->row();
	}


	public function getJadwal($kelas, $semester, $dosen)
	{
		return $this->db->select('a.id_jadwal,b.mata_kuliah,c.id_dosen,c.nama')
			->from('tbl_jadwal a')
			->join('tbl_mst_mata_kuliah b', 'a.id_mata_kuliah = b.id_mata_kuliah', 'left')
			->join('tbl_mst_dosen c', 'a.id_dosen = c.id_dosen', 'left')
			->where('a.id_kelas', $kelas)
			->where('a.id_semester', $semester)
			->where('c.id_dosen', $dosen)
			->get()
			->result();
	}

	public function newAbsen($data)
	{
		return $this->db->insert('tbl_kehadiran', $data);
	}


	public function newRekap($data)
	{
		return $this->db->insert('tbl_rekap_kehadiran', $data);
	}
}
