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
						<li class="breadcrumb-item">Master Data</li>
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
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-lg-10">
									<h4 class="card-title">New Mata Kuliah</h4>
								</div>
							</div>
						</div>
						<form action="<?= site_url('master_data/mata_kuliah/new') ?>" method="POST">
							<div class="card-body">
								<div class="form-group">
									<label for="mata_kuliah">Mata Kuliah</label>
									<input type="text" class="form-control" id="mata_kuliah" name="mata_kuliah" placeholder="Mata Kuliah" required>
								</div>
								<div class="form-group">
									<label for="id_prodi">Pilih Prodi</label>
									<select class="form-control" id="id_prodi" name="id_prodi" required>
										<option>Pilih Prodi</option>
										<?php foreach ($prodi as $p) { ?>
											<option value="<?= $p->id_prodi ?>"><?= $p->prodi ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="card-footer justify-content-right">
								<button type="submit" class="btn btn-primary">Tambah</button>
							</div>
						</form>
						<!-- /.card -->
					</div>

				</div>
				<div class="col-lg-8">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-lg-10">
									<h4 class="card-title">Kelas</h4>
								</div>
							</div>
						</div>
						<div class="card-body">
							<table id="tb_kelas" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="width: 5%;">NO</th>
										<th style="width: 45%;">Mata Kuliah</th>
										<th style="width: 45%;">Prodi</th>
										<th style="width: 5%;">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1; ?>
									<?php foreach ($matakuliah as $v) : ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $v->mata_kuliah; ?></td>
											<td><?= $v->prodi; ?></td>
											<td>
												<a href="<?= base_url('master_data/mata_kuliah/hapus/' . $v->id_mata_kuliah) ?>">
													<button class="btn bg-danger btn-xs" title="Hapus Kelas" style="width: 30px;">
														<i class="fas fa-user-minus"></i>
													</button>
												</a>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
						<!-- /.card -->
					</div>
				</div>

			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>

<!-- jQuery -->
<script src="<?= base_url('public/plugins/jquery/jquery.min.js') ?>"></script>

<script>
	$(function() {
		$("#tb_kelas").DataTable({
			"responsive": true,
			"lengthChange": false,
			"autoWidth": false
		}).buttons().container().appendTo('#tb_kelas_wrapper .col-md-6:eq(0)');
	});
</script>

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
