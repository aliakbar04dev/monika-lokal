//Datatables server side
$(document).ready( function () {
    var url = '/media/videomednewcontroller/ajax_list';
    var table = $('#datatable-medianewvideo').DataTable({ 
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


// Fungsi tampil input summernote di modal add
$('#medianewvideo_deskripsi').summernote({
    placeholder: 'Masukkan deskripsi disini ...',
    height: 200,
	callbacks: {
        onImageUpload: function(image) {
            uploadImagenewvideo(image[0]);
        },
        onMediaDelete: function(target) {
            deleteImagenewvideo(target[0].src);
        }
    }
});


// Fungsi upload gambar di summernote add
function uploadImagenewvideo(image) {
    var data = new FormData();
    var url = "/media/videomednewcontroller/uploadGambar";
    data.append("image", image);
    $.ajax({
        url: BASE_URL + url,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            $('#medianewvideo_deskripsi').summernote("insertImage", url, data);
        },
        error: function(data) {
            console.log(data);
        }
   });
 }


// Fungsi hapus gambar di summernote add
function deleteImagenewvideo(src) {
    var url = "/media/videomednewcontroller/deleteGambar";
    $.ajax({
    url: BASE_URL + url,
    data: {src : src},
    type: "POST",
    cache: false,
    success: function(response) {
        console.log(response);
    }
    });
}


// Fungsi tampil input summernote di modal edit
$('#medianewvideo_deskripsiubah').summernote({
    placeholder: 'Masukkan deskripsi disini ...',
    height: 200,
	callbacks: {
       onImageUpload: function(image) {
		   editor = $(this);
           uploadImagenewvideoubah(image[0], editor);
       },
       onMediaDelete : function(target) {
        deleteImagenewvideoubah(target[0].src);
       }
    }
  });


// Fungsi upload gambar di summernote edit
function uploadImagenewvideoubah(image) {
    var data = new FormData();
    var url = "/media/videomednewcontroller/uploadGambar";
    data.append("image", image);
    $.ajax({
        url: BASE_URL + url,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            $('#medianewvideo_deskripsiubah').summernote("insertImage", url, data);
        },
        error: function(data) {
            console.log(data);
        }
   });
 }


// Fungsi hapus gambar di summernote edit
function deleteImagenewvideoubah(src) {
    var url = "/media/videomednewcontroller/deleteGambar";
    $.ajax({
    url: BASE_URL + url,
    data: {src : src},
    type: "POST",
    cache: false,
    success: function(response) {
        console.log(response);
    }
    });
}

//Fungsi generate kode
function generatekodemedianewvideo() {
    var url = "/media/videomednewcontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#medianewvideo_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahmedianewvideo').submit(function(e) {
        e.preventDefault();

        // let data = new FormData(this);
        // // data.append('infobursaemiten_isi', CKEDITOR.instances.infobursaemiten_isi.getData());

        // $('.medianewvideo_populer').each(function() {
        //     if ($(this).is(":checked"))
        //     {
        //         data.append('medianewvideo_populer', 1);
        //     }
        //     else
        //     {
        //         data.append('medianewvideo_populer', 0);
        //     }
        // });

        $.ajax({
            type: "post",
			url: $(this).attr('action'),
			data: $(this).serialize(),
			dataType: "json",
            beforeSend: function() {
                $('.btnmodaltambahmedianewvideo').prop('disabled', true);
                $('.btnmodaltambahmedianewvideo').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahmedianewvideo').prop('disabled', false);
                $('.btnmodaltambahmedianewvideo').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.medianewvideo_kode){
                        $('#medianewvideo_kode').addClass('is-invalid');
                        $('.errormedianewvideoKode').html(response.error.medianewvideo_kode);
                    }
                    else
                    {
                        $('#medianewvideo_kode').removeClass('is-invalid');
                        $('.errormedianewvideoKode').html('');
                    }

                    if (response.error.medianewvideo_link){
                        $('#medianewvideo_link').addClass('is-invalid');
                        $('.errormedianewvideoLink').html(response.error.medianewvideo_link);
                    }
                    else
                    {
                        $('#medianewvideo_link').removeClass('is-invalid');
                        $('.errormedianewvideoLink').html('');
                    }
					
					if (response.error.medianewvideo_thumbs){
                        $('#medianewvideo_thumbs').addClass('is-invalid');
                        $('.errormedianewvideoThumbs').html(response.error.medianewvideo_thumbs);
                    }
                    else
                    {
                        $('#medianewvideo_thumbs').removeClass('is-invalid');
                        $('.errormedianewvideoThumbs').html('');
                    }
					
					if (response.error.medianewvideo_judul){
                        $('#medianewvideo_judul').addClass('is-invalid');
                        $('.errormedianewvideoJudul').html(response.error.medianewvideo_judul);
                    }
                    else
                    {
                        $('#medianewvideo_judul').removeClass('is-invalid');
                        $('.errormedianewvideoJudul').html('');
                    }
                }
                else
                {
                    $('#modaltambahmedianewvideo').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#medianewvideo_kode').val('');
                        $('#medianewvideo_link').val('');
						$('#medianewvideo_thumbs').val('');
						$('#medianewvideo_deskripsi').summernote({value: ''});
						$('#medianewvideo_judul').val('');
                        $('#datatable-medianewvideo').DataTable().ajax.reload();
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
function editmedianewvideo($kode) {
    var url = "/media/videomednewcontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#medianewvideo_kodeubah').val(response.success.kode);
            $('#medianewvideo_filterubah').val(response.success.kode_filter);
            $('#medianewvideo_subfilterubah').val(response.success.kode_filter_submedia);
            $('#medianewvideo_judulubah').val(response.success.judul);
			$('#medianewvideo_linkubah').val(response.success.link);
            $('#medianewvideo_linkapiubah').val(response.success.link_api);
			$('#medianewvideo_thumbsubah').val(response.success.thumbs);
            $('#medianewvideo_populerubah').val(response.success.is_populer);
            $('#medianewvideo_berbayarubah').val(response.success.is_berbayar);
			$('#medianewvideo_deskripsiubah').summernote('code', response.success.deskripsi);

            $('#medianewvideo_judulubah').removeClass('is-invalid');
            $('.errormedianewvideoJudulubah').html('');

            $('#medianewvideo_linkubah').removeClass('is-invalid');
            $('.errormedianewvideoLinkubah').html('');

            $('#modalubahmedianewvideo').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahmedianewvideo').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahmedianewvideo').prop('disabled', true);
                $('.btnmodalubahmedianewvideo').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahmedianewvideo').prop('disabled', false);
                $('.btnmodalubahmedianewvideo').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.medianewvideo_judulubah){
                        $('#medianewvideo_judulubah').addClass('is-invalid');
                        $('.errormedianewvideoJudulubah').html(response.error.medianewvideo_judulubah);
                    }
                    else
                    {
                        $('#medianewvideo_judulubah').removeClass('is-invalid');
                        $('.errormedianewvideoJudulubah').html('');
                    }

                    if (response.error.medianewvideo_linkubah){
                        $('#medianewvideo_linkubah').addClass('is-invalid');
                        $('.errormedianewvideoLinkubah').html(response.error.medianewvideo_linkubah);
                    }
                    else
                    {
                        $('#medianewvideo_linkubah').removeClass('is-invalid');
                        $('.errormedianewvideoLinkubah').html('');
                    }
					
					if (response.error.medianewvideo_thumbsubah){
                        $('#medianewvideo_thumbsubah').addClass('is-invalid');
                        $('.errormedianewvideoThumbsubah').html(response.error.medianewvideo_thumbsubah);
                    }
                    else
                    {
                        $('#medianewvideo_thumbsubah').removeClass('is-invalid');
                        $('.errormedianewvideoThumbsubah').html('');
                    }
                }
                else
                {
                    $('#modalubahmedianewvideo').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-medianewvideo').DataTable().ajax.reload();
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
function deletemedianewvideo($kode) {
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
            var url =  '/media/videomednewcontroller/hapusdata';

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
                            $('#datatable-medianewvideo').DataTable().ajax.reload();
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