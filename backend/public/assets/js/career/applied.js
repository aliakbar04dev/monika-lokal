//Datatables server side
$(document).ready( function () {
    var url = '/career/AppliedController/ajax_list';
    var table = $('#datatable-careerapplied').DataTable({ 
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
function downloadcareerapplied($kode) {
    var url = "/career/AppliedController/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
			window.location.href = response.success.dokumen;
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}
