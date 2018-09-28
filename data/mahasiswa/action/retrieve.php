<?php

require_once '../../koneksi_db/db_koneksi.php';

$output = array('data' => array());

$sql = "SELECT * FROM tbl_mhs";
$query = $connect->query($sql);

$x = 1;
while ($row = $query->fetch_assoc()) {
    
    $actionButton = '
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editDataModal" onclick="editData('.$row['nim'].')"> <span class="glyphicon glyphicon-edit"></span> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#deleteDataModal" onclick="deleteData('.$row['nim'].')"> <span class="glyphicon glyphicon-trash"></span> Delete</a></li>	    
	  </ul>
	</div>
		';
    
    $output['data'][] = array(
        $x,
        $row['nim'],
        $row['nama_mhs'],
        $row['fakultas'],
        $row['jurusan'],
        $row['pembimbing1'],
        $row['pembimbing2'],
        $actionButton
    );
    
    $x++;
}

//Tutup koneksi database
$connect->close();

echo json_encode($output);