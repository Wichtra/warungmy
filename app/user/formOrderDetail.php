<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<?php
include "../database.php";
$menu = getAllDatamenu();
$lastOrder;
if (isset($_GET["orderId"])) {
    $lastOrder = getDataOrderById($_GET["orderId"]);
} else {
    $lastOrder = getLastDataOrder();
}
$detailOrder = getAllDataOrderDetailWithMenuById($lastOrder[0]["order_id"]);
?>

<body style="background-color: #eceff5;">
    <div class="container-fluid ms-0 ">
        <div class="container-fluid d-flex flex-column mt-5 py-5 border-top border-primary border-3 rounded bg-white ">
            <div class="container-fluid d-flex gap-5">
                <div>
                    <label><b>Pelanggan</b></label>
                    <br>
                    <input class="form-control" type="text" value="<?= $lastOrder[0]['pelanggan'] ?>" readonly>
                </div>
                <div>
                    <label><b>Antrian</b></label>
                    <br>
                    <input class="form-control" type="text" value="<?= $lastOrder[0]['order_id'] ?>" readonly>
                </div>
                <div>
                    <label><b>Tanggal</b></label>
                    <br>
                    <input class="form-control" type="date" value="<?= getDatee() ?>" readonly>
                </div>
                <div>
                    <label><b>Keterangan</b></label>
                    <br>
                    <input class="form-control" type="text" value="<?= $lastOrder[0]['status'] ?>" readonly>
                </div>
            </div>
            <div class="container-fluid d-flex gap-4">
                <div class="container-fluid w-25 mt-5 p-0">
                    <p class="fs-3">Tambah Menu</p>
                    <form action="" method="post">
                        <label><b>Pilih Barang</b></label>
                        <br>
                        <select class="w-100 form-select" name="makanan">
                            <?php
                            foreach ($menu as $makanan) { ?>
                                <option value="<?= $makanan['menu_id'] ?>"><?= $makanan["nama_makanan"] ?></option>
                            <?php } ?>
                        </select>
                        <br>
                        <label><b>Jumlah</b></label>
                        <br>
                        <input name="jumlah" class="form-control" type="number" value="1">
                        <button type="submit" class="btn btn-primary mt-3" name="tambahMenu">Tambah</button>
                    </form>
                </div>
                <div class="container-fluid w-75 mt-5 p-0">
                    <p class="fs-3">Daftar Pemesanan</p>
                    <table class="w-100 table table-bordered">
                        <thead>
                            <th>Kode Menu</th>
                            <th>Nama Makanan</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Sub Total</th>
                            <th>Opsi</th>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            foreach ($detailOrder as $details) { ?>
                                <tr>
                                    <td>
                                        <?= $details["menu_id"] ?>
                                    </td>
                                    <td>
                                        <?= $details["nama_makanan"] ?>
                                    </td>
                                    <td>
                                        <?= rupiahFormat($details["harga"]) ?>
                                    </td>
                                    <td>
                                        <?= $details["jumlah"] ?>
                                    </td>
                                    <td>
                                        <?= rupiahFormat($details["sub_total"]) ?>
                                    </td>
                                    <td>
                                        <?php
                                        if (isset($_GET["orderId"])) {
                                            $herf = "formOrderDetail.php?orderId={$_GET['orderId']}&detailId={$details['order_detail_id']}";
                                        } else {
                                            $herf = "formOrderDetail.php?detailId={$details['order_detail_id']}";
                                        } ?>
                                        <a class="btn btn-danger" href="<?= $herf ?>">Batal</a>
                                    </td>
                                </tr>
                            <?php
                                $total += $details["sub_total"];
                            } ?>
                            <tr>
                                <td style="background-color:#ddedf5;"></td>
                                <td style="background-color:#ddedf5;" colspan="3"><b>Total</b></td>
                                <td style="background-color:#ddedf5;" colspan="2"><b><?= rupiahFormat($total) ?></b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container-fluid">
                <div class="d-flex justify-content-between">
                    <form action="" method="post">
                        <button name="cancelTransaksi" class="btn btn-danger mt-5">Batalkan Transaksi</button>
                    </form>
                    <form action="" method="post">
                        <input name="total" type="hidden" value="<?= $total ?>">
                        <button type="submit" name="buatTransaksi" class="btn btn-success mt-5">Buat Transaksi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
// ========= Tambah Pesanan =============
if (isset($_POST["tambahMenu"])) {
    $menu = getDatamenuById($_POST["makanan"]);
    $harga = intval($menu["harga"]) * intval($_POST["jumlah"]);
    insertDatamenu($lastOrder[0]['order_id'], $_POST['makanan'], $_POST['jumlah'], $harga);
    if (isset($_GET["orderId"])) {
        echo "<meta http-equiv=refresh content=0;URL='formOrderDetail.php?orderId=$_GET[orderId]'>";
    } else {
        echo "<meta http-equiv=refresh content=0;URL='formOrderDetail.php'>";
    }
}

// ========= Hapus Pesanan ==============
if (isset($_GET["detailId"])) {
    deleteDataDetailOrderById($_GET["detailId"]);
    if (isset($_GET["orderId"])) {
        echo "<meta http-equiv=refresh content=0;URL='formOrderDetail.php?orderId=$_GET[orderId]'>";
    } else {
        echo "<meta http-equiv=refresh content=0;URL='formOrderDetail.php'>";
    }
}

// =========== Kirim Transaksi =========
if (isset($_POST["buatTransaksi"])) {
    updateDataOrder($lastOrder[0]['order_id'], $_POST["total"]);
    echo "<meta http-equiv=refresh content=1;URL='tabelOrder.php'>";
}

// =========== Batal Transaksi ===============
if (isset($_POST["cancelTransaksi"])) {
    if (isset($_GET["orderId"])) {
        echo "<meta http-equiv=refresh content=1;URL='tabelOrder.php'>";
    } else {
        deleteDataDetailOrderById($lastOrder[0]['order_id']);
        echo "<meta http-equiv=refresh content=1;URL='tabelOrder.php'>";
    }
}
?>