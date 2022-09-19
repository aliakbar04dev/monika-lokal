//Datatables server side
$(document).ready( function () {
    var url = '/account/usercontroller/ajax_list';
    var table = $('#datatable-accountuser').DataTable({ 
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

//Fungsi select data 
function editaccountuser($kode) {
    var url = "/account/usercontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#accountuser_kodeubah').val(response.success.kodeuser);
            $('#accountuser_kodereferal').val(response.success.kode_referal);
            $('#accountuser_username').val(response.success.username);
            $('#accountuser_nmlengkap').val(response.success.nama_lengkap);
            $('#accountuser_email').val(response.success.alamat_email);
            $('#accountuser_nohp').val(response.success.no_hp);
            $('#accountuser_kota').val(response.success.kota);

			$('#accountuser_kodelevel').val(response.success.kodelevel);
			$('#accountuser_jenismember').val(response.success.jenismember);
            $('#accountuser_changedate').val(response.success.expdate);

            if (response.success.status == 1)
            {
                $('#accountuser_changepass').prop("checked", true);
            }
            else
            {
                $('#accountuser_changepass').prop("checked", false);
            }

            $('#modalubahaccountuser').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahaccountuser').submit(function(e) {
        e.preventDefault();

        let data = new FormData(this);

        $('.accountuser_changepass').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('accountuser_changepass', 1);
            }
            else
            {
                // alert(0);
                data.append('accountuser_changepass', 0);
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
            beforeSend: function() {
                $('.btnmodalubahaccountuser').prop('disabled', true);
                $('.btnmodalubahaccountuser').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahaccountuser').prop('disabled', false);
                $('.btnmodalubahaccountuser').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.accountuser_expdate){
                        $('#accountuser_changedate').addClass('is-invalid');
                        $('.errorAccountuserlevelNamaubah').html(response.error.accountuser_expdate);
                    } else {
                        $('#accountuser_changedate').removeClass('is-invalid');
                        $('.errorAccountuserlevelNamaubah').html('');
                    }

                    if (response.error.accountuser_username){
                        $('#accountuser_username').addClass('is-invalid');
                        $('.errorAccountuserUsername').html(response.error.accountuser_username);
                    } else {
                        $('#accountuser_username').removeClass('is-invalid');
                        $('.errorAccountuserUsername').html('');
                    }

                    if (response.error.accountuser_email){
                        $('#accountuser_email').addClass('is-invalid');
                        $('.errorAccountuserEmail').html(response.error.accountuser_email);
                    } else {
                        $('#accountuser_email').removeClass('is-invalid');
                        $('.errorAccountuserEmail').html('');
                    }

                    if (response.error.accountuser_nohp){
                        $('#accountuser_nohp').addClass('is-invalid');
                        $('.errorAccountuserNohp').html(response.error.accountuser_nohp);
                    } else {
                        $('#accountuser_nohp').removeClass('is-invalid');
                        $('.errorAccountuserNohp').html('');
                    }
                }
                else
                {
                    $('#modalubahaccountuser').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-accountuser').DataTable().ajax.reload();
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