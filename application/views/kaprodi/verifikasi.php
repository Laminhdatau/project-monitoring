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
					<h4 class="card-title">Verifikasi Kehadiran</h4>
				</div>
				<div class="card-body">

					<table id="absensi_verifikasi" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="width: 5%;">NO</th>
								<th style="width: 25%;">Mata Kuliah</th>
								<th style="width: 25%;">Nama Dosen Pengampuh</th>
								<th style="width: 25%;">Nama Ketua Tinggkat</th>
								<th style="width: 20%;">Tanggal, Jam Absensi</th>
								<th style="width: 10%;">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($verifikasi as $v) : ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $v->mata_kuliah; ?></td>
									<td><?= $v->nama_dosen; ?></td>
									<td><?= $v->nama_keting; ?></td>
									<td><?= date("d-m-Y", strtotime($v->date_created)); ?></td>
									<td>
										<button class="btn bg-info btn-xs btn-edit" title="Verifikasi Kehadiran" style="width: 30px;" data-toggle="modal" data-target="#verifikasi-absen" data-id="<?= $v->id_kehadiran ?>">
											<i class="fas fa-pen"></i>
										</button>
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

<div class="modal fade" id="verifikasi-absen">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Verfikasi Kehadiran</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12 col-sm-6">
						<div class="col-12">
							<img src="" id="bukti-foto" class="product-image" alt="Foto Bukti">
						</div>
					</div>
					<div class="col-12 col-sm-6">
						<div class="form-group">
							<label for="mata_kuliah">Mata Kuliah</label>
							<input type="text" class="form-control" id="mata_kuliah" name="mata_kuliah" disabled>
						</div>
						<div class="form-group">
							<label for="nama_dosen">Nama Dosen</label>
							<input type="text" class="form-control" id="nama_dosen" name="nama_dosen" disabled>
						</div>
						<div class="form-group">
							<label for="nama_keting">Nama Keting</label>
							<input type="text" class="form-control" id="nama_keting" name="nama_keting" disabled>
						</div>
						<div class="form-group">
							<label for="waktu">Tanggal, Waktu Absensi</label>
							<input type="text" class="form-control" id="waktu" name="waktu" disabled>
						</div>
						<div class="row">
							<div class="form-group col-lg-3">
								<label for="hadir">Hadir</label>
								<input type="text" class="form-control" id="hadir" name="hadir" disabled>
							</div>
							<div class="form-group col-lg-3">
								<label for="alfa">Alfa</label>
								<input type="text" class="form-control" id="alfa" name="alfa" disabled>
							</div>
							<div class="form-group col-lg-3">
								<label for="izin">Izin</label>
								<input type="text" class="form-control" id="izin" name="izin" disabled>
							</div>
							<div class="form-group col-lg-3">
								<label for="sakit">Sakit</label>
								<input type="text" class="form-control" id="sakit" name="sakit" disabled>
							</div>
						</div>
						<div class="form-group">
							<label for="ket">Keterangan</label>
							<textarea class="form-control" id="ket" name="ket" disabled></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<form action="<?= base_url('verifikasi/verifikasiAbsen') ?>" method="post">
						<input type="hidden" class="form-control" id="id" name="id">
						<button type="submit" class="btn btn-primary">Verifikasi Laporan</button>
					</form>
				</div>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<!-- jQuery -->
<script src="<?= base_url('public/plugins/jquery/jquery.min.js') ?>"></script>

<script>
	$(function() {
		$("#absensi_verifikasi").DataTable({
			"responsive": true,
			"lengthChange": false,
			"autoWidth": false
		}).buttons().container().appendTo('#absensi_verifikasi_wrapper .col-md-6:eq(0)');
	});
</script>

<script>
	$(document).on("click", ".btn-edit", function() {
		var id = $(this).data("id");
		$.ajax({
			url: "<?= base_url('verifikasi/getById/') ?>" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				console.log(data);
				$('#id').val(data.data['id_kehadiran']);
				$('#mata_kuliah').val(data.data['mata_kuliah']);
				$('#nama_dosen').val(data.data['nama_dosen']);
				$('#nama_keting').val(data.data['nama_keting']);
				$('#waktu').val(data.data['waktu']);
				$('#hadir').val(data.data['hadir']);
				$('#alfa').val(data.data['alfa']);
				$('#izin').val(data.data['izin']);
				$('#sakit').val(data.data['sakit']);
				$('#ket').text(data.data['keterangan']);
				$('#bukti-foto').attr('src', "<?= base_url('uploads/') ?>" + data.data['foto']);
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
