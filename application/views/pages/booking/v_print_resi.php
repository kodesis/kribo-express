<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url() ?>assets/logo/icon-kribo-express.png" rel="icon">
    <title>Resi Pengiriman</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            width: 300px;
            /* width: 396px; */
            /* Approx 105mm */
            height: 450px;
            /* height: 559px; */
            /* Approx 148mm */
            padding: 40px;
            /* Approx 10mm */
        }

        .resi-container {
            width: 100%;
            height: 100%;
            border: 1px solid #000;
            padding: 10px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo {
            max-width: 170px;
        }

        .barcode {
            text-align: center;
            margin-bottom: 15px;
        }

        .barcode img {
            max-width: 120px;
            height: auto;
        }

        table.detail {
            width: 100%;
            font-size: 12px;
            margin-top: 10px;
            border-collapse: collapse;
        }

        table.detail h3 {
            font-size: 14px;
            margin-bottom: 5px;
        }

        table.detail p {
            margin-bottom: 10px;
        }

        table.detail tr td {
            vertical-align: top;
            padding: 5px 10px;
        }

        table.detail tr td:first-child {
            width: 50%;
        }
    </style>
</head>

<body>
    <div class="resi-container">
        <div class="header">
            <img src="<?= base_url('assets/logo/logo-03.png') ?>" alt="Logo Perusahaan" class="logo">
        </div>

        <div class="barcode">
            <img src="<?= $qr_code ?>" alt="Barcode Resi">
            <p><?= $resi['no_resi'] ?></p>
        </div>

        <table class="detail">
            <tr>
                <td>
                    <h3>Pengirim:</h3>
                    <p><?= $pengirim ?></p>
                </td>
                <td>
                    <h3>Penerima:</h3>
                    <p><?= $penerima ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <h3>Jumlah Barang:</h3>
                    <p><?= $resi['qty'] ?> Koli</p>
                </td>
                <td>
                    <h3>Berat:</h3>
                    <p><?= $resi['chargeable'] ?> KG</p>
                </td>
            </tr>
            <tr>
                <td>
                    <h3>Deskripsi Barang:</h3>
                    <p><?= $resi['commodity'] ?></p>
                </td>
                <td>
                    <h3>Biaya Kiriman:</h3>
                    <p>Rp. <?= number_format($resi['nominal']) ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <h3>Kota Asal:</h3>
                    <p><?= $resi['origin'] ?></p>
                </td>
                <td>
                    <h3>Kota Tujuan:</h3>
                    <p><?= $resi['destination'] ?></p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>