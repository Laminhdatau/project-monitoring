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
							<h4 class="card-title">Biodata Dosen</h4>
						</div>
						<div class="col-lg-2">
							<button type="button" class="btn btn-block bg-gradient-primary" data-toggle="modal" data-target="#new-dosen"> Tambah Dosen</button>
						</div>
					</div>
				</div>
				<div class="card-body">

					<table id="tb_dosen" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="width: 5%;">NO</th>
								<th style="width: 10%;">NIDN</th>
								<th style="width: 15%;">Nama Dosen</th>
								<th style="width: 20%;">Alamat Dosen</th>
								<th style="width: 10%;">No Telfon Dosen</th>
								<th style="width: 20%;">Prodi Dosen</th>
								<th style="width: 10%;">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($dosen as $v) : ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $v->nidn; ?></td>
									<td><?= $v->nama; ?></td>
									<td><?= $v->alamat; ?></td>
									<td><?= $v->notelp; ?></td>
									<td><?= $v->prodi; ?></td>
									<td>
										<button class="btn bg-info btn-xs btn-edit" title="Edit Dosen" style="width: 30px;" data-toggle="modal" data-target="#edit-dosen" data-id="<?= $v->id_dosen; ?>">
											<i class="fas fa-pen"></i>
										</button>
										<a href="<?= base_url('biodata_user/dosen/hapus/' . $v->id_dosen) ?>">
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

<div class="modal fade" id="new-dosen">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Dosen Baru</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= site_url('biodata_user/dosen/new') ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="nidn">NIDN</label>
						<input type="text" class="form-control" id="nidn" name="nidn" placeholder="Masukan NIDN Dosen Baru" required>
					</div>
					<div class="form-group">
						<label for="nama">Nama Lengkap Dosen</label>
						<input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Lengkap Dosen Baru" required>
					</div>
					<div class="form-group">
						<label for="alamat">Alamat Dosen</label>
						<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat Dosen Baru" required>
					</div>
					<div class="form-group">
						<label for="nope">No Telfon Dosen</label>
						<input type="text" class="form-control" id="nope" name="nope" placeholder="Masukan No. Telfon Dosen Baru" required>
					</div>
					<div class="form-group">
						<label for="nama">Pilih Prodi Dosen</label>
						<select class="form-control" id="id_prodi" name="id_prodi" required>
							<option>Pilih Prodi Dosen</option>
							<?php foreach ($prodi as $p) { ?>
								<option value="<?= $p->id_prodi ?>"><?= $p->prodi ?></option>
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

<div class="modal fade" id="edit-dosen">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Data Dosen</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= site_url('biodata_user/dosen/edit') ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="nidn_edit">NIDN</label>
						<input type="hidden" class="form-control" id="id_edit" name="id_edit" placeholder="Masukan NIDN Dosen Baru" required>
						<input type="text" class="form-control" id="nidn_edit" name="nidn_edit" placeholder="Masukan NIDN Dosen Baru" required>
					</div>
					<div class="form-group">
						<label for="nama_edit">Nama Lengkap Dosen</label>
						<input type="text" class="form-control" id="nama_edit" name="nama_edit" placeholder="Masukan Nama Lengkap Dosen Baru" required>
					</div>
					<div class="form-group">
						<label for="alamat_edit">Alamat Dosen</label>
						<input type="text" class="form-control" id="alamat_edit" name="alamat_edit" placeholder="Masukan Alamat Dosen Baru" required>
					</div>
					<div class="form-group">
						<label for="nope_edit">No Telfon Dosen</label>
						<input type="text" class="form-control" id="nope_edit" name="nope_edit" placeholder="Masukan No. Telfon Dosen Baru" required>
					</div>
					<div class="form-group">
						<label for="id_prodi_edit">Pilih Prodi Dosen</label>
						<select class="form-control" id="id_prodi_edit" name="id_prodi_edit" required>
							<option>Pilih Prodi Dosen</option>
							<?php foreach ($prodi as $p) { ?>
								<option value="<?= $p->id_prodi ?>"><?= $p->prodi ?></option>
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
		$("#tb_dosen").DataTable({
			"responsive": true,
			"lengthChange": false,
			"autoWidth": false
		}).buttons().container().appendTo('#tb_dosen_wrapper .col-md-6:eq(0)');
	});
</script>

<script>
	$(document).on("click", ".btn-edit", function() {
		var id = $(this).data("id");
		$.ajax({
			url: "<?= base_url('biodata_user/dosen/getById/') ?>" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				console.log(data);
				$("#edit-dosen #id_edit").val(data.data['id_dosen']);
				$("#edit-dosen #nidn_edit").val(data.data['nidn']);
				$("#edit-dosen #nama_edit").val(data.data['nama']);
				$("#edit-dosen #alamat_edit").val(data.data['alamat']);
				$("#edit-dosen #nope_edit").val(data.data['notelp']);
				$("#edit-dosen #id_prodi_edit").val(data.data['id_prodi']);
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
