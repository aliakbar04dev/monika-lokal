//Datatables server side
$(document).ready( function () {
    var url = '/package/disccontroller/ajax_list';
    var table = $('#datatable-packagedisc').DataTable({ 
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
function generatekodepackagedisc() {
    var url = "/package/disccontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#packagedisc_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahpackagedisc').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodaltambahdiscfeature').prop('disabled', true);
                $('.btnmodaltambahdiscfeature').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahdiscfeature').prop('disabled', false);
                $('.btnmodaltambahdiscfeature').html('Simpan');
            },
            success: function(response) {
                if (response.error){
					 if (response.error.packagedisc_kode){
                        $('#packagedisc_kode').addClass('is-invalid');
                        $('.errorPackagedisckode').html(response.error.packagedisc_kode);
                    }
                    else
                    {
                        $('#packagedisc_kode').removeClass('is-invalid');
                        $('.errorPackagedisckode').html('');
                    }
					
					if (response.error.packagedisc_diskon){
                        $('#packagedisc_diskon').addClass('is-invalid');
                        $('.errorPackagediscdiskon').html(response.error.packagedisc_diskon);
                    }
                    else
                    {
                        $('#packagedisc_diskon').removeClass('is-invalid');
                        $('.errorPackagediscdiskon').html('');
                    }
                }
                else
                {
                    $('#modaltambahpackagedisc').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
						$('#packagedisc_kode').val('');
                        $('#packagedisc_diskon').val('');
                        $('#datatable-packagedisc').DataTable().ajax.reload();
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
function editpackagedisc($kode) {
    var url = "/package/disccontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#packagedisc_kodeubah').val($kode);
            $('#packagedisc_diskonubah').val(response.success.disc);
            $('#packagedisc_keteranganubah').val(response.success.description);

            $('#packagedisc_kodeubah').removeClass('is-invalid');
            $('.errorPackagedisckodeubah').html('');
			
			$('#packagedisc_diskonubah').removeClass('is-invalid');
            $('.errorPackagediscdiskonubah').html('');

            $('#modalubahpackagedisc').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahpackagedisc').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahpackagedisc').prop('disabled', true);
                $('.btnmodalubahpackagedisc').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahpackagedisc').prop('disabled', false);
                $('.btnmodalubahpackagedisc').html('Ubah');
            },
            success: function(response) {
                if (response.error){
					if (response.error.packagedisc_diskonubah){
                        $('#packagedisc_diskonubah').addClass('is-invalid');
                        $('.errorPackagediscdiskonubah').html(response.error.packagedisc_diskonubah);
                    }
                    else
                    {
                        $(packagedisc_diskonubah).removeClass('is-invalid');
                        $('.errorPackagediscdiskonubah').html('');
                    }
                }
                else
                {
                    $('#modalubahpackagedisc').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-packagedisc').DataTable().ajax.reload();
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
function deletepackagedisc($kode) {
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
            var url =  '/package/disccontroller/hapusdata';

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
                            $('#datatable-packagedisc').DataTable().ajax.reload();
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