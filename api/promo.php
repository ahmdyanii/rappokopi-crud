<?php

include "../koneksi.php";

$sql = "SELECT * FROM promo";
$result = mysqli_query($koneksi, $sql);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

header("Content-Type: application/json");
echo json_encode($data);

?>