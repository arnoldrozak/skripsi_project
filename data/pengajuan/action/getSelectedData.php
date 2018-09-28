<?php

require_once '../../koneksi_db/db_koneksi.php';

$dataId = $_POST['data_id'];

$sql = "SELECT * FROM tbl_dokumen WHERE id_dok = {$dataId}";
$query = $connect->query($sql);
$result = $query->fetch_assoc();

$connect->close();

echo json_encode($result);