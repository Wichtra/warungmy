<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<?php
include("../database.php");
$detail = getAllDataOrderDetailWithAll($_GET['orderId']);
?>

<body>
    <?php include "./template/nav.php"; ?>

    <div class="container mt-5">
        <div>
            <h5>Detail Order</h5>
        </div>
        <div>
            <div>
                <p><b>Pelayan</b></p>
                <p><?= $detail[0]["nama_pelayan"] ?></p>
            </div>
            <div class="d-flex gap-5">
                <div>
                    <p><b>Pelanggan</b></p>
                    <p><?= $detail[0]["pelanggan"] ?></p>
                </div>
                <div>
                    <p><b>Antrian</b></p>
                    <p><?= $detail[0]["order_id"] ?></p>
                </div>
                <div>
                    <p><b>Tanggal</b></p>
                    <p><?= $detail[0]["tanggal_pesanan"] ?></p>
                </div>
                <div>
                    <p><b>Keterangan</b></p>
                    <p><?= $detail[0]["status"] ?></p>
                </div>
            </div>
            <div class="mt-3">
                <table class="table table-bordered border border-2 w-100">
                    <thead>
                        <tr>
                            <th>
                                Kode Menu
                            </th>
                            <th>
                                Nama Makanan
                            </th>
                            <th>
                                harga
                            </th>
                            <th>
                                Jumlah
                            </th>
                            <th>
                                Total
                            </th>
                            <th>
                                Opsi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($detail as $details) { ?>
                            <tr>
                                <td>
                                    <?= $details["menu_id"] ?>
                                </td>
                                <td>
                                    <?= $details["nama_makanan"] ?>
                                </td>
                                <td>
                                    <?= rupiahFormat($details["harga"])  ?>
                                </td>
                                <td>
                                    <?= $details["jumlah"] ?>
                                </td>
                                <td>
                                    <?= rupiahFormat($details["sub_total"])  ?>
                                </td>
                                <td>
                                    <a class="btn btn-danger" href="?idMenu=<?= $details["order_detail_id"] ?>">Batal</a>
                                </td>
                            </tr>
                        <?php
                            $total += $details["sub_total"];
                        } ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex gap-5 mt-5">
                <p><b>Total : </b></p>
                <span><?= rupiahFormat($detail[0]["total"]) ?></span>
            </div>
            <div>
                <a href="./formOrderDetail.php?orderId=<?= $detail[0]["order_id"] ?>" class="btn btn-primary">Tambah Order</a>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_GET["detailId"])) {
    deleteDataDetailOrderById($_GET["detailId"]);
    echo "
    <meta http-equiv=refresh content=1;URL='tabelOrderDetail.php'>";
} ?>