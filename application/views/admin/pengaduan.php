<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Selamat Datang <?= $user['name']; ?></h1>
    <h1 class="h3 mb-4 mt-3 text-gray-800">Data Pengaduan</h1>

    <?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert">
            <?= validation_errors(); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <?php if (!empty($pengaduan)) : ?>
        <div class="row">

            <?php foreach ($pengaduan as $p) : ?>
                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><?= $p['name']; ?></h6>
                        </div>
                        <div style="overflow: auto; height: 150px;">
                            <img src="<?= base_url() ?>assets/img/profile/<?= $p['bukti'] ?>" class="card-img-top">
                        </div>
                        <div class="card-body">
                            <span class="text-dark">Judul :</span>
                            <p><?= $p['title'] ?></p>
                            <span class="text-dark">No Identitas :</span>
                            <p><?= $p['npm'] ?></p>
                            <span class="text-dark">Tgl Pengaduan :</span>
                            <p><?= $p['created_at']; ?></p>
                        </div>
                        <div class="text-center mb-2">
                            <?= form_open('admin/pengaduan_detail'); ?>
                            <input type="hidden" name="id" value="<?= $p['id'] ?>">
                            <button class="btn btn-success" name="terima">Lihat Detail</button>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <div class="text-center">Belum Ada Pengaduan</div>
    <?php endif; ?>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->