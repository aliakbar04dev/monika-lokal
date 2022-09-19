//Datatables server side
$(document).ready( function () {
    var url = '/media/Filtersubmedcontroller/ajax_list';
    var table = $('#datatable-submediafilter').DataTable({ 
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
function generatekodesubmediafilter() {
    var url = "/media/Filtersubmedcontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#submediafilter_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

// Fungsi tampil input summernote di modal add
$('#submediafilter_desc').summernote({
    placeholder: 'Masukkan deskripsi disini ...',
    height: 200,
	callbacks: {
        onImageUpload: function(image) {
            uploadImagesubkategorimedia(image[0]);
        },
        onMediaDelete: function(target) {
            deleteImagesubkategorimedia(target[0].src);
        }
    }
});


// Fungsi upload gambar di summernote add
function uploadImagesubkategorimedia(image) {
    var data = new FormData();
    var url = "/media/filtersubmedcontroller/uploadGambar";
    data.append("image", image);
    $.ajax({
        url: BASE_URL + url,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            $('#submediafilter_desc').summernote("insertImage", url, data);
        },
        error: function(data) {
            console.log(data);
        }
   });
 }


// Fungsi hapus gambar di summernote add
function deleteImagesubkategorimedia(src) {
    var url = "/media/filtersubmedcontroller/deleteGambar";
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
$('#submediafilter_descubah').summernote({
    placeholder: 'Masukkan deskripsi disini ...',
    height: 200,
	callbacks: {
       onImageUpload: function(image) {
		   editor = $(this);
           uploadImagesubkategorimediaubah(image[0], editor);
       },
       onMediaDelete : function(target) {
        deleteImagesubkategorimediaubah(target[0].src);
       }
    }
  });


// Fungsi upload gambar di summernote edit
function uploadImagesubkategorimediaubah(image) {
    var data = new FormData();
    var url = "/media/filtersubmedcontroller/uploadGambar";
    data.append("image", image);
    $.ajax({
        url: BASE_URL + url,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            $('#submediafilter_descubah').summernote("insertImage", url, data);
        },
        error: function(data) {
            console.log(data);
        }
   });
 }


// Fungsi hapus gambar di summernote edit
function deleteImagesubkategorimediaubah(src) {
    var url = "/media/filtersubmedcontroller/deleteGambar";
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

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahsubmediafilter').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodaltambahsubmediafilter').prop('disabled', true);
                $('.btnmodaltambahsubmediafilter').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahsubmediafilter').prop('disabled', false);
                $('.btnmodaltambahsubmediafilter').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.submediafilter_kode){
                        $('#submediafilter_kode').addClass('is-invalid');
                        $('.errorSubmediafilterKode').html(response.error.submediafilter_kode);
                    }
                    else
                    {
                        $('#submediafilter_kode').removeClass('is-invalid');
                        $('.errorSubmediafilterKode').html('');
                    }

                    if (response.error.submediafilter_keterangan){
                        $('#submediafilter_keterangan').addClass('is-invalid');
                        $('.errorSubmediafilterKeterangan').html(response.error.submediafilter_keterangan);
                    }
                    else
                    {
                        $('#submediafilter_keterangan').removeClass('is-invalid');
                        $('.errorSubmediafilterKeterangan').html('');
                    }

                    if (response.error.submediafilter_desc){
                        $('#submediafilter_desc').addClass('is-invalid');
                        $('.errorSubmediafilterdesc').html(response.error.submediafilter_desc);
                    }
                    else
                    {
                        $('#submediafilter_desc').removeClass('is-invalid');
                        $('.errorSubmediafilterdesc').html('');
                    }
                }
                else
                {
                    $('#modaltambahsubmediafilter').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#submediafilter_kode').val('');
                        $('#datatable-submediafilter').DataTable().ajax.reload();
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
function editsubmediafilter($kode) {
    var url = "/media/Filtersubmedcontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#submediafilter_kodeubah').val(response.success.kode);
            $('#submediafilter_keteranganubah').val(response.success.judul);
			$('#submediafilter_descubah').summernote('code', response.success.desc);
            $('#modalubahsubmediafilter').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahsubmediafilter').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahsubmediafilter').prop('disabled', true);
                $('.btnmodalubahsubmediafilter').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahsubmediafilter').prop('disabled', false);
                $('.btnmodalubahsubmediafilter').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.submediafilter_keteranganubah){
                        $('#submediafilter_keteranganubah').addClass('is-invalid');
                        $('.errorSubmediafilterKeteranganubah').html(response.error.submediafilter_keteranganubah);
                    }
                    else
                    {
                        $('#submediafilter_keteranganubah').removeClass('is-invalid');
                        $('.errorSubmediafilterKeteranganubah').html('');
                    }

                    if (response.error.submediafilter_descubah){
                        $('#submediafilter_descubah').addClass('is-invalid');
                        $('.errorSubmediafilterdescubah').html(response.error.submediafilter_descubah);
                    }
                    else
                    {
                        $('#submediafilter_descubah').removeClass('is-invalid');
                        $('.errorSubmediafilterdescubah').html('');
                    }
                }
                else
                {
                    $('#modalubahsubmediafilter').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-submediafilter').DataTable().ajax.reload();
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
function deletesubmediafilter($kode) {
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
            var url =  '/media/Filtersubmedcontroller/hapusdata';

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
                            $('#datatable-submediafilter').DataTable().ajax.reload();
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