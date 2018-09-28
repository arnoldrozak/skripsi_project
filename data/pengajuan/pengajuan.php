<?php
@session_start();
if(@$_SESSION['kajur'] || @$_SESSION['dosen'] || @$_SESSION['mahasiswa']){
?>
<!DOCTYPE html>
<html>
    <head>
        <title>JUDUL SKRIPSI</title>
        
        <!-- Bootstrap css -->
        <link rel="stylesheet" type="text/css" href="../../assests/bootstrap/css/bootstrap.min.css">
        <!-- Datatables css -->
        <link rel="stylesheet" type="text/css" href="../../assests/datatables/datatables.min.css">
        <!-- Custom Style css -->
        <link rel="stylesheet" type="text/css" href="../../custom/css/style.css">
        
    </head>
    <body>
        
        <!-- Menu Navigasi Bar -->
        <nav class="navbar navbar-static-top navbar-inverse navbar-fixed-header">
            <ul class="nav navbar-nav">
                <li role="presentation"><a href="../../home.php"><span class="glyphicon glyphicon-home"></span> HOME</a></li>
                <li><a href="../dosen/index_dosen.php"><span class="glyphicon glyphicon-bookmark"></span> DATA DOSEN</a></li>
                <li><a href="../mahasiswa/index_mahasiswa.php"><span class="glyphicon glyphicon-book"></span> DATA MAHASISWA</a></li>
                <li><a href="../pengajuan/pengajuan.php"><span class="glyphicon glyphicon-upload"></span> PENGAJUAN JUDUL</a></li>
                <li class="col-lg-push-11"><a href="../../action/keluar.php"><span class="glyphicon glyphicon-log-out"></span> LOGOUT</a></li>
            </ul>
        </nav>        
        
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                    <center><h1 class="page-header"><small>STATUS </small>JUDUL SKRIPSI</h1></center>
                    
                    <div class="removeMessages"></div>
                    
                    <?php if(@$_SESSION['mahasiswa']){ ?>
                    <button class="btn btn-info" data-toggle="modal" data-target="#tambahData" id="tambahDataModal">
                        <span class="glyphicon glyphicon-download-alt"></span> Ajukan Judul
                    </button>
                    <?php } ?>
                    
                    <br/><br/><br/>
                                        
                    <table class="table table-responsive table-striped" id="manageTable">
                        <thead>
                            <tr>                                
                                <th style="background-color: salmon">No</th>
                                <th style="background-color: salmon">NIM</th>
                                <th style="background-color: salmon">Jurusan</th>
                                <th style="background-color: salmon">Judul</th>
                                <th style="background-color: salmon">Status</th>
                                <?php if(@$_SESSION['kajur']){ ?>
                                <th style="background-color: salmon">Option</th>
                                <?php } ?>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>                    
        
        <!-- Tambah Data Form -->
        <div class="modal fade" tabindex="-1" role="dialog" id="tambahData">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span 
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="glyphicon glyphicon-download"></span> Pengajuan Judul</h4>
              </div>
                
              <form class="form-horizontal" action="action/create.php" method="POST" id="buatDataForm">
              <div class="modal-body">
                <div class="messages"></div>
                  
                <div class="form-group">
                  <label for="nim" class="col-sm-2 control-label">NIM</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM Mahasiswa">
                  </div>
                </div>
                <div class="form-group">
                  <label for="jurusan" class="col-sm-2 control-label">Jurusan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Jurusan">
                  </div>
                </div>
                <div class="form-group">
                  <label for="judul" class="col-sm-2 control-label">Judul</label>
                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" id="judul" name="judul" placeholder="Judul Skripsi"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="validasi" class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-10">
                      <select class="form-control" name="validasi" id="validasi">                          
                          <option value="1">PROSES</option>                          
                      </select>
                  </div>
                </div>
                
                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Ajukan</button>
              </div>
              </form>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        <!-- Delete modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="deleteDataModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"></span></button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Delete Data</h4>
                    </div>
                    <div class="modal-body">
                        <p><center>Apa anda yakin ingin menghapus data ini?</center></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" id=deleteBtn>Delete</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Edit Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="editDataModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismis="modal" aria-label="Close"><span 
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-refresh"></span> Proses Judul</h4>
                    </div>
                    
                <form class="form-horizontal" action="action/update.php" method="POST" id="updateDataForm">
              
                    <div class="modal-body">
                        
                        <div class="edit-messages"></div>
                  
                            <div class="form-group">
                              <label for="editNim" class="col-sm-2 control-label">NIM</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="editNim" name="editNim" placeholder="NIM Mahasiswa" readonly="readonly">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="editJurusan" class="col-sm-2 control-label">Jurusan</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="editJurusan" name="editJurusan" placeholder="Jurusan" readonly="readonly">
                              </div>
                            </div>
                            <div class="form-group">
                                <label for="editJudul" class="col-sm-2 control-label">Judul</label>
                                <div class="col-sm-10">
                                  <textarea type="text" class="form-control" id="editJudul" name="editJudul" placeholder="Judul Skripsi" readonly="readonly"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                              <label for="editValidasi" class="col-sm-2 control-label">Status</label>
                              <div class="col-sm-10">
                                <select class="form-control" name="editValidasi" id="editValidasi">
                                    <option value="">-Status-</option>
                                    <option value="1">PROSES</option>
                                    <option value="2">SETUJUI</option>
                                    <option value="3">TOLAK</option>
                                </select>
                              </div>
                            </div>
                                                    
                    </div>
                    <div class="modal-footer editDataModal">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>    
                </div>
            </div>
        </div>
        
        <!-- jquery Plugin -->
        <script type="text/javascript" src="../../assests/jquery/jquery.min.js"></script>
        <!-- Bootstrap js -->
        <script type="text/javascript" src="../../assests/bootstrap/js/bootstrap.min.js"></script>
        <!-- Datatables js -->
        <script type="text/javascript" src="../../assests/datatables/datatables.min.js"></script>
        <!-- Custom Index js -->
        <script type="text/javascript" src="../../custom/js/index_pengajuan.js"></script>
    </body>
</html>
<?php
} else {
    header("location: ../../index.php");
}
?>