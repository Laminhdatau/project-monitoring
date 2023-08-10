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
					<h4 class="card-title">Laporan Kehadiran</h4>
				</div>
				<div class="card-body">

					<table id="laporan_kehadiran" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="width: 5%;">NO</th>
								<th style="width: 15%;">Semester</th>
								<th style="width: 25%;">Mata Kuliah</th>
								<th style="width: 25%;">Nama Dosen Pengampuh</th>
								<th style="width: 30%;">Keterangan</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($verifikasi as $v) : ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $v->semester; ?></td>
									<td><?= $v->mata_kuliah; ?></td>
									<td><?= $v->nama_dosen; ?></td>
									<td>Hadir Sebanyak <?= $v->jumlah_kehadiran ?> Dari 16 Pertemuan</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
				<!-- /.card -->
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>

<!-- jQuery -->
<script src="<?= base_url('public/plugins/jquery/jquery.min.js') ?>"></script>

<script>
	$(function() {
		$("#laporan_kehadiran").DataTable({
			"responsive": true,
			"lengthChange": false,
			"autoWidth": false,
			"buttons": ["excel", "pdf"]
		}).buttons().container().appendTo('#laporan_kehadiran_wrapper .col-md-6:eq(0)');
	});
</script>
