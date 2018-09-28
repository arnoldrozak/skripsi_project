<?php

require_once '../../koneksi_db/db_koneksi.php';

$output = array('data' => array());

$sql = "SELECT * FROM tbl_dokumen";
$query = $connect->query($sql);

$x = 1;
while ($row = $query->fetch_assoc()) {
    
    $validasi = '';
    if($row['validasi'] == 1) {
        $validasi = '<label class="label label-default">PROSES</label>';
    } elseif ($row['validasi'] == 2) {
        $validasi = '<label class="label label-success">DISETUJUI</label>';
    } elseif ($row['validasi'] == 3) {
        $validasi = '<label class="label label-danger">DITOLAK</label>';
    }
    
    $actionButton = '
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editDataModal" onclick="editData('.$row['id_dok'].')"> <span class="glyphicon glyphicon-pencil"></span> Proses</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#deleteDataModal" onclick="deleteData('.$row['id_dok'].')"> <span class="glyphicon glyphicon-trash"></span> Delete</a></li>	    
	  </ul>
	</div>
		';
    
    $output['data'][] = array(
        $x,
        $row['nim'],
        $row['jurusan'],
        $row['judul'],
        $validasi,
        $actionButton
    );
    
    $x++;
}

//Tutup koneksi database
$connect->close();

echo json_encode($output);