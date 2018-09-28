<?php
@session_start();
include "./action/db_koneksilog.php";
if(@$_SESSION['kajur'] || @$_SESSION['dosen'] || @$_SESSION['mahasiswa']){
    header("location: home.php");
}else{
?>
<!DOCTYPE html>
<html>
    <head>
        <title>LOGIN</title>
        
        <!-- Bootstrap css -->
        <link rel="stylesheet" type="text/css" href="assests/bootstrap/css/bootstrap.min.css">
        <!-- Datatables css -->
        <link rel="stylesheet" type="text/css" href="assests/datatables/datatables.min.css">
        <!-- Custom Style css -->
        <link rel="stylesheet" type="text/css" href="../../custom/css/style.css">
        
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
        
        </br>
        </br>
        </br>
        
        <img src="custom/image/pdark.jpg" class="bg" alt="back" />
        
        <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                      <strong>REGISTRASI SKRIPSI</strong>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="" role="form" method="post">
                        <div class="form-group">
                            <label for="nama" class="col-sm-3 control-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap" name="nama">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user" class="col-sm-3 control-label">NIM/Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="user" placeholder="Nomer Induk Mahasiswa" name="user">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pass" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="pass" placeholder="Password" name="pass">
                            </div>
                        </div>
                        
                        <div class="form-group last">
                            <div class="col-sm-offset-3 col-sm-9">
                                <input type="submit" name="daftar" value="Daftar" class="btn btn-primary btn-sm">
                                <input type="reset" name="reset" value="Reset" class="btn btn-danger btn-sm">
                            </div>
                        </div>
                            <p class="pull-right">                
                                Silahkan
                                <a href="index.php" class="label label-success">Masuk</a></p>
                        </form>
                        
                        <?php
                        if(@$_POST['daftar']) {
                            $nama = @$_POST['nama'];
                            $user = @$_POST['user'];
                            $pass = @$_POST['pass'];
                            
                            if($nama == '' || $user == '' || $pass == ''){
                                ?> <script type="text/javascript">alert('Lengkapi Registrasi')</script><?php
                            } else {
                                $sql_daftar = mysql_query("insert into `user` values('', '$user', md5('$pass'), '$nama', 'mahasiswa')") or die (mysql_error());
                                if($sql_daftar){
                                    ?> <script type="text/javascript">alert('Pendaftaran Berhasil, Silahkan Login')</script><?php
                                }
                            }
                        }
                        ?>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
        
        
        
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
}
?>