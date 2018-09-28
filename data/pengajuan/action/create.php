<?php

require_once '../../koneksi_db/db_koneksi.php';

//Submit tambah data
if($_POST) {
    
    $validator = array('success' => false, 'messages' => array());
    
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];
    $judul = $_POST['judul'];
    $validasi = $_POST['validasi'];
        
    $sql = "INSERT INTO tbl_dokumen (nim, jurusan, judul, validasi) VALUES ('$nim', '$jurusan', '$judul', '$validasi')";
    $query = $connect->query($sql);
    
    if($query === TRUE){
        $validator['success'] = true;
        $validator['messages'] = " Berhasil Ditambahkan";        
    } else {
        $validator['success'] = false;
        $validator['messages'] = " <center>NIM belum terdaftar, Silahkan hubungi <a href='../dosen/index_dosen.php'><span class='glyphicon glyphicon-bookmark'></span> DOSEN</a> Pembimbing</center>";        
    }
    
    $connect->close();
    
    echo json_encode($validator);
        
}