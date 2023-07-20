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

            <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newStaffModal">Add New Staff</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($staffs as $s) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $s['staff']; ?></td>
                            <td><?= $s['kategori']; ?></td>
                            <td><?= $s['email']; ?></td>
                            <td><?= $s['role']; ?></td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#updateStaff<?= $s['id']; ?>" class="badge badge-success">edit</a>
                                <a href="#" data-toggle="modal" data-target="#delete<?= $s['id']; ?>" class="badge badge-danger">delete</a>
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

<!-- Modal Tambah-->
<div class="modal fade" id="newStaffModal" tabindex="-1" role="dialog" aria-labelledby="newStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newStaffModalLabel">New Staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/staffs'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="staff" name="staff" placeholder="Staff" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Kategori" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <select name="role_id" id="role_id" class="form-control" required>
                            <option value="">Select Menu</option>
                            <?php foreach ($role as $r) : ?>
                                <option value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
                            <?php endforeach; ?>
                            <!-- <option value="1" selected>Menu 2</option> -->
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit-->
<?php foreach ($staffs as $s) : ?>
    <div class="modal fade" id="updateStaff<?= $s['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateStaffLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateStaffLabel">Update Staff</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/staffEdit/' . $s['id']); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="staff" name="staff" value="<?= $s['staff']; ?>" placeholder="name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="kategori" name="kategori" value="<?= $s['kategori']; ?>" placeholder="Kategori" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="email" name="email" value="<?= $s['email']; ?>" placeholder="Email" readonly>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <select name="role_id" id="role_id" class="form-control" required>
                                <option value="">Select Menu</option>
                                <?php foreach ($role as $r) : ?>
                                    <option value="<?= $r['id']; ?>" <?= $r['id'] == $s['role_id'] ? 'selected' : ''; ?>><?= $r['role']; ?></option>
                                <?php endforeach; ?>
                                <!-- <option value="1" selected>Menu 2</option> -->
                            </select>
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
<?php foreach ($staffs as $s) : ?>
    <div class="modal fade" id="delete<?= $s['id']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete <?= $s['staff']; ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h5>Apakah Anda Yakin Ingin Menghapus Data Ini...??</h5>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('admin/staff_delete/' . $s['id']) ?>" class="btn btn-danger">Delete</a>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>