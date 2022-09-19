//Datatables server side
$(document).ready( function () {
    var url = '/ultimate/Wtcactioncontroller/ajax_list';
    var table = $('#datatable-ultimatewtcaction').DataTable({ 
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


// Fungsi tampil input summernote di modal add
$('#ultimatewtcaction_descnarration').summernote({
    placeholder: 'Masukkan konten disini ...',
    height: 200,
	callbacks: {
        onImageUpload: function(image) {
            uploadImagewtcact(image[0]);
        },
        onMediaDelete : function(target) {
            deleteImagewtcact(target[0].src);
        }
    }
});


// Fungsi upload gambar di summernote add
function uploadImagewtcact(image) {
    var data = new FormData();
    var url = "/ultimate/Wtcactioncontroller/uploadGambar";
    data.append("image", image);
    $.ajax({
        url: BASE_URL + url,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            $('#ultimatewtcaction_descnarration').summernote("insertImage", url, data);
        },
        error: function(data) {
            console.log(data);
        }
   });
 }


// Fungsi hapus gambar di summernote add
function deleteImagewtcact(src) {
    var url = "/ultimate/Wtcactioncontroller/deleteGambar";
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
$('#ultimatewtcaction_descnarrationubah').summernote({
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
    var url = "/ultimate/Wtcactioncontroller/uploadGambar";
    data.append("image", image);
    $.ajax({
        url: BASE_URL + url,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            $('#ultimatewtcaction_descnarrationubah').summernote("insertImage", url, data);
        },
        error: function(data) {
            console.log(data);
        }
   });
 }


// Fungsi hapus gambar di summernote edit
function deleteImagewtcactedit(src) {
    var url = "/ultimate/Wtcactioncontroller/deleteGambar";
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
function generatekodeultimatewtcaction() {
    var url = "/ultimate/wtcactioncontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#ultimatewtcaction_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahultimatewtcaction').submit(function(e) {
        e.preventDefault();

        let data = new FormData(this);

        $('.ultimatewtcaction_isactive').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('ultimatewtcaction_isactive', 1);
            }
            else
            {
                // alert(0);
                data.append('ultimatewtcaction_isactive', 0);
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
                $('.btnmodaltambahultimatewtcaction').prop('disabled', true);
                $('.btnmodaltambahultimatewtcaction').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahultimatewtcaction').prop('disabled', false);
                $('.btnmodaltambahultimatewtcaction').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.ultimatewtcaction_kode){
                        $('#ultimatewtcaction_kode').addClass('is-invalid');
                        $('.errorultimatewtcactionKode').html(response.error.ultimatewtcaction_kode);
                    }
                    else
                    {
                        $('#ultimatewtcaction_kode').removeClass('is-invalid');
                        $('.errorultimatewtcactionKode').html('');
                    }

                    if (response.error.ultimatewtcaction_stock){
                        $('#ultimatewtcaction_stock').addClass('is-invalid');
                        $('.errorultimatewtcactiontock').html(response.error.ultimatewtcaction_stock);
                    }
                    else
                    {
                        $('#ultimatewtcaction_stock').removeClass('is-invalid');
                        $('.errorultimatewtcactiontock').html('');
                    }

                    if (response.error.ultimatewtcaction_value){
                        $('#ultimatewtcaction_value').addClass('is-invalid');
                        $('.errorultimatewtcactionvalue').html(response.error.ultimatewtcaction_value);
                    }
                    else
                    {
                        $('#ultimatewtcaction_value').removeClass('is-invalid');
                        $('.errorultimatewtcactionvalue').html('');
                    }
					
					if (response.error.ultimatewtcaction_buyprice){
                        $('#ultimatewtcaction_buyprice').addClass('is-invalid');
                        $('.errorultimatewtcactionbuyprice').html(response.error.ultimatewtcaction_buyprice);
                    }
                    else
                    {
                        $('#ultimatewtcaction_buyprice').removeClass('is-invalid');
                        $('.errorultimatewtcactionbuyprice').html('');
                    }

                    if (response.error.ultimatewtcaction_targetprice){
                        $('#ultimatewtcaction_targetprice').addClass('is-invalid');
                        $('.errorultimatewtcactiontargetprice').html(response.error.ultimatewtcaction_targetprice);
                    }
                    else
                    {
                        $('#ultimatewtcaction_targetprice').removeClass('is-invalid');
                        $('.errorultimatewtcactiontargetprice').html('');
                    }

                    if (response.error.ultimatewtcaction_stoploss){
                        $('#ultimatewtcaction_stoploss').addClass('is-invalid');
                        $('.errorultimatewtcactionstoploss').html(response.error.ultimatewtcaction_stoploss);
                    }
                    else
                    {
                        $('#ultimatewtcaction_stoploss').removeClass('is-invalid');
                        $('.errorultimatewtcactionstoploss').html('');
                    }

                    if (response.error.ultimatewtcaction_risk){
                        $('#ultimatewtcaction_risk').addClass('is-invalid');
                        $('.errorultimatewtcactionrisk').html(response.error.ultimatewtcaction_risk);
                    }
                    else
                    {
                        $('#ultimatewtcaction_risk').removeClass('is-invalid');
                        $('.errorultimatewtcactionrisk').html('');
                    }

                    if (response.error.ultimatewtcaction_narration){
                        $('#ultimatewtcaction_narration').addClass('is-invalid');
                        $('.errorultimatewtcactionnarration').html(response.error.ultimatewtcaction_narration);
                    }
                    else
                    {
                        $('#ultimatewtcaction_narration').removeClass('is-invalid');
                        $('.errorultimatewtcactionnarration').html('');
                    }
                }
                else
                {
                    $('#modaltambahultimatewtcaction').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#ultimatewtcaction_stock').val('');
                        $('#ultimatewtcaction_value').val('');
                        $('#ultimatewtcaction_buyprice').val('');
                        $('#ultimatewtcaction_targetprice').val('');
                        $('#ultimatewtcaction_stoploss').val('');
                        $('#ultimatewtcaction_risk').val('');
                        $('#ultimatewtcaction_narration').val('');
						
						$('#ultimatewtcaction_stock').removeClass('is-invalid');
						$('.errorultimatewtcactiontock').html('');
						
						$('#ultimatewtcaction_value').removeClass('is-invalid');
						$('.errorultimatewtcactionvalue').html('');
						
						$('#ultimatewtcaction_buyprice').removeClass('is-invalid');
						$('.errorultimatewtcactionbuyprice').html('');
						
						$('#ultimatewtcaction_targetprice').removeClass('is-invalid');
						$('.errorultimatewtcactiontargetprice').html('');

                        $('#ultimatewtcaction_stoploss').removeClass('is-invalid');
						$('.errorultimatewtcactionstoploss').html('');
						
						$('#ultimatewtcaction_risk').removeClass('is-invalid');
						$('.errorultimatewtcactionrisk').html('');
			
                        $("#ultimatewtcaction_narration").summernote("code", "");
                        $('#datatable-ultimatewtcaction').DataTable().ajax.reload();
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
function editultimatewtcaction($kode) {
    var url = "/ultimate/wtcactioncontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#ultimatewtcaction_kodeubah').val(response.success.kode);
            $('#ultimatewtcaction_stockubah').val(response.success.stock);
            $('#ultimatewtcaction_valueubah').val(response.success.value);
			$('#ultimatewtcaction_buypriceubah').val(response.success.buyprice);
            $('#ultimatewtcaction_targetpriceubah').val(response.success.targetprice);
            $('#ultimatewtcaction_stoplossubah').val(response.success.stoploss);
			$('#ultimatewtcaction_riskubah').val(response.success.risk);
            $('#ultimatewtcaction_narrationubah').val(response.success.narration);
            $("#ultimatewtcaction_descnarrationubah").summernote('code', response.success.desc_narration);

            $('#ultimatewtcaction_actionubah').val(response.success.action);
			
			if (response.success.active == 1)
            {
                $('#ultimatewtcaction_isactiveubah').prop("checked", true);
            }
            else
            {
                $('#ultimatewtcaction_isactiveubah').prop("checked", false);
            }

            $('#ultimatewtcaction_stockubah').removeClass('is-invalid');
            $('.errorultimatewtcactiontockubah').html('');
			
			$('#ultimatewtcaction_valueubah').removeClass('is-invalid');
            $('.errorultimatewtcactionvalueubah').html('');
			
			$('#ultimatewtcaction_buypriceubah').removeClass('is-invalid');
            $('.errorultimatewtcactionbuypriceubah').html('');
			
			$('#ultimatewtcaction_targetpriceubah').removeClass('is-invalid');
            $('.errorultimatewtcactiontargetpriceubah').html('');

            $('#ultimatewtcaction_stoplossubah').removeClass('is-invalid');
            $('.errorultimatewtcactionstoplossubah').html('');
			
			$('#ultimatewtcaction_riskubah').removeClass('is-invalid');
            $('.errorultimatewtcactionriskubah').html('');

            $('#modalubahultimatewtcaction').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahultimatewtcaction').submit(function(e) {
        e.preventDefault();
		
		let data = new FormData(this);

        $('.ultimatewtcaction_isactiveubah').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('ultimatewtcaction_isactiveubah', 1);
            }
            else
            {
                // alert(0);
                data.append('ultimatewtcaction_isactiveubah', 0);
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
                $('.btnmodalubahultimatewtcaction').prop('disabled', true);
                $('.btnmodalubahultimatewtcaction').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahultimatewtcaction').prop('disabled', false);
                $('.btnmodalubahultimatewtcaction').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.ultimatewtcaction_stockubah){
                        $('#ultimatewtcaction_stockubah').addClass('is-invalid');
                        $('.errorultimatewtcactiontockubah').html(response.error.ultimatewtcaction_stockubah);
                    }
                    else
                    {
                        $('#ultimatewtcaction_stockubah').removeClass('is-invalid');
                        $('.errorultimatewtcactiontockubah').html('');
                    }

                    if (response.error.ultimatewtcaction_valueubah){
                        $('#ultimatewtcaction_valueubah').addClass('is-invalid');
                        $('.errorultimatewtcactionvalueubah').html(response.error.ultimatewtcaction_valueubah);
                    }
                    else
                    {
                        $('#ultimatewtcaction_valueubah').removeClass('is-invalid');
                        $('.errorultimatewtcactionvalueubah').html('');
                    }
					
					if (response.error.ultimatewtcaction_buypriceubah){
                        $('#ultimatewtcaction_buypriceubah').addClass('is-invalid');
                        $('.errorultimatewtcactionbuypriceubah').html(response.error.ultimatewtcaction_buypriceubah);
                    }
                    else
                    {
                        $('#ultimatewtcaction_buypriceubah').removeClass('is-invalid');
                        $('.errorultimatewtcactionbuypriceubah').html('');
                    }

                    if (response.error.ultimatewtcaction_targetpriceubah){
                        $('#ultimatewtcaction_targetpriceubah').addClass('is-invalid');
                        $('.errorultimatewtcactiontargetpriceubah').html(response.error.ultimatewtcaction_targetpriceubah);
                    }
                    else
                    {
                        $('#ultimatewtcaction_targetpriceubah').removeClass('is-invalid');
                        $('.errorultimatewtcactiontargetpriceubah').html('');
                    }

                    if (response.error.ultimatewtcaction_stoplossubah){
                        $('#ultimatewtcaction_stoplossubah').addClass('is-invalid');
                        $('.errorultimatewtcactionstoplossubah').html(response.error.ultimatewtcaction_stoplossubah);
                    }
                    else
                    {
                        $('#ultimatewtcaction_stoplossubah').removeClass('is-invalid');
                        $('.errorultimatewtcactionstoplossubah').html('');
                    }
					
					if (response.error.ultimatewtcaction_riskubah){
                        $('#ultimatewtcaction_riskubah').addClass('is-invalid');
                        $('.errorultimatewtcactionriskubah').html(response.error.ultimatewtcaction_riskubah);
                    }
                    else
                    {
                        $('#ultimatewtcaction_riskubah').removeClass('is-invalid');
                        $('.errorultimatewtcactionriskubah').html('');
                    }

                    if (response.error.ultimatewtcaction_narrationubah){
                        $('#ultimatewtcaction_narrationubah').addClass('is-invalid');
                        $('.errorultimatewtcactionnarrationubah').html(response.error.ultimatewtcaction_narrationubah);
                    }
                    else
                    {
                        $('#ultimatewtcaction_narrationubah').removeClass('is-invalid');
                        $('.errorultimatewtcactionnarrationubah').html('');
                    }
                }
                else
                {
					$('#modalubahultimatewtcaction').modal('hide');
					
                    Swal.fire(
                        'Pemberitahuan',
						response.success.data,
                        'success',
						).then(function() {
                            $("#ultimatewtcaction_descnarrationubah").summernote("code", "");
							$('#datatable-ultimatewtcaction').DataTable().ajax.reload();
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
function deleteultimatewtcaction($kode) {
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
            var url =  '/ultimate/wtcactioncontroller/hapusdata';

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
                            $('#datatable-ultimatewtcaction').DataTable().ajax.reload();
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