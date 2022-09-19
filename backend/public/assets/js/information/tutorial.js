// CKEDITOR.replace('infotutorial_isi');
// CKEDITOR.replace('infotutorial_isiubah');

//Datatables server side
$(document).ready( function () {
    var url = '/information/tutorialcontroller/ajax_list';
    var table = $('#datatable-infotutorial').DataTable({
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
            "widht": '100',
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

/*$('#infotutorial_isi').summernote({
  placeholder: 'Masukkan pesan disini ...',
  tabsize: 2,
  height: 100
}); */



// $('#infonews_isiubah').summernote({
//     tabsize: 2,
//     height: 100
//   });

// ClassicEditor
//     .create(document.querySelector('#infotutorial_isi'))
//     .then(editor => {
//         console.log(editor);
//     })
//     .catch(error => {
//         console.error(error);
//     } 
// );

//Fungsi generate kode
function generatekodeinfotutor() {
  var url = "/information/tutorialcontroller/getdata";
  $.ajax({
      url: BASE_URL + url,
      dataType: "JSON",
      success: function(response) {
          $('#infotutorial_kode').val(response.kodegen);
      },
      error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
  });
}


// Fungsi tampil input summernote di modal add
$('#infotutorial_isi').summernote({
    placeholder: 'Masukkan konten disini ...',
    height: 200,
	callbacks: {
        onImageUpload: function(image) {
            uploadImageinfotutorial(image[0]);
        },
        onMediaDelete : function(target) {
            deleteImageinfotutorial(target[0].src);
        }
    }
});


// Fungsi upload gambar di summernote add
function uploadImageinfotutorial(image) {
    var data = new FormData();
    var url = "/information/Tutorialcontroller/uploadGambar";
    data.append("image", image);
    $.ajax({
        url: BASE_URL + url,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            $('#infotutorial_isi').summernote("insertImage", url, data);
        },
        error: function(data) {
            console.log(data);
        }
   });
 }


// Fungsi hapus gambar di summernote add
function deleteImageinfotutorial(src) {
    var url = "/information/Tutorialcontroller/deleteGambar";
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
$('#infotutorial_isiubah').summernote({
    placeholder: 'Masukkan konten disini ...',
    height: 200,
	callbacks: {
       onImageUpload: function(image) {
		   editor = $(this);
           uploadImageinfotutorialedit(image[0], editor);
       },
       onMediaDelete : function(target) {
        deleteImageinfotutorialedit(target[0].src);
       }
    }
  });


// Fungsi upload gambar di summernote edit
function uploadImageinfotutorialedit(image) {
    var data = new FormData();
    var url = "/information/Tutorialcontroller/uploadGambar";
    data.append("image", image);
    $.ajax({
        url: BASE_URL + url,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            $('#infotutorial_isiubah').summernote("insertImage", url, data);
        },
        error: function(data) {
            console.log(data);
        }
   });
 }


// Fungsi hapus gambar di summernote edit
function deleteImageinfotutorialedit(src) {
    var url = "/information/Tutorialcontroller/deleteGambar";
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
  $('.formModaltambahinfotutorial').submit(function(e) {
      e.preventDefault();

      let data = new FormData(this);
	  
      $.ajax({
          type: "post",
          url: $(this).attr('action'),
          enctype: 'multipart/form-data',
          processData: false,
          contentType: false,
          cache: false,
          data: data,
		  //data: $(this).serialize(),
          dataType: "json",
          beforeSend: function() {
              $('.btnmodaltambahinfotutorial').prop('disabled', true);
              $('.btnmodaltambahinfotutorial').html('<i class="fa fa-spin fa-spinner"></i> Processing');
          },
          complete: function() {
              $('.btnmodaltambahinfotutorial').prop('disabled', false);
              $('.btnmodaltambahinfotutorial').html('Simpan');
          },
          success: function(response) {
                // $('#infotutorial_kategori').val(response.success.kategori);

              if (response.error){
                  if (response.error.infotutorial_judul){
                      $('#infotutorial_judul').addClass('is-invalid');
                      $('.errorInfotutorialJudul').html(response.error.infotutorial_judul);
                  }
                  else
                  {
                      $('#infotutorial_judul').removeClass('is-invalid');
                      $('.errorInfotutorialJudul').html('');
                  }
              }
              else
              {
                  $('#modaltambahinfotutorial').modal('hide');

                  Swal.fire(
                      'Pemberitahuan',
                      response.success.data,
                      'success',
                  ).then(function() {
                      window.location = response.success.link;
                      $("#infotutorial_isi").summernote("code", "");
                      $('#datatable-infotutorial').DataTable().ajax.reload();
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
function editinfotutorial($kode) {
    var url = "/information/tutorialcontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#infotutorial_kodeubah').val(response.success.kode);
            $('#infotutorial_kategoriubah').val(response.success.kategori);
            $('#infotutorial_judulubah').val(response.success.judul);
            $('#infotutorial_subjudulubah').val(response.success.subjudul);
            $("#infotutorial_isiubah").summernote('code', response.success.isi);

            $('#infotutorial_judulubah').removeClass('is-invalid');
            $('.errorInfotutorialJudulubah').html('');

            $('#modalubahinfotutorial').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahinfotutorial').submit(function(e) {
        e.preventDefault();
		
		let data = new FormData(this);
	  
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
			enctype: 'multipart/form-data',
			processData: false,
			contentType: false,
			cache: false,
			data: data,
            //data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahinfotutorial').prop('disabled', true);
                $('.btnmodalubahinfotutorial').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahinfotutorial').prop('disabled', false);
                $('.btnmodalubahinfotutorial').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.infotutorial_judulubah){
                        $('#infotutorial_judulubah').addClass('is-invalid');
                        $('.errorInfotutorialJudulubah').html(response.error.infotutorial_judulubah);
                    }
                    else
                    {
                        $('#infotutorial_judulubah').removeClass('is-invalid');
                        $('.errorInfotutorialJudulubah').html('');
                    }
                }
                else
                {
                    $('#modalubahinfotutorial').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $("#infotutorial_isiubah").summernote("code", "");
                        $('#datatable-infotutorial').DataTable().ajax.reload();
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
function deleteinfotutorial($kode) {
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
          var url =  '/information/tutorialcontroller/hapusdata';

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
                          $('#datatable-infotutorial').DataTable().ajax.reload();
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