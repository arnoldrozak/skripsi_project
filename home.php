<?php
@session_start();
include "./action/db_koneksilog.php";
if(@$_SESSION['kajur'] || @$_SESSION['dosen'] || @$_SESSION['mahasiswa']){
?>
<!DOCTYPE html>
<html>
    <head>
        <title>HALAMAN AWAL</title>
        
        <!-- Bootstrap css -->
        <link rel="stylesheet" type="text/css" href="assests/bootstrap/css/bootstrap.min.css">
        <!-- Datatables css -->
        <link rel="stylesheet" type="text/css" href="assests/datatables/datatables.min.css">
        <!-- Custom css -->
        <link rel="stylesheet" type="text/css" href="custom/css/style.css">
        
    </head>
    <body>
        
        <style type="text/css" media="screen"> 
            img.bg {              
                min-height: 100%;
                min-width: 1024px;
                width: 100%;
                height: auto;
                position: fixed;
                top: 0;
                left: 0;
            }

            @media screen and (max-width: 1024px){
              img.bg {
                left: 50%;
                margin-left: -512px; }
            }
        </style>
        
        <!-- Menu Navigasi Bar -->
        <nav class="navbar navbar-static-top navbar-inverse">
            <ul class="nav navbar-nav">
                <li><a href="home.php"><span class="glyphicon glyphicon-home"></span> HOME</a></li>
                <li><a href="data/dosen/index_dosen.php"><span class="glyphicon glyphicon-bookmark"></span> DATA DOSEN</a></li>                
                <li><a href="data/mahasiswa/index_mahasiswa.php"><span class="glyphicon glyphicon-book"></span> DATA MAHASISWA</a></li>
                <li><a href="data/pengajuan/pengajuan.php"><span class="glyphicon glyphicon-upload"></span> PENGAJUAN JUDUL</a></li>
                <li class="col-lg-push-6 pull-right">
                    <?php
                    if(@$_SESSION['kajur']){
                        $user_login = @$_SESSION['kajur'];
                    }else if(@$_SESSION['dosen']){
                        $user_login = @$_SESSION['dosen'];
                    }else if(@$_SESSION['mahasiswa']){
                        $user_login = @$_SESSION['mahasiswa'];
                    }
                    
                    $sql_user = mysql_query("select * from `user` where id_user = '$user_login'") or die (mysql_error());
                    $data_user = mysql_fetch_array($sql_user);
                    ?>
                    <a><span class="glyphicon glyphicon-user"></span> <?php echo $data_user['nama']; ?></a></li>
                <li class="col-lg-push-10 pull-right"><a href="action/keluar.php"><span class="glyphicon glyphicon-log-out"></span> LOGOUT</a></li>
            </ul>
        </nav>
        
        <img src="custom/image/bgnvidiaedit.jpg" class="bg" alt="back" />
        
        
        
        <!-- jquery Plugin -->
        <script type="text/javascript" src="assests/jquery/jquery.min.js"></script>
        <!-- Bootstrap js -->
        <script type="text/javascript" src="assests/bootstrap/js/bootstrap.min.js"></script>
        <!-- Datatables js -->
        <script type="text/javascript" src="assests/datatables/datatables.min.js"></script>
        <!-- Custom Index js -->
        <script type="text/javascript" src="custom/index_dosen.js"></script>
    </body>
</html>
<?php
} else {
    header("location: index.php");
}
?>