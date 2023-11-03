<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Tambah Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container pt-5 w-75">
        <div class="container-fluid p-3 bg-info">
            <h2 class="text-center w-100 border-bottom border-dark">Tambahkan menu</h2>
            <form class="row g-3" action="" method="post">
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Makanan</label>
                    <input type="text" class="form-control" name="nama">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Harga</label>
                    <input type="text" class="form-control" name="harga">
                </div>
                <!-- <div class="col-12">
                    <label for="inputAddress" class="form-label">Porsi</label>
                    <select name="porsi" class="form-select">
                        <option selected> Dewasa</option>
                        <option>Anak-anak</option>
                    </select>
                </div> -->
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
    insertDatamenuu();
    echo "Data berhasil ditambahkan";
?>
    <meta http-equiv="refresh" content="1 ;URL='/tabelMenu.php'">
<?php } ?>