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
						<li class="breadcrumb-item">Mahasiswa</li>
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
							<h4 class="card-title">Data Mahasiswa</h4>
						</div>
						<div class="col-lg-2">
							<button type="button" class="btn btn-block bg-gradient-primary" data-toggle="modal" data-target="#new-mahasiswa"> Tambah Mahasiswa</button>
						</div>
					</div>
				</div>
				<div class="card-body">

					<table id="tb_mahasiswa" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="width: 5%;">NO</th>
								<th style="width: 15%;">NIM</th>
								<th style="width: 30%;">Nama Lengkap</th>
								<th style="width: 30%;">Alamat</th>
								<th style="width: 5%;">Semester</th>
								<th style="width: 5%;">Kelas</th>
								<th style="width: 20%;">Prodi</th>
								<th style="width: 10%;">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($mahasiswa as $v) : ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $v->nim; ?></td>
									<td><?= $v->nama_lengkap; ?></td>
									<td><?= $v->alamat; ?></td>
									<td><?= $v->semester; ?></td>
									<td><?= $v->kelas; ?></td>
									<td><?= $v->prodi; ?></td>
									<td>
										<button class="btn bg-info btn-xs btn-edit" title="Edit mahasiswa" style="width: 30px;" data-toggle="modal" data-target="#edit-mahasiswa" data-idm="<?= $v->id_mahasiswa; ?>" data-idb="<?= $v->id_biodata; ?>">
											<i class="fas fa-pen"></i>
										</button>
										<a href="<?= base_url('master_data/mahasiswa/hapus/' . $v->id_mahasiswa) ?>">
											<button class="btn bg-danger btn-xs" title="Hapus mahasiswa" style="width: 30px;">
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

<div class="modal fade" id="new-mahasiswa">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Mahasiswa Baru</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= site_url('master_data/mahasiswa/new') ?>" method="POST">
				<div class="modal-body">

					<div class="form-group">
						<label for="nik">NIK</label>
						<input type="number" class="form-control" id="nik" name="nik" maxlength="16" placeholder="Masukan NIK Mahasiswa" required>
					</div>
					<div class="form-group">
						<label for="nim">NIM</label>
						<input type="number" class="form-control" id="nim" name="nim" placeholder="Masukan NIM Mahasiswa" required>
					</div>
					<div class="form-group">
						<label for="nama">Nama Lengkap</label>
						<input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Lengkap Mahasiswa" required>
					</div>
					<div class="form-group">
						<label for="nama">Alamat Lengkap</label>
						<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat Lengkap Mahasiswa" required>
					</div>
					<div class="form-group">
						<label for="jk">Jenis Kelamin</label>
						<select name="jk" id="" class="form-control" required>
							<option>Pilih Jenis Kelamin</option>
							<option value="L">Laki-Laki</option>
							<option value="P">Perempuan</option>
						</select>
					</div>
					<div class="form-group">
						<label for="id_semester">Pilih Kelas Mahasiswa</label>
						<select class="form-control" id="id_kelas" name="id_kelas" required>
							<option>Pilih Kelas Mahasiswa</option>
							<?php foreach ($kelas as $k) { ?>
								<option value="<?= $k->id_kelas ?>"><?= $k->kelas ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="id_prodi">Pilih Prodi Mahasiswa</label>
						<select class="form-control" id="id_prodi" name="id_prodi" required>
							<option>Pilih Prodi Mahasiswa</option>
							<?php foreach ($prodi as $p) { ?>
								<option value="<?= $p->id_prodi ?>"><?= $p->prodi ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="id_semester">Pilih Semester Mahasiswa</label>
						<select class="form-control" id="id_semester" name="id_semester" required>
							<option>Pilih Semester Mahasiswa</option>
							<?php foreach ($semester as $k) { ?>
								<option value="<?= $k->id_semester ?>"><?= $k->semester ?></option>
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

<div class="modal fade" id="edit-mahasiswa">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Data Ketua Tingkat</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= site_url('master_data/mahasiswa/edit') ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="nik">NIK</label>

						<input type="hidden" class="form-control" id="idm" name="idm">
						<input type="hidden" class="form-control" id="idb" name="idb">
						<input type="number" class="form-control" id="nik_edit" name="nik_edit" placeholder="Masukan NIK Mahasiswa" readonly>
					</div>
					<div class="form-group">
						<label for="nim">NIM</label>
						<input type="number" class="form-control" id="nim_edit" name="nim_edit" placeholder="Masukan NIM Mahasiswa" readonly>
					</div>
					<div class="form-group">
						<label for="nama">Nama Lengkap</label>
						<input type="text" class="form-control" id="nama_edit" name="nama_edit" placeholder="Masukan Nama Lengkap Mahasiswa" required>
					</div>
					<div class="form-group">
						<label for="nama">Alamat Lengkap</label>
						<input type="text" class="form-control" id="alamat_edit" name="alamat_edit" placeholder="Masukan Alamat Lengkap Mahasiswa" required>
					</div>
					<div class="form-group">
						<label for="jk">Jenis Kelamin</label>
						<select name="jk_edit" id="jk_edit" class="form-control" required>
							<option>Pilih Jenis Kelamin</option>
							<option value="L">Laki-Laki</option>
							<option value="P">Perempuan</option>
						</select>
					</div>
					<div class="form-group">
						<label for="id_prodi">Pilih Prodi Mahasiswa</label>
						<select class="form-control" id="id_prodi_edit" name="id_prodi_edit" required>
							<option>Pilih Prodi Mahasiswa</option>
							<?php foreach ($prodi as $p) { ?>
								<option value="<?= $p->id_prodi ?>"><?= $p->prodi ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="id_semester">Pilih Semester Mahasiswa</label>
						<select class="form-control" id="id_semester_edit" name="id_semester_edit" required>
							<option>Pilih Semester Mahasiswa</option>
							<?php foreach ($semester as $k) { ?>
								<option value="<?= $k->id_semester ?>"><?= $k->semester ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="id_semester">Pilih Kelas Mahasiswa</label>
						<select class="form-control" id="id_kelas_edit" name="id_kelas_edit" required>
							<option>Pilih Kelas Mahasiswa</option>
							<?php foreach ($kelas as $k) { ?>
								<option value="<?= $k->id_kelas ?>"><?= $k->kelas ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Edit Data</button>
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
		$("#tb_mahasiswa").DataTable({
			"responsive": true,
			"lengthChange": false,
			"autoWidth": false
		}).buttons().container().appendTo('#tb_mahasiswa_wrapper .col-md-6:eq(0)');
	});
</script>

<script>
	$(document).on("click", ".btn-edit", function() {
		var idm = $(this).data("idm");
		var idb = $(this).data("idb");
		$.ajax({
			url: "<?= base_url('master_data/mahasiswa/getById/') ?>" + idm + '/' + idb,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				console.log(data);
				$("#edit-mahasiswa #idm").val(data.data['id_mahasiswa']);
				$("#edit-mahasiswa #idb").val(data.data['id_biodata']);
				$("#edit-mahasiswa #nik_edit").val(data.data['nik']);
				$("#edit-mahasiswa #nim_edit").val(data.data['nim']);
				$("#edit-mahasiswa #nama_edit").val(data.data['nama_lengkap']);
				$("#edit-mahasiswa #alamat_edit").val(data.data['alamat']);
				$("#edit-mahasiswa #jk_edit").val(data.data['jk']);
				$("#edit-mahasiswa #id_prodi_edit").val(data.data['id_prodi']);
				$("#edit-mahasiswa #id_semester_edit").val(data.data['id_semester']);
				$("#edit-mahasiswa #id_kelas_edit").val(data.data['id_kelas']);
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