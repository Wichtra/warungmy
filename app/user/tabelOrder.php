<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<?php
include "../database.php";
$order = getAllDataOrder();
?>

<body style="background-color: #eceff5;">
    <?php include "./template/nav.php"; ?>
    <div class="container-fluid ms-0 ">
        <div class="container-fluid d-flex flex-column mt-5 pb-5 border-top border-primary border-3 rounded-top bg-white ">
            <h4 class="py-4"> Tabel Order</h4>
            <table class="table table-bordered w-100 pt-4 text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id Order</th>
                        <th>Tanggal</th>
                        <th>Pelayan</th>
                        <th>No Meja</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($order as $ord) { ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td>
                                <?= $ord["order_id"] ?>
                            </td>
                            <td>
                                <?= $ord["tanggal_pesanan"] ?>
                            </td>
                            <td>
                                <?= $ord["nama_pelayan"] ?>
                            </td>
                            <td>
                                <?= $ord["no_meja"] ?>
                            </td>
                            <td>
                                <?= rupiahFormat($ord["total"]) ?>
                            </td>
                            <td>
                                <?= $ord["status"] ?>
                            </td>
                            <td>
                                <a class="btn btn-danger" href="tabelOrder.php?menuId=<?= $ord['order_id'] ?>">X</a>
                                <a href="tabelOrderDetail.php?orderId=<?= $ord['order_id'] ?>" class="btn btn-primary">Detil</a>
                            </td>
                        </tr>
                    <?php
                        $no++;
                    } ?>
                    <tr>
                        <td colspan="7"></td>
                        <td><a href="./formOrder.php" class="btn btn-primary">Tambah Order</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_GET["menuId"])) {
    eraseDataOrderById($_GET["menuId"]);
    echo "<meta http-equiv=refresh content=0;URL='tabelOrder.php'>";
}

if (isset($_GET["detailId"])) {
    eraseDataOrderById($_GET["menuId"]);
    echo "
<meta http-equiv=refresh content=0;URL='tabelOrder.php'>";
} ?>