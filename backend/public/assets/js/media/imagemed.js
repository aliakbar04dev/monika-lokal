//Datatables server side
$(document).ready( function () {
    var url = '/media/imagemedcontroller/ajax_list';
    var table = $('#datatable-mediaimage').DataTable({ 
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

$('#mediaimage_deskripsi').summernote({
  placeholder: 'Masukkan pesan disini ...',
  tabsize: 2,
  height: 100
});

//Fungsi generate kode
function generatekodemediaimage() {
    var url = "/media/imagemedcontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#mediaimage_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahmediaimage').submit(function(e) {
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
                $('.btnmodaltambahmediaimage').prop('disabled', true);
                $('.btnmodaltambahmediaimage').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahmediaimage').prop('disabled', false);
                $('.btnmodaltambahmediaimage').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.mediaimage_kode){
                        $('#mediaimage_kode').addClass('is-invalid');
                        $('.errorMediaimageKode').html(response.error.mediaimage_kode);
                    }
                    else
                    {
                        $('#mediaimage_kode').removeClass('is-invalid');
                        $('.errorMediaimageKode').html('');
                    }

                    if (response.error.mediaimage_judul){
                        $('#mediaimage_judul').addClass('is-invalid');
                        $('.errorMediaimageJudul').html(response.error.mediaimage_judul);
                    }
                    else
                    {
                        $('#mediaimage_judul').removeClass('is-invalid');
                        $('.errorMediaimageJudul').html('');
                    }
					
					if (response.error.mediaimage_gambar){
                        $('#mediaimage_gambar').addClass('is-invalid');
                        $('.errorMediaimageGambar').html(response.error.mediaimage_gambar);
                    }
                    else
                    {
                        $('#mediaimage_gambar').removeClass('is-invalid');
                        $('.errorMediaimageGambar').html('');
                    }
                }
                else
                {
                    $('#modaltambahmediaimage').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
						window.location = response.success.link;
                        $('#mediaimage_kode').val('');
						$('#mediaimage_deskripsi').summernote({value: ''});
						$('#mediaimage_judul').val('');
                        //$('#datatable-mediaimage').DataTable().ajax.reload();
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
function editmediaimage($kode) {
    var url = "/media/imagemedcontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#mediaimage_kodeubah').val(response.success.kode);
			$('#mediaimage_filterubah').val(response.success.kode_filter);
			$('#mediaimage_judulubah').val(response.success.judul);
			$('#mediaimage_deskripsiubah').summernote('insertText', response.success.deskripsi);

            $('#mediaimage_judulubah').removeClass('is-invalid');
            $('.mediaimage_judulubah').html('');

            $('#modalubahmediaimage').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahmediaimage').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahmediaimage').prop('disabled', true);
                $('.btnmodalubahmediaimage').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahmediaimage').prop('disabled', false);
                $('.btnmodalubahmediaimage').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.mediaimage_judulubah){
                        $('#mediaimage_judulubah').addClass('is-invalid');
                        $('.errorMediaimageJudulubah').html(response.error.mediaimage_judulubah);
                    }
                    else
                    {
                        $('#mediaimage_judulubah').removeClass('is-invalid');
                        $('.errorMediaimageJudulubah').html('');
                    }
                }
                else
                {
                    $('#modalubahmediaimage').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-mediaimage').DataTable().ajax.reload();
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

//Fungsi select image
function changeimgmediaimage($kode) {
    var url = "/media/imagemedcontroller/pilihgambar";
    var location = "/public/assets/img/allimg/";
	//alert($kode);
	//var location = "/writable/uploads/";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
			//alert(response.success.kode);
            var imgloc = BASE_URL + location + response.success.gambar;
            $('#mediaimage_kodeubahgambar').val(response.success.kode);
            $('#mediaimage_editimg').attr("src", imgloc);
			$('#mediaimage_editgambarubah').val('');
			
            $('#mediaimage_editgambarubah').removeClass('is-invalid');
            $('.errorMediaimageeditGambarubah').html('');

            $('#modalubahgambarmediaimage').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update gambar
$(document).ready(function() {
    $('.formModalubahgambarmediaimage').submit(function(e) {
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
                $('.btnmodalubahgambarmediaimage').prop('disabled', true);
                $('.btnmodalubahgambarmediaimage').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahgambarmediaimage').prop('disabled', false);
                $('.btnmodalubahgambarmediaimage').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.mediaimage_editgambarubah){
                        $('#mediaimage_editgambarubah').addClass('is-invalid');
                        $('.errorMediaimageeditGambarubah').html(response.error.mediaimage_editgambarubah);
                    }
                    else
                    {
                        $('#mediaimage_editgambarubah').removeClass('is-invalid');
                        $('.errorMediaimageeditGambarubah').html('');
                    }
                }
                else
                {
                    $('#modalubahgambarmediaimage').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
						window.location = response.success.link;
                        //$('#datatable-mediaimage').DataTable().ajax.reload();
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
function deletemediaimage($kode) {
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
            var url =  '/media/imagemedcontroller/hapusdata';

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
                            $('#datatable-mediaimage').DataTable().ajax.reload();
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