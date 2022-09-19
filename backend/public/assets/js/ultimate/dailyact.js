//Datatables server side
$(document).ready(function () {
    var url = '/ultimate/Dailyactcontroller/ajax_list';
    var table = $('#datatable-ultimatedailyact').DataTable({
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


$('#ultimatedailyact_deskripsi').summernote({
    placeholder: 'Masukkan konten disini ...',
    height: 200,
    callbacks: {
        onImageUpload: function (image) {
            uploadImagedailyact(image[0]);
        },
        onMediaDelete: function (target) {
            deleteImagedailyact(target[0].src);
        }
    }
});


// Fungsi upload gambar di summernote add
function uploadImagedailyact(image) {
    var data = new FormData();
    var url = "/ultimate/Dailyactcontroller/uploadGambar";
    data.append("image", image);
    $.ajax({
        url: BASE_URL + url,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            $('#ultimatedailyact_deskripsi').summernote("insertImage", url, data);
        },
        error: function(data) {
            console.log(data);
        }
   });
 }


// Fungsi hapus gambar di summernote add
function deleteImagedailyact(src) {
    var url = "/ultimate/Dailyactcontroller/deleteGambar";
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
$('#ultimatedailyact_deskripsiubah').summernote({
    placeholder: 'Masukkan konten disini ...',
    height: 200,
	callbacks: {
       onImageUpload: function(image) {
		   editor = $(this);
           uploadImagedailyactedit(image[0], editor);
       },
       onMediaDelete : function(target) {
        deleteImagedailyactedit(target[0].src);
       }
    }
  });


// Fungsi upload gambar di summernote edit
function uploadImagedailyactedit(image) {
    var data = new FormData();
    var url = "/ultimate/Dailyactcontroller/uploadGambar";
    data.append("image", image);
    $.ajax({
        url: BASE_URL + url,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            $('#ultimatedailyact_deskripsiubah').summernote("insertImage", url, data);
        },
        error: function(data) {
            console.log(data);
        }
   });
 }


// Fungsi hapus gambar di summernote edit
function deleteImagedailyactedit(src) {
    var url = "/ultimate/Dailyactcontroller/deleteGambar";
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
function generatekodeultimatedailyact() {
    var url = "/ultimate/Dailyactcontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function (response) {
            $('#ultimatedailyact_kode').val(response.kodegen);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function () {
    $('.formModaltambahultimatedailyact').submit(function (e) {
        e.preventDefault();

        let data = new FormData(this);

        $('.ultimatedailyact_isactive').each(function () {
            if ($(this).is(":checked")) {
                data.append('ultimatedailyact_isactive', 1);
            } else {
                data.append('ultimatedailyact_isactive', 0);
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
                $('.btnmodaltambahultimatedailyact').prop('disabled', true);
                $('.btnmodaltambahultimatedailyact').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function () {
                $('.btnmodaltambahultimatedailyact').prop('disabled', false);
                $('.btnmodaltambahultimatedailyact').html('Simpan');
            },
            success: function (response) {
                if (response.error) {
                    if (response.error.ultimatedailyact_kode) {
                        $('#ultimatedailyact_kode').addClass('is-invalid');
                        $('.errorultimatedailyactKode').html(response.error.ultimatedailyact_kode);
                    } else {
                        $('#ultimatedailyact_kode').removeClass('is-invalid');
                        $('.errorultimatedailyactKode').html('');
                    }
                } else {
                    $('#modaltambahultimatedailyact').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function () {
                        $("#ultimatedailyact_deskripsi").summernote("code", "");
                        $('#datatable-ultimatedailyact').DataTable().ajax.reload();
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
function editultimatedailyact($kode) {
    var url = "/ultimate/Dailyactcontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function (response) {
            $('#ultimatedailyact_kodeubah').val(response.success.kode);
            $("#ultimatedailyact_deskripsiubah").summernote('code', response.success.content);

            $('#modalubahultimatedailyact').modal('show');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function () {
    $('.formModalubahultimatedailyact').submit(function (e) {
        e.preventDefault();

        let data = new FormData(this);

        $('.ultimatedailyact_isactiveubah').each(function () {
            if ($(this).is(":checked")) {
                data.append('ultimatedailyact_isactiveubah', 1);
            } else {
                data.append('ultimatedailyact_isactiveubah', 0);
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
                $('.btnmodalubahultimatedailyact').prop('disabled', true);
                $('.btnmodalubahultimatedailyact').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function () {
                $('.btnmodalubahultimatedailyact').prop('disabled', false);
                $('.btnmodalubahultimatedailyact').html('Ubah');
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
                    $('#modalubahultimatedailyact').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function () {
						$("#ultimatedailyact_deskripsiubah").summernote("code", "");
                        $('#datatable-ultimatedailyact').DataTable().ajax.reload();
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
function deleteultimatedailyact($kode) {
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
            var url = '/ultimate/Dailyactcontroller/hapusdata';

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
                            $('#datatable-ultimatedailyact').DataTable().ajax.reload();
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