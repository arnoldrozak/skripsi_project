<?php

require_once '../../koneksi_db/db_koneksi.php';

//Submit tambah data
if($_POST) {
    
    $validator = array('success' => false, 'messages' => array());
    
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $fakultas = $_POST['fakultas'];
    $jurusan = $_POST['jurusan'];
    $dosen1 = $_POST['dosen1'];
    $dosen2 = $_POST['dosen2'];
        
    $sql = "INSERT INTO tbl_mhs (nim, nama_mhs, fakultas, jurusan, pembimbing1, pembimbing2) VALUES ('$nim', '$nama', '$fakultas', '$jurusan', '$dosen1', '$dosen2')";
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