<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<?php
include "../database.php";
$order;
if (isset($_GET["idOrder"])) {
    $order = sortOrderById($_GET['idOrder']);
} elseif (isset($_GET["noMeja"])) {
    $order = sortOrderByNoMeja($_GET['noMeja']);
} elseif (isset($_GET["Tgl"])) {
    $order = sortOrderByDate($_GET['Tgl']);
} else {
    $order = getAllDataOrder();
}
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
                        <th><a style="text-decoration: none; color:black" href="tabelOrder.php?idOrder=<?php 
                        if (isset($_GET["idOrder"])) {
                            if ($_GET["idOrder"] == "asc") {
                                echo "desc";
                            } elseif ($_GET["idOrder"] == "desc") {
                                echo "asc";
                            }
                        } else {
                            echo "asc";
                        } ?>">Id Order
                                <?php if (isset($_GET["idOrder"])) {
                                    if (($_GET["idOrder"]) == "asc") {
                                        echo " <i class='fa fa-sort-asc'></i>";
                                    } else {
                                        echo " <i class='fa fa-sort-desc'></i>";
                                    }
                                } else {
                                    echo " <i class='fa fa-sort'></i>";
                                }
                                ?></a></th>
                        <th><a style="text-decoration: none; color:black" href="tabelOrder.php?Tgl=<?php 
                        if (isset($_GET["Tgl"])) {
                            if ($_GET["Tgl"] == "asc") {
                            echo "desc";
                        } elseif ($_GET["Tgl"] == "desc") {
                            echo "asc";
                        }
                        } else {
                        echo "asc";
                    } ?>">Tanggal
                                <?php if (isset($_GET["Tgl"])) {
                                    if (($_GET["Tgl"]) == "asc") {
                                        echo " <i class='fa fa-sort-asc'></i>";
                                    } else {
                                        echo " <i class='fa fa-sort-desc'></i>";
                                    }
                                } else {
                                    echo " <i class='fa fa-sort'></i>";
                                }
                                ?></a></th>
                        <th>Pelayan</th>
                        <th><a style="text-decoration: none; color:black" href="tabelOrder.php?noMeja=<?php 
                        if (isset($_GET["noMeja"])) {
                             if ($_GET["noMeja"] == "asc") {
                                 echo "desc";
                             } elseif ($_GET["noMeja"] == "desc") {
                                 echo "asc";
                             }
                        } else {
                            echo "asc";
                         } ?>">Meja
                                <?php if (isset($_GET["noMeja"])) {
                                    if (($_GET["noMeja"]) == "asc") {
                                        echo " <i class='fa fa-sort-asc'></i>";
                                    } else {
                                        echo " <i class='fa fa-sort-desc'></i>";
                                    }
                                } else {
                                    echo " <i class='fa fa-sort'></i>";
                                }
                                ?></a></th>
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