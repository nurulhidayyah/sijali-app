<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?php if ($pengaduan) : ?>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Nik</th>
                    <th scope="col">Laporan</th>
                    <th scope="col">Tgl P</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tanggapan</th>
                    <th scope="col">Tgl T</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($pengaduan as $p) : ?>
                    <tr>
                        <th scope="row"><?= $no++; ?></th>
                        <td><?= $p['name'] ?></td>
                        <td><?= $p['npm'] ?></td>
                        <td><?= $p['title'] ?></td>
                        <td><?=  $p['created_at']; ?></td>
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
                        <td><?= $p['tanggapan'] == null ? '-' : $p['tanggapan']; ?></td>
                        <td><?= $p['tanggal'] == null ? '-' : date('d-m-Y', $p['tanggal']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a target="_blank" href="<?= base_url('admin/generate_laporan') ?>" class="btn btn-primary mt-2">Preview or Download</a>

    <?php else : ?>
        <p class="text-center">Belum ada data</p>
    <?php endif; ?>
</div>
<!-- /.container-fluid -->