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