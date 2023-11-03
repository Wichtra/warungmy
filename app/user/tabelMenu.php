<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    include "./template/nav.php"; ?>
    <div class="container w-100 pt-5">
        <table class="table table-secondary table-stripped-coloumn text-center">
            <thead>
                <th class="w-0">No</th>
                <th class="w-0">
                    <a style="text-decoration: none; color:black" href="tabelMenu.php?nameU=<?php if (isset($_GET["nameU"])) {
                                                                                            if ($_GET["nameU"] == "asc") {
                                                                                                echo "desc";
                                                                                            } elseif ($_GET["nameU"] == "desc") {
                                                                                                echo "asc";
                                                                                            }
                                                                                        } else {
                                                                                            echo "asc";
                                                                                        } ?>">Nama
                        <?php if (isset($_GET["nameU"])) {
                            if (($_GET["nameU"]) == "asc") {
                                echo " <i class='fa fa-sort-asc'></i>";
                            } else {
                                echo " <i class='fa fa-sort-desc'></i>";
                            }
                        } else {
                            echo " <i class='fa fa-sort'></i>";
                        }
                        ?></a>
                </th>
                <th class="w-0"><a style="text-decoration: none; color:black" href="tabelMenu.php?hargaU=<?php if (isset($_GET["hargaU"])) {
                                                                                                        if ($_GET["hargaU"] == "asc") {
                                                                                                            echo "desc";
                                                                                                        } elseif ($_GET["hargaU"] == "desc") {
                                                                                                            echo "asc";
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo "asc";
                                                                                                    } ?>">Harga
                        <?php if (isset($_GET["hargaU"])) {
                            if (($_GET["hargaU"]) == "desc") {
                                echo " <i class='fa fa-sort-desc'></i>";
                            } else {
                                echo " <i class='fa fa-sort-asc'></i>";
                            }
                        } else {
                            echo " <i class='fa fa-sort'></i>";
                        }
                        ?></a></th>
                <th class="w-0">Aksi</th>
            </thead>
            <?php
            include "../database.php";
            $no = 1;
            $data;
            if (isset($_GET["nameU"])) {
                if (($_GET["nameU"]) == "asc") {
                    $data = mysqli_query(
                        DB,
                        "SELECT * FROM menu ORDER BY nama_makanan ASC"
                    );
                } elseif (($_GET["nameU"]) == "desc") {
                    $data = mysqli_query(
                        DB,
                        "SELECT * FROM menu ORDER BY nama_makanan DESC"
                    );
                }
            } elseif (isset($_GET["hargaU"])) {

                if (($_GET["hargaU"]) == "asc") {
                    $data = mysqli_query(
                        DB,
                        "SELECT * FROM menu ORDER BY harga ASC"
                    );
                } elseif (($_GET["hargaU"]) == "desc") {
                    $data = mysqli_query(
                        DB,
                        "SELECT * FROM menu ORDER BY harga DESC"
                    );
                }
            } else {
                $data = getAllDatamenu();
            }
            foreach ($data as $tampil) { ?>
                <tr>
                    <td class="0"><?= $no ?></td>
                    <td class="25"><?= $tampil["nama_makanan"] ?></td>
                    <td class="25"><?= rupiahFormat($tampil['harga']); ?></td>
                    <td class="25">
                        <a href="?nama=<?= $tampil["nama_makanan"] ?>"><button class="btn btn-danger">Hapus</button></a>
                        <a href="ubahMenu.php?id=<?= $tampil["menu_id"] ?>"><button class="btn btn-danger">Ubah</button></a>
                    </td>
                </tr>
            <?php $no += 1;
            } ?>
            <tr>
                <td colspan="3" class="bg-white border-0"></td>
                <td><a href="formMenu.php"><button type="button" class="btn btn-primary w-100">Tambah</button></a></td>
            </tr>
        </table>
    </div>
</body>

</html>

<?php
if (isset($_GET["nama"])) {
    mysqli_query(DB, "delete from menu where nama_makanan ='$_GET[nama]'");
?>
    <meta http-equiv="refresh" content="1 ;URL='/tabelMenu.php'">
<?php } ?>