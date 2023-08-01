<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

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

        <div class="row no-gutters">
            <?php foreach ($pengaduan as $p) : ?>
                <div class="col-md-4">
                    <div class="card shadow mb-4" style="width: 18rem;">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><?= $p['name'] ?></h6>
                        </div>
                        <img height="150" src="<?= base_url() ?>assets/img/profile/<?= $p['bukti'] ?>" class="card-img-top">
                        <div class="card-body">
                            <span class="text-dark">Laporan :</span>
                            <p><?= $p['body'] ?></p>
                            <span class="text-dark">No Identitas :</span>
                            <p><?= $p['npm'] ?></p>
                            <span class="text-dark">Tgl Pengaduan :</span>
                            <p><?= $p['created_at']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php else : ?>
        <div class="text-center">Belum Ada Pengaduan</div>
    <?php endif; ?>


</div>