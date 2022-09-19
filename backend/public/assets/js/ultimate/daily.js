//Datatables server side
$(document).ready( function () {
    var url = '/ultimate/Dailycontroller/ajax_list';
    var table = $('#datatable-ultimatedaily').DataTable({ 
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
function generatekodeultimatedaily() {
    var url = "/ultimate/dailycontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#ultimatedaily_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahultimatedaily').submit(function(e) {
        e.preventDefault();

        let data = new FormData(this);

        $('.ultimatedaily_isactive').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('ultimatedaily_isactive', 1);
            }
            else
            {
                // alert(0);
                data.append('ultimatedaily_isactive', 0);
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
                $('.btnmodaltambahultimatedaily').prop('disabled', true);
                $('.btnmodaltambahultimatedaily').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahultimatedaily').prop('disabled', false);
                $('.btnmodaltambahultimatedaily').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.ultimatedaily_kode){
                        $('#ultimatedaily_kode').addClass('is-invalid');
                        $('.errorultimatedailyKode').html(response.error.ultimatedaily_kode);
                    }
                    else
                    {
                        $('#ultimatedaily_kode').removeClass('is-invalid');
                        $('.errorultimatedailyKode').html('');
                    }

                    if (response.error.ultimatedaily_stock){
                        $('#ultimatedaily_stock').addClass('is-invalid');
                        $('.errorultimatedailystock').html(response.error.ultimatedaily_stock);
                    }
                    else
                    {
                        $('#ultimatedaily_stock').removeClass('is-invalid');
                        $('.errorultimatedailystock').html('');
                    }

                    if (response.error.ultimatedaily_buydate){
                        $('#ultimatedaily_buydate').addClass('is-invalid');
                        $('.errorultimatedailybuydate').html(response.error.ultimatedaily_buydate);
                    }
                    else
                    {
                        $('#ultimatedaily_buydate').removeClass('is-invalid');
                        $('.errorultimatedailybuydate').html('');
                    }

                    if (response.error.ultimatedaily_buyprice){
                        $('#ultimatedaily_buyprice').addClass('is-invalid');
                        $('.errorultimatedailybuyprice').html(response.error.ultimatedaily_buyprice);
                    }
                    else
                    {
                        $('#ultimatedaily_buyprice').removeClass('is-invalid');
                        $('.errorultimatedailybuyprice').html('');
                    }


                    if (response.error.ultimatedaily_closed){
                        $('#ultimatedaily_closed').addClass('is-invalid');
                        $('.errorultimatedailyclosed').html(response.error.ultimatedaily_closed);
                    }
                    else
                    {
                        $('#ultimatedaily_closed').removeClass('is-invalid');
                        $('.errorultimatedailyclosed').html('');
                    }

                    if (response.error.ultimatedaily_gainloss){
                        $('#ultimatedaily_gainloss').addClass('is-invalid');
                        $('.errorultimatedailygainloss').html(response.error.ultimatedaily_gainloss);
                    }
                    else
                    {
                        $('#ultimatedaily_gainloss').removeClass('is-invalid');
                        $('.errorultimatedailygainloss').html('');
                    }

                    if (response.error.ultimatedaily_areabeli){
                        $('#ultimatedaily_areabeli').addClass('is-invalid');
                        $('.errorultimatedailyareabeli').html(response.error.ultimatedaily_areabeli);
                    }
                    else
                    {
                        $('#ultimatedaily_areabeli').removeClass('is-invalid');
                        $('.errorultimatedailyareabeli').html('');
                    }
					
					if (response.error.ultimatedaily_areajual){
                        $('#ultimatedaily_areajual').addClass('is-invalid');
                        $('.errorultimatedailyareajual').html(response.error.ultimatedaily_areajual);
                    }
                    else
                    {
                        $('#ultimatedaily_areajual').removeClass('is-invalid');
                        $('.errorultimatedailyareajual').html('');
                    }

                    if (response.error.ultimatedaily_stoploss){
                        $('#ultimatedaily_stoploss').addClass('is-invalid');
                        $('.errorultimatedailystoploss').html(response.error.ultimatedaily_stoploss);
                    }
                    else
                    {
                        $('#ultimatedaily_stoploss').removeClass('is-invalid');
                        $('.errorultimatedailystoploss').html('');
                    }

                    
                    if (response.error.ultimatedaily_jaraksl){
                        $('#ultimatedaily_jaraksl').addClass('is-invalid');
                        $('.errorultimatedailyjaraksl').html(response.error.ultimatedaily_jaraksl);
                    }
                    else
                    {
                        $('#ultimatedaily_jaraksl').removeClass('is-invalid');
                        $('.errorultimatedailyjaraksl').html('');
                    }
                }
                else
                {
                    $('#modaltambahultimatedaily').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#ultimatedaily_stock').val('');
                        $('#ultimatedaily_buydate').val('');
                        $('#ultimatedaily_buyprice').val('');
                        $('#ultimatedaily_closed').val('');
                        $('#ultimatedaily_gainloss').val('');
                        $('#ultimatedaily_areabeli').val('');
                        $('#ultimatedaily_areajual').val('');
                        $('#ultimatedaily_stoploss').val('');
                        $('#ultimatedaily_jaraksl').val('');
						
						$('#ultimatedaily_stock').removeClass('is-invalid');
						$('.errorultimatedailystock').html('');

                        $('#ultimatedaily_buydate').removeClass('is-invalid');
						$('.errorultimatedailybuydate').html('');

                        $('#ultimatedaily_buyprice').removeClass('is-invalid');
						$('.errorultimatedailybuyprice').html('');

                        $('#ultimatedaily_closed').removeClass('is-invalid');
						$('.errorultimatedailyclosed').html('');

                        $('#ultimatedaily_gainloss').removeClass('is-invalid');
						$('.errorultimatedailygainloss').html('');
						
						$('#ultimatedaily_areabeli').removeClass('is-invalid');
						$('.errorultimatedailyareabeli').html('');
						
						$('#ultimatedaily_areajual').removeClass('is-invalid');
						$('.errorultimatedailyareajual').html('');
						
						$('#ultimatedaily_stoploss').removeClass('is-invalid');
						$('.errorultimatedailystoploss').html('');

                        $('#ultimatedaily_jaraksl').removeClass('is-invalid');
						$('.errorultimatedailyjaraksl').html('');
			
                        $('#datatable-ultimatedaily').DataTable().ajax.reload();
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
function editultimatedaily($kode) {
    var url = "/ultimate/dailycontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#ultimatedaily_kodeubah').val(response.success.kode);
            $('#ultimatedaily_stockubah').val(response.success.stock);
            $('#ultimatedaily_buydateubah').val(response.success.buydate);
            $('#ultimatedaily_buypriceubah').val(response.success.buyprice);
            $('#ultimatedaily_closedubah').val(response.success.closed);
            $('#ultimatedaily_gainlossubah').val(response.success.gainloss);
            $('#ultimatedaily_areabeliubah').val(response.success.areabeli);
			$('#ultimatedaily_areajualubah').val(response.success.areajual);
            $('#ultimatedaily_stoplossubah').val(response.success.stoploss);
            $('#ultimatedaily_jarakslubah').val(response.success.jaraksl);
			
			if (response.success.active == 1) {
                $('#ultimatedaily_isactiveubah').prop("checked", true);
            } else {
                $('#ultimatedaily_isactiveubah').prop("checked", false);
            }

            $('#ultimatedaily_stockubah').removeClass('is-invalid');
            $('.errorultimatedailystockubah').html('');

            $('#ultimatedaily_buydateubah').removeClass('is-invalid');
            $('.errorultimatedailybuydateubah').html('');

            $('#ultimatedaily_buypriceubah').removeClass('is-invalid');
            $('.errorultimatedailybuypriceubah').html('');

            $('#ultimatedaily_closedubah').removeClass('is-invalid');
            $('.errorultimatedailyclosedubah').html('');

            $('#ultimatedaily_gainlossubah').removeClass('is-invalid');
            $('.errorultimatedailygainlossubah').html('');
			
			$('#ultimatedaily_areabeliubah').removeClass('is-invalid');
            $('.errorultimatedailyareabeliubah').html('');
			
			$('#ultimatedaily_areajualubah').removeClass('is-invalid');
            $('.errorultimatedailyareajualubah').html('');
			
			$('#ultimatedaily_stoplossubah').removeClass('is-invalid');
            $('.errorultimatedailystoplossubah').html('');

            $('#ultimatedaily_jarakslubah').removeClass('is-invalid');
            $('.errorultimatedailyjarakslubah').html('');

            $('#modalubahultimatedaily').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahultimatedaily').submit(function(e) {
        e.preventDefault();
		
		let data = new FormData(this);

        $('.ultimatedaily_isactiveubah').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('ultimatedaily_isactiveubah', 1);
            }
            else
            {
                // alert(0);
                data.append('ultimatedaily_isactiveubah', 0);
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
                $('.btnmodalubahultimatedaily').prop('disabled', true);
                $('.btnmodalubahultimatedaily').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahultimatedaily').prop('disabled', false);
                $('.btnmodalubahultimatedaily').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.ultimatedaily_stockubah){
                        $('#ultimatedaily_stockubah').addClass('is-invalid');
                        $('.errorultimatedailystockubah').html(response.error.ultimatedaily_stockubah);
                    }
                    else
                    {
                        $('#ultimatedaily_stockubah').removeClass('is-invalid');
                        $('.errorultimatedailystockubah').html('');
                    }

                    if (response.error.ultimatedaily_buydateubah){
                        $('#ultimatedaily_buydateubah').addClass('is-invalid');
                        $('.errorultimatedailybuydateubah').html(response.error.ultimatedaily_buydateubah);
                    }
                    else
                    {
                        $('#ultimatedaily_buydateubah').removeClass('is-invalid');
                        $('.errorultimatedailybuydateubah').html('');
                    }

                    if (response.error.ultimatedaily_buypriceubah){
                        $('#ultimatedaily_buypriceubah').addClass('is-invalid');
                        $('.errorultimatedailybuypriceubah').html(response.error.ultimatedaily_buypriceubah);
                    }
                    else
                    {
                        $('#ultimatedaily_buypriceubah').removeClass('is-invalid');
                        $('.errorultimatedailystockubah').html('');
                    }

                    if (response.error.ultimatedaily_closedubah){
                        $('#ultimatedaily_closedubah').addClass('is-invalid');
                        $('.errorultimatedailyclosedubah').html(response.error.ultimatedaily_closedubah);
                    }
                    else
                    {
                        $('#ultimatedaily_closedubah').removeClass('is-invalid');
                        $('.errorultimatedailyclosedubah').html('');
                    }

                    
                    if (response.error.ultimatedaily_gainlossubah){
                        $('#ultimatedaily_gainlossubah').addClass('is-invalid');
                        $('.errorultimatedailygainlossubah').html(response.error.ultimatedaily_gainlossubah);
                    }
                    else
                    {
                        $('#ultimatedaily_gainlossubah').removeClass('is-invalid');
                        $('.errorultimatedailystockubah').html('');
                    }

                    if (response.error.ultimatedaily_areabeliubah){
                        $('#ultimatedaily_areabeliubah').addClass('is-invalid');
                        $('.errorultimatedailyareabeliubah').html(response.error.ultimatedaily_areabeliubah);
                    }
                    else
                    {
                        $('#ultimatedaily_areabeliubah').removeClass('is-invalid');
                        $('.errorultimatedailyareabeliubah').html('');
                    }
					
					if (response.error.ultimatedaily_areajualubah){
                        $('#ultimatedaily_areajualubah').addClass('is-invalid');
                        $('.errorultimatedailyareajualubah').html(response.error.ultimatedaily_areajualubah);
                    }
                    else
                    {
                        $('#ultimatedaily_areajualubah').removeClass('is-invalid');
                        $('.errorultimatedailyareajualubah').html('');
                    }

                    if (response.error.ultimatedaily_stoplossubah){
                        $('#ultimatedaily_stoplossubah').addClass('is-invalid');
                        $('.errorultimatedailystoplossubah').html(response.error.ultimatedaily_stoplossubah);
                    }
                    else
                    {
                        $('#ultimatedaily_stoplossubah').removeClass('is-invalid');
                        $('.errorultimatedailystoplossubah').html('');
                    }

                    
                    if (response.error.ultimatedaily_jarakslubah){
                        $('#ultimatedaily_jarakslubah').addClass('is-invalid');
                        $('.errorultimatedailyjarakslubah').html(response.error.ultimatedaily_jarakslubah);
                    }
                    else
                    {
                        $('#ultimatedaily_jarakslubah').removeClass('is-invalid');
                        $('.errorultimatedailystockubah').html('');
                    }
                }
                else
                {
					$('#modalubahultimatedaily').modal('hide');
					
                    Swal.fire(
                        'Pemberitahuan',
						response.success.data,
                        'success',
						).then(function() {
							$('#datatable-ultimatedaily').DataTable().ajax.reload();
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
function deleteultimatedaily($kode) {
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
            var url =  '/ultimate/dailycontroller/hapusdata';

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
                            $('#datatable-ultimatedaily').DataTable().ajax.reload();
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

//Fungsi select data tgl
function fungsiGantiTgl($id) {
    var url = "/ultimate/dailycontroller/pilihdatatgl";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            id: $id,
        },
        dataType: "JSON",
        success: function(response) {
            $('#ultimatedaily_idtgl').val(response.success.id);
            $('#ultimatedaily_edittgl').val(response.success.tgl);
			
			if (response.success.is_active == 1){
                $('#ultimatedaily_isactiveubahtgl').prop("checked", true);
            } else {
                $('#ultimatedaily_isactiveubahtgl').prop("checked", false);
            }

            $('#ultimatedaily_edittgl').removeClass('is-invalid');
            $('.errorultimatedailytglubah').html('');

            $('#modaleditultimatedailytgl').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data tgl
$(document).ready(function() {
    $('.formModalubahultimatedailytgl').submit(function(e) {
        e.preventDefault();
		
		let data = new FormData(this);

        $('.ultimatedaily_isactiveubahtgl').each(function() {
            if ($(this).is(":checked")) {
                // alert(1);
                data.append('ultimatedaily_isactiveubahtgl', 1);
            } else {
                // alert(0);
                data.append('ultimatedaily_isactiveubahtgl', 0);
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
                $('.btnmodalubahultimatedailytgl').prop('disabled', true);
                $('.btnmodalubahultimatedailytgl').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahultimatedailytgl').prop('disabled', false);
                $('.btnmodalubahultimatedailytgl').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.ultimatedaily_edittgl){
                        $('#ultimatedaily_edittgl').addClass('is-invalid');
                        $('.errorultimatedailytglubah').html(response.error.ultimatedaily_edittgl);
                    } else {
                        $('#ultimatedaily_edittgl').removeClass('is-invalid');
                        $('.errorultimatedailytglubah').html('');
                    }
                } else {
					$('#modaleditultimatedailytgl').modal('hide');
					
                    Swal.fire(
                        'Pemberitahuan',
						response.success.data,
                        'success',
						).then(function() {
							$('#datatable-ultimatedaily').DataTable().ajax.reload();
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