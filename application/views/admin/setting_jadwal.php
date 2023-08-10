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
						<li class="breadcrumb-item">Jadwal</li>
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
					<div class="row">
						<div class="col-lg-10">
							<h4 class="card-title">Setting Jadwal</h4>
						</div>
						<div class="col-lg-2">
							<button type="button" class="btn btn-block bg-gradient-primary" data-toggle="modal" data-target="#new-jadwal"> Tambah Jadwal</button>
						</div>
					</div>
				</div>
				<div class="card-body">

					<table id="tb_jadwal" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="width: 5%;">NO</th>
								<th style="width: 20%;">Mata Kuliah</th>
								<th style="width: 15%;">Nama Dosen</th>
								<th style="width: 10%;">Semester</th>
								<th style="width: 10%;">Kelas</th>
								<th style="width: 20%;">Prodi</th>
								<th style="width: 10%;">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($jadwal as $v) : ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $v->mata_kuliah; ?></td>
									<td><?= $v->nama_dosen; ?></td>
									<td><?= $v->semester; ?></td>
									<td><?= $v->kelas; ?></td>
									<td><?= $v->prodi; ?></td>
									<td>
										<button class="btn bg-info btn-xs btn-edit" title="Edit Mata Kuliah" style="width: 30px;" data-toggle="modal" data-target="#edit-jadwal" data-id="<?= $v->id_jadwal; ?>">
											<i class="fas fa-pen"></i>
										</button>
										<a href="<?= base_url('setting_jadwal/hapus/' . $v->id_jadwal) ?>">
											<button class="btn bg-danger btn-xs" title="Hapus Mata Kuliah" style="width: 30px;">
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
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>

<div class="modal fade" id="new-jadwal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Buat Jadwal Baru</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= site_url('setting_jadwal/new') ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="id_prodi">Pilih Prodi</label>
						<select class="form-control" id="id_prodi" name="id_prodi" required>
							<option>Pilih Prodi</option>
							<?php foreach ($prodi as $p) { ?>
								<option value="<?= $p->id_prodi ?>"><?= $p->prodi ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="id_mata_kuliah">Pilih Mata Kuliah</label>
						<select class="form-control" id="id_mata_kuliah" name="id_mata_kuliah" required>
							<option>Pilih Mata Kuliah</option>
						</select>
					</div>
					<div class="form-group">
						<label for="id_semester">Pilih Semester</label>
						<select class="form-control" id="id_semester" name="id_semester" required>
							<option>Pilih Semester</option>
							<?php foreach ($semester as $s) { ?>
								<option value="<?= $s->id_semester ?>"><?= $s->semester ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="id_kelas">Pilih Kelas</label>
						<select class="form-control" id="id_kelas" name="id_kelas" required>
							<option>Pilih Kelas</option>
							<?php foreach ($kelas as $k) { ?>
								<option value="<?= $k->id_kelas ?>"><?= $k->kelas ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="id_dosen">Pilih Dosen Pengampuh</label>
						<select class="form-control" id="id_dosen" name="id_dosen" required>
							<option>Pilih Dosen Pengampuh</option>
							<?php foreach ($dosen as $d) { ?>
								<option value="<?= $d->id_dosen ?>"><?= $d->nama ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Tambah Baru</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="edit-jadwal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Data Dosen</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<form action="<?= site_url('setting_jadwal/new') ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="id_prodi_edit">Pilih Prodi</label>
						<input type="hidden" id="id_edit" name="id_edit">
						<select class="form-control" id="id_prodi_edit" name="id_prodi_edit" required>
							<option>Pilih Prodi</option>
							<?php foreach ($prodi as $p) { ?>
								<option value="<?= $p->id_prodi ?>"><?= $p->prodi ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="id_mata_kuliah_edit">Pilih Mata Kuliah</label>
						<select class="form-control" id="id_mata_kuliah_edit" name="id_mata_kuliah_edit" required>
							<option>Pilih Mata Kuliah</option>
							<?php foreach ($mk as $m) { ?>
								<option value="<?= $m->id_mata_kuliah ?>"><?= $m->mata_kuliah ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="id_semester_edit">Pilih Semester</label>
						<select class="form-control" id="id_semester_edit" name="id_semester_edit" required>
							<option>Pilih Semester</option>
							<?php foreach ($semester as $s) { ?>
								<option value="<?= $s->id_semester ?>"><?= $s->semester ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="id_kelas_edit">Pilih Kelas</label>
						<select class="form-control" id="id_kelas_edit" name="id_kelas_edit" required>
							<option>Pilih Kelas</option>
							<?php foreach ($kelas as $k) { ?>
								<option value="<?= $k->id_kelas ?>"><?= $k->kelas ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="id_dosen_edit">Pilih Dosen Pengampuh</label>
						<select class="form-control" id="id_dosen_edit" name="id_dosen_edit" required>
							<option>Pilih Dosen Pengampuh</option>
							<?php foreach ($dosen as $d) { ?>
								<option value="<?= $d->id_dosen ?>"><?= $d->nama ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Edit Jadwal</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<!-- jQuery -->
<script src="<?= base_url('public/plugins/jquery/jquery.min.js') ?>"></script>

<script>
	$(function() {
		$("#tb_dosen").DataTable({
			"responsive": true,
			"lengthChange": false,
			"autoWidth": false
		}).buttons().container().appendTo('#tb_dosen_wrapper .col-md-6:eq(0)');
	});
</script>

<script>
	$('#id_prodi').change(function() {
		var id_prodi = $(this).val();
		$.ajax({
			type: "POST",
			url: "<?= base_url('setting_jadwal/getMatKul') ?>",
			data: {
				id_prodi: id_prodi
			},
			dataType: "json",
			success: function(response) {
				var options = '';
				$.each(response, function(key, value) {
					options += '<option value="' + value['id_mata_kuliah'] + '">' + value['mata_kuliah'] + '</option>';
				});
				$('#id_mata_kuliah').html(options);
			}
		});
	});

	$(document).on("click", ".btn-edit", function() {
		var id = $(this).data("id");
		$.ajax({
			url: "<?= base_url('setting_jadwal/getById/') ?>" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$("#edit-jadwal #id_edit").val(data.data[0]['id_jadwal']);
				$("#edit-jadwal #id_prodi_edit").val(data.data[0]['id_prodi']);
				$("#edit-jadwal #id_mata_kuliah_edit").val(data.data[0]['id_mata_kuliah']);
				$("#edit-jadwal #id_semester_edit").val(data.data[0]['id_semester']);
				$("#edit-jadwal #id_kelas_edit").val(data.data[0]['id_kelas']);
				$("#edit-jadwal #id_dosen_edit").val(data.data[0]['id_dosen']);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert("Error get data from ajax");
			}
		});
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
