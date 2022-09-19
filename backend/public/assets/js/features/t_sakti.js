//Datatables server side
$(document).ready( function () {
    var url = '/features/tsakticontroller/ajax_list';
    var table = $('#datatable-featurestsakti').DataTable({ 
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

//Fungsi generate kode
function generatekodefeaturestsakti() {
    var url = "/features/tsakticontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#featurestsakti_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahfeaturestsakti').submit(function(e) {
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
            beforeSend: function() {
                $('.btnmodaltambahfeaturestsakti').prop('disabled', true);
                $('.btnmodaltambahfeaturestsakti').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahfeaturestsakti').prop('disabled', false);
                $('.btnmodaltambahfeaturestsakti').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.featurestsakti_kode){
                        $('#featurestsakti_kode').addClass('is-invalid');
                        $('.errorFeaturestsaktiKode').html(response.error.featurestsakti_kode);
                    }
                    else
                    {
                        $('#featurestsakti_kode').removeClass('is-invalid');
                        $('.errorFeaturestsaktiKode').html('');
                    }

                    if (response.error.featurestsakti_nama){
                        $('#featurestsakti_nama').addClass('is-invalid');
                        $('.errorFeaturesjenistsaktiNama').html(response.error.featurestsakti_nama);
                    }
                    else
                    {
                        $('#featurestsakti_nama').removeClass('is-invalid');
                        $('.errorFeaturesjenistsaktiNama').html('');
                    }

                    if (response.error.featurestsakti_files){
                        $('#featurestsakti_files').addClass('is-invalid');
                        $('.errorFeaturestsaktiFiles').html(response.error.featurestsakti_files);
                    }
                    else
                    {
                        $('#featurestsakti_files').removeClass('is-invalid');
                        $('.errorFeaturestsaktiFiles').html('');
                    }
                }
                else
                {
                    $('#modaltambahfeaturestsakti').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#featurestsakti_nama').val('');
						$('#featurestsakti_files').val('');
						
                        $('#datatable-featurestsakti').DataTable().ajax.reload();
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
});

//Fungsi select data 
function editfeaturestsakti($kode) {
    var url = "/features/tsakticontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#featurestsakti_kodeubah').val(response.success.kode);
            $('#featurestsakti_jenisubah').val(response.success.jenis);
            $('#featurestsakti_namaubah').val(response.success.judul);
			$('#featurestsakti_tanggalubah').val(response.success.tanggal);

            $('#featurestsakti_namaubah').removeClass('is-invalid');
            $('.errorFeaturesjenistsaktiNamaubah').html('');

            $('#modalubahfeaturestsakti').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi select file 
function changefilefeaturestsakti($kode) {
    var url = "/features/tsakticontroller/pilihfile";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#featurestsakti_kodeubahfile').val(response.success.kode);

            $('#modalubahfilesfeaturestsakti').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

// Handle Modal ubah
$(document).ready(function() {
    $('.formModalubahfeaturestsakti').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahfeaturestsakti').prop('disabled', true);
                $('.btnmodalubahfeaturestsakti').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahfeaturestsakti').prop('disabled', false);
                $('.btnmodalubahfeaturestsakti').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.featurestsakti_namaubah){
                        $('#featurestsakti_namaubah').addClass('is-invalid');
                        $('.errorFeaturesjenistsaktiNamaubah').html(response.error.featurestsakti_namaubah);
                    }
                    else
                    {
                        $('#featurestsakti_namaubah').removeClass('is-invalid');
                        $('.errorFeaturesjenistsaktiNamaubah').html('');
                    }
                }
                else
                {
                    $('#modalubahfeaturestsakti').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-featurestsakti').DataTable().ajax.reload();
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });

        return false;
    });
});

// Handle Modal file
$(document).ready(function() {
    $('.formModalubahfilesfeaturestsakti').submit(function(e) {
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
            beforeSend: function() {
                $('.btnmodalubahfilesfeaturestsakti').prop('disabled', true);
                $('.btnmodalubahfilesfeaturestsakti').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahfilesfeaturestsakti').prop('disabled', false);
                $('.btnmodalubahfilesfeaturestsakti').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.featurestsakti_filesubahfile){
                        $('#featurestsakti_filesubahfile').addClass('is-invalid');
                        $('.errorFeaturestsaktiFilesubah').html(response.error.featurestsakti_filesubahfile);
                    }
                    else
                    {
                        $('#featurestsakti_filesubahfile').removeClass('is-invalid');
                        $('.errorFeaturestsaktiFilesubah').html('');
                    }
                }
                else
                {
                    $('#modalubahfilesfeaturestsakti').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-featurestsakti').DataTable().ajax.reload();
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });

        return false;
    });
});

// Handle Modal hapus
function deletefeaturestsakti($kode) {
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
            var url =  '/features/tsakticontroller/hapusdata';

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
                            $('#datatable-featurestsakti').DataTable().ajax.reload();
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