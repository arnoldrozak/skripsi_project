<?php

require_once '../../koneksi_db/db_koneksi.php';

//Submit tambah data
if($_POST) {
    
    $validator = array('success' => false, 'messages' => array());
    
    $id = $_POST['data_id'];
    $nim = $_POST['editNim'];
    $jurusan = $_POST['editJurusan'];    
    $judul = $_POST['editJudul'];
    $validasi = $_POST['editValidasi'];
        
    $sql = "UPDATE tbl_dokumen SET nim = '$nim', jurusan = '$jurusan', judul = '$judul', validasi = '$validasi' WHERE id_dok = $id";
    $query = $connect->query($sql);
    
    if($query === TRUE){
        $validator['success'] = true;
        $validator['messages'] = " Judul Berhasil Diproses";        
    } else {
        $validator['success'] = false;
        $validator['messages'] = " Error menambahkan data";        
    }
    
    $connect->close();
    
    echo json_encode($validator);
        
}