<?php

require_once '../../koneksi_db/db_koneksi.php';

//Submit tambah data
if($_POST) {
    
    $validator = array('success' => false, 'messages' => array());
    
    $nid = $_POST['nid'];
    $nama = $_POST['nama'];
    $fakultas = $_POST['fakultas'];
    $status = $_POST['status'];
    $jabatan = $_POST['jabatan'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];
    
    $sql = "INSERT INTO tbl_dosen (id_dosen, nm_dosen, fakultas, status, jabatan, alamat, no_telp, email) VALUES ('$nid', '$nama', '$fakultas', '$status', '$jabatan', '$alamat', '$telepon', '$email')";
    $query = $connect->query($sql);
    
    if($query === TRUE){
        $validator['success'] = true;
        $validator['messages'] = " Berhasil Ditambahkan";        
    } else {
        $validator['success'] = false;
        $validator['messages'] = " Error menambahkan data";        
    }
    
    $connect->close();
    
    echo json_encode($validator);
        
}