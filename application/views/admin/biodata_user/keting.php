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
						<li class="breadcrumb-item">Biodata User</li>
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
							<h4 class="card-title">Biodata Ketua Tingkat</h4>
						</div>
						<div class="col-lg-2">
							<button type="button" class="btn btn-block bg-gradient-primary" data-toggle="modal" data-target="#new-keting"> Tambah Ketua Tingkat</button>
						</div>
					</div>
				</div>
				<div class="card-body">

					<table id="tb_keting" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="width: 5%;">NO</th>
								<th style="width: 15%;">NIM</th>
								<th style="width: 30%;">Nama Ketua Tingkat</th>
								<th style="width: 5%;">Semester</th>
								<th style="width: 5%;">Kelas</th>
								<th style="width: 20%;">Prodi</th>
								<th style="width: 10%;">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($keting as $v) : ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $v->nim; ?></td>
									<td><?= $v->nama; ?></td>
									<td><?= $v->semester; ?></td>
									<td><?= $v->kelas; ?></td>
									<td><?= $v->prodi; ?></td>
									<td>
										<a href="<?= base_url('biodata_user/keting/hapus/' . $v->nim) ?>">
											<button class="btn bg-danger btn-xs" title="Hapus Keting" style="width: 30px;">
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

<div class="modal fade" id="new-keting">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ketua Tingkat Baru</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= site_url('biodata_user/keting/new') ?>" method="POST">
				<div class="modal-body">

					<div class="row col-12">
						<div class="col-md-6">
							<div class="form-group">
								<label for="search_term">NIM / Nama</label>
								<input type="text" class="form-control" id="search_term" name="search_term" placeholder="Cari Nama Atau Nim" required>
								<input type="hidden" name="nim" id="nim" required readonly>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Pilih Keting</label>
								<select name="nama" id="nama" class="form-control" disabled required>
									<option>Pilih Keting</option>
									<?php foreach ($mahasiswa as $k) { ?>
										<option value="<?= $k->nim; ?>"><?= $k->nim . ' === ' . $k->nama; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>


					<div class="form-group">
						<label for="id_prodi">Pilih Prodi Ketua Tingkat</label>
						<select class="form-control" id="id_prodi" name="id_prodi" disabled required>
							<option>Pilih Prodi Ketua Tingkat</option>
							<?php foreach ($prodi as $p) { ?>
								<option value="<?= $p->id_prodi ?>"><?= $p->prodi ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="id_semester">Pilih Semester Ketua Tingkat</label>
						<select class="form-control" id="id_semester" name="id_semester" disabled required>
							<option>Pilih Semester Ketua Tingkat</option>
							<?php foreach ($semester as $k) { ?>
								<option value="<?= $k->id_semester ?>"><?= $k->semester ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="id_kelas">Pilih Kelas Ketua Tingkat</label>
						<select class="form-control" id="id_kelas" name="id_kelas" disabled required>
							<option>Pilih Prodi Ketua Tingkat</option>
							<?php foreach ($kelas as $k) { ?>
								<option value="<?= $k->id_kelas ?>"><?= $k->kelas ?></option>
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
	</div>
</div>


<!-- jQuery -->
<script src="<?= base_url('public/plugins/jquery/jquery.min.js') ?>"></script>

<script>
	$(function() {
		$("#tb_keting").DataTable({
			"responsive": true,
			"lengthChange": false,
			"autoWidth": false
		}).buttons().container().appendTo('#tb_keting_wrapper .col-md-6:eq(0)');
	});
</script>

<!-- <script>
	$(document).on("click", ".btn-edit", function() {
		var id = $(this).data("id");
		$.ajax({
			url: "<?= base_url('biodata_user/keting/getById/') ?>" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				console.log(data);
				$("#edit-keting #nim_edit").val(data.data['nim']);
				$("#edit-keting #nama_edit").val(data.data['nama']);
				$("#edit-keting #id_prodi_edit").val(data.data['id_prodi']);
				$("#edit-keting #id_semester_edit").val(data.data['id_semester']);
				$("#edit-keting #id_kelas_edit").val(data.data['id_kelas']);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert("Error get data from ajax");
			}
		});
	});
</script> -->

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





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	$(document).ready(function() {
		$("#search_term").keyup(function() {
			var search_term = $(this).val();

			if (search_term !== '' && search_term.length >= 1) { // Periksa apakah search_term tidak kosong
				$.ajax({
					url: "<?php echo site_url('biodata_user/keting/cariKeting'); ?>",
					method: "POST",
					data: {
						search_term: search_term
					},
					dataType: 'json', // Menambahkan dataType json
					success: function(data) {
						console.log(data);
						if (data) {
							$('#nim').val(data.nim);
							$('#nama').val(data.nim);
							$('#id_prodi').val(data.id_prodi);
							$('#id_semester').val(data.id_semester);
							$('#id_kelas').val(data.id_kelas);
						} else {
							$('#nim').val('');
							$('#nama').val('');
							$('#id_prodi').val('');
							$('#id_semester').val('');
							$('#id_kelas').val('');
						}
					}
				});
			} else {
				// Reset nilai input jika search_term kosong
				$('#nim').val('');
				$('#nama').val('');
				$('#id_prodi').val('');
				$('#id_semester').val('');
				$('#id_kelas').val('');
			}
		});
	});
</script>