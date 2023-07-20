<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <a href="<?= base_url('user/pengaduan') ?>" class="btn btn-dark"><i class="fas fa-arrow-left"></i></a>
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">



        <div class="card mb-3 col-lg-8">
            <div class="row no-gutters">
                <div class="col-md-4 mt-2 ml-2">
                    <img src="<?= base_url('/assets/img/profile/' . $pengaduan['bukti']) ?>" class="card-img" alt="img user">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Laporan : <span class="text-dark"><?= $pengaduan['body'] ?></span></h5>

                        <p class="card-text"> Status :
                            <?php
                            if ($pengaduan['status'] == '0') :
                                echo '<span class="badge badge-secondary">Sedang di verifikasi</span>';
                            elseif ($pengaduan['status'] == '1') :
                                echo '<span class="badge badge-primary">Sedang di proses</span>';
                            elseif ($pengaduan['status'] == '3') :
                                echo '<span class="badge badge-success">Selesai dikerjakan ' . $pengaduan['staff'] . '</span>';
                            elseif ($pengaduan['status'] == '2') :
                                echo '<span class="badge badge-danger">Pengaduan ditolak</span>';
                            else :
                                echo '-';
                            endif;
                            ?>
                        </p>

                        <p class="card-text">Tanggapan : <span class="text-success"><?= $pengaduan['tanggapan'] ?></span></p>

                        <p class="card-text">Tgl Pengaduan : <span class="text-danger"><?= date('d-m-Y', $pengaduan['created_at']); ?></span></p>
                        <p class="card-text">
                            Tgl Tanggapan :
                            <span class="text-danger">
                                <?= $pengaduan['tanggal'] == null ? '-' : date('d-m-Y', $pengaduan['tanggal']); ?>
                            </span>
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid