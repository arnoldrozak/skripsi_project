<?php

require_once '../../koneksi_db/db_koneksi.php';

$output = array('success' => false, 'messages' => array());

$dataId = $_POST['data_id'];

$sql = "DELETE FROM tbl_mhs WHERE nim = {$dataId}";
$query = $connect->query($sql);
if($query === TRUE) {
    $output['success'] = true;
    $output['messages'] = ' Berhasil Dihapus';
} else {
    $output['success'] = false;
    $output['messages'] = ' Error saat menghapus data';
}

// Tutup Koneksi Database
$connect->close();

echo json_encode($output);