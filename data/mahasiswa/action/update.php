<?php

require_once '../../koneksi_db/db_koneksi.php';

//Submit tambah data
if($_POST) {
    
    $validator = array('success' => false, 'messages' => array());
    
    $id = $_POST['data_id'];
    $nim = $_POST['editNim'];
    $nama = $_POST['editNama'];
    $fakultas = $_POST['editFakultas'];
    $jurusan = $_POST['editJurusan'];
    $dosen1 = $_POST['editDosen1'];
    $dosen2 = $_POST['editDosen2'];
        
    $sql = "UPDATE tbl_mhs SET nim = '$nim', nama_mhs = '$nama', fakultas = '$fakultas', jurusan = '$jurusan', pembimbing1 = '$dosen1', pembimbing2 = '$dosen2' WHERE nim = $id";
    $query = $connect->query($sql);
    
    if($query === TRUE){
        $validator['success'] = true;
        $validator['messages'] = " Berhasil Diupdate";        
    } else {
        $validator['success'] = false;
        $validator['messages'] = " Error menambahkan data";        
    }
    
    $connect->close();
    
    echo json_encode($validator);
        
}