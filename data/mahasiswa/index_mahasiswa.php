<?php
@session_start();
require_once "../koneksi_db/db_koneksi.php";
if(@$_SESSION['kajur'] || @$_SESSION['dosen'] || @$_SESSION['mahasiswa']){
?>
<!DOCTYPE html>
<html>
    <head>
        <title>DATA MAHASISWA</title>
        
        <!-- Bootstrap css -->
        <link rel="stylesheet" type="text/css" href="../../assests/bootstrap/css/bootstrap.min.css">
        <!-- Datatables css -->
        <link rel="stylesheet" type="text/css" href="../../assests/datatables/datatables.min.css">
        <!-- Custom Style css -->
        <link rel="stylesheet" type="text/css" href="../../custom/css/style.css">
        
    </head>
    <body>
        
        <!-- Menu Navigasi Bar -->
        <nav class="navbar navbar-static-top navbar-inverse">
            <ul class="nav navbar-nav">
                <li><a href="../../home.php"><span class="glyphicon glyphicon-home"></span> HOME</a></li>
                <li><a href="../dosen/index_dosen.php"><span class="glyphicon glyphicon-bookmark"></span> DATA DOSEN</a></li>                
                <li><a href="../mahasiswa/index_mahasiswa.php"><span class="glyphicon glyphicon-book"></span> DATA MAHASISWA</a></li>
                <li><a href="../pengajuan/pengajuan.php"><span class="glyphicon glyphicon-upload"></span> PENGAJUAN JUDUL</a></li>
                <li class="col-lg-push-11"><a href="../../action/keluar.php"><span class="glyphicon glyphicon-log-out"></span> LOGOUT</a></li>
            </ul>
        </nav>
        
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                    <center><h1 class="page-header"><small>DATA </small>MAHASISWA</h1></center>
                    
                    <div class="removeMessages"></div>
                    
                    <?php if(@$_SESSION['kajur']){ ?>
                    <button class="btn btn-success pull-right" data-toggle="modal" data-target="#tambahData" id="tambahDataModal">
                        <span class="glyphicon glyphicon-plus-sign"></span> Tambah Data
                    </button>
                    <?php } ?>
                    
                    <br/><br/><br/>
                                        
                    <table class="table table-bordered table-responsive table-striped" id="manageTable">
                        <thead>
                            <tr>                                
                                <th style="background-color: skyblue">No</th>
                                <th style="background-color: skyblue">NIM</th>
                                <th style="background-color: skyblue">Nama</th>
                                <th style="background-color: skyblue">Fakultas</th>
                                <th style="background-color: skyblue">Jurusan</th>
                                <th style="background-color: skyblue">NID 1</th>
                                <th style="background-color: skyblue">NID 2</th>
                                <?php if(@$_SESSION['kajur']){ ?>
                                <th style="background-color: skyblue">Option</th>
                                <?php } ?>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
                
        <!-- Footer -->
        <div class="clear">&nbsp;</div>
        <div class="footer-copyright text-center py-3">&copy; 2017 Copyright Arnold Rozak &
          <a href="https://usni.ac.id/"> USNI</a>
        <div class="clear">&nbsp;</div>
        </div>
        
        <!-- Tambah Data Form -->
        <div class="modal fade" tabindex="-1" role="dialog" id="tambahData">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span 
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span> Tambah Data</h4>
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
                  <label for="nama" class="col-sm-2 control-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Mahasiswa">
                  </div>
                </div>
                <div class="form-group">
                  <label for="fakultas" class="col-sm-2 control-label">Fakultas</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="fakultas" name="fakultas" placeholder="Fakultas">
                  </div>
                </div>                              
                <div class="form-group">
                  <label for="jurusan" class="col-sm-2 control-label">Jurusan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Jurusan">
                  </div>
                </div>
                <div class="form-group">
                  <label for="dosen1" class="col-sm-2 control-label">Dosen 1</label>
                  <?php $sql_dosen1 = mysqli_query($connect, 'SELECT * FROM tbl_dosen'); ?>
                  <div class="col-sm-10">
                      <select class="form-control" name="dosen1" id="dosen1">
                          <option value="">-Dosen Pembimbing 1-</option>
                          <?php while($row_dosen1 = mysqli_fetch_array($sql_dosen1)) {?>
                          <option value="<?php echo $row_dosen1['id_dosen'] ?>"><?php echo $row_dosen1['nm_dosen'] ?></option>
                          <?php } ?>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="dosen2" class="col-sm-2 control-label">Dosen 2</label>
                  <?php $sql_dosen2 = mysqli_query($connect, 'SELECT * FROM tbl_dosen'); ?>
                  <div class="col-sm-10">
                      <select class="form-control" name="dosen2" id="dosen2">
                          <option value="">-Dosen Pembimbing 2-</option>
                          <?php while($row_dosen2 = mysqli_fetch_array($sql_dosen2)) {?>
                          <option value="<?php echo $row_dosen2['id_dosen'] ?>"><?php echo $row_dosen2['nm_dosen'] ?></option>
                          <?php } ?>
                      </select>
                  </div>
                </div>
                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
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
                        <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Edit Data</h4>
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
                              <label for="editNama" class="col-sm-2 control-label">Nama</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="editNama" name="editNama" placeholder="Nama Mahasiswa">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="editFakultas" class="col-sm-2 control-label">Fakultas</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="editFakultas" name="editFakultas" placeholder="Fakultas">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="editJurusan" class="col-sm-2 control-label">Jurusan</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="editJurusan" name="editJurusan" placeholder="Jurusan">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="editDosen1" class="col-sm-2 control-label">Dosen 1</label>
                              <?php $sql_dosen1 = mysqli_query($connect, 'SELECT * FROM tbl_dosen'); ?>
                              <div class="col-sm-10">
                                  <select class="form-control" name="editDosen1" id="editDosen1">
                                      <option value="">-Dosen Pembimbing 1-</option>
                                      <?php while($row_dosen1 = mysqli_fetch_array($sql_dosen1)) {?>
                                      <option value="<?php echo $row_dosen1['id_dosen'] ?>"><?php echo $row_dosen1['nm_dosen'] ?></option>
                                      <?php } ?>
                                  </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="editDosen2" class="col-sm-2 control-label">Dosen 2</label>
                              <?php $sql_dosen2 = mysqli_query($connect, 'SELECT * FROM tbl_dosen'); ?>
                              <div class="col-sm-10">
                                  <select class="form-control" name="editDosen2" id="editDosen2">
                                      <option value="">-Dosen Pembimbing 2-</option>
                                      <?php while($row_dosen2 = mysqli_fetch_array($sql_dosen2)) {?>
                                      <option value="<?php echo $row_dosen2['id_dosen'] ?>"><?php echo $row_dosen2['nm_dosen'] ?></option>
                                      <?php } ?>
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
        <script type="text/javascript" src="../../custom/js/index_mahasiswa.js"></script>
    </body>
</html>
<?php
} else {
    header("location: ../../index.php");
}
?>