//Datatables server side
$(document).ready( function () {
    var url = '/ultimate/Trailingactcontroller/ajax_list';
    var table = $('#datatable-ultimatetrailact').DataTable({ 
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
function generatekodeultimatetrailact() {
    var url = "/ultimate/Trailingactcontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#ultimatetrailingact_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}


// Fungsi tampil input summernote di modal add
$('#ultimatetrailingact_deskripsi').summernote({
    placeholder: 'Masukkan konten disini ...',
    height: 200,
	callbacks: {
        onImageUpload: function(image) {
            uploadImagetrailact(image[0]);
        },
        onMediaDelete : function(target) {
            deleteImagetrailact(target[0].src);
        }
    }
});


// Fungsi upload gambar di summernote add
function uploadImagetrailact(image) {
    var data = new FormData();
    var url = "/ultimate/Trailingactcontroller/uploadGambar";
    data.append("image", image);
    $.ajax({
        url: BASE_URL + url,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            $('#ultimatetrailingact_deskripsi').summernote("insertImage", url, data);
        },
        error: function(data) {
            console.log(data);
        }
   });
 }


// Fungsi hapus gambar di summernote add
function deleteImagetrailact(src) {
    var url = "/ultimate/Trailingactcontroller/deleteGambar";
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
$('#ultimatetrailingact_deskripsiubah').summernote({
    placeholder: 'Masukkan konten disini ...',
    height: 200,
	callbacks: {
       onImageUpload: function(image) {
		   editor = $(this);
           uploadImagetrailactedit(image[0], editor);
       },
       onMediaDelete : function(target) {
        deleteImagetrailactedit(target[0].src);
       }
    }
  });


// Fungsi upload gambar di summernote edit
function uploadImagetrailactedit(image) {
    var data = new FormData();
    var url = "/ultimate/Trailingactcontroller/uploadGambar";
    data.append("image", image);
    $.ajax({
        url: BASE_URL + url,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            $('#ultimatetrailingact_deskripsiubah').summernote("insertImage", url, data);
        },
        error: function(data) {
            console.log(data);
        }
   });
 }


// Fungsi hapus gambar di summernote edit
function deleteImagetrailactedit(src) {
    var url = "/ultimate/Trailingactcontroller/deleteGambar";
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
    $('.formModaltambahultimatetrailingact').submit(function(e) {
        e.preventDefault();

        let data = new FormData(this);

        $('.ultimatetrailingact_isactive').each(function() {
            if ($(this).is(":checked"))
            {
                data.append('ultimatetrailingact_isactive', 1);
            }
            else
            {
                data.append('ultimatetrailingact_isactive', 0);
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
                $('.btnmodaltambahultimatetrailingact').prop('disabled', true);
                $('.btnmodaltambahultimatetrailingact').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahultimatetrailingact').prop('disabled', false);
                $('.btnmodaltambahultimatetrailingact').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.ultimatetrailingact_kode){
                        $('#ultimatetrailingact_kode').addClass('is-invalid');
                        $('.errorultimatetrailingactKode').html(response.error.ultimatetrailingact_kode);
                    }
                    else
                    {
                        $('#ultimatetrailingact_kode').removeClass('is-invalid');
                        $('.errorultimatetrailingactKode').html('');
                    }
                }
                else
                {
                    $('#modaltambahultimatetrailact').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
						$("#ultimatetrailingact_deskripsi").summernote("code", "");
                        $('#datatable-ultimatetrailact').DataTable().ajax.reload();
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
function editultimatetrailact($kode) {
    var url = "/ultimate/Trailingactcontroller/pilihdata";

    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#ultimatetrailingact_kodeubah').val(response.success.kode);
            $('#ultimatetrailingact_jenisubah').val(response.success.alias);
            $("#ultimatetrailingact_deskripsiubah").summernote('code', response.success.content);

            $('#modalubahultimatetrailingact').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}


// Fungsi proses kirim data di modal edit
$(document).ready(function() {
    $('.formModalubahultimatetrailingact').submit(function(e) {
        e.preventDefault();

        let data = new FormData(this);

        $('#ultimatetrailingact_isactiveubah').each(function() {
            if ($(this).is(":checked"))
            {
                data.append('ultimatetrailingact_isactiveubah', 1);
            }
            else
            {
                data.append('ultimatetrailingact_isactiveubah', 0);
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
                $('.btnmodalubahultimatetrailingact').prop('disabled', true);
                $('.btnmodalubahultimatetrailingact').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahultimatetrailingact').prop('disabled', false);
                $('.btnmodalubahultimatetrailingact').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.ultimatetrailingact_kode){
                        $('#ultimatetrailingact_kodeubah').addClass('is-invalid');
                        $('.errorultimatetrailingactKodeubah').html(response.error.ultimatetrailingact_kodeubah);
                    }
                    else
                    {
                        $('#ultimatetrailingact_kodeubah').removeClass('is-invalid');
                        $('.errorultimatetrailingactKodeubah').html('');
                    }
                }
                else
                {
                    $('#modalubahultimatetrailingact').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
						$("#ultimatetrailingact_deskripsiubah").summernote("code", "");
                        $('#datatable-ultimatetrailact').DataTable().ajax.reload();
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
function deleteultimatetrailact($kode) {
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
            var url =  '/ultimate/Trailingactcontroller/hapusdata';

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
                            $('#datatable-ultimatetrailact').DataTable().ajax.reload();
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
