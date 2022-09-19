//Datatables server side
$(document).ready( function () {
    var url = '/career/DepartmentcarController/ajax_list';
    var table = $('#datatable-careerdepartment').DataTable({ 
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
function generatekodecareerdepartment() {
    var url = "/career/DepartmentcarController/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#careerdepartment_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahcareerdepartment').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodaltambahCareerdepartment').prop('disabled', true);
                $('.btnmodaltambahCareerdepartment').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahCareerdepartment').prop('disabled', false);
                $('.btnmodaltambahCareerdepartment').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.careerdepartment_kode){
                        $('#careerdepartment_kode').addClass('is-invalid');
                        $('.errorCareerDepartmentKode').html(response.error.careerdepartment_kode);
                    }
                    else
                    {
                        $('#careerdepartment_kode').removeClass('is-invalid');
                        $('.errorCareerDepartmentKode').html('');
                    }

                    if (response.error.careerdepartment_nama){
                        $('#careerdepartment_nama').addClass('is-invalid');
                        $('.errorCareerDepartmentNama').html(response.error.careerdepartment_nama);
                    }
                    else
                    {
                        $('#careerdepartment_nama').removeClass('is-invalid');
                        $('.errorCareerDepartmentNama').html('');
                    }
                }
                else
                {
                    $('#modaltambahcareerdepartment').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        // window.location = response.success.link;
                        // refreshTable();
                        $('#careerdepartment_nama').val('');
                        $('#datatable-careerdepartment').DataTable().ajax.reload();
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
function editcareerdepartment($kode) {
    var url = "/career/DepartmentcarController/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#careerdepartment_kodeubah').val(response.success.kode);
            $('#careerdepartment_namaubah').val(response.success.nama);

            $('#careerdepartment_namaubah').removeClass('is-invalid');
            $('.errorDepartmentcareerNamaubah').html('');

            $('#modalubahcareerdepartment').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahcareerdepartment').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahDepartmentcareer').prop('disabled', true);
                $('.btnmodalubahDepartmentcareer').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahDepartmentcareer').prop('disabled', false);
                $('.btnmodalubahDepartmentcareer').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.careerdepartment_namaubah){
                        $('#careerdepartment_namaubah').addClass('is-invalid');
                        $('.errorDepartmentcareerNamaubah').html(response.error.careerdepartment_namaubah);
                    }
                    else
                    {
                        $('#careerdepartment_namaubah').removeClass('is-invalid');
                        $('.errorDepartmentcareerNamaubah').html('');
                    }
                }
                else
                {
                    $('#modalubahcareerdepartment').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-careerdepartment').DataTable().ajax.reload();
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
function deletecareerdepartment($kode) {
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
            var url =  '/career/DepartmentcarController/hapusdata';

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
                            $('#datatable-careerdepartment').DataTable().ajax.reload();
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