//Datatables server side
$(document).ready( function () {
    // var url = '/information/bursaemitencontroller/ajax_list';
    // var table = $('#datatable-infobursaemiten').DataTable({ 
    //   "processing": true,
    //   "serverSide": true,
    //   "order": [],
    //   "ajax": {
    //       "url": BASE_URL + url,
    //       "type": "POST"
    //   },
    //   //optional
    //   "lengthMenu": [10, 25, 50, 100, 250, 500],
    //   "columnDefs": [
    //     { 
    //         "targets": [],
    //         "orderable": false,
    //     },
    //   ],
    //   "language": {
    //     "paginate": 
    //     {
    //         "previous": "<i class='fas fa-angle-left'>",
    //         "next": "<i class='fas fa-angle-right'>"
    //     }
    // }
    // });
    $('#datatable-infobursaemiten').DataTable({
        "language": {
            "paginate": 
            {
                "previous": "<i class='fas fa-angle-left'>",
                "next": "<i class='fas fa-angle-right'>"
            }
        }
    });
});

//Fungsi generate kode
function generatekodeinfobursaemiten() {
    var url = "/information/bursaemitencontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function (response) {
            $('#infobursaemiten_kode').val(response.kodegen);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

// Fungsi tampil input summernote di modal add
$('#infobursaemiten_isi').summernote({
    placeholder: 'Masukkan konten disini ...',
    height: 200,
	callbacks: {
        onImageUpload: function(image) {
            uploadImageinfobursaemiten(image[0]);
        },
        onMediaDelete : function(target) {
            deleteImageinfobursaemiten(target[0].src);
        }
    }
});


// Fungsi upload gambar di summernote add
function uploadImageinfobursaemiten(image) {
    var data = new FormData();
    var url = "/information/bursaemitencontroller/uploadGambar";
    data.append("image", image);
    $.ajax({
        url: BASE_URL + url,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            $('#infobursaemiten_isi').summernote("insertImage", url, data);
        },
        error: function(data) {
            console.log(data);
        }
   });
 }


// Fungsi hapus gambar di summernote add
function deleteImageinfobursaemiten(src) {
    var url = "/information/bursaemitencontroller/deleteGambar";
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
$('#infobursaemiten_isiubah').summernote({
    placeholder: 'Masukkan konten disini ...',
    height: 200,
	callbacks: {
       onImageUpload: function(image) {
		   editor = $(this);
           uploadImageinfobursaemitenedit(image[0], editor);
       },
       onMediaDelete : function(target) {
        deleteImageinfobursaemitenedit(target[0].src);
       }
    }
  });


// Fungsi upload gambar di summernote edit
function uploadImageinfobursaemitenedit(image) {
    var data = new FormData();
    var url = "/information/bursaemitencontroller/uploadGambar";
    data.append("image", image);
    $.ajax({
        url: BASE_URL + url,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            $('#infobursaemiten_isiubah').summernote("insertImage", url, data);
        },
        error: function(data) {
            console.log(data);
        }
   });
 }


// Fungsi hapus gambar di summernote edit
function deleteImageinfobursaemitenedit(src) {
    var url = "/information/bursaemitencontroller/deleteGambar";
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

//Fungsi modal add data
$(document).ready(function () {
    // $("#chooseKategoriPengumuman").hide();
    $('#infobursaemiten_jenispengumuman').on('change', function () {
        var url = "/information/bursaemitencontroller/filterJenis";
        var kode = $('#infobursaemiten_jenispengumuman :selected').val();

        $.ajax({
            type: "POST",
            url: BASE_URL + url,
            data: {
                kode: kode,
            },
            success: function (data) {
                $("#infobursaemiten_kategoripengumuman").empty();
                $.each(JSON.parse(data.trim()), function (index, item) {
                    //console.log("Agent Id: " + item.kode_kategori_pengumuman);
                    //console.log("Agent Name: " + item.nama_kategori_pengumuman);
                    var id = item.kode_kategori_pengumuman;
                    var name = item.nama_kategori_pengumuman;
                    $("#infobursaemiten_kategoripengumuman").append("<option value='" + id + "'>" + name + "</option>");
                });
                //  $("#chooseKategoriPengumuman").show();
            },
        });
    });

    $('.formModaltambahinfobursaemiten').submit(function (e) {
        e.preventDefault();

        let data = new FormData(this);
        // data.append('infobursaemiten_isi', CKEDITOR.instances.infobursaemiten_isi.getData());

        $('.infobursaemiten_isactive').each(function() {
            if ($(this).is(":checked"))
            {
                data.append('infobursaemiten_isactive', 1);
            }
            else
            {
                data.append('infobursaemiten_isactive', 0);
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
                $('.btnmodaltambahinfobursaemiten').prop('disabled', true);
                $('.btnmodaltambahinfobursaemiten').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function () {
                $('.btnmodaltambahinfobursaemiten').prop('disabled', false);
                $('.btnmodaltambahinfobursaemiten').html('Simpan');
            },
            success: function (response) {
                if (response.error) {
                    if (response.error.infobursaemiten_kode) {
                        $('#infobursaemiten_kode').addClass('is-invalid');
                        $('.errorinfobursaemitenKode').html(response.error.infobursaemiten_kode);
                    } else {
                        $('#infobursaemiten_kode').removeClass('is-invalid');
                        $('.errorinfobursaemitenKode').html('');
                    }

                    if (response.error.infobursaemiten_judul) {
                        $('#infobursaemiten_judul').addClass('is-invalid');
                        $('.errorinfobursaemitenJudul').html(response.error.infobursaemiten_judul);
                    } else {
                        $('#infobursaemiten_judul').removeClass('is-invalid');
                        $('.errorinfobursaemitenJudul').html('');
                    }

                    // if (response.error.infobursaemiten_berkas) {
                    //     $('#infobursaemiten_berkas').addClass('is-invalid');
                    //     $('.errorinfobursaemitenBerkas').html(response.error.infobursaemiten_berkas);
                    // } else {
                    //     $('#infobursaemiten_berkas').removeClass('is-invalid');
                    //     $('.errorinfobursaemitenBerkas').html('');
                    // }
                } else {
                    $('#modaltambahinfobursaemiten').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function () {
                        window.location = response.success.link;
                        // refreshTable();
                        $('#infobursaemiten_judul').val('');
                        location.reload();
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
function editinfobursaemiten($kode) {
    var url = "/information/bursaemitencontroller/pilihdata";

    // if ($('#infobursaemiten_isactiveubah').val() == 0) {
    //     $('#infobursaemiten_isactiveubah').prop('checked', true);
    // } else {
    //     $('#infobursaemiten_isactiveubah').prop('checked', false);
    // }
    
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function (response) {
            $('#infobursaemiten_kodeubah').val(response.success.kode);
            $('#infobursaemiten_kategoripengumumanubah').val(response.success.kode_kategori);
            $('#infobursaemiten_statuspengumumanubah').val(response.success.status);
            $('#infobursaemiten_jenispengumumanubah').val(response.success.kode_pengumuman);
            $('#infobursaemiten_judulubah').val(response.success.judul);
            $("#infobursaemiten_isiubah").summernote('code', response.success.isi);
            $('#infobursaemiten_isactiveubah').val(response.success.active);  
            $('#infobursaemiten_statusnotifubah').val(response.success.status_notif);

            let nilaiAktif =  $('#infobursaemiten_isactiveubah').val(); 

            if ((nilaiAktif) == 0) {
                $('#infobursaemiten_isactiveubah').prop('checked', false);
            } else if ((nilaiAktif) == 1) {
                $('#infobursaemiten_isactiveubah').prop('checked', true);
            } else {
                $('#infobursaemiten_isactiveubah').prop('checked', false);
            }
    
            // CKEDITOR.instances.infobursaemiten_isiubah.setData(response.success.isi);

            $('#infobursaemiten_judulubah').removeClass('is-invalid');
            $('.errorinfobursaemitenJudulubah').html('');

            $('#modalubahinfobursaemiten').modal('show');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });

    $('#infobursaemiten_jenispengumumanubah').on('change', function () {
        var url = "/information/bursaemitencontroller/filterJenis";
        var kode = $('#infobursaemiten_jenispengumumanubah :selected').val();

        $.ajax({
            type: "POST",
            url: BASE_URL + url,
            data: {
                kode: kode,
            },
            success: function (data) {
                $("#infobursaemiten_kategoripengumumanubah").empty();
                $.each(JSON.parse(data.trim()), function (index, item) {
                    //console.log("Agent Id: " + item.kode_kategori_pengumuman);
                    //console.log("Agent Name: " + item.nama_kategori_pengumuman);
                    var id = item.kode_kategori_pengumuman;
                    var name = item.nama_kategori_pengumuman;
                    $("#infobursaemiten_kategoripengumumanubah").append("<option value='" + id + "'>" + name + "</option>");
                });
                //  $("#chooseKategoriPengumuman").show();
            },
        });
    });
}

//Fungsi modal update data
$(document).ready(function () {
    $('.formModalubahinfobursaemiten').submit(function (e) {
        e.preventDefault();

        let data = new FormData(this);
        // data.append('infobursaemiten_isiubah', CKEDITOR.instances.infobursaemiten_isiubah.getData());

        $('.infobursaemiten_isactiveubah').each(function() {
            if ($(this).is(":checked"))
            {
                data.append('infobursaemiten_isactiveubah', 1);
            }
            else
            {
                data.append('infobursaemiten_isactiveubah', 0);
            }
        });

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            //data: $(this).serialize(),
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            data: data,
            dataType: "json",
            beforeSend: function () {
                $('.btnmodalubahinfobursaemiten').prop('disabled', true);
                $('.btnmodalubahinfobursaemiten').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function () {
                $('.btnmodalubahinfobursaemiten').prop('disabled', false);
                $('.btnmodalubahinfobursaemiten').html('Ubah');
            },
            success: function (response) {
                if (response.error) {
                    if (response.error.infobursaemiten_judulubah) {
                        $('#infobursaemiten_judulubah').addClass('is-invalid');
                        $('.errorinfobursaemitenJudulubah').html(response.error.infobursaemiten_judulubah);
                    } else {
                        $('#infobursaemiten_judulubah').removeClass('is-invalid');
                        $('.errorinfobursaemitenJudulubah').html('');
                    }

                    // if (response.error.infobursaemiten_gambarubah){
                    //     $('#infobursaemiten_gambarubah').addClass('is-invalid');
                    //     $('.errorinfobursaemitenGambarubah').html(response.error.infobursaemiten_gambarubah);
                    // }
                    // else
                    // {
                    //     $('#infobursaemiten_gambarubah').removeClass('is-invalid');
                    //     $('.errorinfobursaemitenGambarubah').html('');
                    // }
                } else {
                    $('#modalubahinfobursaemiten').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function () {
                        location.reload();
                        // $("#infobursaemiten_isiubah").summernote("code", "");
                        // $('#datatable-infobursaemiten').DataTable().ajax.reload();
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

//Fungsi select image
function changeimginfobursaemiten($kode) {
    var url = "/information/bursaemitencontroller/pilihgambar";
    var location = "/public/assets/img/bursaemiten/";
    //var location = "/writable/uploads/";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function (response) {
            var imgloc = BASE_URL + location + response.success.gambar;
            $('#infobursaemiten_editkodeubah').val(response.success.kode);
            $('#infobursaemiten_editimg').attr("src", imgloc);

            $('#infobursaemiten_editgambarubah').removeClass('is-invalid');
            $('.errorinfobursaemiteneditGambarubah').html('');

            $('#modalubahgambarinfobursaemiten').modal('show');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update gambar
$(document).ready(function () {
    $('.formModalubahgambarinfobursaemiten').submit(function (e) {
        e.preventDefault();

        var data = new FormData(this);

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
                $('.btnmodalubahgambarinfobursaemiten').prop('disabled', true);
                $('.btnmodalubahgambarinfobursaemiten').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function () {
                $('.btnmodalubahgambarinfobursaemiten').prop('disabled', false);
                $('.btnmodalubahgambarinfobursaemiten').html('Ubah');
            },
            success: function (response) {
                if (response.error) {
                    if (response.error.infobursaemiten_editgambarubah) {
                        $('#infobursaemiten_editgambarubah').addClass('is-invalid');
                        $('.errorinfobursaemiteneditGambarubah').html(response.error.infobursaemiten_editgambarubah);
                    } else {
                        $('#infobursaemiten_editgambarubah').removeClass('is-invalid');
                        $('.errorinfobursaemiteneditGambarubah').html('');
                    }
                } else {
                    $('#modalubahgambarinfobursaemiten').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function () {
                        window.location = response.success.link;
                        //$('#datatable-infobursaemiten').DataTable().ajax.reload();
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

//Fungsi select pdf
function changepdfinfobursaemiten($kode) {
    var url = "/information/bursaemitencontroller/pilihpdf";
    var location = "/public/assets/img/bursaemiten/";
    //var location = "/writable/uploads/";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function (response) {
            var pdfloc = BASE_URL + location + response.success.berkas;
            $('#infobursaemiten_editkodeubahpdf').val(response.success.kode);
            $('#infobursaemiten_editpdf').attr("href", pdfloc);

            $('#infobursaemiten_editpdfubah').removeClass('is-invalid');
            $('.errorinfobursaemiteneditPdfubah').html('');

            $('#modalubahpdfinfobursaemiten').modal('show');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update pdf
$(document).ready(function () {
    $('.formModalubahpdfinfobursaemiten').submit(function (e) {
        e.preventDefault();

        var data = new FormData(this);

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
                $('.btnmodalubahpdfinfobursaemiten').prop('disabled', true);
                $('.btnmodalubahpdfinfobursaemiten').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function () {
                $('.btnmodalubahpdfinfobursaemiten').prop('disabled', false);
                $('.btnmodalubahpdfinfobursaemiten').html('Ubah');
            },
            success: function (response) {
                if (response.error) {
                    if (response.error.infobursaemiten_editpdfubah) {
                        $('#infobursaemiten_editpdfubah').addClass('is-invalid');
                        $('.errorinfobursaemiteneditPdfubah').html(response.error.infobursaemiten_editpdfubah);
                    } else {
                        $('#infobursaemiten_editpdfubah').removeClass('is-invalid');
                        $('.errorinfobursaemiteneditPdfubah').html('');
                    }
                } else {
                    $('#modalubahpdfinfobursaemiten').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function () {
                        window.location = response.success.link;
                        //$('#datatable-infobursaemiten').DataTable().ajax.reload();
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
function deleteinfobursaemiten($kode) {
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
            var url = '/information/bursaemitencontroller/hapusdata';

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
                            location.reload();
                            // $('#datatable-infobursaemiten').DataTable().ajax.reload();
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