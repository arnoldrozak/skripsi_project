var manageTable;

$(document).ready(function() {
    manageTable = $("#manageTable").DataTable({
        "ajax": "action/retrieve.php",
        "order": []
    });
    
    $("#tambahDataModal").on('click', function() {
        // Reset Form
        $("#buatDataForm")[0].reset();
        //Hilangkan notif error
        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-danger").remove();
        // Kosongkan Pesan (Message div)
        $(".messages").html("");
        
        // Submit Form
        $("#buatDataForm").unbind('submit').bind('submit', function() {
            
            $(".text-danger").remove();
            
            var form = $(this);
            
            // Validasi
            var nid = $("#nid").val();
            var nama = $("#nama").val();
            var fakultas = $("#fakultas").val();
            var status = $("#status").val();
            var jabatan = $("#jabatan").val();
            var alamat = $("#alamat").val();
            var telepon = $("#telepon").val();
            var email = $("#email").val();
            
            if(nid == "") {
                $("#nid").closest('.form-group').addClass('has-error');
                $("#nid").after('<p class="text-danger">Masukan Nomer Induk Dosen</p>');
            } else {
                $("#nid").closest('.form-group').removeClass('has-error');
                $("#nid").closest('.form-group').addClass('has-success');                
            }
            
            if(nama == "") {
                $("#nama").closest('.form-group').addClass('has-error');
                $("#nama").after('<p class="text-danger">Masukan Nama Dosen</p>');
            } else {
                $("#nama").closest('.form-group').removeClass('has-error');
                $("#nama").closest('.form-group').addClass('has-success');                
            }
            
            if(fakultas == "") {
                $("#fakultas").closest('.form-group').addClass('has-error');
                $("#fakultas").after('<p class="text-danger">Masukan Fakultas Dosen</p>');
            } else {
                $("#fakultas").closest('.form-group').removeClass('has-error');
                $("#fakultas").closest('.form-group').addClass('has-success');                
            }
            
            if(status == "") {
                $("#status").closest('.form-group').addClass('has-error');
                $("#status").after('<p class="text-danger">Masukan Status Dosen</p>');
            } else {
                $("#status").closest('.form-group').removeClass('has-error');
                $("#status").closest('.form-group').addClass('has-success');                
            }
            
            if(jabatan == "") {
                $("#jabatan").closest('.form-group').addClass('has-error');
                $("#jabatan").after('<p class="text-danger">Masukan Jabatan Dosen</p>');
            } else {
                $("#jabatan").closest('.form-group').removeClass('has-error');
                $("#jabatan").closest('.form-group').addClass('has-success');                
            }
            
            if(alamat == "") {
                $("#alamat").closest('.form-group').addClass('has-error');
                $("#alamat").after('<p class="text-danger">Masukan Alamat Dosen</p>');
            } else {
                $("#alamat").closest('.form-group').removeClass('has-error');
                $("#alamat").closest('.form-group').addClass('has-success');                
            }
            
            if(telepon == "") {
                $("#telepon").closest('.form-group').addClass('has-error');
                $("#telepon").after('<p class="text-danger">Masukan Nomer Telepon/HP Dosen</p>');
            } else {
                $("#telepon").closest('.form-group').removeClass('has-error');
                $("#telepon").closest('.form-group').addClass('has-success');
            }
            
            if(email == "") {
                $("#email").closest('.form-group').addClass('has-error');
                $("#email").after('<p class="text-danger">Masukan Alamat Email Dosen</p>');
            } else {
                $("#email").closest('.form-group').removeClass('has-error');
                $("#email").closest('.form-group').addClass('has-success');
            }
            
            if(nid && nama && fakultas && status && jabatan && alamat && telepon && email) {
                //Submit form ke server
                $.ajax({
                    url : form.attr('action'),
                    type : form.attr('method'),
                    data : form.serialize(),
                    dataType : 'json',
                    success:function(response) {
                        
                        //Hapus pesan error
                        $(".form-group").removeClass('has-error').removeClass('has-success');
                        
                        if(response.success == true) {
                            $(".messages").html('<div class="alert alert-success alert-dismissible" role=alert">'+
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                '<strong><span class="glyphicon glyphicon-ok-sign"></span></strong>'+response.messages+
                                '</div>');
                        
                                //Reset Form
                                $("#buatDataForm")[0].reset();
                                
                                //Memuat ulang Datatables
                                manageTable.ajax.reload(null, false);
                                
                        
                        } else {
                            $(".messages").html('<div class="alert alert-warning alert-dismissible" role=alert">'+
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                '<strong><span class="glyphicon exclamation-ok-sign"></span></strong>'+response.messages+
                                '</div>');
                        }
                    }
                }); // Ajax Submit
            }
            
            return false;
        }); // Submit Buat Data Form        
    }); // Tambah data modal
});

// Fungsi Delete
function deleteData(id_dosen = null) {
    if(id_dosen) {
        $("#deleteBtn").unbind('click').bind('click', function() {
            $.ajax({
               url : 'action/delete.php',
               type : 'post',
               data : {data_id : id_dosen},
               dataType : 'json',
               success:function(response){
                   if(response.success == true) {                       
                       $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role=alert">'+
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                '<strong><span class="glyphicon glyphicon-ok-sign"></span></strong>'+response.messages+
                                '</div>');
                        
                        //Refresh Table data
                        manageTable.ajax.reload(null, false);
                        
                        //Tutup Modal Delete
                        $("#deleteDataModal").modal('hide');
                        
                   } else {
                       $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role=alert">'+
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                '<strong><span class="glyphicon glyphicon-exclamation-sign"></span></strong>'+response.messages+
                                '</div>');
                   }                
               }
            });
        }); // Klik delete data
    }else{
        alert('Error : Please Refresh Page');
    }
}

function editData (id_dosen = null) {
    if(id_dosen) {
                
        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-danger").remove();
        // Kosongkan Pesan (Message div)
        $(".edit-messages").html("");
        
        $("#data_id").remove();
        
        // fetch data
        $.ajax({
           url : 'action/getSelectedData.php',
           type : 'post',
           data : {data_id : id_dosen},
           dataType : 'json',
           success : function(response) {
                $("#editNid").val(response.id_dosen);
                $("#editNama").val(response.nm_dosen);
                $("#editFakultas").val(response.fakultas);
                $("#editStatus").val(response.status);
                $("#editJabatan").val(response.jabatan);
                $("#editAlamat").val(response.alamat);
                $("#editTelepon").val(response.no_telp);
                $("#editEmail").val(response.email);
                
                //Data id
                $(".editDataModal").append('<input type="hidden" name="data_id" id="data_id" value="'+response.id_dosen+'"/>');
                
                $("#updateDataForm").unbind('submit').bind('submit', function() {
                    
                    $(".text-danger").remove();
                    
                    var form = $(this);
                    
                    // Validasi
                    var editNid = $("#editNid").val();
                    var editNama = $("#editNama").val();
                    var editFakultas = $("#editFakultas").val();
                    var editStatus = $("#editStatus").val();
                    var editJabatan = $("#editJabatan").val();
                    var editAlamat = $("#editAlamat").val();
                    var editTelepon = $("#editTelepon").val();
                    var editEmail = $("#editEmail").val();

                    if(editNid == "") {
                        $("#editNid").closest('.form-group').addClass('has-error');
                        $("#editNid").after('<p class="text-danger">Masukan Nomer Induk Dosen</p>');
                    } else {
                        $("#editNid").closest('.form-group').removeClass('has-error');
                        $("#editNid").closest('.form-group').addClass('has-success');                
                    }
                    
                    if(editNama == "") {
                        $("#editNama").closest('.form-group').addClass('has-error');
                        $("#editNama").after('<p class="text-danger">Masukan Nama Dosen</p>');
                    } else {
                        $("#editNama").closest('.form-group').removeClass('has-error');
                        $("#editNama").closest('.form-group').addClass('has-success');                
                    }

                    if(editFakultas == "") {
                        $("#editFakultas").closest('.form-group').addClass('has-error');
                        $("#editFakultas").after('<p class="text-danger">Masukan Fakultas Dosen</p>');
                    } else {
                        $("#editFakultas").closest('.form-group').removeClass('has-error');
                        $("#editFakultas").closest('.form-group').addClass('has-success');                
                    }

                    if(editStatus == "") {
                        $("#editStatus").closest('.form-group').addClass('has-error');
                        $("#editStatus").after('<p class="text-danger">Masukan Status Dosen</p>');
                    } else {
                        $("#editStatus").closest('.form-group').removeClass('has-error');
                        $("#editStatus").closest('.form-group').addClass('has-success');                
                    }

                    if(editJabatan == "") {
                        $("#editJabatan").closest('.form-group').addClass('has-error');
                        $("#editJabatan").after('<p class="text-danger">Masukan Jabatan Dosen</p>');
                    } else {
                        $("#editJabatan").closest('.form-group').removeClass('has-error');
                        $("#editJabatan").closest('.form-group').addClass('has-success');                
                    }

                    if(editAlamat == "") {
                        $("#editAlamat").closest('.form-group').addClass('has-error');
                        $("#editAlamat").after('<p class="text-danger">Masukan Alamat Dosen</p>');
                    } else {
                        $("#editAlamat").closest('.form-group').removeClass('has-error');
                        $("#editAlamat").closest('.form-group').addClass('has-success');                
                    }

                    if(editTelepon == "") {
                        $("#editTelepon").closest('.form-group').addClass('has-error');
                        $("#editTelepon").after('<p class="text-danger">Masukan Nomer Telepon/HP Dosen</p>');
                    } else {
                        $("#editTelepon").closest('.form-group').removeClass('has-error');
                        $("#editTelepon").closest('.form-group').addClass('has-success');
                    }

                    if(editEmail == "") {
                        $("#editEmail").closest('.form-group').addClass('has-error');
                        $("#editEmail").after('<p class="text-danger">Masukan Alamat Email Dosen</p>');
                    } else {
                        $("#editEmail").closest('.form-group').removeClass('has-error');
                        $("#editEmail").closest('.form-group').addClass('has-success');
                    }

                    if(editNid && editNama && editFakultas && editStatus && editJabatan && editAlamat && editTelepon && editEmail) {
                        $.ajax({
                            url : form.attr('action'),
                            type : form.attr('method'),
                            data : form.serialize(),
                            dataType : 'json',
                            success : function(response) {
                                if(response.success == true) {
                                    $(".edit-messages").html('<div class="alert alert-success alert-dismissible" role=alert">'+
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                    '<strong><span class="glyphicon glyphicon-ok-sign"></span></strong>'+response.messages+
                                    '</div>');

                                    //Memuat ulang Datatables
                                    manageTable.ajax.reload(null, false);
                                    
                                    //Hilangkan notif error
                                    $(".form-group").removeClass('has-success').removeClass('has-error');
                                    $(".text-danger").remove();
                                    
                                } else {
                                    $(".edit-messages").html('<div class="alert alert-warning alert-dismissible" role=alert">'+
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                    '<strong><span class="glyphicon exclamation-ok-sign"></span></strong>'+response.messages+
                                    '</div>');
                                }
                            }
                        })
                    };
                    
                    return false;
                });
           }
        });
    } else {
        alert("Error : Please Refresh Page");
    }
}

function deleteData(id_dosen = null) {
    if(id_dosen) {
        $("#deleteBtn").unbind('click').bind('click', function() {
            $.ajax({
               url : 'action/print.php',
               type : 'post',
               data : {data_id : id_dosen},
               dataType : 'json',
               success:function(response){
                   if(response.success == true) {                       
                       $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role=alert">'+
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                '<strong><span class="glyphicon glyphicon-ok-sign"></span></strong>'+response.messages+
                                '</div>');
                        
                        //Refresh Table data
                        manageTable.ajax.reload(null, false);
                        
                        //Tutup Modal Delete
                        $("#printDataModal").modal('hide');
                        
                   } else {
                       $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role=alert">'+
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                '<strong><span class="glyphicon glyphicon-exclamation-sign"></span></strong>'+response.messages+
                                '</div>');
                   }
               }
            });
        }); // Klik delete data
    }else{
        alert('Error : Please Refresh Page');
    }
}