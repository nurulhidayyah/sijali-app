<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card mb-3 col-lg-8">
        <div class="row no-gutters">
            <div class="col-md-4">
                <?php
                $session = $this->session->userdata('email');
                $user = $this->db->get_where('user', ['email' => $session])->row_array();
                $staff = $this->db->get_where('staff', ['email' => $session])->row_array();
                ?>

                <?php if ($staff) : ?>
                    <img src="<?= base_url('assets/img/profile/') . $staff['image']; ?>" class="card-img">
                <?php else : ?>
                    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img">
                <?php endif; ?>

            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <?php if ($staff) : ?>
                        <h5 class="card-title"><?= $staff['staff']; ?></h5>
                        <p class="card-text"><?= $staff['email']; ?></p>
                        <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $staff['date_created']); ?></small></p>
                    <?php else : ?>
                        <h5 class="card-title"><?= $user['name']; ?></h5>
                        <p class="card-text"><?= $user['email']; ?></p>
                        <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $user['date_created']); ?></small></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->