<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<?php
include "../database.php";
date_default_timezone_set("Asia/Jakarta");
?>

<body>
    <div class="container pt-5 w-75">
        <div class="container-fluid p-3 bg-info">
            <h2 class="text-center w-100 border-bottom border-dark">Order Tempat</h2>
            <form class="row g-3" action="" method="post">
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="pelanggan">
                </div>
                <?php
                if (isset($_GET['meja'])) { ?>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" value="<?= date("Y-m-d") ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Waktu</label>
                        <input type="time" class="form-control" name="jam" value="<?= date('h:i') ?>" readonly>
                    </div>
                <?php } else { ?>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" value="<?= date("Y-m-d") ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Waktu</label>
                        <input type="time" class="form-control" name="jam" value="<?= date('h:i') ?>">
                    </div>
                <?php } ?>
                <div class="col-12">
                    <label class="form-label">Pelayan</label>
                    <input readonly type="text" name="pelayan" value="<?= getRandomWaiter()['nama_pelayan'] ?>" class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label">No Meja</label>
                    <?php
                    if (isset($_GET["meja"])) { ?>
                        <input type="number" name="meja" value="<?= $_GET['meja'] ?>" class="form-control" readonly>
                    <?php
                    } else { ?>
                        <select name="meja" class="form-select">
                            <option selected> 1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    <?php } ?>
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
if (isset($_POST["tambah"])) {
    $chekout = date("H:i:s", strtotime($_POST["jam"]) + 600);
    $tanggal = str_replace('/', '-', "$_POST[tanggal]");
    //  ==================
    $check = checkTable($_POST['meja'],$_POST["jam"],$chekout);
    if ($check) {
        echo "<p>Meja sedang dipakai</p>";
    } else {
        insertDataOrder($_POST["pelanggan"], $tanggal, $_POST["jam"] . ":00", $chekout, $_POST["pelayan"], $_POST["meja"]);
        // echo "<meta http-equiv=\"refresh\" content=\"1; URL=formOrderDetail.php\">";
    }
} ?>