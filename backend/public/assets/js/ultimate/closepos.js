//Datatables server side
$(document).ready( function () {
    var url = '/ultimate/Closeposcontroller/ajax_list';
    var table = $('#datatable-ultimateclosepos').DataTable({ 
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
function generatekodeultimateclosepos() {
    var url = "/ultimate/closeposcontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#ultimateclosepos_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahultimateclosepos').submit(function(e) {
        e.preventDefault();

        let data = new FormData(this);

        $('.ultimateclosepos_isactive').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('ultimateclosepos_isactive', 1);
            }
            else
            {
                // alert(0);
                data.append('ultimateclosepos_isactive', 0);
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
                $('.btnmodaltambahultimateclosepos').prop('disabled', true);
                $('.btnmodaltambahultimateclosepos').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahultimateclosepos').prop('disabled', false);
                $('.btnmodaltambahultimateclosepos').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.ultimateclosepos_kode){
                        $('#ultimateclosepos_kode').addClass('is-invalid');
                        $('.errorultimatecloseposKode').html(response.error.ultimateclosepos_kode);
                    }
                    else
                    {
                        $('#ultimateclosepos_kode').removeClass('is-invalid');
                        $('.errorultimatecloseposKode').html('');
                    }

                    if (response.error.ultimateclosepos_stock){
                        $('#ultimateclosepos_stock').addClass('is-invalid');
                        $('.errorultimatecloseposstock').html(response.error.ultimateclosepos_stock);
                    }
                    else
                    {
                        $('#ultimateclosepos_stock').removeClass('is-invalid');
                        $('.errorultimatecloseposstock').html('');
                    }

                    if (response.error.ultimateclosepos_buyprice){
                        $('#ultimateclosepos_buyprice').addClass('is-invalid');
                        $('.errorultimatecloseposbuyprice').html(response.error.ultimateclosepos_buyprice);
                    }
                    else
                    {
                        $('#ultimateclosepos_buyprice').removeClass('is-invalid');
                        $('.errorultimatecloseposbuyprice').html('');
                    }
					
					if (response.error.ultimateclosepos_sellprice){
                        $('#ultimateclosepos_sellprice').addClass('is-invalid');
                        $('.errorultimateclosepossellprice').html(response.error.ultimateclosepos_sellprice);
                    }
                    else
                    {
                        $('#ultimateclosepos_sellprice').removeClass('is-invalid');
                        $('.errorultimateclosepossellprice').html('');
                    }

                    if (response.error.ultimateclosepos_buydate){
                        $('.ultimateclosepos_buydate').addClass('is-invalid');
                        $('.errorultimatecloseposbuydate').html(response.error.ultimateclosepos_buydate);
                    }
                    else
                    {
                        $('.ultimateclosepos_buydate').removeClass('is-invalid');
                        $('.errorultimatecloseposbuydate').html('');
                    }

                    if (response.error.ultimateclosepos_selldate){
                        $('#ultimateclosepos_selldate').addClass('is-invalid');
                        $('.errorultimatecloseposselldate').html(response.error.ultimateclosepos_selldate);
                    }
                    else
                    {
                        $('#ultimateclosepos_selldate').removeClass('is-invalid');
                        $('.errorultimatecloseposselldate').html('');
                    }

                    if (response.error.ultimateclosepos_profit){
                        $('#ultimateclosepos_profit').addClass('is-invalid');
                        $('.errorultimatecloseposprofit').html(response.error.ultimateclosepos_profit);
                    }
                    else
                    {
                        $('#ultimateclosepos_profit').removeClass('is-invalid');
                        $('.errorultimatecloseposprofit').html('');
                    }

                    if (response.error.ultimateclosepos_dayshold){
                        $('#ultimateclosepos_dayshold').addClass('is-invalid');
                        $('.errorultimatecloseposdayshold').html(response.error.ultimateclosepos_dayshold);
                    }
                    else
                    {
                        $('#ultimateclosepos_dayshold').removeClass('is-invalid');
                        $('.errorultimatecloseposdayshold').html('');
                    }
                }
                else
                {
                    $('#modaltambahultimateclosepos').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#ultimateclosepos_stock').val('');
                        $('#ultimateclosepos_buyprice').val('');
                        $('#ultimateclosepos_sellprice').val('');
                        $('#ultimateclosepos_buydate').val('');
                        $('#ultimateclosepos_selldate').val('');
                        $('#ultimateclosepos_profit').val('');
                        $('#ultimateclosepos_dayshold').val('');
						
						$('#ultimateclosepos_stock').removeClass('is-invalid');
						$('.errorultimatecloseposstock').html('');
						
						$('#ultimateclosepos_buyprice').removeClass('is-invalid');
						$('.errorultimatecloseposbuyprice').html('');
						
						$('#ultimateclosepos_sellprice').removeClass('is-invalid');
						$('.errorultimateclosepossellprice').html('');
						
						$('#ultimateclosepos_buydate').removeClass('is-invalid');
						$('.errorultimatecloseposbuydate').html('');

                        $('#ultimateclosepos_selldate').removeClass('is-invalid');
						$('.errorultimatecloseposselldate').html('');
						
						$('#ultimateclosepos_profit').removeClass('is-invalid');
						$('.errorultimatecloseposprofit').html('');
						
						$('#ultimateclosepos_dayshold').removeClass('is-invalid');
						$('.errorultimatecloseposdayshold').html('');
			
                        $('#datatable-ultimateclosepos').DataTable().ajax.reload();
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
function editultimateclosepos($kode) {
    var url = "/ultimate/closeposcontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#ultimateclosepos_kodeubah').val(response.success.kode);
            $('#ultimateclosepos_stockubah').val(response.success.stock);
			$('#ultimateclosepos_buypriceubah').val(response.success.buyprice);
            $('#ultimateclosepos_sellpriceubah').val(response.success.sellprice);
            $('#ultimateclosepos_buydateubah').val(response.success.buydate);
			$('#ultimateclosepos_selldateubah').val(response.success.selldate);
            $('#ultimateclosepos_profitubah').val(response.success.profit);
            $('#ultimateclosepos_daysholdubah').val(response.success.dayshold);
			
			if (response.success.active == 1)
            {
                $('#ultimateclosepos_isactiveubah').prop("checked", true);
            }
            else
            {
                $('#ultimateclosepos_isactiveubah').prop("checked", false);
            }

            $('#ultimateclosepos_stockubah').removeClass('is-invalid');
            $('.errorultimateclosepostockubah').html('');
			
			$('#ultimateclosepos_marketubah').removeClass('is-invalid');
            $('.errorultimatecloseposmarketubah').html('');
			
			$('#ultimateclosepos_buypriceubah').removeClass('is-invalid');
            $('.errorultimatecloseposbuypriceubah').html('');
			
			$('#ultimateclosepos_sellpriceubah').removeClass('is-invalid');
            $('.errorultimateclosepossellpriceubah').html('');

            $('#ultimateclosepos_buydateubah').removeClass('is-invalid');
            $('.errorultimatecloseposbuydateubah').html('');
			
			$('#ultimateclosepos_selldateubah').removeClass('is-invalid');
            $('.errorultimatecloseposselldateubah').html('');
			
			$('#ultimateclosepos_profitubah').removeClass('is-invalid');
            $('.errorultimatecloseposprofitubah').html('');

            $('#ultimateclosepos_daysholdubah').removeClass('is-invalid');
            $('.errorultimatecloseposdaysholdubah').html('');

            $('#modalubahultimateclosepos').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahultimateclosepos').submit(function(e) {
        e.preventDefault();
		
		let data = new FormData(this);

        $('.ultimateclosepos_isactiveubah').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('ultimateclosepos_isactiveubah', 1);
            }
            else
            {
                // alert(0);
                data.append('ultimateclosepos_isactiveubah', 0);
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
                $('.btnmodalubahultimateclosepos').prop('disabled', true);
                $('.btnmodalubahultimateclosepos').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahultimateclosepos').prop('disabled', false);
                $('.btnmodalubahultimateclosepos').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.ultimateclosepos_stockubah){
                        $('#ultimateclosepos_stockubah').addClass('is-invalid');
                        $('.errorultimatecloseposstockubah').html(response.error.ultimateclosepos_stockubah);
                    }
                    else
                    {
                        $('#ultimateclosepos_stockubah').removeClass('is-invalid');
                        $('.errorultimatecloseposstockubah').html('');
                    }

                    if (response.error.ultimateclosepos_buypriceubah){
                        $('#ultimateclosepos_buypriceubah').addClass('is-invalid');
                        $('.errorultimatecloseposbuypriceubah').html(response.error.ultimateclosepos_buypriceubah);
                    }
                    else
                    {
                        $('#ultimateclosepos_buypriceubah').removeClass('is-invalid');
                        $('.errorultimatecloseposbuypriceubah').html('');
                    }
					
					if (response.error.ultimateclosepos_sellpriceubah){
                        $('#ultimateclosepos_sellpriceubah').addClass('is-invalid');
                        $('.errorultimateclosepossellpriceubah').html(response.error.ultimateclosepos_sellpriceubah);
                    }
                    else
                    {
                        $('#ultimateclosepos_sellpriceubah').removeClass('is-invalid');
                        $('.errorultimateclosepossellpriceubah').html('');
                    }

                    if (response.error.ultimateclosepos_buydateubah){
                        $('#ultimateclosepos_buydateubah').addClass('is-invalid');
                        $('.errorultimatecloseposbuydateubah').html(response.error.ultimateclosepos_buydateubah);
                    }
                    else
                    {
                        $('#ultimateclosepos_buydateubah').removeClass('is-invalid');
                        $('.errorultimatecloseposbuydateubah').html('');
                    }

                    if (response.error.ultimateclosepos_selldateubah){
                        $('#ultimateclosepos_selldateubah').addClass('is-invalid');
                        $('.errorultimatecloseposselldateubah').html(response.error.ultimateclosepos_selldateubah);
                    }
                    else
                    {
                        $('#ultimateclosepos_selldateubah').removeClass('is-invalid');
                        $('.errorultimatecloseposselldateubah').html('');
                    }
					
					if (response.error.ultimateclosepos_profitubah){
                        $('#ultimateclosepos_profitubah').addClass('is-invalid');
                        $('.errorultimatecloseposprofitubah').html(response.error.ultimateclosepos_profitubah);
                    }
                    else
                    {
                        $('#ultimateclosepos_profitubah').removeClass('is-invalid');
                        $('.errorultimatecloseposprofitubah').html('');
                    }

                    if (response.error.ultimateclosepos_daysholdubah){
                        $('#ultimateclosepos_daysholdubah').addClass('is-invalid');
                        $('.errorultimatecloseposdaysholdubah').html(response.error.ultimateclosepos_daysholdubah);
                    }
                    else
                    {
                        $('#ultimateclosepos_daysholdubah').removeClass('is-invalid');
                        $('.errorultimatecloseposdaysholdubah').html('');
                    }
                }
                else
                {
					$('#modalubahultimateclosepos').modal('hide');
					
                    Swal.fire(
                        'Pemberitahuan',
						response.success.data,
                        'success',
						).then(function() {
							$('#datatable-ultimateclosepos').DataTable().ajax.reload();
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
function deleteultimateclosepos($kode) {
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
            var url =  '/ultimate/closeposcontroller/hapusdata';

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
                            $('#datatable-ultimateclosepos').DataTable().ajax.reload();
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