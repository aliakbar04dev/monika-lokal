//Datatables server side
$(document).ready( function () {
    var url = '/ultimate/Wtcdatacontroller/ajax_list';
    var table = $('#datatable-ultimatewtcdata').DataTable({ 
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
function generatekodeultimatewtcdata() {
    var url = "/ultimate/wtcdatacontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#ultimatewtcdata_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahultimatewtcdata').submit(function(e) {
        e.preventDefault();

        let data = new FormData(this);

        $('.ultimatewtcdata_isactive').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('ultimatewtcdata_isactive', 1);
            }
            else
            {
                // alert(0);
                data.append('ultimatewtcdata_isactive', 0);
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
                $('.btnmodaltambahultimatewtcdata').prop('disabled', true);
                $('.btnmodaltambahultimatewtcdata').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahultimatewtcdata').prop('disabled', false);
                $('.btnmodaltambahultimatewtcdata').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.ultimatewtcdata_kode){
                        $('#ultimatewtcdata_kode').addClass('is-invalid');
                        $('.errorultimatewtcdataKode').html(response.error.ultimatewtcdata_kode);
                    }
                    else
                    {
                        $('#ultimatewtcdata_kode').removeClass('is-invalid');
                        $('.errorultimatewtcdataKode').html('');
                    }

                    if (response.error.ultimatewtcdata_stock){
                        $('#ultimatewtcdata_stock').addClass('is-invalid');
                        $('.errorultimatewtcdatatock').html(response.error.ultimatewtcdata_stock);
                    }
                    else
                    {
                        $('#ultimatewtcdata_stock').removeClass('is-invalid');
                        $('.errorultimatewtcdatatock').html('');
                    }

                    if (response.error.ultimatewtcdata_market){
                        $('#ultimatewtcdata_market').addClass('is-invalid');
                        $('.errorultimatewtcdatamarket').html(response.error.ultimatewtcdata_market);
                    }
                    else
                    {
                        $('#ultimatewtcdata_market').removeClass('is-invalid');
                        $('.errorultimatewtcdatamarket').html('');
                    }
					
					if (response.error.ultimatewtcdata_buyprice){
                        $('#ultimatewtcdata_buyprice').addClass('is-invalid');
                        $('.errorultimatewtcdatabuyprice').html(response.error.ultimatewtcdata_buyprice);
                    }
                    else
                    {
                        $('#ultimatewtcdata_buyprice').removeClass('is-invalid');
                        $('.errorultimatewtcdatabuyprice').html('');
                    }

                    if (response.error.ultimatewtcdata_targetprice){
                        $('#ultimatewtcdata_targetprice').addClass('is-invalid');
                        $('.errorultimatewtcdatatargetprice').html(response.error.ultimatewtcdata_targetprice);
                    }
                    else
                    {
                        $('#ultimatewtcdata_targetprice').removeClass('is-invalid');
                        $('.errorultimatewtcdatatargetprice').html('');
                    }

                    if (response.error.ultimatewtcdata_stoploss){
                        $('#ultimatewtcdata_stoploss').addClass('is-invalid');
                        $('.errorultimatewtcdatastoploss').html(response.error.ultimatewtcdata_stoploss);
                    }
                    else
                    {
                        $('#ultimatewtcdata_stoploss').removeClass('is-invalid');
                        $('.errorultimatewtcdatastoploss').html('');
                    }

                    if (response.error.ultimatewtcdata_risk){
                        $('#ultimatewtcdata_risk').addClass('is-invalid');
                        $('.errorultimatewtcdatarisk').html(response.error.ultimatewtcdata_risk);
                    }
                    else
                    {
                        $('#ultimatewtcdata_risk').removeClass('is-invalid');
                        $('.errorultimatewtcdatarisk').html('');
                    }

                    if (response.error.ultimatewtcdata_narration){
                        $('#ultimatewtcdata_narration').addClass('is-invalid');
                        $('.errorultimatewtcdatanarration').html(response.error.ultimatewtcdata_narration);
                    }
                    else
                    {
                        $('#ultimatewtcdata_narration').removeClass('is-invalid');
                        $('.errorultimatewtcdatanarration').html('');
                    }
                }
                else
                {
                    $('#modaltambahultimatewtcdata').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#ultimatewtcdata_stock').val('');
                        $('#ultimatewtcdata_market').val('');
                        $('#ultimatewtcdata_buyprice').val('');
                        $('#ultimatewtcdata_targetprice').val('');
                        $('#ultimatewtcdata_stoploss').val('');
                        $('#ultimatewtcdata_risk').val('');
                        $('#ultimatewtcdata_narration').val('');
						
						$('#ultimatewtcdata_stock').removeClass('is-invalid');
						$('.errorultimatewtcdatatock').html('');
						
						$('#ultimatewtcdata_market').removeClass('is-invalid');
						$('.errorultimatewtcdatamarket').html('');
						
						$('#ultimatewtcdata_buyprice').removeClass('is-invalid');
						$('.errorultimatewtcdatabuyprice').html('');
						
						$('#ultimatewtcdata_targetprice').removeClass('is-invalid');
						$('.errorultimatewtcdatatargetprice').html('');

                        $('#ultimatewtcdata_stoploss').removeClass('is-invalid');
						$('.errorultimatewtcdatastoploss').html('');
						
						$('#ultimatewtcdata_risk').removeClass('is-invalid');
						$('.errorultimatewtcdatarisk').html('');
						
						$('#ultimatewtcdata_narration').removeClass('is-invalid');
						$('.errorultimatewtcdatanarration').html('');
			
                        $('#datatable-ultimatewtcdata').DataTable().ajax.reload();
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
function editultimatewtcdata($kode) {
    var url = "/ultimate/wtcdatacontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#ultimatewtcdata_kodeubah').val(response.success.kode);
            $('#ultimatewtcdata_stockubah').val(response.success.stock);
            $('#ultimatewtcdata_marketubah').val(response.success.market);
			$('#ultimatewtcdata_buypriceubah').val(response.success.buyprice);
            $('#ultimatewtcdata_targetpriceubah').val(response.success.targetprice);
            $('#ultimatewtcdata_stoplossubah').val(response.success.stoploss);
			$('#ultimatewtcdata_riskubah').val(response.success.risk);
            $('#ultimatewtcdata_narrationubah').val(response.success.narration);
            $('#ultimatewtcdata_actionubah').val(response.success.action);
			
			if (response.success.active == 1)
            {
                $('#ultimatewtcdata_isactiveubah').prop("checked", true);
            }
            else
            {
                $('#ultimatewtcdata_isactiveubah').prop("checked", false);
            }

            $('#ultimatewtcdata_stockubah').removeClass('is-invalid');
            $('.errorultimatewtcdatatockubah').html('');
			
			$('#ultimatewtcdata_marketubah').removeClass('is-invalid');
            $('.errorultimatewtcdatamarketubah').html('');
			
			$('#ultimatewtcdata_buypriceubah').removeClass('is-invalid');
            $('.errorultimatewtcdatabuypriceubah').html('');
			
			$('#ultimatewtcdata_targetpriceubah').removeClass('is-invalid');
            $('.errorultimatewtcdatatargetpriceubah').html('');

            $('#ultimatewtcdata_stoplossubah').removeClass('is-invalid');
            $('.errorultimatewtcdatastoplossubah').html('');
			
			$('#ultimatewtcdata_riskubah').removeClass('is-invalid');
            $('.errorultimatewtcdatariskubah').html('');
			
			$('#ultimatewtcdata_narrationubah').removeClass('is-invalid');
            $('.errorultimatewtcdatanarrationubah').html('');

            $('#modalubahultimatewtcdata').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahultimatewtcdata').submit(function(e) {
        e.preventDefault();
		
		let data = new FormData(this);

        $('.ultimatewtcdata_isactiveubah').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('ultimatewtcdata_isactiveubah', 1);
            }
            else
            {
                // alert(0);
                data.append('ultimatewtcdata_isactiveubah', 0);
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
                $('.btnmodalubahultimatewtcdata').prop('disabled', true);
                $('.btnmodalubahultimatewtcdata').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahultimatewtcdata').prop('disabled', false);
                $('.btnmodalubahultimatewtcdata').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.ultimatewtcdata_stockubah){
                        $('#ultimatewtcdata_stockubah').addClass('is-invalid');
                        $('.errorultimatewtcdatatockubah').html(response.error.ultimatewtcdata_stockubah);
                    }
                    else
                    {
                        $('#ultimatewtcdata_stockubah').removeClass('is-invalid');
                        $('.errorultimatewtcdatatockubah').html('');
                    }

                    if (response.error.ultimatewtcdata_marketubah){
                        $('#ultimatewtcdata_marketubah').addClass('is-invalid');
                        $('.errorultimatewtcdatamarketubah').html(response.error.ultimatewtcdata_marketubah);
                    }
                    else
                    {
                        $('#ultimatewtcdata_marketubah').removeClass('is-invalid');
                        $('.errorultimatewtcdatamarketubah').html('');
                    }
					
					if (response.error.ultimatewtcdata_buypriceubah){
                        $('#ultimatewtcdata_buypriceubah').addClass('is-invalid');
                        $('.errorultimatewtcdatabuypriceubah').html(response.error.ultimatewtcdata_buypriceubah);
                    }
                    else
                    {
                        $('#ultimatewtcdata_buypriceubah').removeClass('is-invalid');
                        $('.errorultimatewtcdatabuypriceubah').html('');
                    }

                    if (response.error.ultimatewtcdata_targetpriceubah){
                        $('#ultimatewtcdata_targetpriceubah').addClass('is-invalid');
                        $('.errorultimatewtcdatatargetpriceubah').html(response.error.ultimatewtcdata_targetpriceubah);
                    }
                    else
                    {
                        $('#ultimatewtcdata_targetpriceubah').removeClass('is-invalid');
                        $('.errorultimatewtcdatatargetpriceubah').html('');
                    }

                    if (response.error.ultimatewtcdata_stoplossubah){
                        $('#ultimatewtcdata_stoplossubah').addClass('is-invalid');
                        $('.errorultimatewtcdatastoplossubah').html(response.error.ultimatewtcdata_stoplossubah);
                    }
                    else
                    {
                        $('#ultimatewtcdata_stoplossubah').removeClass('is-invalid');
                        $('.errorultimatewtcdatastoplossubah').html('');
                    }
					
					if (response.error.ultimatewtcdata_riskubah){
                        $('#ultimatewtcdata_riskubah').addClass('is-invalid');
                        $('.errorultimatewtcdatariskubah').html(response.error.ultimatewtcdata_riskubah);
                    }
                    else
                    {
                        $('#ultimatewtcdata_riskubah').removeClass('is-invalid');
                        $('.errorultimatewtcdatariskubah').html('');
                    }

                    if (response.error.ultimatewtcdata_narrationubah){
                        $('#ultimatewtcdata_narrationubah').addClass('is-invalid');
                        $('.errorultimatewtcdatanarrationubah').html(response.error.ultimatewtcdata_narrationubah);
                    }
                    else
                    {
                        $('#ultimatewtcdata_narrationubah').removeClass('is-invalid');
                        $('.errorultimatewtcdatanarrationubah').html('');
                    }
                }
                else
                {
					$('#modalubahultimatewtcdata').modal('hide');
					
                    Swal.fire(
                        'Pemberitahuan',
						response.success.data,
                        'success',
						).then(function() {
							$('#datatable-ultimatewtcdata').DataTable().ajax.reload();
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
function deleteultimatewtcdata($kode) {
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
            var url =  '/ultimate/wtcdatacontroller/hapusdata';

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
                            $('#datatable-ultimatewtcdata').DataTable().ajax.reload();
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