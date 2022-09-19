
//Datatables server side
$(document).ready( function () {
    var url = '/ultimate/Openposcontroller/ajax_list';
    var table = $('#datatable-ultimateopenpos').DataTable({ 
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

// CKEDITOR.replace('ultimateopenpos_descnarration');
// CKEDITOR.replace('ultimateopenpos_descnarrationubah');


// Fungsi tampil input summernote di modal add
$('#ultimateopenpos_descnarration').summernote({
    placeholder: 'Masukkan konten disini ...',
    height: 200,
	callbacks: {
        onImageUpload: function(image) {
            uploadImageopenposact(image[0]);
        },
        onMediaDelete : function(target) {
            deleteImageopenposact(target[0].src);
        }
    }
});


// Fungsi upload gambar di summernote add
function uploadImageopenposact(image) {
    var data = new FormData();
    var url = "/ultimate/Openposcontroller/uploadGambar";
    data.append("image", image);
    $.ajax({
        url: BASE_URL + url,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            $('#ultimateopenpos_descnarration').summernote("insertImage", url, data);
        },
        error: function(data) {
            console.log(data);
        }
   });
 }


// Fungsi hapus gambar di summernote add
function deleteImageopenposact(src) {
    var url = "/ultimate/Openposcontroller/deleteGambar";
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
$('#ultimateopenpos_descnarrationubah').summernote({
    placeholder: 'Masukkan konten disini ...',
    height: 200,
	callbacks: {
       onImageUpload: function(image) {
		   editor = $(this);
           uploadImagewtcactedit(image[0], editor);
       },
       onMediaDelete : function(target) {
        deleteImagewtcactedit(target[0].src);
       }
    }
  });


// Fungsi upload gambar di summernote edit
function uploadImagewtcactedit(image) {
    var data = new FormData();
    var url = "/ultimate/Openposcontroller/uploadGambar";
    data.append("image", image);
    $.ajax({
        url: BASE_URL + url,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            $('#ultimateopenpos_descnarrationubah').summernote("insertImage", url, data);
        },
        error: function(data) {
            console.log(data);
        }
   });
 }


// Fungsi hapus gambar di summernote edit
function deleteImagewtcactedit(src) {
    var url = "/ultimate/Openposcontroller/deleteGambar";
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
function generatekodeultimateopenpos() {
    var url = "/ultimate/openposcontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#ultimateopenpos_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahultimateopenpos').submit(function(e) {
        e.preventDefault();

        let data = new FormData(this);

        // data.append('ultimateopenpos_descnarration', CKEDITOR.instances.ultimateopenpos_descnarration.getData());

        $('.ultimateopenpos_isactive').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('ultimateopenpos_isactive', 1);
            }
            else
            {
                // alert(0);
                data.append('ultimateopenpos_isactive', 0);
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
                $('.btnmodaltambahultimateopenpos').prop('disabled', true);
                $('.btnmodaltambahultimateopenpos').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahultimateopenpos').prop('disabled', false);
                $('.btnmodaltambahultimateopenpos').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.ultimateopenpos_kode){
                        $('#ultimateopenpos_kode').addClass('is-invalid');
                        $('.errorultimateopenposKode').html(response.error.ultimateopenpos_kode);
                    }
                    else
                    {
                        $('#ultimateopenpos_kode').removeClass('is-invalid');
                        $('.errorultimateopenposKode').html('');
                    }

                    if (response.error.ultimateopenpos_stock){
                        $('#ultimateopenpos_stock').addClass('is-invalid');
                        $('.errorultimateopenposstock').html(response.error.ultimateopenpos_stock);
                    }
                    else
                    {
                        $('#ultimateopenpos_stock').removeClass('is-invalid');
                        $('.errorultimateopenposstock').html('');
                    }

                    if (response.error.ultimateopenpos_buydate){
                        $('#ultimateopenpos_buydate').addClass('is-invalid');
                        $('.errorultimateopenposbuydate').html(response.error.ultimateopenpos_buydate);
                    }
                    else
                    {
                        $('#ultimateopenpos_buydate').removeClass('is-invalid');
                        $('.errorultimateopenposbuydate').html('');
                    }
					
					if (response.error.ultimateopenpos_buyprice){
                        $('#ultimateopenpos_buyprice').addClass('is-invalid');
                        $('.errorultimateopenposbuyprice').html(response.error.ultimateopenpos_buyprice);
                    }
                    else
                    {
                        $('#ultimateopenpos_buyprice').removeClass('is-invalid');
                        $('.errorultimateopenposbuyprice').html('');
                    }

                    if (response.error.ultimateopenpos_targetprice){
                        $('#ultimateopenpos_targetprice').addClass('is-invalid');
                        $('.errorultimateopenpostargetprice').html(response.error.ultimateopenpos_targetprice);
                    }
                    else
                    {
                        $('#ultimateopenpos_targetprice').removeClass('is-invalid');
                        $('.errorultimateopenpostargetprice').html('');
                    }

                    if (response.error.ultimateopenpos_lastprice){
                        $('#ultimateopenpos_lastprice').addClass('is-invalid');
                        $('.errorultimateopenposlastprice').html(response.error.ultimateopenpos_lastprice);
                    }
                    else
                    {
                        $('#ultimateopenpos_lastprice').removeClass('is-invalid');
                        $('.errorultimateopenposlastprice').html('');
                    }

                    if (response.error.ultimateopenpos_lostprofit){
                        $('#ultimateopenpos_lostprofit').addClass('is-invalid');
                        $('.errorultimateopenposlostprofit').html(response.error.ultimateopenpos_lostprofit);
                    }
                    else
                    {
                        $('#ultimateopenpos_lostprofit').removeClass('is-invalid');
                        $('.errorultimateopenposlostprofit').html('');
                    }

                    if (response.error.ultimateopenpos_narration){
                        $('#ultimateopenpos_narration').addClass('is-invalid');
                        $('.errorultimateopenposnarration').html(response.error.ultimateopenpos_narration);
                    }
                    else
                    {
                        $('#ultimateopenpos_narration').removeClass('is-invalid');
                        $('.errorultimateopenposnarration').html('');
                    }

                    if (response.error.ultimateopenpos_gambar) {
                        $('#ultimateopenpos_gambar').addClass('is-invalid');
                        $('.errorultimateopenposGambar').html(response.error.ultimateopenpos_gambar);
                    } else {
                        $('#ultimateopenpos_gambar').removeClass('is-invalid');
                        $('.errorultimateopenposGambar').html('');
                    }

                    if (response.error.ultimateopenpos_stoploss){
                        $('#ultimateopenpos_stoploss').addClass('is-invalid');
                        $('.errorultimateopenposstoploss').html(response.error.ultimateopenpos_stoploss);
                    }
                    else
                    {
                        $('#ultimateopenpos_stoploss').removeClass('is-invalid');
                        $('.errorultimateopenposstoploss').html('');
                    }
                }
                else
                {
                    $('#modaltambahultimateopenpos').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#ultimateopenpos_kode').val('');
                        $('#ultimateopenpos_stock').val('');
                        $('#ultimateopenpos_buyprice').val('');
                        $('#ultimateopenpos_targetprice').val('');
                        $('#ultimateopenpos_lastprice').val('');
                        $('#ultimateopenpos_lostprofit').val('');
                        $('#ultimateopenpos_narration').val('');
                        $('#ultimateopenpos_stoploss').val('');
						
						$('#ultimateopenpos_kode').removeClass('is-invalid');
						$('.errorultimateopenposKode').html('');
						
						$('#ultimateopenpos_stock').removeClass('is-invalid');
						$('.errorultimateopenposstock').html('');
						
						$('#ultimateopenpos_buyprice').removeClass('is-invalid');
						$('.errorultimateopenposbuyprice').html('');
						
						$('#ultimateopenpos_targetprice').removeClass('is-invalid');
						$('.errorultimateopenpostargetprice').html('');

                        $('#ultimateopenpos_lastprice').removeClass('is-invalid');
						$('.errorultimateopenposlastprice').html('');
						
						$('#ultimateopenpos_lostprofit').removeClass('is-invalid');
						$('.errorultimateopenposlostprofit').html('');
						
						$('#ultimateopenpos_narration').removeClass('is-invalid');
						$('.errorultimateopenposnarration').html('');

                        $('#ultimateopenpos_stoploss').removeClass('is-invalid');
						$('.errorultimateopenposstoploss').html('');
			
                        $('#datatable-ultimateopenpos').DataTable().ajax.reload();
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
});

//Fungsi select image
function changeimgultimateopenpos($kode) {
    var url = "/ultimate/openposcontroller/pilihgambar";
    var location = "/public/assets/img/openposition/";

    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function (response) {
            var imgloc = BASE_URL + location + response.success.gambar;
            $('#ultimateopenpos_kodeubahgambar').val(response.success.kode);
            $('#ultimateopenpos_stockdetailgambar').val(response.success.stock);
            $('#ultimateopenpos_editimg').attr("href", imgloc);
        
            $('#ultimateopenpos_editgambarubah').removeClass('is-invalid');
            $('.errorultimateopenposeditGambarubah').html('');

            $('#modalubahgambarultimateopenpos').modal('show');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update gambar
$(document).ready(function () {
    $('.formModalubahgambarultimateopenpos').submit(function (e) {
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
            beforeSend: function () {
                $('.btnmodalubahgambarultimateopenpos').prop('disabled', true);
                $('.btnmodalubahgambarultimateopenpos').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function () {
                $('.btnmodalubahgambarultimateopenpos').prop('disabled', false);
                $('.btnmodalubahgambarultimateopenpos').html('Ubah');
            },
            success: function (response) {
                if (response.error) {
                    if (response.error.infobursaemiten_editgambarubah) {
                        $('#ultimateopenpos_editgambarubah').addClass('is-invalid');
                        $('.errorultimateopenposeditGambarubah').html(response.error.ultimateopenpos_editgambarubah);
                    } else {
                        $('#ultimateopenpos_editgambarubah').removeClass('is-invalid');
                        $('.errorultimateopenposeditGambarubah').html('');
                    }
                } else {
                    $('#modalubahgambarultimateopenpos').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function () {
                        window.location = response.success.link;
                        //$('#datatable-infobursaemiten').DataTable().ajax.reload();
                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });

        return false;
    });
});

//Fungsi select data 
function editultimateopenpos($kode) {
    var url = "/ultimate/openposcontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#ultimateopenpos_kodeubah').val(response.success.kode);
            $('#ultimateopenpos_stockubah').val(response.success.stock);
            $('#ultimateopenpos_buydateubah').val(response.success.buydate);
			$('#ultimateopenpos_buypriceubah').val(response.success.buyprice);
            $('#ultimateopenpos_targetpriceubah').val(response.success.targetprice);
            $('#ultimateopenpos_lastpriceubah').val(response.success.lastprice);
			$('#ultimateopenpos_lostprofitubah').val(response.success.lossprofit);
            $('#ultimateopenpos_narrationubah').val(response.success.narration);
            // CKEDITOR.instances.ultimateopenpos_descnarrationubah.setData(response.success.desc_narration);
            $("#ultimateopenpos_descnarrationubah").summernote('code', response.success.desc_narration);

            $('#ultimateopenpos_stoplossubah').val(response.success.stoploss);
			
			if (response.success.active == 1)
            {
                $('#ultimateopenpos_isactiveubah').prop("checked", true);
            }
            else
            {
                $('#ultimateopenpos_isactiveubah').prop("checked", false);
            }

            $('#ultimateopenpos_stockubah').removeClass('is-invalid');
            $('.errorultimateopenposstockubah').html('');
			
			$('#ultimateopenpos_buydateubah').removeClass('is-invalid');
            $('.errorultimateopenposbuydateubah').html('');
			
			$('#ultimateopenpos_buypriceubah').removeClass('is-invalid');
            $('.errorultimateopenposbuypriceubah').html('');
			
			$('#ultimateopenpos_targetpriceubah').removeClass('is-invalid');
            $('.errorultimateopenpostargetpriceubah').html('');

            $('#ultimateopenpos_lastpriceubah').removeClass('is-invalid');
            $('.errorultimateopenposlastpriceubah').html('');
			
			$('#ultimateopenpos_lostprofitubah').removeClass('is-invalid');
            $('.errorultimateopenposlostprofitubah').html('');
			
			$('#ultimateopenpos_narrationubah').removeClass('is-invalid');
            $('.errorultimateopenposnarrationubah').html('');

            $('#ultimateopenpos_stoplossubah').removeClass('is-invalid');
            $('.errorultimateopenposstoplossubah').html('');

            $('#modalubahultimateopenpos').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahultimateopenpos').submit(function(e) {
        e.preventDefault();
		
		let data = new FormData(this);

        // data.append('ultimateopenpos_descnarrationubah', CKEDITOR.instances.ultimateopenpos_descnarrationubah.getData());

        $('.ultimateopenpos_isactiveubah').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('ultimateopenpos_isactiveubah', 1);
            }
            else
            {
                // alert(0);
                data.append('ultimateopenpos_isactiveubah', 0);
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
                $('.btnmodalubahultimateopenpos').prop('disabled', true);
                $('.btnmodalubahultimateopenpos').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahultimateopenpos').prop('disabled', false);
                $('.btnmodalubahultimateopenpos').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.ultimateopenpos_stockubah){
                        $('#ultimateopenpos_stockubah').addClass('is-invalid');
                        $('.errorultimateopenposstockubah').html(response.error.ultimateopenpos_stockubah);
                    }
                    else
                    {
                        $('#ultimateopenpos_stockubah').removeClass('is-invalid');
                        $('.errorultimateopenposstockubah').html('');
                    }

                    if (response.error.ultimateopenpos_buydateubah){
                        $('#ultimateopenpos_buydateubah').addClass('is-invalid');
                        $('.errorultimateopenposbuydateubah').html(response.error.ultimateopenpos_buydateubah);
                    }
                    else
                    {
                        $('#ultimateopenpos_buydateubah').removeClass('is-invalid');
                        $('.errorultimateopenposbuydateubah').html('');
                    }
					
					if (response.error.ultimateopenpos_buypriceubah){
                        $('#ultimatewtcdata_buypriceubah').addClass('is-invalid');
                        $('.errorultimateopenposbuypriceubah').html(response.error.ultimateopenpos_buypriceubah);
                    }
                    else
                    {
                        $('#ultimateopenpos_buypriceubah').removeClass('is-invalid');
                        $('.errorultimateopenposbuypriceubah').html('');
                    }

                    if (response.error.ultimateopenpos_targetpriceubah){
                        $('#ultimateopenpos_targetpriceubah').addClass('is-invalid');
                        $('.errorultimateopenpostargetpriceubah').html(response.error.ultimateopenpos_targetpriceubah);
                    }
                    else
                    {
                        $('#ultimateopenpos_targetpriceubah').removeClass('is-invalid');
                        $('.errorultimateopenpostargetpriceubah').html('');
                    }

                    if (response.error.ultimateopenpos_lastpriceubah){
                        $('#ultimateopenpos_lastpriceubah').addClass('is-invalid');
                        $('.errorultimateopenposlastpriceubah').html(response.error.ultimateopenpos_lastpriceubah);
                    }
                    else
                    {
                        $('#ultimateopenpos_lastpriceubah').removeClass('is-invalid');
                        $('.errorultimateopenposlastpriceubah').html('');
                    }
					
					if (response.error.ultimateopenpos_lostprofitubah){
                        $('#ultimateopenpos_lostprofitubah').addClass('is-invalid');
                        $('.errorultimateopenposlostprofitubah').html(response.error.ultimateopenpos_lostprofitubah);
                    }
                    else
                    {
                        $('#ultimateopenpos_lostprofitubah').removeClass('is-invalid');
                        $('.errorultimateopenposlostprofitubah').html('');
                    }

                    if (response.error.ultimateopenpos_narrationubah){
                        $('#ultimateopenpos_narrationubah').addClass('is-invalid');
                        $('.errorultimateopenposnarrationubah').html(response.error.ultimateopenpos_narrationubah);
                    }
                    else
                    {
                        $('#ultimateopenpos_narrationubah').removeClass('is-invalid');
                        $('.errorultimateopenposnarrationubah').html('');
                    }

                    if (response.error.ultimateopenpos_stoplossubah){
                        $('#ultimateopenpos_stoplossubah').addClass('is-invalid');
                        $('.errorultimateopenposstoplossubah').html(response.error.ultimateopenpos_stoplossubah);
                    }
                    else
                    {
                        $('#ultimateopenpos_stoplossubah').removeClass('is-invalid');
                        $('.errorultimateopenposstoplossubah').html('');
                    }
                }
                else
                {
					$('#modalubahultimateopenpos').modal('hide');
					
                    Swal.fire(
                        'Pemberitahuan',
						response.success.data,
                        'success',
						).then(function() {
                            $("#ultimateopenpos_descnarrationubah").summernote("code", "");
							$('#datatable-ultimateopenpos').DataTable().ajax.reload();
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
function deleteultimateopenpos($kode) {
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
            var url =  '/ultimate/openposcontroller/hapusdata';

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
                            $('#datatable-ultimateopenpos').DataTable().ajax.reload();
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