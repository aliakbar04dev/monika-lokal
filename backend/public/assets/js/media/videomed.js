//Datatables server side
$(document).ready( function () {
    var url = '/media/videomedcontroller/ajax_list';
    var table = $('#datatable-mediavideo').DataTable({ 
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
	  },
    });
});

$('#mediavideo_deskripsi').summernote({
  placeholder: 'Masukkan pesan disini ...',
  tabsize: 2,
  height: 100
});

//Fungsi generate kode
function generatekodemediavideo() {
    var url = "/media/videomedcontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#mediavideo_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahmediavideo').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
			url: $(this).attr('action'),
			data: $(this).serialize(),
			dataType: "json",
            beforeSend: function() {
                $('.btnmodaltambahmediavideo').prop('disabled', true);
                $('.btnmodaltambahmediavideo').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahmediavideo').prop('disabled', false);
                $('.btnmodaltambahmediavideo').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.mediavideo_kode){
                        $('#mediavideo_kode').addClass('is-invalid');
                        $('.errorMediavideoKode').html(response.error.mediavideo_kode);
                    }
                    else
                    {
                        $('#mediavideo_kode').removeClass('is-invalid');
                        $('.errorMediavideoKode').html('');
                    }

                    if (response.error.mediavideo_link){
                        $('#mediavideo_link').addClass('is-invalid');
                        $('.errorMediavideoLink').html(response.error.mediavideo_link);
                    }
                    else
                    {
                        $('#mediavideo_link').removeClass('is-invalid');
                        $('.errorMediavideoLink').html('');
                    }
					
					if (response.error.mediavideo_thumbs){
                        $('#mediavideo_thumbs').addClass('is-invalid');
                        $('.errorMediavideoThumbs').html(response.error.mediavideo_thumbs);
                    }
                    else
                    {
                        $('#mediavideo_thumbs').removeClass('is-invalid');
                        $('.errorMediavideoThumbs').html('');
                    }
					
					if (response.error.mediavideo_judul){
                        $('#mediavideo_judul').addClass('is-invalid');
                        $('.errorMediavideoJudul').html(response.error.mediavideo_judul);
                    }
                    else
                    {
                        $('#mediavideo_judul').removeClass('is-invalid');
                        $('.errorMediavideoJudul').html('');
                    }
                }
                else
                {
                    $('#modaltambahmediavideo').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#mediavideo_kode').val('');
                        $('#mediavideo_link').val('');
						$('#mediavideo_thumbs').val('');
						$('#mediavideo_deskripsi').summernote({value: ''});
						$('#mediavideo_judul').val('');
                        $('#datatable-mediavideo').DataTable().ajax.reload();
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
function editmediavideo($kode) {
    var url = "/media/videomedcontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#mediavideo_kodeubah').val(response.success.kode);
            $('#mediavideo_filterubah').val(response.success.kode_filter);
            $('#mediavideo_judulubah').val(response.success.judul);
			$('#mediavideo_linkubah').val(response.success.link);
			$('#mediavideo_thumbsubah').val(response.success.thumbs);
			$('#mediavideo_deskripsiubah').summernote('insertText', response.success.deskripsi);

            $('#mediavideo_judulubah').removeClass('is-invalid');
            $('.errorMediavideoJudulubah').html('');

            $('#mediavideo_linkubah').removeClass('is-invalid');
            $('.errorMediavideoLinkubah').html('');

            $('#modalubahmediavideo').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahmediavideo').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahmediavideo').prop('disabled', true);
                $('.btnmodalubahmediavideo').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahmediavideo').prop('disabled', false);
                $('.btnmodalubahmediavideo').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.mediavideo_judulubah){
                        $('#mediavideo_judulubah').addClass('is-invalid');
                        $('.errorMediavideoJudulubah').html(response.error.mediavideo_judulubah);
                    }
                    else
                    {
                        $('#mediavideo_judulubah').removeClass('is-invalid');
                        $('.errorMediavideoJudulubah').html('');
                    }

                    if (response.error.mediavideo_linkubah){
                        $('#mediavideo_linkubah').addClass('is-invalid');
                        $('.errorMediavideoLinkubah').html(response.error.mediavideo_linkubah);
                    }
                    else
                    {
                        $('#mediavideo_linkubah').removeClass('is-invalid');
                        $('.errorMediavideoLinkubah').html('');
                    }
					
					if (response.error.mediavideo_thumbsubah){
                        $('#mediavideo_thumbsubah').addClass('is-invalid');
                        $('.errorMediavideoThumbsubah').html(response.error.mediavideo_thumbsubah);
                    }
                    else
                    {
                        $('#mediavideo_thumbsubah').removeClass('is-invalid');
                        $('.errorMediavideoThumbsubah').html('');
                    }
                }
                else
                {
                    $('#modalubahmediavideo').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-mediavideo').DataTable().ajax.reload();
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
function deletemediavideo($kode) {
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
            var url =  '/media/videomedcontroller/hapusdata';

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
                            $('#datatable-mediavideo').DataTable().ajax.reload();
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