<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php
    $session = $this->session->userdata('email');
    $user = $this->db->get_where('user', ['email' => $session])->row_array();
    $staff = $this->db->get_where('staff', ['email' => $session])->row_array();
    ?>

    <div class="row">
        <div class="col-lg-8">

            <?= form_open_multipart('setting/edit'); ?>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <?php if ($staff) : ?>
                        <input type="text" class="form-control" id="email" name="email" value="<?= $staff['email']; ?>" readonly>
                    <?php else : ?>
                        <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Full name</label>
                <div class="col-sm-10">
                    <?php if ($staff) : ?>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $staff['staff']; ?>">
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                    <?php else : ?>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="no_telp" class="col-sm-2 col-form-label">No Telepon</label>
                <div class="col-sm-10">
                    <?php if ($user) : ?>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= $user['no_telp']; ?>">
                        <?= form_error('no_telp', '<small class="text-danger pl-3">', '</small>'); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">Picture</div>
                <div class="col-sm-10">
                    <div class="row">
                        <?php if ($staff) : ?>
                            <div class="col-sm-3">
                                <img src="<?= base_url('assets/img/profile/') . $staff['image']; ?>" class="img-thumbnail">
                            </div>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                    <?= form_error('image', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="col-sm-3">
                                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
                            </div>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                    <?= form_error('image', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </div>


            </form>


        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->