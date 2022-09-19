//Datatables server side
$(document).ready( function () {
    var url = '/ultimate/Dailyclosedcontroller/ajax_list';
    var table = $('#datatable-ultimatedailyclosed').DataTable({ 
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
function generatekodeultimatedailyclosed() {

    var url = "/ultimate/Dailyclosedcontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#ultimatedailyclosed_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahultimatedailyclosed').submit(function(e) {
        e.preventDefault();

        let data = new FormData(this);

        $('.ultimatedailyclosed_isactive').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('ultimatedailyclosed_isactive', 1);
            }
            else
            {
                // alert(0);
                data.append('ultimatedailyclosed_isactive', 0);
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
                $('.btnmodaltambahultimateDailyclosed').prop('disabled', true);
                $('.btnmodaltambahultimateDailyclosed').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahultimateDailyclosed').prop('disabled', false);
                $('.btnmodaltambahultimateDailyclosed').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.ultimatedailyclosed_kode){
                        $('#ultimatedailyclosed_kode').addClass('is-invalid');
                        $('.errorultimatedailyclosedKode').html(response.error.ultimatedailyclosed_kode);
                    }
                    else
                    {
                        $('#ultimatedailyclosed_kode').removeClass('is-invalid');
                        $('.errorultimatedailyclosedKode').html('');
                    }

                    if (response.error.ultimatedailyclosed_stock){
                        $('#ultimatedailyclosed_stock').addClass('is-invalid');
                        $('.errorultimatedailyclosedstock').html(response.error.ultimatedailyclosed_stock);
                    }
                    else
                    {
                        $('#ultimatedailyclosed_stock').removeClass('is-invalid');
                        $('.errorultimatedailyclosedstock').html('');
                    }

                    if (response.error.ultimatedailyclosed_buyprice){
                        $('#ultimatedailyclosed_buyprice').addClass('is-invalid');
                        $('.errorultimatedailyclosedbuyprice').html(response.error.ultimatedailyclosed_buyprice);
                    }
                    else
                    {
                        $('#ultimatedailyclosed_buyprice').removeClass('is-invalid');
                        $('.errorultimatedailyclosedbuyprice').html('');
                    }
					
					if (response.error.ultimatedailyclosed_sellprice){
                        $('#ultimatedailyclosed_sellprice').addClass('is-invalid');
                        $('.errorultimatedailyclosedsellprice').html(response.error.ultimatedailyclosed_sellprice);
                    }
                    else
                    {
                        $('#ultimatedailyclosed_sellprice').removeClass('is-invalid');
                        $('.errorultimatedailyclosedsellprice').html('');
                    }

                    if (response.error.ultimatedailyclosed_buydate){
                        $('.ultimatedailyclosed_buydate').addClass('is-invalid');
                        $('.errorultimatedailyclosedbuydate').html(response.error.ultimatedailyclosed_buydate);
                    }
                    else
                    {
                        $('.ultimatedailyclosed_buydate').removeClass('is-invalid');
                        $('.errorultimatedailyclosedbuydate').html('');
                    }

                    if (response.error.ultimatedailyclosed_selldate){
                        $('#ultimatedailyclosed_selldate').addClass('is-invalid');
                        $('.errorultimatedailyclosedselldate').html(response.error.ultimatedailyclosed_selldate);
                    }
                    else
                    {
                        $('#ultimatedailyclosed_selldate').removeClass('is-invalid');
                        $('.errorultimatedailyclosedselldate').html('');
                    }

                    if (response.error.ultimatedailyclosed_gainloss){
                        $('#ultimatedailyclosed_gainloss').addClass('is-invalid');
                        $('.errorultimatedailyclosedgainloss').html(response.error.ultimatedailyclosed_gainloss);
                    }
                    else
                    {
                        $('#ultimatedailyclosed_gainloss').removeClass('is-invalid');
                        $('.errorultimatedailyclosedgainloss').html('');
                    }

                    if (response.error.ultimatedailyclosed_target){
                        $('#ultimatedailyclosed_target').addClass('is-invalid');
                        $('.errorultimatedailyclosedtarget').html(response.error.ultimatedailyclosed_target);
                    }
                    else
                    {
                        $('#ultimatedailyclosed_target').removeClass('is-invalid');
                        $('.errorultimatedailyclosedtarget').html('');
                    }

                    
                    if (response.error.ultimatedailyclosed_hitmiss){
                        $('#ultimatedailyclosed_hitmiss').addClass('is-invalid');
                        $('.errorultimatedailyclosedhitmiss').html(response.error.ultimatedailyclosed_hitmiss);
                    }
                    else
                    {
                        $('#ultimatedailyclosed_hitmiss').removeClass('is-invalid');
                        $('.errorultimatedailyclosedhitmiss').html('');
                    }

                    
                    if (response.error.ultimatedailyclosed_highest){
                        $('#ultimatedailyclosed_highest').addClass('is-invalid');
                        $('.errorultimatedailyclosedhighest').html(response.error.ultimatedailyclosed_highest);
                    }
                    else
                    {
                        $('#ultimatedailyclosed_highest').removeClass('is-invalid');
                        $('.errorultimatedailyclosedhighest').html('');
                    }
                }
                else
                {
                    $('#modaltambahultimatedailyclosed').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#ultimatedailyclosed_stock').val('');
                        $('#ultimatedailyclosed_buyprice').val('');
                        $('#ultimatedailyclosed_sellprice').val('');
                        $('#ultimatedailyclosed_buydate').val('');
                        $('#ultimatedailyclosed_selldate').val('');
                        $('#ultimatedailyclosed_gainloss').val('');
                        $('#ultimatedailyclosed_target').val('');
                        $('#ultimatedailyclosed_hitmiss').val('');
                        $('#ultimatedailyclosed_highest').val('');
						
						$('#ultimatedailyclosed_stock').removeClass('is-invalid');
						$('.errorultimatedailyclosedstock').html('');
						
						$('#ultimatedailyclosed_buyprice').removeClass('is-invalid');
						$('.errorultimatedailyclosedbuyprice').html('');
						
						$('#ultimatedailyclosed_sellprice').removeClass('is-invalid');
						$('.errorultimatedailyclosedsellprice').html('');
						
						$('#ultimatedailyclosed_buydate').removeClass('is-invalid');
						$('.errorultimatedailyclosedbuydate').html('');

                        $('#ultimatedailyclosed_selldate').removeClass('is-invalid');
						$('.errorultimatedailyclosedselldate').html('');
						
						$('#ultimatedailyclosed_gainloss').removeClass('is-invalid');
						$('.errorultimatedailyclosedgainloss').html('');
						
						$('#ultimatedailyclosed_target').removeClass('is-invalid');
						$('.errorultimatedailyclosedtarget').html('');

                        $('#ultimatedailyclosed_hitmiss').removeClass('is-invalid');
						$('.errorultimatedailyclosedhitmiss').html('');

                        $('#ultimatedailyclosed_highest').removeClass('is-invalid');
						$('.errorultimatedailyclosedhighest').html('');
			
                        $('#datatable-ultimatedailyclosed').DataTable().ajax.reload();
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
function editultimatedailyclosed($kode) {
    var url = "/ultimate/Dailyclosedcontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#ultimatedailyclosed_kodeubah').val(response.success.kode);
            $('#ultimatedailyclosed_stockubah').val(response.success.stock);
			$('#ultimatedailyclosed_buypriceubah').val(response.success.buyprice);
            $('#ultimatedailyclosed_sellpriceubah').val(response.success.sellprice);
            $('#ultimatedailyclosed_buydateubah').val(response.success.buydate);
			$('#ultimatedailyclosed_selldateubah').val(response.success.selldate);
            $('#ultimatedailyclosed_gainlossubah').val(response.success.gainloss);
            $('#ultimatedailyclosed_targetubah').val(response.success.target);
            $('#ultimatedailyclosed_hitmissubah').val(response.success.hitmiss);
            $('#ultimatedailyclosed_highestubah').val(response.success.highest);
			
			if (response.success.active == 1)
            {
                $('#ultimatedailyclosed_isactiveubah').prop("checked", true);
            }
            else
            {
                $('#ultimatedailyclosed_isactiveubah').prop("checked", false);
            }

            $('#ultimatedailyclosed_stockubah').removeClass('is-invalid');
            $('.errorultimatedailyclosedtockubah').html('');
			
			$('#ultimatedailyclosed_marketubah').removeClass('is-invalid');
            $('.errorultimatedailyclosedmarketubah').html('');
			
			$('#ultimatedailyclosed_buypriceubah').removeClass('is-invalid');
            $('.errorultimatedailyclosedbuypriceubah').html('');
			
			$('#ultimatedailyclosed_sellpriceubah').removeClass('is-invalid');
            $('.errorultimatedailyclosedsellpriceubah').html('');

            $('#ultimatedailyclosed_buydateubah').removeClass('is-invalid');
            $('.errorultimatedailyclosedbuydateubah').html('');
			
			$('#ultimatedailyclosed_selldateubah').removeClass('is-invalid');
            $('.errorultimatedailyclosedselldateubah').html('');
			
			$('#ultimatedailyclosed_gainlossubah').removeClass('is-invalid');
            $('.errorultimatedailyclosedgainlossubah').html('');

            $('#ultimatedailyclosed_hitmissubah').removeClass('is-invalid');
            $('.errorultimatedailyclosedhitmissubah').html('');

            $('#ultimatedailyclosed_highestubah').removeClass('is-invalid');
            $('.errorultimatedailyclosedhighestubah').html('');

            $('#modalubahultimatedailyclosed').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahultimatedailyclosed').submit(function(e) {
        e.preventDefault();
		
		let data = new FormData(this);

        $('.ultimatedailyclosed_isactiveubah').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('ultimatedailyclosed_isactiveubah', 1);
            }
            else
            {
                // alert(0);
                data.append('ultimatedailyclosed_isactiveubah', 0);
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
                $('.btnmodalubahultimateDailyclosed').prop('disabled', true);
                $('.btnmodalubahultimateDailyclosed').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahultimateDailyclosed').prop('disabled', false);
                $('.btnmodalubahultimateDailyclosed').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.ultimatedailyclosed_stockubah){
                        $('#ultimatedailyclosed_stockubah').addClass('is-invalid');
                        $('.errorultimatedailyclosedstockubah').html(response.error.ultimatedailyclosed_stockubah);
                    }
                    else
                    {
                        $('#ultimatedailyclosed_stockubah').removeClass('is-invalid');
                        $('.errorultimatedailyclosedstockubah').html('');
                    }

                    if (response.error.ultimatedailyclosed_buypriceubah){
                        $('#ultimatedailyclosed_buypriceubah').addClass('is-invalid');
                        $('.errorultimatedailyclosedbuypriceubah').html(response.error.ultimatedailyclosed_buypriceubah);
                    }
                    else
                    {
                        $('#ultimatedailyclosed_buypriceubah').removeClass('is-invalid');
                        $('.errorultimatedailyclosedbuypriceubah').html('');
                    }
					
					if (response.error.ultimatedailyclosed_sellpriceubah){
                        $('#ultimatedailyclosed_sellpriceubah').addClass('is-invalid');
                        $('.errorultimatedailyclosedsellpriceubah').html(response.error.ultimatedailyclosed_sellpriceubah);
                    }
                    else
                    {
                        $('#ultimatedailyclosed_sellpriceubah').removeClass('is-invalid');
                        $('.errorultimatedailyclosedsellpriceubah').html('');
                    }

                    if (response.error.ultimatedailyclosed_buydateubah){
                        $('#ultimatedailyclosed_buydateubah').addClass('is-invalid');
                        $('.errorultimatedailyclosedbuydateubah').html(response.error.ultimatedailyclosed_buydateubah);
                    }
                    else
                    {
                        $('#ultimatedailyclosed_buydateubah').removeClass('is-invalid');
                        $('.errorultimatedailyclosedbuydateubah').html('');
                    }

                    if (response.error.ultimatedailyclosed_selldateubah){
                        $('#ultimatedailyclosed_selldateubah').addClass('is-invalid');
                        $('.errorultimatedailyclosedselldateubah').html(response.error.ultimatedailyclosed_selldateubah);
                    }
                    else
                    {
                        $('#ultimatedailyclosed_selldateubah').removeClass('is-invalid');
                        $('.errorultimatedailyclosedselldateubah').html('');
                    }
					
					if (response.error.ultimatedailyclosed_gainlossubah){
                        $('#ultimatedailyclosed_gainlossubah').addClass('is-invalid');
                        $('.errorultimatedailyclosedgainlossubah').html(response.error.ultimatedailyclosed_gainlossubah);
                    }
                    else
                    {
                        $('#ultimatedailyclosed_gainlossubah').removeClass('is-invalid');
                        $('.errorultimatedailyclosedgainlossubah').html('');
                    }

                    if (response.error.ultimatedailyclosed_targetubah){
                        $('#ultimatedailyclosed_targetubah').addClass('is-invalid');
                        $('.errorultimatedailyclosedtargetubah').html(response.error.ultimatedailyclosed_targetubah);
                    }
                    else
                    {
                        $('#ultimatedailyclosed_targetubah').removeClass('is-invalid');
                        $('.errorultimatedailyclosedtargetubah').html('');
                    }

                    if (response.error.ultimatedailyclosed_hitmissubah){
                        $('#ultimatedailyclosed_hitmissubah').addClass('is-invalid');
                        $('.errorultimatedailyclosedhitmissubah').html(response.error.ultimatedailyclosed_hitmissubah);
                    }
                    else
                    {
                        $('#ultimatedailyclosed_hitmissubah').removeClass('is-invalid');
                        $('.errorultimatedailyclosedhitmissubah').html('');
                    }

                    
                    if (response.error.ultimatedailyclosed_highestubah){
                        $('#ultimatedailyclosed_highestubah').addClass('is-invalid');
                        $('.errorultimatedailyclosedhighestubah').html(response.error.ultimatedailyclosed_highestubah);
                    }
                    else
                    {
                        $('#ultimatedailyclosed_highestubah').removeClass('is-invalid');
                        $('.errorultimatedailyclosedhighestubah').html('');
                    }
                }
                else
                {
					$('#modalubahultimatedailyclosed').modal('hide');
					
                    Swal.fire(
                        'Pemberitahuan',
						response.success.data,
                        'success',
						).then(function() {
							$('#datatable-ultimatedailyclosed').DataTable().ajax.reload();
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
function deleteultimatedailyclosed($kode) {

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
            var url =  '/ultimate/Dailyclosedcontroller/hapusdata';

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
                            $('#datatable-ultimatedailyclosed').DataTable().ajax.reload();
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