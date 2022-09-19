//Datatables server side
$(document).ready(function () {
    var url = '/ultimate/Dailychartcontroller/ajax_list';
    var table = $('#datatable-ultimatedailychart').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": BASE_URL + url,
            "type": "POST"
        },
        //optional
        "lengthMenu": [10, 25, 50, 100, 250, 500],
        "columnDefs": [{
            "targets": [],
            "orderable": false,
        }, ],
        "language": {
            "paginate": {
                "previous": "<i class='fas fa-angle-left'>",
                "next": "<i class='fas fa-angle-right'>"
            }
        }
    });
});


$('#ultimatedailychart_deskripsi').summernote({
    placeholder: 'Masukkan konten disini ...',
    height: 200,
    callbacks: {
        onImageUpload: function (image) {
            uploadImagedailychart(image[0]);
        },
        onMediaDelete: function (target) {
            deleteImagedailychart(target[0].src);
        }
    }
});


// Fungsi upload gambar di summernote add
function uploadImagedailychart(image) {
    var data = new FormData();
    var url = "/ultimate/dailychartcontroller/uploadGambar";
    data.append("image", image);
    $.ajax({
        url: BASE_URL + url,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            $('#ultimatedailychart_deskripsi').summernote("insertImage", url, data);
        },
        error: function(data) {
            console.log(data);
        }
   });
 }


// Fungsi hapus gambar di summernote add
function deleteImagedailychart(src) {
    var url = "/ultimate/dailychartcontroller/deleteGambar";
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
$('#ultimatedailychart_deskripsiubah').summernote({
    placeholder: 'Masukkan konten disini ...',
    height: 200,
	callbacks: {
       onImageUpload: function(image) {
		   editor = $(this);
           uploadImagedailychartedit(image[0], editor);
       },
       onMediaDelete : function(target) {
        deleteImagedailychartedit(target[0].src);
       }
    }
  });


// Fungsi upload gambar di summernote edit
function uploadImagedailychartedit(image) {
    var data = new FormData();
    var url = "/ultimate/dailychartcontroller/uploadGambar";
    data.append("image", image);
    $.ajax({
        url: BASE_URL + url,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            $('#ultimatedailychart_deskripsiubah').summernote("insertImage", url, data);
        },
        error: function(data) {
            console.log(data);
        }
   });
 }


// Fungsi hapus gambar di summernote edit
function deleteImagedailychartedit(src) {
    var url = "/ultimate/dailychartcontroller/deleteGambar";
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

//Fungsi generate kode
function generatekodeultimatedailychart() {
    var url = "/ultimate/dailychartcontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function (response) {
            $('#ultimatedailychart_kode').val(response.kodegen);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function () {
    $('.formModaltambahultimatedailychart').submit(function (e) {
        e.preventDefault();

        let data = new FormData(this);

        $('.ultimatedailychart_isactive').each(function () {
            if ($(this).is(":checked")) {
                data.append('ultimatedailychart_isactive', 1);
            } else {
                data.append('ultimatedailychart_isactive', 0);
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
            beforeSend: function () {
                $('.btnmodaltambahultimatedailychart').prop('disabled', true);
                $('.btnmodaltambahultimatedailychart').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function () {
                $('.btnmodaltambahultimatedailychart').prop('disabled', false);
                $('.btnmodaltambahultimatedailychart').html('Simpan');
            },
            success: function (response) {
                if (response.error) {
                    if (response.error.ultimatedailychart_kode) {
                        $('#ultimatedailychart_kode').addClass('is-invalid');
                        $('.errorultimatedailychartKode').html(response.error.ultimatedailychart_kode);
                    } else {
                        $('#ultimatedailychart_kode').removeClass('is-invalid');
                        $('.errorultimatedailychartKode').html('');
                    }
                } else {
                    $('#modaltambahultimatedailychart').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function () {
                        $("#ultimatedailychart_deskripsi").summernote("code", "");
                        $('#datatable-ultimatedailychart').DataTable().ajax.reload();
                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
});


//Fungsi select data 
function editultimatedailychart($kode) {
    var url = "/ultimate/dailychartcontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function (response) {
            $('#ultimatedailychart_kodeubah').val(response.success.kode);
            $("#ultimatedailychart_deskripsiubah").summernote('code', response.success.content);

            $('#modalubahultimatedailychart').modal('show');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function () {
    $('.formModalubahultimatedailychart').submit(function (e) {
        e.preventDefault();

        let data = new FormData(this);

        $('.ultimatedailychart_isactiveubah').each(function () {
            if ($(this).is(":checked")) {
                data.append('ultimatedailychart_isactiveubah', 1);
            } else {
                data.append('ultimatedailychart_isactiveubah', 0);
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
            beforeSend: function () {
                $('.btnmodalubahultimatedailychart').prop('disabled', true);
                $('.btnmodalubahultimatedailychart').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function () {
                $('.btnmodalubahultimatedailychart').prop('disabled', false);
                $('.btnmodalubahultimatedailychart').html('Ubah');
            },
            success: function (response) {
                if (response.error) {
                    /* if (response.error.settingbanner_namaubah){
                        $('#settingbanner_namaubah').addClass('is-invalid');
                        $('.errorSettingbannertNamaubah').html(response.error.settingbanner_namaubah);
                    }
                    else
                    {
                        $('#settingbanner_namaubah').removeClass('is-invalid');
                        $('.errorSettingbannertNamaubah').html('');
                    }*/
                } else {
                    $('#modalubahultimatedailychart').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function () {
						$("#ultimatedailychart_deskripsiubah").summernote("code", "");
                        $('#datatable-ultimatedailychart').DataTable().ajax.reload();
                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });

        return false;
    });
});

//Fungsi modal delete data
function deleteultimatedailychart($kode) {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: 'Data akan terhapus permanen dari sistem',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
    }).then(function (result) {
        if (result.value) {
            var url = '/ultimate/dailychartcontroller/hapusdata';

            $.ajax({
                type: "post",
                url: BASE_URL + url,
                data: {
                    kode: $kode,
                },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        Swal.fire(
                            'Pemberitahuan',
                            response.success.data,
                            'success',
                        ).then(function () {
                            $('#datatable-ultimatedailychart').DataTable().ajax.reload();
                        });
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        } else if (result.dismiss == 'batal') {
            swal.dismiss();
        }
    });
}