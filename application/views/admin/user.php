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
						<li class="breadcrumb-item">User</li>
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
							<h4 class="card-title">User Management</h4>
						</div>
						<div class="col-lg-2">
							<button type="button" class="btn btn-block bg-gradient-primary" data-toggle="modal" data-target="#new-user"> Tambah User</button>
						</div>
					</div>
				</div>
				<div class="card-body">

					<table id="tb_jadwal" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="width: 5%;">NO</th>
								<th style="width: 35%;">Username</th>
								<th style="width: 20%;">Role</th>
								<th style="width: 35%;">Nama Pengguna</th>
								<th style="width: 5%;">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($user as $v) : ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $v->username; ?></td>
									<td><?= $v->role; ?></td>
									<td><?= $v->nama; ?></td>
									<td>
										<a href="<?= base_url('user_management/hapus/' . $v->id_user) ?>">
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

<div class="modal fade" id="new-user">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Buat User Baru</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= site_url('user_management/new') ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username" required>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password" required>
					</div>
					<div class="form-group">
						<label for="id_role">Pilih Role</label>
						<select class="form-control" id="id_role" name="id_role" required>
							<option>Pilih Role</option>
							<?php foreach ($role as $p) { ?>
								<option value="<?= $p->id_role ?>"><?= $p->role ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="id_biodata">Pilih Keting / Dosen</label>
						<select class="form-control" id="id_biodata" name="id_biodata" required>
							<option>Pilih Keting / Dosen</option>
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
	$('#id_role').change(function() {
		var id_role = $(this).val();
		$.ajax({
			type: "POST",
			url: "<?= base_url('user_management/getBiodata') ?>",
			data: {
				id_role: id_role
			},
			dataType: "json",
			success: function(response) {
				var options = '';
				$.each(response, function(key, value) {
					options += '<option value="' + value['id'] + '">' + value['nama'] + '</option>';
				});
				$('#id_biodata').html(options);
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
