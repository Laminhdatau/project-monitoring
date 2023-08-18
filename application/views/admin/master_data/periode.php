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
									<h4 class="card-title">New Tahun Ajaran</h4>
								</div>
							</div>
						</div>
						<form action="<?= site_url('master_data/periode/new') ?>" method="POST">
							<div class="card-body">
								<div class="form-group">
									<label for="tahunMulai">Tahun Mulai</label>
									<input type="number" class="form-control" id="tahunMulai" name="tahunMulai" placeholder="Tahun Mulai" required min="1900" max="2099">
								</div>
								<div class="form-group">
									<label for="tahunSelesai">Tahun Selesai</label>
									<input type="number" class="form-control" id="tahunSelesai" name="tahunSelesai" placeholder="Tahun Selesai" required min="1900" max="2099">
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
									<h4 class="card-title">Tahun Ajaran</h4>
								</div>
							</div>
						</div>
						<div class="card-body">
							<table id="tb_prodi" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="width: 5%;">NO</th>
										<th style="width: 70%;">Tahun Ajaran</th>
										<th style="width: 20%;">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1; ?>
									<?php foreach ($periode as $v) : ?>



										<tr>
											<td><?= $no++ ?></td>
											<td>
												<?= $v->periode; ?>
											</td>
											<td>
												<button class="btnStatus btnStts btn btn-xs bg-<?= $v->status == '0' ? 'danger' : 'success'; ?>" data-id="<?= $v->id_periode; ?>" data-status="<?= $v->status; ?>">
													<?= $v->status == '0' ? 'Non-Aktif' : 'Aktif'; ?>
												</button>

												<?php if ($cek->ada == $v->id_periode) { ?>

													<a href="#">
														<button class="btn bg-dark btn-xs" title="Hapus Periode" style="width: 30px;">
															<i class="fas fa-user-minus"></i>
														</button>
													</a>

												<?php } else { ?>
													<a href="<?= base_url('master_data/periode/hapus/' . $v->id_periode) ?>">
														<button class="btn bg-danger btn-xs" title="Hapus Periode" style="width: 30px;">
															<i class="fas fa-user-minus"></i>
														</button>
													</a>
												<?php } ?>


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
		$("#tb_prodi").DataTable({
			"responsive": true,
			"lengthChange": false,
			"autoWidth": false
		}).buttons().container().appendTo('#tb_prodi_wrapper .col-md-6:eq(0)');
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





<script>
	$(document).ready(function() {
		$('.btnStatus').click(function() {
			var button = $(this); // Simpan tombol yang diklik dalam variabel
			var id = button.data('id');
			var currentStatus = button.data('status');
			var newStatus = currentStatus === '0' ? '0' : '1';

			$.ajax({
				url: "<?php echo base_url('master_data/periode/updateStatus'); ?>",
				method: "POST",
				data: {
					id_periode: id,
					status: newStatus
				},
				dataType: "json",
				success: function(response) {
					if (response.status === 'success') {
						// Handle success, e.g., show a success message
						console.log(response);

						$('.btnStatus').removeClass('bg-success').addClass('bg-danger').text('Non-Aktif');
						button.removeClass('bg-success bg-danger').addClass(newStatus === '0' ? 'bg-danger' : 'bg-success').text(newStatus === '0' ? 'Non-Aktif' : 'Aktif');
						// button.removeClass('bg-success bg-danger ').addClass(newStatus === '1' ? 'bg-success':'bg-danger').text(newStatus === '1' ? 'Aktif' : 'Non-Aktif');

					} else {
						// Handle error, e.g., show an error message
						alert('Error updating status.');
					}
				},
				error: function() {
					// Handle error, e.g., show an error message
					alert('Error updating status. Please try again.');
				}
			});
		});
	});
</script>