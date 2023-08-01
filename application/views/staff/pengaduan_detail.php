<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800">Selamat Datang <?= $user['staff']; ?></h1>
    <a href="<?= base_url('staff/pengaduan') ?>" class="btn btn-dark"><i class="fas fa-arrow-left"></i></a>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 mt-3 text-gray-800">Data Pengaduan</h1>

    <?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert">
            <?= validation_errors(); ?>
        </div>
    <?php endif; ?>

    <div class="card no-border mb-3 col-lg-8">
        <div class="justify-content-center">
            <div class="">
                <h3 class="mt-2 mb-2"></h3>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-md-6 text-center">
                <img src="<?= base_url() ?>assets/img/profile/<?= $pengaduan['bukti'] ?>" alt="" class="mt-2 mb-2" width="250">
            </div>

            <div class="col-md-6">
                <div class="card-body">
                    <h5 class="card-title">Tgl Pengaduan : <?= $pengaduan['created_at']; ?></h5>
                    <p class="card-text">Status : <?= $pengaduan['status'] == 1 ? 'Diproses' : ''; ?></p>
                    <p class="card-text"><small class="text-muted">Laporan : <?= $pengaduan['body'] ?></small></p>
                </div>
            </div>
        </div>
    </div>

    <h1 class="h3 mb-4 text-gray-800">Masukan Tanggapan Anda</h1>

    <div class="row" style="margin-bottom: 200px;">
        <div class="col-lg-6">

            <?= form_open('staff/tanggapan'); ?>

            <input type="hidden" name="id" value="<?= $pengaduan['id']; ?>">

            <label for="">Status Tanggapan</label>
            <div class="form-group">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="status-setuju" value="3">
                    <label class="form-check-label" for="status-setuju"> Setuju</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="status-tolak" value="2">
                    <label class="form-check-label" for="status-tolak"> Tolak</label>
                </div>
            </div>

            <div class="form-group">
                <label for="tanggapan">Tanggapan</label>
                <textarea name="tanggapan" class="form-control" id="tanggapan" cols="30" rows="10"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <?= form_close(); ?>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->