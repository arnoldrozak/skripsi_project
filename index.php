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
        
        <img src="custom/image/nvidiot.jpg" class="bg" alt="back" />
        
        <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                      <strong>LOGIN SKRIPSI</strong>
                    </div></br>
                    <h4 class="text-center">UNIVERSITAS SATYA NEGARA INDONESIA</h4>
                    <img class="center-block "src="custom/image/fixlogous.png"/>
                    <div class="panel-body">
                        <form class="form-horizontal" action="" role="form" method="post">
                        <div class="form-group">
                            <label for="user" class="col-sm-3 control-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="user" placeholder="Username" name="user">
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
                                <input type="submit" name="login" value="Login" class="btn btn-success btn-sm">
                                <input type="reset" name="reset" value="Reset" class="btn btn-danger btn-sm">
                            </div>
                        </div>
                            <p class="pull-right"><a href="register.php" class="label label-info">Daftar</a> Untuk Masuk</p>
                            
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
        
        <?php
        $user = @$_POST['user'];
        $pass = @$_POST['pass'];
        $login = @$_POST['login'];
        
        if($login) {
            if($user == "" || $pass == ""){
                ?><script type="text/javascript">alert("Username atau Password Kosong");</script><?php
            }else{
                $sql = mysql_query("select * from `user` where username = '$user' and password = md5('$pass')") or die(mysql_error());
                $data = mysql_fetch_array($sql);
                $cek = mysql_num_rows($sql);
                if($cek >= 1) {
                    if($data['level'] == "kajur") {
                        @$_SESSION['kajur'] = $data['id_user'];
                        header("location: home.php");
                    } else if($data['level'] == "dosen") {
                        @$_SESSION['dosen'] = $data['id_user'];
                        header("location: home.php");
                    } else if($data['level'] == "mahasiswa") {
                        @$_SESSION['mahasiswa'] = $data['id_user'];
                        header("location: home.php");
                    }
                }else{
                    ?><script type="text/javascript">alert("USERNAME ATAU PASSWORD SALAH");</script><?php
                }
            }      
        }
        ?>
        
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