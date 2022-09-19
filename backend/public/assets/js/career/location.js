//Datatables server side
$(document).ready( function () {
    var url = '/career/LocationcarController/ajax_list';
    var table = $('#datatable-careerlocation').DataTable({ 
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
function generatekodecareerlocation() {
    var url = "/career/LocationcarController/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#careerlocation_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahcareerlocation').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodaltambahCareerlocation').prop('disabled', true);
                $('.btnmodaltambahCareerlocation').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahCareerlocation').prop('disabled', false);
                $('.btnmodaltambahCareerlocation').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.careerlocation_kode){
                        $('#careerlocation_kode').addClass('is-invalid');
                        $('.errorCareerlocationKode').html(response.error.careerlocation_kode);
                    }
                    else
                    {
                        $('#careerlocation_kode').removeClass('is-invalid');
                        $('.errorCareerlocationKode').html('');
                    }

                    if (response.error.careerlocation_nama){
                        $('#careerlocation_nama').addClass('is-invalid');
                        $('.errorCareerlocationNama').html(response.error.careerlocation_nama);
                    }
                    else
                    {
                        $('#careerlocation_nama').removeClass('is-invalid');
                        $('.errorCareerlocationNama').html('');
                    }
                }
                else
                {
                    $('#modaltambahcareerlocation').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        // window.location = response.success.link;
                        // refreshTable();
                        $('#careerlocation_nama').val('');
                        $('#datatable-careerlocation').DataTable().ajax.reload();
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
function editcareerlocation($kode) {
    var url = "/career/LocationcarController/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#careerlocation_kodeubah').val(response.success.kode);
            $('#careerlocation_namaubah').val(response.success.nama);

            $('#careerlocation_namaubah').removeClass('is-invalid');
            $('.errorLocationcareerNamaubah').html('');

            $('#modalubahcareerlocation').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahcareerlocation').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahLocationcareer').prop('disabled', true);
                $('.btnmodalubahLocationcareer').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahLocationcareer').prop('disabled', false);
                $('.btnmodalubahLocationcareer').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.careerlocation_namaubah){
                        $('#careerlocation_namaubah').addClass('is-invalid');
                        $('.errorLocationcareerNamaubah').html(response.error.careerlocation_namaubah);
                    }
                    else
                    {
                        $('#careerlocation_namaubah').removeClass('is-invalid');
                        $('.errorLocationcareerNamaubah').html('');
                    }
                }
                else
                {
                    $('#modalubahcareerlocation').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-careerlocation').DataTable().ajax.reload();
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

//Fungsi modal delete data
function deletecareerlocation($kode) {
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
            var url =  '/career/LocationcarController/hapusdata';

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
                            // window.location = response.success.link;
                            $('#datatable-careerlocation').DataTable().ajax.reload();
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