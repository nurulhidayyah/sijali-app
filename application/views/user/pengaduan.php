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
                        <td><?= date('Y-m-d', $p['created_at']); ?></td>
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
                                <a href="<?= base_url('Masyarakat/PengaduanController/edit/' . $p['id']) ?>" class="badge badge-info">Edit</a>

                                <a href="<?= base_url('Masyarakat/PengaduanController/pengaduan_batal/' . $p['id']) ?>" class="badge badge-warning">Hapus</a>
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