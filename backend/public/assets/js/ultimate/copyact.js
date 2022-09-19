//Datatables server side
$(document).ready( function () {
    var url = '/ultimate/Copyactcontroller/ajax_list';
    var table = $('#datatable-ultimatecopyact').DataTable({ 
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
          "url": BASE_URL + url,
          "type": "POST"
      },
      //optional
      "lengthMenu": [10, 25, 50, 100, 250, 500],
      "columnDefs": [
        { 
            "targets": [],
            "orderable": false,
        },
      ],
      "language": {
        "paginate": 
        {
            "previous": "<i class='fas fa-angle-left'>",
            "next": "<i class='fas fa-angle-right'>"
        }
    }
    });
});


// Fungsi generate kode di modal add
function generatekodeultimatecopyact() {
    var url = "/ultimate/Copyactcontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#ultimatecopyact_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}


// Fungsi tampil input summernote di modal add
$('#ultimatecopyact_deskripsi').summernote({
    placeholder: 'Masukkan konten disini ...',
    height: 200,
	callbacks: {
        onImageUpload: function(image) {
            uploadImage(image[0]);
        },
        onMediaDelete : function(target) {
            deleteImage(target[0].src);
        }
    }
});


// Fungsi upload gambar di summernote add
function uploadImage(image) {
    var data = new FormData();
    var url = "/ultimate/Copyactcontroller/uploadGambar";
    data.append("image", image);
    $.ajax({
        url: BASE_URL + url,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            $('#ultimatecopyact_deskripsi').summernote("insertImage", url, data);
        },
        error: function(data) {
            console.log(data);
        }
   });
 }


// Fungsi hapus gambar di summernote add
function deleteImage(src) {
    var url = "/ultimate/Copyactcontroller/deleteGambar";
    $.ajax({
    url: BASE_URL + url,
    data: {src : src},
    type: "POST",
    cache: false,
    success: function(response) {
        console.log(response);
    }
    });
}


// Fungsi tampil input summernote di modal edit
$('#ultimatecopyact_deskripsiedit').summernote({
    placeholder: 'Masukkan konten disini ...',
    height: 200,
	callbacks: {
       onImageUpload: function(image) {
		   editor = $(this);
           uploadImageEdit(image[0], editor);
       },
       onMediaDelete : function(target) {
           deleteImageEdit(target[0].src);
       }
    }
  });


// Fungsi upload gambar di summernote edit
function uploadImageEdit(image) {
    var data = new FormData();
    var url = "/ultimate/Copyactcontroller/uploadGambar";
    data.append("image", image);
    $.ajax({
        url: BASE_URL + url,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            $('#ultimatecopyact_deskripsiedit').summernote("insertImage", url, data);
        },
        error: function(data) {
            console.log(data);
        }
   });
 }


// Fungsi hapus gambar di summernote edit
function deleteImageEdit(src) {
    var url = "/ultimate/Copyactcontroller/deleteGambar";
    $.ajax({
    url: BASE_URL + url,
    data: {src : src},
    type: "POST",
    cache: false,
    success: function(response) {
        console.log(response);
    }
    });
}


// Fungsi proses kirim data di modal add
$(document).ready(function() {
    $('.formModaltambahultimatecopyact').submit(function(e) {
        e.preventDefault();

        let data = new FormData(this);

        $('.ultimatecopyact_isactive').each(function() {
            if ($(this).is(":checked"))
            {
                data.append('ultimatecopyact_isactive', 1);
            }
            else
            {
                data.append('ultimatecopyact_isactive', 0);
            }
        });

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            data: data,
            dataType: "json",
            beforeSend: function() {
                $('.modaltambahultimatecopyact').prop('disabled', true);
                $('.modaltambahultimatecopyact').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.modaltambahultimatecopyact').prop('disabled', false);
                $('.modaltambahultimatecopyact').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.ultimatecopyact_kode){
                        $('#ultimatecopyact_kode').addClass('is-invalid');
                        $('.errorultimatecopyactKode').html(response.error.ultimatecopyact_kode);
                    }
                    else
                    {
                        $('#ultimatecopyact_kode').removeClass('is-invalid');
                        $('.errorultimatecopyactKode').html('');
                    }
                }
                else
                {
                    $('#modaltambahultimatecopyact').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
						$("#ultimatecopyact_deskripsi").summernote("code", "");
                        $('#datatable-ultimatecopyact').DataTable().ajax.reload();
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
});



// Fungsi tampil data di modal edit
function editultimatecopyact($kode) {
    var url = "/ultimate/Copyactcontroller/pilihdata";

    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#ultimatecopyact_kodeedit').val(response.success.kode);
            $('#ultimatecopyact_jenisedit').val(response.success.alias);
            $("#ultimatecopyact_deskripsiedit").summernote('code', response.success.content);

            $('#modaleditultimatecopyact').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}


// Fungsi proses kirim data di modal edit
$(document).ready(function() {
    $('.formModaleditultimatecopyact').submit(function(e) {
        e.preventDefault();

        let data = new FormData(this);

        $('.ultimatecopyact_isactiveedit').each(function() {
            if ($(this).is(":checked"))
            {
                data.append('ultimatecopyact_isactiveedit', 1);
            }
            else
            {
                data.append('ultimatecopyact_isactiveedit', 0);
            }
        });

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            data: data,
            dataType: "json",
            beforeSend: function() {
                $('.modaleditultimatecopyact').prop('disabled', true);
                $('.modaleditultimatecopyact').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.modaleditultimatecopyact').prop('disabled', false);
                $('.modaleditultimatecopyact').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.ultimatecopyact_kode){
                        $('#ultimatecopyact_kodeedit').addClass('is-invalid');
                        $('.errorultimatecopyactKodeedit').html(response.error.ultimatecopyact_kodeedit);
                    }
                    else
                    {
                        $('#ultimatecopyact_kodeedit').removeClass('is-invalid');
                        $('.errorultimatecopyactKodeedit').html('');
                    }
                }
                else
                {
                    $('#modaleditultimatecopyact').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
						$("#ultimatecopyact_deskripsiedit").summernote("code", "");
                        $('#datatable-ultimatecopyact').DataTable().ajax.reload();
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
});
 


//Fungsi modal delete data
function deleteultimatecopyact($kode) {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: 'Data akan terhapus permanen dari sistem',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
    }).then(function(result) {
        if (result.value)
        {
            var url =  '/ultimate/Copyactcontroller/hapusdata';

            $.ajax({
                type: "post",
                url: BASE_URL + url,
                data: {
                    kode: $kode,
                },
                dataType: "json",
                success: function(response) {
                    if (response.success){
                        Swal.fire(
                            'Pemberitahuan',
                            response.success.data,
                            'success',
                        ).then(function() {
                            $('#datatable-ultimatecopyact').DataTable().ajax.reload();
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
        else if (result.dismiss == 'batal')
        {
            swal.dismiss();
        }
    });
}
