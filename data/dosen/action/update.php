<?php

require_once '../../koneksi_db/db_koneksi.php';

//Submit tambah data
if($_POST) {
    
    $validator = array('success' => false, 'messages' => array());
    
    $id = $_POST['data_id'];
    $nid = $_POST['editNid'];
    $nama = $_POST['editNama'];
    $fakultas = $_POST['editFakultas'];
    $status = $_POST['editStatus'];
    $jabatan = $_POST['editJabatan'];
    $alamat = $_POST['editAlamat'];
    $telepon = $_POST['editTelepon'];
    $email = $_POST['editEmail'];
    
    $sql = "UPDATE tbl_dosen SET id_dosen = '$nid', nm_dosen = '$nama', fakultas = '$fakultas', status = '$status', jabatan = '$jabatan', alamat = '$alamat', no_telp = '$telepon', email = '$email' WHERE id_dosen = $id";
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