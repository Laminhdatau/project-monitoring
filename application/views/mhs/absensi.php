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
				<form action="<?= site_url('absensi/new') ?>" method="post" enctype="multipart/form-data">
					<div class="card-body">
						<div class="form-group">
							<label for="nama">Pilih Jadwal</label>
							<select class="form-control" id="id_jadwal" name="id_jadwal" required>
								<option>Pilih Jadwal</option>
								<?php foreach ($dosen as $s ) { ?>
									<option value="<?= $s->id_jadwal ?>">Mata Kuliah : <?= $s->mata_kuliah ?>, Dosen Pengampuh : <?= $s->nama ?> </option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="hadir">Hadir</label>
							<input type="text" class="form-control" id="hadir" name="hadir" placeholder="Jumlah Mahasiswa Hadir">
						</div>
						<div class="form-group">
							<label for="izin">Izin</label>
							<input type="text" class="form-control" id="izin" name="izin" placeholder="Jumlah Mahasiswa Izin">
						</div>
						<div class="form-group">
							<label for="sakit">Sakit</label>
							<input type="text" class="form-control" id="sakit" name="sakit" placeholder="Jumlah Mahasiswa Sakit">
						</div>
						<div class="form-group">
							<label for="alfa">Alpha</label>
							<input type="text" class="form-control" id="alfa" name="alfa" placeholder="Jumlah Mahasiswa Alpha">
						</div>
						<div class="form-group">
							<label for="keterangan">Keterangan</label>
							<textarea class="form-control" id="keterangan" name="keterangan"></textarea>
						</div>
						<div class="form-group">
							<label for="nama">Pilih Status Kehadiran Dosen</label>
							<select class="form-control" id="id_status" name="id_status" required>
								<option>Pilih Status Kehadiran Dosen</option>
								<?php foreach ($status as $s ) { ?>
									<option value="<?= $s->id_status_kehadiran ?>"><?= $s->status_kehadiran ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="foto">Bukti Foto</label>
							<input type="file" class="form-control" id="foto" name="foto" placeholder="Bukti Foto">
						</div>
					</div>
					<div class="card-footer">
						<button type="submit" class="btn btn-primary">Absen</button>
					</div>
				</form>
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
