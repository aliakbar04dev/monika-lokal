//Datatables server side
$(document).ready( function () {
    var url = '/information/faqcontroller/ajax_list';
    var table = $('#datatable-infofaq').DataTable({ 
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

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahinfofaq').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodaltambahinfofaq').prop('disabled', true);
                $('.btnmodaltambahinfofaq').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahinfofaq').prop('disabled', false);
                $('.btnmodaltambahinfofaq').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.infofaq_soal){
                        $('#infofaq_soal').addClass('is-invalid');
                        $('.errorInfofaqSoal').html(response.error.infofaq_soal);
                    }
                    else
                    {
                        $('#infofaq_soal').removeClass('is-invalid');
                        $('.errorInfofaqSoal').html('');
                    }

                    if (response.error.infofaq_jawab){
                        $('#infofaq_jawab').addClass('is-invalid');
                        $('.errorInfotypeJawab').html(response.error.infofaq_jawab);
                    }
                    else
                    {
                        $('#infofaq_jawab').removeClass('is-invalid');
                        $('.errorInfotypeJawab').html('');
                    }
                }
                else
                {
                    $('#modaltambahinfofaq').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#infofaq_soal').val('');
						$('#infofaq_jawab').val('');
                        $('#datatable-infofaq').DataTable().ajax.reload();
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
function editinfofaq($kode) {
    var url = "/information/faqcontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
			$('#infofaq_kodeubah').val(response.success.kode);
            $('#infofaq_soalubah').val(response.success.soal);
            $('#infofaq_jawabubah').val(response.success.jawab);

            $('#infofaq_soalubah').removeClass('is-invalid');
            $('.errorInfofaqSoalubah').html('');
			
			$('#infofaq_jawabubah').removeClass('is-invalid');
            $('.errorInfotypeJawabubah').html('');

            $('#modalubahinfofaq').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

// Handle Modal ubah
$(document).ready(function() {
    $('.formModalubahinfofaq').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahinfofaq').prop('disabled', true);
                $('.btnmodalubahinfofaq').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahinfofaq').prop('disabled', false);
                $('.btnmodalubahinfofaq').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.infofaq_soalubah){
                        $('#infofaq_soalubah').addClass('is-invalid');
                        $('.errorInfofaqSoalubah').html(response.error.infofaq_soalubah);
                    }
                    else
                    {
                        $('#infofaq_soalubah').removeClass('is-invalid');
                        $('.errorInfofaqSoalubah').html('');
                    }
					
					if (response.error.infofaq_jawabubah){
                        $('#infofaq_jawabubah').addClass('is-invalid');
                        $('.errorInfotypeJawabubah').html(response.error.infofaq_jawabubah);
                    }
                    else
                    {
                        $('#infofaq_jawabubah').removeClass('is-invalid');
                        $('.errorInfotypeJawabubah').html('');
                    }
                }
                else
                {
                    $('#modalubahinfofaq').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-infofaq').DataTable().ajax.reload();
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
function deleteinfofaq($kode) {
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
            var url =  '/information/faqcontroller/hapusdata';

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
                            $('#datatable-infofaq').DataTable().ajax.reload();
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