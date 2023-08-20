<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0"><?= $title ?></h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Beranda</a></li>
						<li class="breadcrumb-item active"><?= $title ?></li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- /.row -->
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Laporan</h4>
				</div>
				<?php if (empty($periode)) { ?>
					<div class="form-group">
						<h2 class="text-center">Tidak Ada Tahun Ajaran Aktif</h2>
					</div>
				<?php } else if (empty($dosen)) { ?>
					<div class="form-group">
						<h2 class="text-center">Tidak Ada Dosen Pengampu Pada Jadwal</h2>
					</div>
				<?php } else if (empty($jumlah) || $jumlah === '0' || $jumlah === null) { ?>
					<!-- Tidak ada personil -->
					<div class="form-group">
						<h2 class="text-center">Anda Tidak Memiliki Personil</h2>
					</div>

				<?php } else { ?>
					<form action="<?= site_url('absensi/new') ?>" method="post" enctype="multipart/form-data">

						<div class="card-body">
							<div class="form-group">
								<label for="periode">Tahun Ajaran</label>
								<input type="hidden" class="form-control" id="id_kehadiran" name="id_kehadiran">
								<input type="hidden" class="form-control" id="id_periode" name="id_periode" value="<?= $periode->id_periode; ?>" required>
								<input type="text" class="form-control" placeholder="<?= $periode->periode; ?>" readonly>
							</div>
							<div class="form-group">
								<label for="nama">Dosen Pengampu</label>
								<select class="form-control" id="dosen" name="dosen" required>
									<option value="">-- PILIH DOSEN PENGAMPU -- </option>
									<?php foreach ($dosen as $s) { ?>
										<option value="<?= $s->id_dosen ?>"><?= $s->nama ?></option>
									<?php } ?>
								</select>
							</div>

							<div class="form-group" id="idj">
								<label for="nama">Matakuliah</label>
								<select class="form-control" id="id_jadwal" name="id_jadwal" required>
								</select>
							</div>

							<div class="form-group">
								<label for="hadir">Hadir</label>
								<input type="number" class="form-control" id="hadir" name="hadir" min="0" max="<?= $jumlah ?>" value="<?= $jumlah; ?>" placeholder="Jumlah Mahasiswa Hadir" readonly>
							</div>
							<div class="form-group">
								<label for="izin">Izin</label>
								<input type="number" class="form-control" id="izin" name="izin" min="0" max="<?= $jumlah ?>" placeholder="Jumlah Mahasiswa Izin" oninput="calculateRemaining()">
							</div>
							<div class="form-group">
								<label for="sakit">Sakit</label>
								<input type="number" class="form-control" id="sakit" name="sakit" min="0" max="<?= $jumlah ?>" placeholder="Jumlah Mahasiswa Sakit" oninput="calculateRemaining()">
							</div>
							<div class="form-group">
								<label for="alfa">Alpa</label>
								<input type="number" class="form-control" id="alfa" name="alfa" min="0" max="<?= $jumlah ?>" placeholder="Jumlah Mahasiswa Alpha" oninput="calculateRemaining()">
							</div>


							<div class="form-group">
								<label for="keterangan">Materi Perkuliahan</label>
								<textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
							</div>

							<div class="form-group">
								<label for="nama">Kehadiran Dosen</label>
								<select class="form-control" id="id_status" name="id_status" required>
									<option value="">--PILIH STATUS KEHADIRAN DOSEN--</option>
									<?php foreach ($status as $s) { ?>
										<option value="<?= $s->id_status_kehadiran ?>"><?= $s->status_kehadiran ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="foto">Bukti Foto</label>
								<input type="file" class="form-control" id="foto" name="foto" placeholder="Bukti Foto" required>
							</div>
						</div>
						<div class="card-footer">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>

					</form>
				<?php } ?>
				<!-- /.card -->
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>

<!-- jQuery -->
<script src="<?= base_url('public/plugins/jquery/jquery.min.js') ?>"></script>

<?php if ($this->session->flashdata('error')) { ?>
	<script>
		$(function() {
			var Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000
			});

			toastr.error('<?php echo $this->session->flashdata('error'); ?>')
		});
	</script>
<?php } else if ($this->session->flashdata('success')) { ?>
	<script>
		$(function() {
			var Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000
			});

			toastr.success('<?php echo $this->session->flashdata('success'); ?>')
		});
	</script>
<?php } ?>


<script>
	function calculateRemaining() {
		var total = <?= $jumlah ?>;
		var izin = parseInt(document.getElementById("izin").value) || 0;
		var sakit = parseInt(document.getElementById("sakit").value) || 0;
		var alfa = parseInt(document.getElementById("alfa").value) || 0;
		if (izin + sakit + alfa > total) {
			var excess = izin + sakit + alfa - total;
			if (alfa >= excess) {
				alfa -= excess;
			} else if (sakit >= excess) {
				sakit -= excess;
			} else {
				izin -= excess;
			}
		}

		var hadir = total - (izin + sakit + alfa);

		if (hadir < 0) {
			hadir = 0;
		} else if (hadir > total) {
			hadir = total;
		}

		document.getElementById("izin").value = izin;
		document.getElementById("sakit").value = sakit;
		document.getElementById("alfa").value = alfa;
		document.getElementById("hadir").value = hadir;
	}
</script>



<script>
	$(document).ready(function() {
		$('#idj').hide();
		$('#dosen').change(function() {
			var dosen = $(this).val();
			$.ajax({
				url: 'Absensi/getMataKuliahku',
				method: 'POST',
				dataType: 'JSON',
				data: {
					dosen: dosen
				},
				success: function(response) {
					$('#idj').show();

					$('#id_jadwal').empty();
					$('#id_jadwal').append('<option value="" disabled selected>--PILIH MATAKULIAH--</option>');
					$.each(response, function(index, mataKuliah) {
						$('#id_jadwal').append('<option value="' + mataKuliah.id_jadwal + '">' + mataKuliah.mata_kuliah + '</option>');
					});
				},
				error: function(xhr, status, error) {
					console.log('Terjadi kesalahan saat mengambil data jadwal.');
					console.log('Pesan error: ' + error);
				}
			});
		});

		// Tambahkan validasi required pada elemen kedua
		$('#id_jadwal').change(function() {
			if ($(this).val() === "") {
				$(this).addClass('is-invalid'); // Tambahkan class untuk penanda invalid (sesuaikan dengan framework CSS Anda)
			} else {
				$(this).removeClass('is-invalid');
			}
		});

		// Submit form hanya jika kedua elemen terpilih
		$('form').submit(function(event) {
			if ($('#dosen').val() === "" || $('#id_jadwal').val() === "") {
				event.preventDefault();
				alert('Harap lengkapi pilihan dosen dan matakuliah.');
			}
		});
	});
</script>