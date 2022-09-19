//Datatables server side
$(document).ready( function () {
    var url = '/Career/CategorycarController/ajax_list';
    var table = $('#datatable-careercategory').DataTable({ 
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
function generatekodecareercategory() {
    var url = "/career/CategorycarController/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#careercategory_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahcareercategory').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodaltambahCareercategory').prop('disabled', true);
                $('.btnmodaltambahCareercategory').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahCareercategory').prop('disabled', false);
                $('.btnmodaltambahCareercategory').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.careercategory_kode){
                        $('#careercategory_kode').addClass('is-invalid');
                        $('.errorCareercategoryKode').html(response.error.careercategory_kode);
                    }
                    else
                    {
                        $('#careercategory_kode').removeClass('is-invalid');
                        $('.errorCareercategoryKode').html('');
                    }

                    if (response.error.careercategory_nama){
                        $('#careercategory_nama').addClass('is-invalid');
                        $('.errorCareercategoryNama').html(response.error.careercategory_nama);
                    }
                    else
                    {
                        $('#careercategory_nama').removeClass('is-invalid');
                        $('.errorCareercategoryNama').html('');
                    }
                }
                else
                {
                    $('#modaltambahcareercategory').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        // window.location = response.success.link;
                        // refreshTable();
                        $('#careercategory_nama').val('');
                        $('#datatable-careercategory').DataTable().ajax.reload();
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
function editcareercategory($kode) {
    var url = "/career/CategorycarController/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#careercategory_kodeubah').val(response.success.kode);
            $('#careercategory_namaubah').val(response.success.nama);

            $('#careercategory_namaubah').removeClass('is-invalid');
            $('.errorCategorycareerNamaubah').html('');

            $('#modalubahcareercategory').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahcareercategory').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahCategorycareer').prop('disabled', true);
                $('.btnmodalubahCategorycareer').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahCategorycareer').prop('disabled', false);
                $('.btnmodalubahCategorycareer').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.careercategory_namaubah){
                        $('#careercategory_namaubah').addClass('is-invalid');
                        $('.errorCategorycareerNamaubah').html(response.error.careercategory_namaubah);
                    }
                    else
                    {
                        $('#careercategory_namaubah').removeClass('is-invalid');
                        $('.errorCategorycareerNamaubah').html('');
                    }
                }
                else
                {
                    $('#modalubahcareercategory').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-careercategory').DataTable().ajax.reload();
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
function deletecareercategory($kode) {
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
            var url =  '/career/CategorycarController/hapusdata';

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
                            $('#datatable-careercategory').DataTable().ajax.reload();
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