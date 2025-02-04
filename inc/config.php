<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
$DB_host = "localhost";
$DB_user = "cuviguxi_animevsub";
$DB_pass = "XEBSFNqrcLgbgYrn3arb";
$DB_name = "cuviguxi_animevsub";
try {
    $DBcon = new PDO("mysql:host={$DB_host};dbname={$DB_name};charset=utf8mb4", $DB_user, $DB_pass);
    $DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $Nhan_connect = mysqli_connect($DB_host, $DB_user, $DB_pass, $DB_name);
    mysqli_set_charset($Nhan_connect, "utf8mb4");
    $conn = mysqli_connect($DB_host, $DB_user, $DB_pass, $DB_name);
    $conn->set_charset("utf8mb4");
} catch (PDOException $e) {
    echo "ERROR : " . $e->getMessage();
}
$sql = "SELECT * FROM thongtin";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $trangchu = htmlspecialchars($row["linktrang"], ENT_QUOTES, 'UTF-8');
        $tieude = htmlspecialchars($row["tieude"], ENT_QUOTES, 'UTF-8');
        $mota = htmlspecialchars($row["mota"], ENT_QUOTES, 'UTF-8');
        $appid = htmlspecialchars($row["appid"], ENT_QUOTES, 'UTF-8');
        $google = htmlspecialchars($row["google"], ENT_QUOTES, 'UTF-8');
        $facebook = htmlspecialchars($row["facebook"], ENT_QUOTES, 'UTF-8');
        $style = htmlspecialchars($row["style"], ENT_QUOTES, 'UTF-8');
        $hientai = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }
}