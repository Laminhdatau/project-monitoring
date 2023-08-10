		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">


			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
						<li class="nav-item">
							<div class="user-panel mt-3 pb-3 mb-3 d-flex">
								<div class="image">
									<img src="<?= base_url('public/dist/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
								</div>
								<div class="info">
									<font color="white">
										<h4>
											&ensp;<?= $this->session->userdata('username') ?> &ensp;&ensp;
										</h4>
									</font>
								</div>
							</div>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('dashboard') ?>" class="nav-link <?php if ($title == "Dashboard") {
																						echo "active";
																					} ?>">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>
									Beranda
								</p>
							</a>
						</li>

						<?php if ($this->session->userdata('id_role') == 2) { ?>
							<li class="nav-item">
								<a href="<?= base_url('absensi') ?>" class="nav-link <?php if ($title == "Laporan") {
																							echo "active";
																						} ?>">
									<i class="nav-icon fas fa-calendar-check"></i>
									<p>
										Laporan
									</p>
								</a>
							</li>

							<li class="nav-item">
								<a href="<?= base_url('grafik/indexForMhs') ?>" class="nav-link <?php if ($title == "Grafik") {
																							echo "active";
																						} ?>">
									<i class="nav-icon fas fa-chart-bar"></i>
									<p>
										Grafik
									</p>
								</a>
							</li>
						<?php } ?>

						<?php if ($this->session->userdata('id_role') == 3) { ?>
							<li class="nav-item">
								<a href="<?= base_url('verifikasi') ?>" class="nav-link <?php if ($title == "Verifikasi") {
																							echo "active";
																						} ?>">
									<i class="nav-icon fas fa-check-square"></i>
									<p>
										Verifikasi Kehadiran
									</p>
								</a>
							</li>
						<?php } ?>

						<?php if ($this->session->userdata('id_role') == 1) { ?>
							<li class="nav-item">
								<a href="<?= base_url('user_management') ?>" class="nav-link <?php if ($title == "User Management") {
																									echo "active";
																								} ?>">
									<i class="nav-icon fas fa-user"></i>
									<p>
										User Management
									</p>
								</a>
							</li>
							<li class="nav-item <?php if ($title == "Dosen") {
													echo "menu-open";
												} elseif ($title == "Ketua Tingkat") {
													echo "menu-open";
												} ?>">
								<a href="#" class="nav-link <?php if ($title == "Dosen") {
																echo "active";
															} elseif ($title == "Ketua Tingkat") {
																echo "active";
															} ?>">
									<i class="nav-icon fas fa-users"></i>
									<p>
										Biodata User
									</p>
									<i class="right fas fa-angle-left"></i>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="<?= base_url('biodata_user/dosen') ?>" class="nav-link <?php if ($title == "Dosen") {
																											echo "active";
																										} ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Dosen</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('biodata_user/keting') ?>" class="nav-link <?php if ($title == "Ketua Tingkat") {
																												echo "active";
																											} ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Ketua Tingkat</p>
										</a>
									</li>
								</ul>
							</li>







							<li class="nav-item <?php if ($title == "Grafik Mahasiswa") {
													echo "menu-open";
												} elseif ($title == "Grafik Dosen") {
													echo "menu-open";
												} ?>">
								<a href="#" class="nav-link <?php if ($title == "Grafik Mahasiswa") {
																echo "active";
															} elseif ($title == "Grafik Dosen") {
																echo "active";
															} ?>">
									<i class="nav-icon fas fa-chart-bar"></i>
									<p>
										Grafik
									</p>
									<i class="right fas fa-angle-left"></i>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="<?= base_url('grafik/indexMhs') ?>" class="nav-link <?php if ($title == "Grafik Mahasiswa") {
																											echo "active";
																										} ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Grafik Mahasiswa</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('grafik/indexDosen') ?>" class="nav-link <?php if ($title == "Grafik Dosen") {
																												echo "active";
																											} ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Grafik Dosen</p>
										</a>
									</li>
								</ul>
							</li>







							<li class="nav-item">
								<a href="<?= base_url('setting_jadwal') ?>" class="nav-link <?php if ($title == "Setting Jadwal") {
																								echo "active";
																							} ?>">
									<i class="nav-icon fas fa-bell"></i>
									<p>
										Setting Jadwal
									</p>
								</a>
							</li>


						<?php } ?>

						<?php if ($this->session->userdata('id_role') == 4) { ?>
							<li class="nav-item">
								<a href="<?= base_url('laporan') ?>" class="nav-link <?php if ($title == "Laporan") {
																							echo "active";
																						} ?>">
									<i class="nav-icon fas fa-file"></i>
									<p>
										Laporan Kehadiran
									</p>
								</a>
							</li>
						<?php } ?>

						<?php if ($this->session->userdata('id_role') == 1) { ?>
							<li class="nav-item <?php if ($title == "Prodi") {
													echo "menu-open";
												} elseif ($title == "Semester") {
													echo "menu-open";
												} elseif ($title == "Kelas") {
													echo "menu-open";
												} elseif ($title == "Mata Kuliah") {
													echo "menu-open";
												} elseif ($title == "Status Kehadiran") {
													echo "menu-open";
												} ?>">
								<a href="#" class="nav-link <?php if ($title == "Prodi") {
																echo "active";
															} elseif ($title == "Semester") {
																echo "active";
															} elseif ($title == "Kelas") {
																echo "active";
															} elseif ($title == "Mata Kuliah") {
																echo "active";
															} elseif ($title == "Status Kehadiran") {
																echo "active";
															} ?>">
									<i class="nav-icon fas fa-brain"></i>
									<p>
										Master Data
									</p>
									<i class="right fas fa-angle-left"></i>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="<?= base_url('master_data/prodi') ?>" class="nav-link <?php if ($title == "Prodi") {
																											echo "active";
																										} ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Prodi</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('master_data/mahasiswa') ?>" class="nav-link <?php if ($title == "Mahasiswa") {
																												echo "active";
																											} ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Mahasiswa</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('master_data/semester') ?>" class="nav-link <?php if ($title == "Semester") {
																												echo "active";
																											} ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Semester</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('master_data/kelas') ?>" class="nav-link <?php if ($title == "Kelas") {
																											echo "active";
																										} ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Kelas</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('master_data/mata_kuliah') ?>" class="nav-link <?php if ($title == "Mata Kuliah") {
																													echo "active";
																												} ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Mata Kuliah</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= base_url('master_data/status_kehadiran') ?>" class="nav-link <?php if ($title == "Status Kehadiran") {
																														echo "active";
																													} ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Status Kehadiran</p>
										</a>
									</li>
								</ul>
							</li>
						<?php } ?>

						<li class="nav-item">
							<a href="<?= base_url('auth/logout') ?>" class="nav-link">
								<i class="nav-icon fas fa-sign-out-alt"></i>
								<p>
									Log Out
								</p>
							</a>
						</li>
					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>