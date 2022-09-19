//Datatables server side
$(document).ready( function () {
    var url = '/information/newscontroller/ajax_list';
    var table = $('#datatable-infonews').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        drawCallback: function (settings, json) {
            $('[data-toggle="tooltip"]').tooltip('update');
        },
        "ajax": {
            "url": BASE_URL + url,
            "type": "POST"
        },
        //optional
        "lengthMenu": [10, 25, 50, 100, 250, 500],
        "columnDefs": [
            { 
                "width": '100',
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

    $('[data-toggle="tooltip"]').tooltip();


});

// CKEDITOR.replace('infonews_isi');
// CKEDITOR.replace('infonews_isiubah');

//Fungsi generate kode
function generatekodeinfonews() {
  var url = "/information/newscontroller/getdata";
  $.ajax({
      url: BASE_URL + url,
      dataType: "JSON",
      success: function(response) {
          $('#infonews_kode').val(response.kodegen);
      },
      error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
  });
}


// Fungsi tampil input summernote di modal add
$('#infonews_isi').summernote({
    placeholder: 'Masukkan konten disini ...',
    height: 200,
	callbacks: {
        onImageUpload: function(image) {
            uploadImageinfonews(image[0]);
        },
        onMediaDelete : function(target) {
            deleteImageinfonews(target[0].src);
        }
    }
});


// Fungsi upload gambar di summernote add
function uploadImageinfonews(image) {
    var data = new FormData();
    var url = "/information/newscontroller/uploadGambar";
    data.append("image", image);
    $.ajax({
        url: BASE_URL + url,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            $('#infonews_isi').summernote("insertImage", url, data);
        },
        error: function(data) {
            console.log(data);
        }
   });
 }


// Fungsi hapus gambar di summernote add
function deleteImageinfonews(src) {
    var url = "/information/newscontroller/deleteGambar";
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
$('#infonews_isiubah').summernote({
    placeholder: 'Masukkan konten disini ...',
    height: 200,
	callbacks: {
       onImageUpload: function(image) {
		   editor = $(this);
           uploadImageinfonewsedit(image[0], editor);
       },
       onMediaDelete : function(target) {
        deleteImageinfonewsedit(target[0].src);
       }
    }
  });


// Fungsi upload gambar di summernote edit
function uploadImageinfonewsedit(image) {
    var data = new FormData();
    var url = "/information/newscontroller/uploadGambar";
    data.append("image", image);
    $.ajax({
        url: BASE_URL + url,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            $('#infonews_isiubah').summernote("insertImage", url, data);
        },
        error: function(data) {
            console.log(data);
        }
   });
 }


// Fungsi hapus gambar di summernote edit
function deleteImageinfonewsedit(src) {
    var url = "/information/newscontroller/deleteGambar";
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
 // $("#chooseKategoriPengumuman").hide();
  $('#infonews_jenispengumuman').on('change',function(){
	   var url = "/information/newscontroller/filterJenis";
	   var kode = $('#infonews_jenispengumuman :selected').val();
	   
	   $.ajax({
           type: "POST",
           url: BASE_URL + url,
           data: {
			  kode: kode,
		   },
           success:function(data){
			  $("#infonews_kategoripengumuman").empty();
			  $.each(JSON.parse(data.trim()), function(index, item) { 
				//console.log("Agent Id: " + item.kode_kategori_pengumuman);
				//console.log("Agent Name: " + item.nama_kategori_pengumuman);
				var id = item.kode_kategori_pengumuman;
                var name = item.nama_kategori_pengumuman;
				$("#infonews_kategoripengumuman").append("<option value='"+id+"'>"+name+"</option>");
			  });
			//  $("#chooseKategoriPengumuman").show();
		   },
	   });
  });
  
  $('.formModaltambahinfonews').submit(function(e) {
      e.preventDefault();

      let data = new FormData(this);
	//   data.append('infonews_isi', CKEDITOR.instances.infonews_isi.getData());

    $('.infonews_isactive').each(function() {
        if ($(this).is(":checked"))
        {
            data.append('infonews_isactive', 1);
        }
        else
        {
            data.append('infonews_isactive', 0);
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
              $('.btnmodaltambahinfonews').prop('disabled', true);
              $('.btnmodaltambahinfonews').html('<i class="fa fa-spin fa-spinner"></i> Processing');
          },
          complete: function() {
              $('.btnmodaltambahinfonews').prop('disabled', false);
              $('.btnmodaltambahinfonews').html('Simpan');
          },
          success: function(response) {
              if (response.error){
                  if (response.error.infonews_kode){
                      $('#infonews_kode').addClass('is-invalid');
                      $('.errorInfonewsKode').html(response.error.infonews_kode);
                  }
                  else
                  {
                      $('#infonews_kode').removeClass('is-invalid');
                      $('.errorInfonewsKode').html('');
                  }

                  if (response.error.infonews_judul){
                      $('#infonews_judul').addClass('is-invalid');
                      $('.errorInfonewsJudul').html(response.error.infonews_judul);
                  }
                  else
                  {
                      $('#infonews_judul').removeClass('is-invalid');
                      $('.errorInfonewsJudul').html('');
                  }

                //   if (response.error.infonews_gambar){
                //       $('#infonews_gambar').addClass('is-invalid');
                //       $('.errorInfonewsGambar').html(response.error.infonews_gambar);
                //   }
                //   else
                //   {
                //       $('#infonews_gambar').removeClass('is-invalid');
                //       $('.errorInfonewsGambar').html('');
                //   }

                  if (response.error.infonews_cover){
                      $('#infonews_cover').addClass('is-invalid');
                      $('.errorInfonewsCover').html(response.error.infonews_cover);
                  }
                  else
                  {
                      $('#infonews_cover').removeClass('is-invalid');
                      $('.errorInfonewsCover').html('');
                  }
              }
              else
              {
                  $('#modaltambahinfonews').modal('hide');

                  Swal.fire(
                      'Pemberitahuan',
                      response.success.data,
                      'success',
                  ).then(function() {
                      window.location = response.success.link;
                      // refreshTable();
                      $('#infonews_judul').val('');
                      $('#datatable-infonews').DataTable().ajax.reload();
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
function editinfonews($kode) {
    var url = "/information/newscontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#infonews_kodeubah').val(response.success.kode);
            $('#infonews_jenispengumumanubah').val(response.success.kode_jenis);
            $('#infonews_kategoripengumumanubah').val(response.success.kode_kategori);
            $('#infonews_statuspengumumanubah').val(response.success.status);
            $('#infonews_judulubah').val(response.success.judul);
            $('#infonews_isactiveubah').val(response.success.active);
            $('#infonews_statusnotifubah').val(response.success.status_notif);
            $("#infonews_isiubah").summernote('code', response.success.isi); 
            // CKEDITOR.instances.infonews_isiubah.setData(response.success.isi); 

            let nilaiAktif =  $('#infonews_isactiveubah').val(); 

            if ((nilaiAktif) == 0) {
                $('#infonews_isactiveubah').prop('checked', false);
            } else if ((nilaiAktif) == 1) {
                $('#infonews_isactiveubah').prop('checked', true);
            } else {
                $('#infonews_isactiveubah').prop('checked', false);
            }

            $('#infonews_judulubah').removeClass('is-invalid');
            $('.errorInfonewsJudulubah').html('');

            $('#modalubahinfonews').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
	
	$('#infonews_jenispengumumanubah').on('change',function(){
	   var url = "/information/newscontroller/filterJenis";
	   var kode = $('#infonews_jenispengumumanubah :selected').val();
	   
	   $.ajax({
           type: "POST",
           url: BASE_URL + url,
           data: {
			  kode: kode,
		   },
           success:function(data){
			  $("#infonews_kategoripengumumanubah").empty();
			  $.each(JSON.parse(data.trim()), function(index, item) { 
				//console.log("Agent Id: " + item.kode_kategori_pengumuman);
				//console.log("Agent Name: " + item.nama_kategori_pengumuman);
				var id = item.kode_kategori_pengumuman;
                var name = item.nama_kategori_pengumuman;
				$("#infonews_kategoripengumumanubah").append("<option value='"+id+"'>"+name+"</option>");
			  });
			//  $("#chooseKategoriPengumuman").show();
		   },
	   });
	});
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahinfonews').submit(function(e) {
        e.preventDefault();
		
		let data = new FormData(this);
            // data.append('infonews_isiubah', CKEDITOR.instances.infonews_isiubah.getData());

        $('.infonews_isactiveubah').each(function() {
            if ($(this).is(":checked"))
            {
                data.append('infonews_isactiveubah', 1);
            }
            else
            {
                data.append('infonews_isactiveubah', 0);
            }
        });
		
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            //data: $(this).serialize(),
			enctype: 'multipart/form-data',
			processData: false,
			contentType: false,
			cache: false,
			data: data,
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahinfonews').prop('disabled', true);
                $('.btnmodalubahinfonews').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahinfonews').prop('disabled', false);
                $('.btnmodalubahinfonews').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.infonews_judulubah){
                        $('#infonews_judulubah').addClass('is-invalid');
                        $('.errorInfonewsJudulubah').html(response.error.infonews_judulubah);
                    }
                    else
                    {
                        $('#infonews_judulubah').removeClass('is-invalid');
                        $('.errorInfonewsJudulubah').html('');
                    }

                    // if (response.error.infonews_gambarubah){
                    //     $('#infonews_gambarubah').addClass('is-invalid');
                    //     $('.errorInfonewsGambarubah').html(response.error.infonews_gambarubah);
                    // }
                    // else
                    // {
                    //     $('#infonews_gambarubah').removeClass('is-invalid');
                    //     $('.errorInfonewsGambarubah').html('');
                    // }
                }
                else
                {
                    $('#modalubahinfonews').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $("#infonews_isiubah").summernote("code", "");
                        $('#datatable-infonews').DataTable().ajax.reload();
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

//Fungsi tampil gambar
function changeimginfonews($kode) {
    var url = "/information/newscontroller/pilihgambar";
    var location = "/public/assets/img/news/";
	//var location = "/writable/uploads/";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            var imgloc = BASE_URL + location + response.success.gambar;
            $('#infonews_editkodeubah').val(response.success.kode);
            $('#infonews_editimg').attr("src", imgloc);

            $('#infonews_editgambarubah').removeClass('is-invalid');
            $('.errorInfonewseditGambarubah').html('');

            $('#modalubahgambarinfonews').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update gambar berita
$(document).ready(function() {
    $('.formModalubahgambarinfonews').submit(function(e) {
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
                $('.btnmodalubahgambarinfonews').prop('disabled', true);
                $('.btnmodalubahgambarinfonews').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahgambarinfonews').prop('disabled', false);
                $('.btnmodalubahgambarinfonews').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.infonews_editgambarubah){
                        $('#infonews_editgambarubah').addClass('is-invalid');
                        $('.errorInfonewseditGambarubah').html(response.error.infonews_editgambarubah);
                    }
                    else
                    {
                        $('#infonews_editgambarubah').removeClass('is-invalid');
                        $('.errorInfonewseditGambarubah').html('');
                    }
                }
                else
                {
                    $('#modalubahgambarinfonews').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
						window.location = response.success.link;
                        //$('#datatable-infonews').DataTable().ajax.reload();
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

//Fungsi tampil cover
function changecoverinfonews($kode) {
    var url = "/information/newscontroller/pilihcover";
    var location = "/public/assets/img/news_cms/";
	//var location = "/writable/uploads/";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            var imgloc = BASE_URL + location + response.success.cover;
            $('#infonews_editkodeubahcover').val(response.success.kode);
            $('#infonews_editcovershow').attr("src", imgloc);

            $('#infonews_editcoverubah').removeClass('is-invalid');
            $('.errorInfonewseditCoverubah').html('');

            $('#modalubahcoverinfonews').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update cover berita
$(document).ready(function() {
    $('.formModalubahcoverinfonews').submit(function(e) {
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
                $('.btnmodalubahcoverinfonews').prop('disabled', true);
                $('.btnmodalubahcoverinfonews').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahcoverinfonews').prop('disabled', false);
                $('.btnmodalubahcoverinfonews').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.infonews_editcoverubah){
                        $('#infonews_editcoverubah').addClass('is-invalid');
                        $('.errorInfonewseditCoverubah').html(response.error.infonews_editcoverubah);
                    }
                    else
                    {
                        $('#infonews_editcoverubah').removeClass('is-invalid');
                        $('.errorInfonewseditCoverubah').html('');
                    }
                }
                else
                {
                    $('#modalubahcoverinfonews').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
						window.location = response.success.link;
                        //$('#datatable-infonews').DataTable().ajax.reload();
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
function deleteinfonews($kode) {
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
          var url =  '/information/newscontroller/hapusdata';

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
                          $('#datatable-infonews').DataTable().ajax.reload();
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