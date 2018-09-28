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
            var jurusan = $("#jurusan").val();
            var judul = $("#judul").val();
            var validasi = $("#validasi").val();
                        
            if(nim == "") {
                $("#nim").closest('.form-group').addClass('has-error');
                $("#nim").after('<p class="text-danger">Masukan NIM Mahasiswa</p>');
            } else {
                $("#nim").closest('.form-group').removeClass('has-error');
                $("#nim").closest('.form-group').addClass('has-success');                
            }
            
            if(jurusan == "") {
                $("#jurusan").closest('.form-group').addClass('has-error');
                $("#jurusan").after('<p class="text-danger">Masukan Jurusan Mahasiswa</p>');
            } else {
                $("#jurusan").closest('.form-group').removeClass('has-error');
                $("#jurusan").closest('.form-group').addClass('has-success');                
            }
            
            if(judul == "") {
                $("#judul").closest('.form-group').addClass('has-error');
                $("#judul").after('<p class="text-danger">Masukan Judul Skripsi</p>');
            } else {
                $("#judul").closest('.form-group').removeClass('has-error');
                $("#judul").closest('.form-group').addClass('has-success');                
            }
            
            if(validasi == "") {
                $("#validasi").closest('.form-group').addClass('has-error');
                $("#validasi").after('<p class="text-danger">Pilih Status</p>');
            } else {
                $("#validasi").closest('.form-group').removeClass('has-error');
                $("#validasi").closest('.form-group').addClass('has-success');                
            }
            
            if(nim && jurusan && judul && validasi) {
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
function deleteData(id_dok = null) {
    if(id_dok) {
        $("#deleteBtn").unbind('click').bind('click', function() {
            $.ajax({
               url : 'action/delete.php',
               type : 'post',
               data : {data_id : id_dok},
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

function editData (id_dok = null) {
    if(id_dok) {
                
        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-danger").remove();
        // Kosongkan Pesan (Message div)
        $(".edit-messages").html("");
        
        $("#data_id").remove();
        
        // fetch data
        $.ajax({
           url : 'action/getSelectedData.php',
           type : 'post',
           data : {data_id : id_dok},
           dataType : 'json',
           success : function(response) {                
                $("#editNim").val(response.nim);
                $("#editJurusan").val(response.jurusan);
                $("#editJudul").val(response.judul);
                $("#editValidasi").val(response.validasi);
                                
                //Data id
                $(".editDataModal").append('<input type="hidden" name="data_id" id="data_id" value="'+response.id_dok+'"/>');
                
                $("#updateDataForm").unbind('submit').bind('submit', function() {
                    
                    $(".text-danger").remove();
                    
                    var form = $(this);
                    
                    // Validasi                    
                    var editNim = $("#editNim").val();
                    var editJurusan = $("#editJurusan").val();
                    var editJudul = $("#editJudul").val();
                    var editValidasi = $("#editValidasi").val();
                                     
                    if(editNim == "") {
                        $("#editNim").closest('.form-group').addClass('has-error');
                        $("#editNim").after('<p class="text-danger">Masukan NIM Mahasiswa</p>');
                    } else {
                        $("#editNim").closest('.form-group').removeClass('has-error');
                        $("#editNim").closest('.form-group').addClass('has-success');                
                    }
                    
                    if(editJurusan == "") {
                        $("#editJurusan").closest('.form-group').addClass('has-error');
                        $("#editJurusan").after('<p class="text-danger">Masukan Jurusan Mahasiswa</p>');
                    } else {
                        $("#editJurusan").closest('.form-group').removeClass('has-error');
                        $("#editJurusan").closest('.form-group').addClass('has-success');                
                    }

                    if(editJudul == "") {
                        $("#editJudul").closest('.form-group').addClass('has-error');
                        $("#editJudul").after('<p class="text-danger">Masukan Judul Skripsi</p>');
                    } else {
                        $("#editJudul").closest('.form-group').removeClass('has-error');
                        $("#editJudul").closest('.form-group').addClass('has-success');                
                    }
                    
                    if(editValidasi == "") {
                        $("#editValidasi").closest('.form-group').addClass('has-error');
                        $("#editValidasi").after('<p class="text-danger">Pilih Status</p>');
                    } else {
                        $("#editValidasi").closest('.form-group').removeClass('has-error');
                        $("#editValidasi").closest('.form-group').addClass('has-success');                
                    }
                    
                    if(editNim && editJurusan && editJudul && editValidasi) {
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