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
            var nim = $("#nim").val();
            var nama = $("#nama").val();
            var fakultas = $("#fakultas").val();
            var jurusan = $("#jurusan").val();
            var dosen1 = $("#dosen1").val();
            var dosen2 = $("#dosen2").val();
                        
            if(nim == "") {
                $("#nim").closest('.form-group').addClass('has-error');
                $("#nim").after('<p class="text-danger">Masukan NIM Mahasiswa</p>');
            } else {
                $("#nim").closest('.form-group').removeClass('has-error');
                $("#nim").closest('.form-group').addClass('has-success');                
            }
            
            if(nama == "") {
                $("#nama").closest('.form-group').addClass('has-error');
                $("#nama").after('<p class="text-danger">Masukan Nama Mahasiswa</p>');
            } else {
                $("#nama").closest('.form-group').removeClass('has-error');
                $("#nama").closest('.form-group').addClass('has-success');                
            }
            
            if(fakultas == "") {
                $("#fakultas").closest('.form-group').addClass('has-error');
                $("#fakultas").after('<p class="text-danger">Masukan Fakultas Mahasiswa</p>');
            } else {
                $("#fakultas").closest('.form-group').removeClass('has-error');
                $("#fakultas").closest('.form-group').addClass('has-success');                
            }
            
            if(jurusan == "") {
                $("#jurusan").closest('.form-group').addClass('has-error');
                $("#jurusan").after('<p class="text-danger">Masukan Jurusan Mahasiswa</p>');
            } else {
                $("#jurusan").closest('.form-group').removeClass('has-error');
                $("#jurusan").closest('.form-group').addClass('has-success');                
            }
            
            if(dosen1 == "") {
                $("#dosen1").closest('.form-group').addClass('has-error');
                $("#dosen1").after('<p class="text-danger">Pilih Dosen 1</p>');
            } else {
                $("#dosen1").closest('.form-group').removeClass('has-error');
                $("#dosen1").closest('.form-group').addClass('has-success');                
            }
            
            if(dosen2 == "") {
                $("#dosen2").closest('.form-group').addClass('has-error');
                $("#dosen2").after('<p class="text-danger">Pilih Dosen 2</p>');
            } else {
                $("#dosen2").closest('.form-group').removeClass('has-error');
                $("#dosen2").closest('.form-group').addClass('has-success');                
            }
            
            if(nim && nama && fakultas && jurusan && dosen1 && dosen2) {
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
function deleteData(nim = null) {
    if(nim) {
        $("#deleteBtn").unbind('click').bind('click', function() {
            $.ajax({
               url : 'action/delete.php',
               type : 'post',
               data : {data_id : nim},
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

function editData (nim = null) {
    if(nim) {
                
        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-danger").remove();
        // Kosongkan Pesan (Message div)
        $(".edit-messages").html("");
        
        $("#data_id").remove();
        
        // fetch data
        $.ajax({
           url : 'action/getSelectedData.php',
           type : 'post',
           data : {data_id : nim},
           dataType : 'json',
           success : function(response) {                
                $("#editNim").val(response.nim);
                $("#editNama").val(response.nama_mhs);
                $("#editFakultas").val(response.fakultas);
                $("#editJurusan").val(response.jurusan);
                $("#editDosen1").val(response.pembimbing1);
                $("#editDosen2").val(response.pembimbing2);
                                
                //Data id
                $(".editDataModal").append('<input type="hidden" name="data_id" id="data_id" value="'+response.nim+'"/>');
                
                $("#updateDataForm").unbind('submit').bind('submit', function() {
                    
                    $(".text-danger").remove();
                    
                    var form = $(this);
                    
                    // Validasi                    
                    var editNim = $("#editNim").val();
                    var editNama = $("#editNama").val();
                    var editFakultas = $("#editFakultas").val();
                    var editJurusan = $("#editJurusan").val();
                    var editDosen1 = $("#editDosen1").val();
                    var editDosen2 = $("#editDosen2").val();
                                     
                    if(editNim == "") {
                        $("#editNim").closest('.form-group').addClass('has-error');
                        $("#editNim").after('<p class="text-danger">Masukan NIM Mahasiswa</p>');
                    } else {
                        $("#editNim").closest('.form-group').removeClass('has-error');
                        $("#editNim").closest('.form-group').addClass('has-success');                
                    }
                    
                    if(editNama == "") {
                        $("#editNama").closest('.form-group').addClass('has-error');
                        $("#editNama").after('<p class="text-danger">Masukan Nama Mahasiswa</p>');
                    } else {
                        $("#editNama").closest('.form-group').removeClass('has-error');
                        $("#editNama").closest('.form-group').addClass('has-success');                
                    }

                    if(editFakultas == "") {
                        $("#editFakultas").closest('.form-group').addClass('has-error');
                        $("#editFakultas").after('<p class="text-danger">Masukan Fakultas Mahasiswa</p>');
                    } else {
                        $("#editFakultas").closest('.form-group').removeClass('has-error');
                        $("#editFakultas").closest('.form-group').addClass('has-success');                
                    }
                    
                    if(editJurusan == "") {
                        $("#editJurusan").closest('.form-group').addClass('has-error');
                        $("#editJurusan").after('<p class="text-danger">Masukan Jurusan Mahasiswa</p>');
                    } else {
                        $("#editJurusan").closest('.form-group').removeClass('has-error');
                        $("#editJurusan").closest('.form-group').addClass('has-success');                
                    }
                    
                    if(editDosen1 == "") {
                        $("#editDosen1").closest('.form-group').addClass('has-error');
                        $("#editDosen1").after('<p class="text-danger">Pilih Dosen 1</p>');
                    } else {
                        $("#editDosen1").closest('.form-group').removeClass('has-error');
                        $("#editDosen1").closest('.form-group').addClass('has-success');                
                    }
                    
                    if(editDosen2 == "") {
                        $("#editDosen2").closest('.form-group').addClass('has-error');
                        $("#editDosen2").after('<p class="text-danger">Pilih Dosen 2</p>');
                    } else {
                        $("#editDosen2").closest('.form-group').removeClass('has-error');
                        $("#editDosen2").closest('.form-group').addClass('has-success');                
                    }
                    
                    if(editNim && editNama && editFakultas && editJurusan && editDosen1 && editDosen2) {
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