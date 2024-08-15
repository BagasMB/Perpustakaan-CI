  <div class="row">

  	<div class="col-lg-6 mb-4 order-0">
  		<div class="card">
  			<div class="d-flex align-items-end row">
  				<div class="col-sm-7">
  					<div class="card-body">
  						<h5 class="card-title text-primary">Selamat Datang <?= $this->session->userdata('nama'); ?>! 🎉</h5>
  						<p class="mb-4">
  							You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
  							your profile.
  						</p>

  						<a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
  					</div>
  				</div>
  				<div class="col-sm-5 text-center text-sm-left">
  					<div class="card-body pb-0 px-0 px-md-4">
  						<img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>

  	<div class="col-lg-6 col-md-4 order-1">
  		<div class="row">
  			<div class="col-lg-4 col-md-12 col-6 mb-4">
  				<div class="card">
  					<div class="card-body">
  						<div class="card-title d-flex align-items-start justify-content-between">
  							<div class="avatar flex-shrink-0">
  								<img src="../assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded" />
  							</div>
  						</div>
  						<span class="fw-semibold d-block mb-1">Buku</span>
  						<h3 class="card-title text-nowrap mb-1"><?= $data_buku; ?></h3>
  					</div>
  				</div>
  			</div>
  			<div class="col-lg-4 col-md-12 col-6 mb-4">
  				<div class="card">
  					<div class="card-body">
  						<div class="card-title d-flex align-items-start justify-content-between">
  							<div class="avatar flex-shrink-0">
  								<img src="../assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded" />
  							</div>
  						</div>
  						<span class="fw-semibold d-block mb-1">Peminjaman</span>
  						<h3 class="card-title text-nowrap mb-1"><?= $peminjaman; ?></h3>
  					</div>
  				</div>
  			</div>
  			<div class="col-lg-4 col-md-12 col-6 mb-4">
  				<div class="card">
  					<div class="card-body">
  						<div class="card-title d-flex align-items-start justify-content-between">
  							<div class="avatar flex-shrink-0">
  								<img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
  							</div>
  						</div>
  						<span class="fw-semibold d-block mb-1">Ulasan</span>
  						<h3 class="card-title text-nowrap mb-1"><?= $ulasan; ?></h3>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
  </div>
  <style>
  	.card-img-top {
  		width: 100%;
  		/* Lebar 100% dari container */
  		height: 200px;
  		/* Atur tinggi gambar sesuai keinginan */
  		object-fit: cover;
  		/* Memastikan gambar terpotong secara proporsional */
  		object-position: center;
  		/* Memusatkan gambar */
  	}

  	/* CSS untuk ikon bintang */
  	.stars {
  		display: flex;
  		color: gold;
  		align-items: center;
  		font-size: 1.5rem;
  		/* Sesuaikan ukuran bintang jika perlu */
  	}

  	.stars i {
  		margin: 0;
  		/* Menghapus margin default */
  		padding: 0;
  		/* Menghapus padding default jika ada */
  	}
  </style>
  <div class="row mb-5">
  	<?php foreach ($buku as $key => $value) : ?>
  		<div class="col-md-6 col-xl-3">
  			<div class="card mb-3">
  				<img class="card-img-top" src="<?= base_url('assets/img/buku/' . $value['foto']); ?>" alt="Card image cap">
  				<div class="card-body">
  					<div class="d-flex justify-content-between">
  						<h5 class="card-title"><?= $value['judul']; ?></h5>
  						<small class="text-muted"><?= $value['penulis']; ?> | <?= $value['tahun_terbit']; ?></small>
  						<?php
							$rating = $value['rata_rata_rating'];
							$fullStars = floor($rating);
							$halfStar = ($rating - $fullStars) >= 0.5 ? 1 : 0;
							$emptyStars = 5 - $fullStars - $halfStar;
							?>
  					</div>
  					<div class="mb-2">
  						<span class="stars">
  							<?= str_repeat('<i class="bx bxs-star"></i>', $fullStars); ?>
  							<?= str_repeat('<i class="bx bxs-star-half"></i>', $halfStar); ?> <!-- Optional: can use different character for half-star if needed -->
  							<?= str_repeat('<i class="bx bx-star"></i>', $emptyStars); ?>
  						</span>
  					</div>
  					<a href="<?= base_url('koleksi/simpan/' . $value['id_buku']); ?>" class="btn btn-primary btn-sm"><i class="bx bx-list-check"></i> Tambah Koleksi</a>
  				</div>
  			</div>
  		</div>
  	<?php endforeach; ?>
  </div>