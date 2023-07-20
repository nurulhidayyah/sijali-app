<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">NPM</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($users as $u) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $u['name']; ?></td>
                            <td><?= $u['npm']; ?></td>
                            <td><?= $u['email']; ?></td>
                            <td><?= $u['role']; ?></td>
                            <td><?= $u['status']; ?></td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#updateUser<?= $u['id']; ?>" class="badge badge-success">edit</a>
                                <a href="#" data-toggle="modal" data-target="#delete<?= $u['id']; ?>" class="badge badge-danger">delete</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>


        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->

<!-- Modal Edit-->
<?php foreach ($users as $u) : ?>
    <div class="modal fade" id="updateUser<?= $u['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateUserLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateUserLabel">Update Users</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/usersEdit/' . $u['id']); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" value="<?= $u['name']; ?>" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="npm" name="npm" value="<?= $u['npm']; ?>" placeholder="NPM">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="email" name="email" value="<?= $u['email']; ?>" placeholder="Email" readonly>
                        </div>
                        <div class="form-group">
                            <select name="menu_id" id="menu_id" class="form-control">
                                <option value="">Select Menu</option>
                                <?php foreach ($role as $r) : ?>
                                    <option value="<?= $r['id']; ?>" <?= $r['id'] == $u['role_id'] ? 'selected' : '' ; ?> ><?= $r['role']; ?></option>
                                <?php endforeach; ?>
                                <!-- <option value="1" selected>Menu 2</option> -->
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-activated" type="checkbox" value="1" name="is_active" id="is_active" <?= $u['is_active'] == 1 ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="is_active">
                                    Active?
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Hapus-->
<?php foreach ($users as $u) : ?>
    <div class="modal fade" id="delete<?= $u['id']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete <?= $u['name']; ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h5>Apakah Anda Yakin Ingin Menghapus Data Ini...??</h5>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('admin/users_delete/' . $u['id']) ?>" class="btn btn-danger">Delete</a>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>