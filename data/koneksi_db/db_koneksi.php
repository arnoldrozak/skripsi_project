<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "skripsi_ol";

$connect = new mysqli($servername, $username, $password, $dbname);

// Cek Koneksi
if($connect->connect_error) {
    die("Koneksi Gagal : " . $connect->connect_error); 
}else{
    // echo "Koneksi Berhasil";
}