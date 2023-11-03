<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container pt-5 w-75">
        <div class="container-fluid p-3 bg-info">
            <h2 class="text-center w-100 border-bottom border-dark">Order Makanan</h2>
            <form class="row g-3" action="" method="post">
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="pelanggan">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Waktu</label>
                    <input type="time" class="form-control" name="jam">
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Pelayan</label>
                    <select name="pelayan" class="form-select">
                        <option selected> Andi</option>
                        <option>Fais</option>
                        <option>Zacky</option>
                        <option>Hanafi</option>
                    </select>
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">No Meja</label>
                    <select name="meja" class="form-select">
                        <option selected> 1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</body>

</html>

<?php
include "../database.php";
if (isset($_POST["tambah"])) {
    $tanggal = str_replace('/', '-', "$_POST[tanggal]");
    insertDataOrder($_POST["pelanggan"], $tanggal, $_POST["jam"] . ':00', $_POST["pelayan"], $_POST["meja"]);
    echo "Data berhasil ditambahkan";
?>
    <meta http-equiv="refresh" content="1 ;URL='/formOrderDetail.php'">
<?php } ?>