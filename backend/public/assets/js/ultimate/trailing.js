//Datatables server side
$(document).ready( function () {
    var url = '/ultimate/Trailingcontroller/ajax_list';
    var table = $('#datatable-ultimatetrail').DataTable({ 
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
function generatekodeultimatetrail() {
    var url = "/ultimate/trailingcontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#ultimatetrail_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahultimatetrail').submit(function(e) {
        e.preventDefault();

        let data = new FormData(this);

        $('.ultimatetrail_isactive').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('ultimatetrail_isactive', 1);
            }
            else
            {
                // alert(0);
                data.append('ultimatetrail_isactive', 0);
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
                $('.btnmodaltambahultimatetrailing').prop('disabled', true);
                $('.btnmodaltambahultimatetrailing').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahultimatetrailing').prop('disabled', false);
                $('.btnmodaltambahultimatetrailing').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.ultimatetrail_kode){
                        $('#ultimatetrail_kode').addClass('is-invalid');
                        $('.errorultimatetrailKode').html(response.error.ultimatetrail_kode);
                    }
                    else
                    {
                        $('#ultimatetrail_kode').removeClass('is-invalid');
                        $('.errorultimatetrailKode').html('');
                    }

                    if (response.error.ultimatetrail_stock){
                        $('#ultimatetrail_stock').addClass('is-invalid');
                        $('.errorultimatetrailstock').html(response.error.ultimatetrail_stock);
                    }
                    else
                    {
                        $('#ultimatetrail_stock').removeClass('is-invalid');
                        $('.errorultimatetrailstock').html('');
                    }

                    if (response.error.ultimatetrail_buydate){
                        $('#ultimatetrail_buydate').addClass('is-invalid');
                        $('.errorultimatetrailbuydate').html(response.error.ultimatetrail_buydate);
                    }
                    else
                    {
                        $('#ultimatetrail_buydate').removeClass('is-invalid');
                        $('.errorultimatetrailbuydate').html('');
                    }
					
					if (response.error.ultimatetrail_buyprice){
                        $('#ultimatetrail_buyprice').addClass('is-invalid');
                        $('.errorultimatetrailbuyprice').html(response.error.ultimatetrail_buyprice);
                    }
                    else
                    {
                        $('#ultimatetrail_buyprice').removeClass('is-invalid');
                        $('.errorultimatetrailbuyprice').html('');
                    }

                    if (response.error.ultimatetrail_closeprice){
                        $('#ultimatetrail_closeprice').addClass('is-invalid');
                        $('.errorultimatetrailcloseprice').html(response.error.ultimatetrail_closeprice);
                    }
                    else
                    {
                        $('#ultimatetrail_closeprice').removeClass('is-invalid');
                        $('.errorultimatetrailcloseprice').html('');
                    }
					
					if (response.error.ultimatetrail_gainloss){
                        $('#ultimatetrail_gainloss').addClass('is-invalid');
                        $('.errorultimatetrailgainloss').html(response.error.ultimatetrail_gainloss);
                    }
                    else
                    {
                        $('#ultimatetrail_gainloss').removeClass('is-invalid');
                        $('.errorultimatetrailgainloss').html('');
                    }

                    if (response.error.ultimatetrail_trailingstop){
                        $('#ultimatetrail_trailingstop').addClass('is-invalid');
                        $('.errorultimatetrailtrailingstop').html(response.error.ultimatetrail_trailingstop);
                    }
                    else
                    {
                        $('#ultimatetrail_trailingstop').removeClass('is-invalid');
                        $('.errorultimatetrailtrailingstop').html('');
                    }
					
					if (response.error.ultimatetrail_jarakts){
                        $('#ultimatetrail_jarakts').addClass('is-invalid');
                        $('.errorultimatetrailjarakts').html(response.error.ultimatetrail_jarakts);
                    }
                    else
                    {
                        $('#ultimatetrail_jarakts').removeClass('is-invalid');
                        $('.errorultimatetrailjarakts').html('');
                    }
                }
                else
                {
                    $('#modaltambahultimatetrail').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#ultimatetrail_stock').val('');
                        $('#ultimatetrail_buyprice').val('');
                        $('#ultimatetrail_closeprice').val('');
                        $('#ultimatetrail_gainloss').val('');
						$('#ultimatetrail_trailingstop').val('');
                        $('#ultimatetrail_jarakts').val('');
						
						$('#ultimatetrail_stock').removeClass('is-invalid');
						$('.errorultimatetrailstock').html('');
						
						$('#ultimatetrail_buyprice').removeClass('is-invalid');
						$('.errorultimatetrailbuyprice').html('');
						
						$('#ultimatetrail_closeprice').removeClass('is-invalid');
						$('.errorultimatetrailcloseprice').html('');
						
						$('#ultimatetrail_gainloss').removeClass('is-invalid');
						$('.errorultimatetrailgainloss').html('');
						
						$('#ultimatetrail_trailingstop').removeClass('is-invalid');
						$('.errorultimatetrailtrailingstop').html('');
						
						$('#ultimatetrail_jarakts').removeClass('is-invalid');
						$('.errorultimatetrailjarakts').html('');
			
                        $('#datatable-ultimatetrail').DataTable().ajax.reload();
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
function editultimatetrail($kode) {
    var url = "/ultimate/trailingcontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#ultimatetrail_kodeubah').val(response.success.kode);
            $('#ultimatetrail_stockubah').val(response.success.stock);
            $('#ultimatetrail_buydateubah').val(response.success.buydate);
			$('#ultimatetrail_buypriceubah').val(response.success.buyprice);
            $('#ultimatetrail_closepriceubah').val(response.success.closeprice);
            $('#ultimatetrail_gainlossubah').val(response.success.gainloss);
			$('#ultimatetrail_trailingstopubah').val(response.success.ts);
            $('#ultimatetrail_jaraktsubah').val(response.success.jarakts);
            $('#ultimatetrail_syariahubah').val(response.success.syariah);
			
			if (response.success.active == 1)
            {
                $('#ultimatetrail_isactiveubah').prop("checked", true);
            }
            else
            {
                $('#ultimatetrail_isactiveubah').prop("checked", false);
            }

            $('#ultimatetrail_stockubah').removeClass('is-invalid');
            $('.ultimatetrail_stockubah').html('');
			
			$('#ultimatetrail_buypriceubah').removeClass('is-invalid');
            $('.errorultimatetrailbuypriceubah').html('');
			
			$('#ultimatetrail_closepriceubah').removeClass('is-invalid');
            $('.errorultimatetrailclosepriceubah').html('');
			
			$('#ultimatetrail_gainlossubah').removeClass('is-invalid');
            $('.errorultimatetrailgainlossubah').html('');
			
			$('#ultimatetrail_trailingstopubah').removeClass('is-invalid');
            $('.errorultimatetrailtrailingstopubah').html('');
			
			$('#ultimatetrail_jaraktsubah').removeClass('is-invalid');
            $('.errorultimatetrailjaraktsubah').html('');

            $('#modalubahultimatetrail').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahultimatetrail').submit(function(e) {
        e.preventDefault();
		
		let data = new FormData(this);

        $('.ultimatetrail_isactiveubah').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('ultimatetrail_isactiveubah', 1);
            }
            else
            {
                // alert(0);
                data.append('ultimatetrail_isactiveubah', 0);
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
                $('.btnmodalubahultimatetrailing').prop('disabled', true);
                $('.btnmodalubahultimatetrailing').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahultimatetrailing').prop('disabled', false);
                $('.btnmodalubahultimatetrailing').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.ultimatetrail_stockubah){
                        $('#ultimatetrail_stockubah').addClass('is-invalid');
                        $('.errorultimatetrailstockubah').html(response.error.ultimatetrail_stockubah);
                    }
                    else
                    {
                        $('#ultimatetrail_stockubah').removeClass('is-invalid');
                        $('.errorultimatetrailstockubah').html('');
                    }

                    if (response.error.ultimatetrail_buydateubah){
                        $('#ultimatetrail_buydateubah').addClass('is-invalid');
                        $('.errorultimatetrailbuydateubah').html(response.error.ultimatetrail_buydateubah);
                    }
                    else
                    {
                        $('#ultimatetrail_buydateubah').removeClass('is-invalid');
                        $('.errorultimatetrailbuydateubah').html('');
                    }
					
					if (response.error.ultimatetrail_buypriceubah){
                        $('#ultimatetrail_buypriceubah').addClass('is-invalid');
                        $('.errorultimatetrailbuypriceubah').html(response.error.ultimatetrail_buypriceubah);
                    }
                    else
                    {
                        $('#ultimatetrail_buypriceubah').removeClass('is-invalid');
                        $('.errorultimatetrailbuypriceubah').html('');
                    }

                    if (response.error.ultimatetrail_closepriceubah){
                        $('#ultimatetrail_closepriceubah').addClass('is-invalid');
                        $('.errorultimatetrailclosepriceubah').html(response.error.ultimatetrail_closepriceubah);
                    }
                    else
                    {
                        $('#ultimatetrail_closepriceubah').removeClass('is-invalid');
                        $('.errorultimatetrailclosepriceubah').html('');
                    }
					
					if (response.error.ultimatetrail_gainlossubah){
                        $('#ultimatetrail_gainlossubah').addClass('is-invalid');
                        $('.errorultimatetrailgainlossubah').html(response.error.ultimatetrail_gainlossubah);
                    }
                    else
                    {
                        $('#ultimatetrail_gainlossubah').removeClass('is-invalid');
                        $('.errorultimatetrailgainlossubah').html('');
                    }

                    if (response.error.ultimatetrail_trailingstopubah){
                        $('#ultimatetrail_trailingstopubah').addClass('is-invalid');
                        $('.errorultimatetrailtrailingstopubah').html(response.error.ultimatetrail_trailingstopubah);
                    }
                    else
                    {
                        $('#ultimatetrail_trailingstopubah').removeClass('is-invalid');
                        $('.errorultimatetrailtrailingstopubah').html('');
                    }
					
					if (response.error.ultimatetrail_jaraktsubah){
                        $('#ultimatetrail_jaraktsubah').addClass('is-invalid');
                        $('.errorultimatetrailjaraktsubah').html(response.error.ultimatetrail_jaraktsubah);
                    }
                    else
                    {
                        $('#ultimatetrail_jaraktsubah').removeClass('is-invalid');
                        $('.errorultimatetrailjaraktsubah').html('');
                    }
                }
                else
                {
					$('#modalubahultimatetrail').modal('hide');
					
                    Swal.fire(
                        'Pemberitahuan',
						response.success.data,
                        'success',
						).then(function() {
							$('#datatable-ultimatetrail').DataTable().ajax.reload();
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
function deleteultimatetrail($kode) {
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
            var url =  '/ultimate/trailingcontroller/hapusdata';

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
                            $('#datatable-ultimatetrail').DataTable().ajax.reload();
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