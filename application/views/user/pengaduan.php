<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Selamat Datang <?= $user['name']; ?></h1>

    <h4 class="h4 mb-4 text-gray-800">Form Pengaduan Keluhan</h4>

    <div class="row">
        <div class="col-lg-6">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>
            <form action="<?= base_url('user/pengaduan'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input name="title" id="title" class="form-control"></input>
                </div>

                <div class="form-group">
                    <label for="body">Isi Laporan</label>
                    <textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="foto">Upload Foto</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="bukti" name="bukti">
                        <label class="custom-file-label" for="bukti">Choose file</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 mt-5 text-gray-800">Data Pengaduan</h1>

    <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Isi Laporan</th>
                    <th scope="col">Tgl Melapor</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($pengaduan as $p) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $p['name']; ?></td>
                        <td><?= $p['title']; ?></td>
                        <td><?= $p['body']; ?></td>
                        <td><?= $p['created_at']; ?></td>
                        <td>
                            <img src="<?= base_url('/assets/img/profile/' . $p['bukti']); ?>" alt="<?= $p['bukti']; ?>" width="100">
                        </td>
                        <td>
                            <?php
                            if ($p['status'] == '0') :
                                echo '<span class="badge badge-secondary">Sedang di verifikasi</span>';
                            elseif ($p['status'] == '1') :
                                echo '<span class="badge badge-primary">Sedang diproses oleh ' . $p['staff'] . '</span>';
                            elseif ($p['status'] == '3') :
                                echo '<span class="badge badge-success">Selesai dikerjakan ' . $p['staff'] . '</span>';
                            elseif ($p['status'] == '2') :
                                echo '<span class="badge badge-danger">Pengaduan ditolak</span>';
                            else :
                                echo '-';
                            endif;
                            ?>
                        </td>
                        <td>
                            <a href="<?= base_url('user/pengaduan_detail/' . $p['id']) ?>" class="badge badge-success"><i class="fas fa-fw fa-eye"></i></a>

                            <?php if ($p['status'] == 0) : ?>
                                <a href="#" data-toggle="modal" data-target="#updatePengaduan<?= $p['id']; ?>" class="badge badge-info">Edit</a>

                                <a href="#" data-toggle="modal" data-target="#deletePengaduan<?= $p['id']; ?>" class="badge badge-warning">Hapus</a>
                            <?php else : ?>
                                <small>Tidak ada aksi</small>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->

<!-- Modal Edit-->
<?php foreach ($pengaduan as $p) : ?>
    <div class="modal fade" id="updatePengaduan<?= $p['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updatePengaduanLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updatePengaduanLabel">Update Pengaduan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('user/pengaduanEdit/' . $p['id']); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?= $p['title']; ?>" placeholder="Judul">
                        </div>
                        <div class="form-group">
                            <label for="body">Isi laporan</label>
                            <input type="text" class="form-control" id="body" name="body" value="<?= $p['body']; ?>" placeholder="Isi Laporan">
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
<?php foreach ($pengaduan as $p) : ?>
    <div class="modal fade" id="deletePengaduan<?= $p['id']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete <?= $p['title']; ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h5>Apakah Anda Yakin Ingin Menghapus Data Ini...??</h5>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('user/pengaduanDelete/' . $p['id']) ?>" class="btn btn-danger">Delete</a>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>