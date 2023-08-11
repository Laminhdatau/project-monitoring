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
			<div class="row">
				<div class="col-8">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Rekapan Kehadiran Dosen</h4>
						</div>
						<div class="card-body">

							<table id="laporan_kehadiran" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="width: 3%;">NO</th>
										<th>Keting</th>
										<th>Nama Dosen</th>
										<th>Semester</th>
										<th>Kelas</th>
										<th>Hadir</th>
										<th>Ijin</th>
										<th>Alpa</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($grafik as $d) { ?>
										<tr class="item" data-nim="<?= $d->nim; ?>">
											<td><?= $no++; ?></td>
											<td><?= $d->nama_lengkap; ?></td>
											<td><?= $d->nama; ?></td>
											<td><?= $d->semester; ?></td>
											<td><?= $d->kelas; ?></td>
											<td><?= $d->hadir; ?></td>
											<td><?= $d->izin; ?></td>
											<td><?= $d->alpa; ?></td>
											<td>Hadir <?= $d->hadir; ?> Kali dari 16 Pertemuan</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<!-- /.card -->
					</div>
				</div>

				<div class="col-4">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Grafik Pertemuan Dosen </h4>
						</div>
						<div class="card-body">
							<div class="container">
								<canvas id="myChart"></canvas>
							</div>
						</div>
						<!-- /.card -->
					</div>
				</div>
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



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
	$(document).ready(function() {
		var myChart;


		$(".item").click(function() {
			var id = $(this).data('nim');
console.log(id);
			if (myChart) {
				myChart.destroy();
			}

			$.ajax({
				url: "getKehadiranDosenById/" + id,
				method: "GET",
				dataType: 'json',
				success: function(data) {
					console.log(data);

					const labels = ["Hadir", "Ijin", "Alpa"];
					const chartData = {
						labels: labels,
						datasets: [{
							label: 'Kehadiran Dosen T.A '+ data.ta,
							data: [data.hadir, data.izin, data.alpa],
							backgroundColor: [
								'rgba(255, 99, 132, 0.2)',
								'rgba(75, 192, 192, 0.2)',
								'rgba(153, 102, 255, 0.2)'
							],
							borderColor: [
								'rgb(255, 99, 132)',
								'rgb(75, 192, 192)',
								'rgb(153, 102, 255)'
							],
							borderWidth: 1
						}]
					};

					const chartConfig = {
						type: 'bar',
						data: chartData,
						options: {
							scales: {
								y: {
									beginAtZero: true
								}
							}
						}
					};

					var ctx = document.getElementById('myChart').getContext('2d');
					myChart = new Chart(ctx, chartConfig);
				}
			});
		});
	});
</script>