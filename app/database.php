<?php
define("DB", mysqli_connect("localhost", "root", "", "mystore"));

// =================== Data Menu =======================

function getAllDatamenu()
{
    return mysqli_query(DB, "SELECT * FROM menu")->fetch_all(MYSQLI_ASSOC);
}

function insertDatamenu($orderId, $menuId, $jumlah, $subtotal)
{
    mysqli_query(DB, "INSERT INTO orderdetail VALUES (NULL,$orderId,$menuId, $jumlah, $subtotal)");
}

function updateDatamenu($menuId, $nama, $harga)
{
    mysqli_query(DB, "UPDATE `menu` SET 
    nama_makanan = '$nama', 
    harga = '$harga' 
    WHERE menu_id = '$menuId';");
}

function getDatamenuById($menuId)
{
    return mysqli_query(DB, "SELECT * FROM menu WHERE menu_id = '$menuId' ")->fetch_assoc();
}

function insertDatamenuu()
{
    mysqli_query(DB, "INSERT INTO menu set
    nama_makanan = '$_POST[nama]',
    harga = '$_POST[harga]',
    ketersediaan = '0'
    ");
}

function sortMenuByName($cond)
{
    if ($cond == "asc") {
        return mysqli_query(DB, "SELECT * FROM menu 
        ORDER BY nama_makanan ASC");
    } elseif ($cond == "desc") {
        return mysqli_query(
            DB,
            "SELECT * FROM menu 
        ORDER BY nama_makanan DESC"
        );
    }
}

function sortMenuByPrice($cond)
{
    if ($cond == "asc") {
        return mysqli_query(
            DB,
            "SELECT * FROM menu 
        ORDER BY harga ASC"
        );
    } elseif ($cond == "desc") {
        return mysqli_query(
            DB,
            "SELECT * FROM menu 
        ORDER BY harga DESC"
        );
    }
}

/// =================== Data Order ======================= ///

function getAllDataOrder()
{
    return mysqli_query(DB, "SELECT * FROM `order`")->fetch_all(MYSQLI_ASSOC);
}

function getDataOrderById($orderId)
{
    return mysqli_query(DB, "SELECT * FROM `order` WHERE order_id = '$orderId' ")->fetch_all(MYSQLI_ASSOC);
}

function getLastDataOrder()
{
    return mysqli_query(DB, "SELECT * FROM `order` ORDER BY order_id DESC LIMIT 1;")->fetch_all(MYSQLI_ASSOC);
}

function updateDataOrder($orderId)
{
    $total = getTotal($orderId);
    mysqli_query(DB, "UPDATE `order` 
    SET total = $total 
    WHERE order_id = $orderId;");
}

function eraseDataOrderById($menuId)
{
    mysqli_query(DB, "DELETE FROM `orderdetail` WHERE order_id = $menuId");
    mysqli_query(DB, "DELETE FROM `order` WHERE order_id = $menuId");
}

function insertDataOrder($pelanggan, $tanggal, $jam, $pelayan, $meja)
{
    echo "$jam";
    mysqli_query(DB, "INSERT INTO `order` SET 
    pelanggan = '$pelanggan',
    tanggal_pesanan = '$tanggal',
    jam = '$jam',
    nama_pelayan = '$pelayan',
    no_meja = '$meja',
    total='0';
    ");
}

function sortOrderById($cond)
{
    if ($cond == "asc") {
        return mysqli_query(
            DB,
            "SELECT * FROM `order` 
        ORDER BY order_id ASC"
        );
    } elseif ($cond == "desc") {
        return mysqli_query(
            DB,
            "SELECT * FROM `order` 
        ORDER BY order_id DESC"
        );
    }
}
function sortOrderByNoMeja($cond)
{
    if ($cond == "asc") {
        return mysqli_query(
            DB,
            "SELECT * FROM `order` 
        ORDER BY no_meja ASC"
        );
    } elseif ($cond == "desc") {
        return mysqli_query(
            DB,
            "SELECT * FROM `order` 
        ORDER BY no_meja DESC"
        );
    }
}
function sortOrderByDate($cond)
{
    if ($cond == "asc") {
        return mysqli_query(
            DB,
            "SELECT * FROM `order` 
        ORDER BY tanggal_pesanan ASC"
        );
    } elseif ($cond == "desc") {
        return mysqli_query(
            DB,
            "SELECT * FROM `order` 
        ORDER BY tanggal_pesanan DESC"
        );
    }
}

// =================== Data Order Detail =======================

function getAllDataOrderDetailWithMenuById($orderId)
{
    return mysqli_query(DB, "SELECT * FROM orderdetail INNER JOIN menu ON orderdetail.menu_id=menu.menu_id WHERE order_id = $orderId;")->fetch_all(MYSQLI_ASSOC);
}

function getAllDataOrderDetail()
{
    return mysqli_query(DB, "SELECT * FROM orderdetail")->fetch_all(MYSQLI_ASSOC);
}

function getDataOrderDetailByOrderId($orderId)
{
    return mysqli_query(DB, "SELECT * FROM orderdetail WHERE order_id = '$orderId' ")->fetch_all(MYSQLI_ASSOC);
}
function deleteDataDetailOrderById($detailId)
{
    mysqli_query(DB, "DELETE FROM `orderdetail` WHERE order_detail_id = $detailId");
}

function getAllDataOrderDetailWithAll($orderId)
{
    return mysqli_query(DB, "SELECT * 
    FROM orderdetail 
    INNER JOIN menu ON orderdetail.menu_id=menu.menu_id 
    INNER JOIN `order` ON orderdetail.order_id =`order`.order_id
    WHERE orderdetail.order_id = $orderId;")->fetch_all(MYSQLI_ASSOC);
}

// ===================== macam macam ==================
function getDatee()
{
    date_default_timezone_set('Asia/Jakarta');
    return date('Y-m-d');
}

function rupiahFormat($uang)
{
    return "Rp " . number_format($uang, 0, ',', '.');
}

function getTotal($id)
{
    return mysqli_query(DB, "SELECT SUM(sub_total) FROM orderdetail WHERE order_id = '$id';")->fetch_assoc()["SUM(sub_total)"];
}
