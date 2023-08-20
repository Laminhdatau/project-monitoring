SELECT
    row_number() OVER(PARTITION BY j.id_mata_kuliah ORDER BY h.date_created) AS pertemuan,
    h.id_kehadiran,
    j.id_dosen,
    j.id_kelas,
    j.id_mata_kuliah,
    h.nim,
    j.id_semester,
    h.date_created
FROM
    tbl_kehadiran h
    JOIN tbl_jadwal j ON j.id_jadwal = h.id_jadwal
WHERE
    h.date_created IS NOT NULL
    AND h.is_verify = '1'
ORDER BY
    j.id_mata_kuliah,
    h.date_created,
    h.nim
LIMIT 16;




SELECT v.*,a.hadir,a.izin,a.sakit,a.alfa,sum(a.hadir+a.izin+a.sakit+a.alfa) as jumlah_mahasiswa,vm.nama_lengkap,d.nama,k.kelas,s.semester,m.mata_kuliah
FROM v_pertemuan v 
, tbl_kehadiran a
, v_mhs vm
, tbl_pertemuan p 
, tbl_mst_dosen d 
, tbl_mst_kelas k
, tbl_mst_semester s 
, tbl_mst_mata_kuliah m
where p.id_pertemuan=v.pertemuan
and d.id_dosen=v.id_dosen
and vm.nim=v.nim
and k.id_kelas=v.id_kelas
and m.id_mata_kuliah=v.id_mata_kuliah
and s.id_semester=v.id_semester
and a.id_kehadiran=v.id_kehadiran
and v.pertemuan ='1'
GROUP BY v.id_dosen,v.nim,v.id_semester,v.id_kelas,v.id_mata_kuliah,v.id_kehadiran;