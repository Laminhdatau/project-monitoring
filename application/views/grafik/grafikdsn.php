<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0"><?= $title ?></h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Beranda</a></li>
						<li class="breadcrumb-item active"><?= $title ?></li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<section class="content">
		<div class="container-fluid">

			<div class="row" id="graf">
				<div class="col-12">
					<div class="card ">
						<div class="row">
							<div class="col-12" id="satu">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">Grafik Pertemuan Dosen </h4>
									</div>
									<div class="card-body">
										<div class="container">
											<canvas id="myChart" width="100" height="20"></canvas>
										</div>
									</div>
								</div>
							</div>

							<div class="col-12" id="dua">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">Matakuliah</h4>
									</div>
									<div class="card-body">
										<div class="container">
											<canvas id="myChartki" width="100" height="20"></canvas>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card">
							<div class="card-header">
								<div class="row col-12 d-flex align-items-center justify-content-between">
									<div class="col-3">
										<h4 class="card-title text-center">Kehadiran Dosen</h4>
									</div>
									<div class="col-3">
										<select name="dosen" id="dosen" class="form-control">
											<option value="">-- DOSEN --</option>
											<?php foreach ($dosen as $p) { ?>
												<option value="<?= $p->id_dosen; ?>"><?= $p->nama; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-3">
										<select name="bulan" id="bulan" class="form-control">
											<option value="">-- BULAN --</option>
											<?php foreach ($bulan as $p) { ?>
												<option value="<?= $p['id_bulan']; ?>"><?= $p['bulan']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-2">
										<select name="tahun" id="tahun" class="form-control">
											<option value="">-- TAHUN --</option>
											<?php foreach ($tahun as $p) { ?>
												<option value="<?= $p['tahun']; ?>"><?= $p['tahun']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-1">
										<button id="tampil" class="btn btn-xs btn-success"><i class="fas fa-search"></i></button>
									</div>

								</div>
							</div>
							<div class="card-body">

								<table id="laporan_kehadiran" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th style="width: 3%;">NO</th>
											<th>Keting</th>
											<th>Dosen Pengampu</th>
											<th>Matakuliah</th>
											<th>Semester</th>
											<th>Kelas</th>
											<th>Hadir</th>
											<th>Tidak Hadir</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1;
										foreach ($grafik as $d) { ?>
											<tr class="item" id="item" data-idos="<?= $d->id_dosen; ?>" data-mk="<?= $d->id_mata_kuliah; ?>" data-nim="<?= $d->nim; ?>">
												<td><?= $no++; ?></td>
												<td><?= $d->nama_lengkap; ?></td>
												<td><?= $d->nama; ?></td>
												<td><?= $d->mata_kuliah; ?></td>

												<td><?= $d->semester; ?></td>
												<td><?= $d->kelas; ?></td>
												<td><?= $d->hadir; ?></td>
												<td><?= $d->alpa; ?></td>
												<td>Hadir <?= $d->hadir; ?> Kali dari 16 Pertemuan</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>

						</div>
					</div>


				</div>

			</div>
	</section>
</div>

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
	$("#graf").hide();
	$("#satu").hide();
	$("#dua").hide();
	$(document).ready(function() {
		var myChart;
		$(".item").click(function() {
			var id = $(this).data('mk');
			var nm = $(this).data('nim');
			if (myChart) {
				myChart.destroy();
			}

			$.ajax({
				url: "getKehadiranDosenById/" + id + '/' + nm,
				method: "GET",
				dataType: 'json',
				success: function(data) {
					console.log(data);
					$("#graf").show();
					$("#satu").show();
					$("#dua").hide();

					const labels = ["Hadir", "Alpa"];
					const chartData = {
						labels: labels,
						datasets: [{
							label: 'Kehadiran Dosen T.A ' + data.ta,
							data: [data.hadir, data.alpa],
							backgroundColor: [
								'rgba(255, 99, 132, 0.2)',
								'rgba(75, 192, 192, 0.2)'
							],
							borderColor: [
								'rgb(255, 99, 132)',
								'rgb(75, 192, 192)'
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
	$("#graf").hide();
	$("#satu").hide();
	$("#dua").hide();
	$(document).ready(function() {
		var myChartki;
		$('#tampil').click(function() {

			var bulan = $("#bulan").val();
			var tahun = $("#tahun").val();
			var dosen = $("#dosen").val();
			console.log("DOSEN " + dosen);
			console.log("BULAN " + bulan);
			console.log("TAHUN " + tahun);
			if (myChartki) {
				myChartki.destroy();
			}

			function getRandomColor() {
				var r, g, b;
				var alpha = Math.random(); 
				do {
					r = Math.floor(Math.random() * 256);
					g = Math.floor(Math.random() * 256);
					b = Math.floor(Math.random() * 256);
				} while (r > 200 && g > 200 && b > 200); 

				return `rgba(${r}, ${g}, ${b}, ${alpha})`;
			}

			$.ajax({
				type: "POST",
				url: "<?= base_url('grafik/getRekapMK'); ?>",
				data: {
					dosen: dosen,
					bulan: bulan,
					tahun: tahun
				},

				success: function(data) {
					console.log(data);
					$("#graf").show();
					$("#satu").hide();
					$("#dua").show();
					var ctx = document.getElementById('myChartki').getContext('2d');
					myChartki = new Chart(ctx, {
						type: 'bar',
						data: {
							labels: data.map(item => item.mata_kuliah),
							datasets: [{
								label: 'Jumlah Pertemuan',
								data: data.map(item => item.jumlah),
								backgroundColor: data.map(() => getRandomColor()),
								borderColor: data.map(() => getRandomColor()),
								borderWidth: 1
							}]
						},
						options: {
							scales: {
								y: {
									beginAtZero: true
								}
							}
						}
					});
				},
				error: function(error) {
					console.error('Error:', error);
				}
			});
		});
	});
</script>