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
							<div class="row col-12 d-flex align-items-center justify-content-between">
								<div class="col-6">
									<h4 class="card-title text-center">Rekapan Kehadiran Mahasiswa</h4>
								</div>
								<div class="col-6">
									<select name="idpertemuan" id="idpertemuan" class="form-control">
										<option value="">--PILIH PERTEMUAN--</option>
										<?php foreach ($pertemuan as $p) { ?>
											<option value="<?= $p->id_pertemuan; ?>"><?= $p->pertemuan; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>


						<div class="card-body">
							<table id="laporan_kehadiran" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="width: 3%;">NO</th>
										<th>Tanggal</th>
										<th>Keting</th>
										<th>Semester</th>
										<th>Kelas</th>
										<th>Matakuliah</th>
										<th>Dosen Pengampu</th>
										<th style="width: 12%;">Jumlah Mahasiswa</th>
									</tr>
								</thead>
								<tbody id="item1">
									<?php $no = 1;
									foreach ($data as $d) { ?>
										<tr class="item" data-id="<?= $d->id_kehadiran; ?>">
											<td><?= $no++; ?></td>
											<td><?= $d->date_created; ?></td>
											<td><?= $d->nama_lengkap; ?></td>
											<td><?= $d->semester; ?></td>
											<td><?= $d->kelas; ?></td>
											<td><?= $d->mata_kuliah; ?></td>
											<td><?= $d->nama; ?></td>
											<td><?= $d->jumlah_mahasiswa . ' Orang'; ?></td>
										</tr>
									<?php } ?>


								</tbody>
								<tbody id="item2">

								</tbody>

							</table>
						</div>
					</div>
				</div>

				<div class="col-4">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Grafik Mahasiswa Kelas </h4>
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




<script>
	$(document).ready(function() {
		var myChart;
		$(".item").click(function() {
			var id = $(this).data('id');

			if (myChart) {
				myChart.destroy();
			}

			$.ajax({
				url: "getGrafikById/" + id,
				method: "GET",
				dataType: 'json',
				success: function(data) {
					console.log(data);

					const labels = ["Hadir", "Ijin", "Sakit", "Alpa"];
					const chartData = {
						labels: labels,
						datasets: [{
							label: 'Kehadiran Mahasiswa T.A ' + data.ta,
							data: [data.hadir, data.izin, data.sakit, data.alfa],
							backgroundColor: [
								'rgba(255, 99, 132, 0.2)',
								'rgba(75, 192, 192, 0.2)',
								'rgba(153, 102, 255, 0.2)',
								'rgba(54, 162, 235, 0.2)'
							],
							borderColor: [
								'rgb(255, 99, 132)',
								'rgb(75, 192, 192)',
								'rgb(153, 102, 255)',
								'rgb(54, 162, 235)'
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


<script>
	$(document).ready(function() {
		$('#item2').hide();
		$('#idpertemuan').change(function() {
			var idp = $(this).val();
			$.ajax({
				url: 'getRekapByPertemuan',
				method: 'post',
				dataType: 'json',
				data: {
					idpertemuan: idp
				},
				success: function(response) {
					$('#item2').show();
					$('#item1').hide();

					$('#item2').empty();

					// Loop melalui data yang diterima dari respons JSON
					$.each(response, function(index, data) {
						console.log(data.id_kehadiran);
						var newRow = `
                            <tr class="item2" data-idku="${data.id_kehadiran}">
                                <td>${index + 1}</td>
                                <td>${data.date_created}</td>
                                <td>${data.nama_lengkap}</td>
                                <td>${data.semester}</td>
                                <td>${data.kelas}</td>
                                <td>${data.mata_kuliah}</td>
                                <td>${data.nama}</td>
                                <td>${data.jumlah_mahasiswa} Orang</td>
                            </tr>
                        `;

						$('#item2').append(newRow);
					});
				}
			})
		})
	})
</script>


<script>
	$(document).ready(function() {
		var myChart;

		// Menggunakan event delegation dengan .on() untuk elemen dinamis
		$(document).on("click", ".item2", function() {
			var id = $(this).data('idku');

			if (myChart) {
				myChart.destroy();
			}

			$.ajax({
				url: "getGrafikById/" + id,
				method: "GET",
				dataType: 'json',
				success: function(data) {
					console.log(data);

					const labels = ["Hadir", "Ijin", "Sakit", "Alpa"];
					const chartData = {
						labels: labels,
						datasets: [{
							label: 'Kehadiran Mahasiswa T.A ' + data.ta,
							data: [data.hadir, data.izin, data.sakit, data.alfa],
							backgroundColor: [
								'rgba(255, 99, 132, 0.2)',
								'rgba(75, 192, 192, 0.2)',
								'rgba(153, 102, 255, 0.2)',
								'rgba(54, 162, 235, 0.2)'
							],
							borderColor: [
								'rgb(255, 99, 132)',
								'rgb(75, 192, 192)',
								'rgb(153, 102, 255)',
								'rgb(54, 162, 235)'
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