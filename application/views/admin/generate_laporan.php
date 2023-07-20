<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <style>
        body {
            margin-top: 20px;
            background-color: #f7f7ff;
        }

        #invoice {
            padding: 0px;
        }

        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 15px
        }

        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #0d6efd
        }

        .invoice .company-details {
            text-align: right
        }

        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .contacts {
            margin-bottom: 20px
        }

        .invoice .invoice-to {
            text-align: left
        }

        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .invoice-details {
            text-align: right
        }

        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #0d6efd
        }

        .invoice main {
            padding-bottom: 50px
        }

        .invoice main .thanks {
            margin-top: -100px;
            font-size: 2em;
            margin-bottom: 50px
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #0d6efd;
            background: #e7f2ff;
            padding: 10px;
        }

        .invoice main .notices .notice {
            font-size: 1.2em
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px
        }

        .invoice table td,
        .invoice table th {
            padding: 15px;
            background: #eee;
            border-bottom: 1px solid #fff
        }

        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px
        }

        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #0d6efd;
            font-size: 1.2em
        }

        .invoice table .qty,
        .invoice table .total,
        .invoice table .unit {
            text-align: right;
            font-size: 1.2em
        }

        .invoice table .no {
            color: #fff;
            font-size: 1.6em;
            background: #0d6efd
        }

        .invoice table .unit {
            background: #ddd
        }

        .invoice table .total {
            background: #0d6efd;
            color: #fff
        }

        .invoice table tbody tr:last-child td {
            border: none
        }

        .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa
        }

        .invoice table tfoot tr:first-child td {
            border-top: none
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0px solid rgba(0, 0, 0, 0);
            border-radius: .25rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
        }

        .invoice table tfoot tr:last-child td {
            color: #0d6efd;
            font-size: 1.4em;
            border-top: 1px solid #0d6efd
        }

        .invoice table tfoot tr td:first-child {
            border: none
        }

        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0
        }

        @media print {
            .invoice {
                font-size: 11px !important;
                overflow: hidden !important
            }

            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }

            .invoice>div:last-child {
                page-break-before: always
            }
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #0d6efd;
            background: #e7f2ff;
            padding: 10px;
        }
    </style>

</head>

<body id="page-top">

    <div class="container">
        <div class="card">
            <div class="card-body">
                <div id="invoice">
                    <div class="invoice overflow-auto">
                        <div style="min-width: 600px">
                            <main>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th scope="text-right">Nama</th>
                                            <th scope="text-right">No Identitas</th>
                                            <th scope="text-right">Laporan</th>
                                            <th scope="text-right">Tgl P</th>
                                            <th scope="text-right">Status</th>
                                            <th scope="text-right">Tanggapan</th>
                                            <th scope="text-right">Tgl T</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($pengaduan as $p) : ?>
                                            <tr>
                                                <th class="no"><?= $no++; ?></th>
                                                <td class="text-left"><?= $p['name'] ?></td>
                                                <td class="text-left"><?= $p['npm'] ?></td>
                                                <td class="text-left"><?= $p['title'] ?></td>
                                                <td class="text-left"><?= date('d-m-Y', $p['created_at']); ?></td>
                                                <td>
                                                    <?php
                                                    if ($p['status'] == '0') :
                                                        echo '<span class="badge badge-secondary">Sedang di verifikasi</span>';
                                                    elseif ($p['status'] == '1') :
                                                        echo '<span class="badge badge-primary">Sedang diproses oleh ' . $p['staff'] . '</span>';
                                                    elseif ($p['status'] == '3') :
                                                        echo '<span class="badge badge-primary">Sedang diproses oleh ' . $p['staff'] . '</span>';
                                                    elseif ($p['status'] == '4') :
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
                                        <!-- <tr>
                                            <td class="no">04</td>
                                            <td class="text-left"> Nurul Hidayah </td>>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </main>

                        </div>
                        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>