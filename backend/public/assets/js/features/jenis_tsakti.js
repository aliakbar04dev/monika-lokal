//Datatables server side
$(document).ready( function () {
    var url = '/features/jenistsakticontroller/ajax_list';
    var table = $('#datatable-featuresjenistsakti').DataTable({ 
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
function generatekodefeaturesjenistsakti() {
    var url = "/features/jenistsakticontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#featuresjenistsakti_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahfeaturesjenistsakti').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodaltambahfeaturesjenistsakti').prop('disabled', true);
                $('.btnmodaltambahfeaturesjenistsakti').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahfeaturesjenistsakti').prop('disabled', false);
                $('.btnmodaltambahfeaturesjenistsakti').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.featuresjenistsakti_kode){
                        $('#featuresjenistsakti_kode').addClass('is-invalid');
                        $('.errorFeaturesjenistsaktiKode').html(response.error.featuresjenistsakti_kode);
                    }
                    else
                    {
                        $('#featuresjenistsakti_kode').removeClass('is-invalid');
                        $('.errorFeaturesjenistsaktiKode').html('');
                    }

                    if (response.error.featuresjenistsakti_nama){
                        $('#featuresjenistsakti_nama').addClass('is-invalid');
                        $('.errorFeaturesjenistsaktiNama').html(response.error.featuresjenistsakti_nama);
                    }
                    else
                    {
                        $('#featuresjenistsakti_nama').removeClass('is-invalid');
                        $('.errorFeaturesjenistsaktiNama').html('');
                    }
                }
                else
                {
                    $('#modaltambahfeaturesjenistsakti').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#featuresjenistsakti_nama').val('');
                        $('#datatable-featuresjenistsakti').DataTable().ajax.reload();
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
function editfeaturesjenistsakti($kode) {
    var url = "/features/jenistsakticontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#featuresjenistsakti_kodeubah').val(response.success.kode);
            $('#featuresjenistsakti_namaubah').val(response.success.jenis);

            $('#featuresjenistsakti_namaubah').removeClass('is-invalid');
            $('.errorFeaturesjenistsaktiKodeubah').html('');

            $('#modalubahfeaturesjenistsakti').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

// Handle Modal ubah
$(document).ready(function() {
    $('.formModalubahfeaturesjenistsakti').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahfeaturesjenistsakti').prop('disabled', true);
                $('.btnmodalubahfeaturesjenistsakti').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahfeaturesjenistsakti').prop('disabled', false);
                $('.btnmodalubahfeaturesjenistsakti').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.featuresjenistsakti_namaubah){
                        $('#featuresjenistsakti_namaubah').addClass('is-invalid');
                        $('.errorFeaturesjenistsaktiNamaubah').html(response.error.featuresjenistsakti_namaubah);
                    }
                    else
                    {
                        $('#featuresjenistsakti_namaubah').removeClass('is-invalid');
                        $('.errorFeaturesjenistsaktiNamaubah').html('');
                    }
                }
                else
                {
                    $('#modalubahfeaturesjenistsakti').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-featuresjenistsakti').DataTable().ajax.reload();
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
function deletefeaturesjenistsakti($kode) {
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
            var url =  '/features/jenistsakticontroller/hapusdata';

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
                            $('#datatable-featuresjenistsakti').DataTable().ajax.reload();
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