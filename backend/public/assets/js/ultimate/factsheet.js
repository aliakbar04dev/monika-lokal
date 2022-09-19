//Datatables server side
$(document).ready( function () {
    var url = '/ultimate/factsheetcontroller/ajax_list';
    var table = $('#datatable-ultimatefactsheet').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [],
      drawCallback: function (settings, json) {
        $('[data-toggle="tooltip"]').tooltip('update');
      },
      "ajax": {
          "url": BASE_URL + url,
          "type": "POST"
      },
      //optional
      "lengthMenu": [10, 25, 50, 100, 250, 500],
      "columnDefs": [
        { 
            "widht": '100',
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

//Fungsi generate kode
function generatekodeultimatefactsheet() {
    var url = "/ultimate/factsheetcontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function (response) {
            $('#ultimatefactsheet_kode').val(response.kodegen);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}


//Fungsi modal add data
$(document).ready(function () {
    $('.formModaltambahultimatefactsheet').submit(function (e) {
        e.preventDefault();

        let data = new FormData(this);
        // data.append('ultimatefactsheet_isi', CKEDITOR.instances.ultimatefactsheet_isi.getData());

        $('.ultimatefactsheet_isactive').each(function() {
            if ($(this).is(":checked"))
            {
                data.append('ultimatefactsheet_isactive', 1);
            }
            else
            {
                data.append('ultimatefactsheet_isactive', 0);
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
                $('.btnmodaltambahultimatefactsheet').prop('disabled', true);
                $('.btnmodaltambahultimatefactsheet').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function () {
                $('.btnmodaltambahultimatefactsheet').prop('disabled', false);
                $('.btnmodaltambahultimatefactsheet').html('Simpan');
            },
            success: function (response) {
                if (response.error) {
                    if (response.error.ultimatefactsheet_kode) {
                        $('#ultimatefactsheet_kode').addClass('is-invalid');
                        $('.errorultimatefactsheetKode').html(response.error.ultimatefactsheet_kode);
                    } else {
                        $('#ultimatefactsheet_kode').removeClass('is-invalid');
                        $('.errorultimatefactsheetKode').html('');
                    }

                    if (response.error.ultimatefactsheet_bulan) {
                        $('#ultimatefactsheet_bulan').addClass('is-invalid');
                        $('.errorultimatefactsheetBulan').html(response.error.ultimatefactsheet_bulan);
                    } else {
                        $('#ultimatefactsheet_bulan').removeClass('is-invalid');
                        $('.errorultimatefactsheetBulan').html('');
                    }

                    if (response.error.ultimatefactsheet_tahun) {
                        $('#ultimatefactsheet_tahun').addClass('is-invalid');
                        $('.errorultimatefactsheetTahun').html(response.error.ultimatefactsheet_tahun);
                    } else {
                        $('#ultimatefactsheet_tahun').removeClass('is-invalid');
                        $('.errorultimatefactsheetTahun').html('');
                    }
                } else {
                    $('#modaltambahultimatefactsheet').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function () {
                        window.location = response.success.link;
                        // refreshTable();
                        $('#datatable-ultimatefactsheet').DataTable().ajax.reload();
                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
});

//Fungsi select pdf
function changepdfultimatefactsheet($kode) {
    var url = "/ultimate/factsheetcontroller/pilihpdf";
    var location = "/public/assets/img/factsheet/";
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
            $('#ultimatefactsheet_editkodeubahpdf').val(response.success.kode);
            $('#ultimatefactsheet_show').attr("href", pdfloc);

            $('#ultimatefactsheet_berkasubah').removeClass('is-invalid');
            $('.errorultimatefactsheetBerkasubah').html('');

            $('#modalubahpdfultimatefactsheet').modal('show');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi select data 
function editultimatefactsheet($kode) {
    var url = "/ultimate/factsheetcontroller/pilihdata";
    
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function (response) {
            $('#ultimatefactsheet_kodeubah').val(response.success.kode);
            $('#ultimatefactsheet_bulanubah').val(response.success.bulan);
            $('#ultimatefactsheet_tahunubah').val(response.success.tahun);
            $('#ultimatefactsheet_isactiveubah').val(response.success.active);  

            let nilaiAktif =  $('#ultimatefactsheet_isactiveubah').val(); 

            if ((nilaiAktif) == 0) {
                $('#ultimatefactsheet_isactiveubah').prop('checked', false);
            } else if ((nilaiAktif) == 1) {
                $('#ultimatefactsheet_isactiveubah').prop('checked', true);
            } else {
                $('#ultimatefactsheet_isactiveubah').prop('checked', false);
            }
    
            // CKEDITOR.instances.ultimatefactsheet_isiubah.setData(response.success.isi);

            $('#modaleditultimatefactsheet').modal('show');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function () {
    $('.formModaleditultimatefactsheet').submit(function (e) {
        e.preventDefault();

        let data = new FormData(this);
        // data.append('ultimatefactsheet_isiubah', CKEDITOR.instances.ultimatefactsheet_isiubah.getData());

        $('.ultimatefactsheet_isactiveubah').each(function() {
            if ($(this).is(":checked"))
            {
                data.append('ultimatefactsheet_isactiveubah', 1);
            }
            else
            {
                data.append('ultimatefactsheet_isactiveubah', 0);
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
                $('.btnmodaleditultimatefactsheet').prop('disabled', true);
                $('.btnmodaleditultimatefactsheet').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function () {
                $('.btnmodaleditultimatefactsheet').prop('disabled', false);
                $('.btnmodaleditultimatefactsheet').html('Ubah');
            },
            success: function (response) {
                if (response.error) {
                    if (response.error.ultimatefactsheet_kodeubah) {
                        $('#ultimatefactsheet_kodeubah').addClass('is-invalid');
                        $('.errorultimatefactsheetKodeubah').html(response.error.ultimatefactsheet_kodeubah);
                    } else {
                        $('#ultimatefactsheet_kodeubah').removeClass('is-invalid');
                        $('.errorultimatefactsheetKodeubah').html('');
                    }

                    if (response.error.ultimatefactsheet_bulanubah){
                        $('#ultimatefactsheet_bulanubah').addClass('is-invalid');
                        $('.errorultimatefactsheetBulanubah').html(response.error.ultimatefactsheet_bulanubah);
                    }
                    else
                    {
                        $('#ultimatefactsheet_bulanubah').removeClass('is-invalid');
                        $('.errorultimatefactsheetBulanubah').html('');
                    }

                    if (response.error.ultimatefactsheet_tahunubah){
                        $('#ultimatefactsheet_tahunubah').addClass('is-invalid');
                        $('.errorultimatefactsheetTahunubah').html(response.error.ultimatefactsheet_tahunubah);
                    }
                    else
                    {
                        $('#ultimatefactsheet_tahunubah').removeClass('is-invalid');
                        $('.errorultimatefactsheetTahunubah').html('');
                    }
                } else {
                    $('#modaleditultimatefactsheet').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function () {
                        window.location = response.success.link;
                        $('#datatable-ultimatefactsheet').DataTable().ajax.reload();
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
function changeimgultimatefactsheet($kode) {
    var url = "/ultimate/factsheetcontroller/pilihgambar";
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
            $('#ultimatefactsheet_editkodeubah').val(response.success.kode);
            $('#ultimatefactsheet_editimg').attr("src", imgloc);

            $('#ultimatefactsheet_editgambarubah').removeClass('is-invalid');
            $('.errorultimatefactsheeteditGambarubah').html('');

            $('#modalubahgambarultimatefactsheet').modal('show');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update gambar
$(document).ready(function () {
    $('.formModalubahgambarultimatefactsheet').submit(function (e) {
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
                $('.btnmodalubahgambarultimatefactsheet').prop('disabled', true);
                $('.btnmodalubahgambarultimatefactsheet').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function () {
                $('.btnmodalubahgambarultimatefactsheet').prop('disabled', false);
                $('.btnmodalubahgambarultimatefactsheet').html('Ubah');
            },
            success: function (response) {
                if (response.error) {
                    if (response.error.ultimatefactsheet_editgambarubah) {
                        $('#ultimatefactsheet_editgambarubah').addClass('is-invalid');
                        $('.errorultimatefactsheeteditGambarubah').html(response.error.ultimatefactsheet_editgambarubah);
                    } else {
                        $('#ultimatefactsheet_editgambarubah').removeClass('is-invalid');
                        $('.errorultimatefactsheeteditGambarubah').html('');
                    }
                } else {
                    $('#modalubahgambarultimatefactsheet').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function () {
                        window.location = response.success.link;
                        //$('#datatable-ultimatefactsheet').DataTable().ajax.reload();
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
function changepdfultimatefactsheet($kode) {
    var url = "/ultimate/factsheetcontroller/pilihpdf";
    var location = "/public/assets/img/factsheet/";
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
            $('#ultimatefactsheet_editkodeubahpdf').val(response.success.kode);
            $('#ultimatefactsheet_show').attr("href", pdfloc);

            $('#ultimatefactsheet_berkasubah').removeClass('is-invalid');
            $('.errorultimatefactsheetBerkasubah').html('');

            $('#modalubahpdfultimatefactsheet').modal('show');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update pdf
$(document).ready(function () {
    $('.formModalubahpdfultimatefactsheet').submit(function (e) {
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
                $('.btnmodalubahpdfultimatefactsheet').prop('disabled', true);
                $('.btnmodalubahpdfultimatefactsheet').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function () {
                $('.btnmodalubahpdfultimatefactsheet').prop('disabled', false);
                $('.btnmodalubahpdfultimatefactsheet').html('Ubah');
            },
            success: function (response) {
                if (response.error) {
                    if (response.error.ultimatefactsheet_editpdfubah) {
                        $('#ultimatefactsheet_berkasubah').addClass('is-invalid');
                        $('.errorultimatefactsheetBerkasubah').html(response.error.ultimatefactsheet_berkasubah);
                    } else {
                        $('#ultimatefactsheet_berkasubah').removeClass('is-invalid');
                        $('.errorultimatefactsheetBerkasubah').html('');
                    }
                } else {
                    $('#modalubahpdfultimatefactsheet').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function () {
                        window.location = response.success.link;
                        //$('#datatable-ultimatefactsheet').DataTable().ajax.reload();
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
function deleteultimatefactsheet($kode) {
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
            var url = '/ultimate/factsheetcontroller/hapusdata';

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
                            // window.location = response.success.link;
                            $('#datatable-ultimatefactsheet').DataTable().ajax.reload();
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