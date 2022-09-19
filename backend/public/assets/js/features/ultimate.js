//Datatables server side
$(document).ready( function () {
    var url = '/features/ultimatecontroller/ajax_list';
    var table = $('#datatable-featuresultimate').DataTable({ 
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

CKEDITOR.replace('featuresultimate_isi');
CKEDITOR.replace('featuresultimate_isiubah');

//Fungsi modal add data
$(document).ready(function() {
    //Fungsi generate kode berdasarkan select option
    $('#featuresultimate_jenis').on('change',function(){
        var url = "/features/ultimatecontroller/getdata";
        var kode = $('#featuresultimate_jenis :selected').val();
        
        $.ajax({
            type: "POST",
            url: BASE_URL + url,
            data: {
               kode: kode,
               date: $('#featuresultimate_tanggal').val(),
            },
            success:function(response){
                var result = JSON.parse(response);
                $('#featuresultimate_kode').val(result.kodegen);
                // alert(result.kodegen);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });

    $('.formModaltambahfeaturesultimate').submit(function(e) {
        e.preventDefault();

        let data = new FormData(this);
	    data.append('featuresultimate_isi', CKEDITOR.instances.featuresultimate_isi.getData());

        $('.featuresultimate_isactive').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('featuresultimate_isactive', 1);
            }
            else
            {
                // alert(0);
                data.append('featuresultimate_isactive', 0);
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
                $('.btnmodaltambahfeaturesultimate').prop('disabled', true);
                $('.btnmodaltambahfeaturesultimate').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahfeaturesultimate').prop('disabled', false);
                $('.btnmodaltambahfeaturesultimate').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.featuresultimate_kode){
                        $('#featuresultimate_kode').addClass('is-invalid');
                        $('.errorFeaturesultimateKode').html(response.error.featuresultimate_kode);
                    }
                    else
                    {
                        $('#featuresultimate_kode').removeClass('is-invalid');
                        $('.errorFeaturesultimateKode').html('');
                    }

                    if (response.error.featuresultimate_isi){
                        $('#featuresultimate_isi').addClass('is-invalid');
                        $('.errorFeaturesultimateIsi').html(response.error.featuresultimate_isi);
                    }
                    else
                    {
                        $('#featuresultimate_isi').removeClass('is-invalid');
                        $('.errorFeaturesultimateIsi').html('');
                    }
                }
                else
                {
                    $('#modaltambahfeaturesultimate').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
						$('#featuresultimate_isi').val('');
                        $('#featuresultimate_isactive').prop("checked", false);
						
                        $('#datatable-featuresultimate').DataTable().ajax.reload();
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
function editfeaturesultimate($kode) {
    var url = "/features/ultimatecontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#featuresultimate_kodeubah').val(response.success.kode);
            $('#featuresultimate_jenisubah').val(response.success.jenis);
            $('#featuresultimate_tanggalubah').val(response.success.tanggal);
            CKEDITOR.instances.featuresultimate_isiubah.setData(response.success.isi);

            if (response.success.status == 1)
            {
                $('#featuresultimate_isactiveubah').prop("checked", true);
            }
            else
            {
                $('#featuresultimate_isactiveubah').prop("checked", false);
            }

            $('#featuresultimate_kodeubah').removeClass('is-invalid');
            $('.errorFeaturesultimateKodeubah').html('');

            $('#modalubahfeaturesultimate').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

// Handle Modal ubah
$(document).ready(function() {
    $('.formModalubahfeaturesultimate').submit(function(e) {
        e.preventDefault();

        let data = new FormData(this);
	  
		data.append('featuresultimate_isiubah', CKEDITOR.instances.featuresultimate_isiubah.getData());

		$('.featuresultimate_isactiveubah').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('featuresultimate_isactiveubah', 1);
            }
            else
            {
                // alert(0);
                data.append('featuresultimate_isactiveubah', 0);
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
                $('.btnmodalubahfeaturesultimate').prop('disabled', true);
                $('.btnmodalubahfeaturesultimate').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahfeaturesultimate').prop('disabled', false);
                $('.btnmodalubahfeaturesultimate').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.featuresultimate_isiubah){
                        $('#featuresultimate_isiubah').addClass('is-invalid');
                        $('.errorFeaturesultimateIsiubah').html(response.error.featuresultimate_isiubah);
                    }
                    else
                    {
                        $('#featuresultimate_isiubah').removeClass('is-invalid');
                        $('.errorFeaturesultimateIsiubah').html('');
                    }
                }
                else
                {
                    $('#modalubahfeaturesultimate').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#featuresultimate_isi').val('');
                        $('#featuresultimate_isactive').prop("checked", false);

                        $('#datatable-featuresultimate').DataTable().ajax.reload();
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

// Handle Modal hapus
function deletefeaturesultimate($kode) {
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
            var url =  '/features/ultimatecontroller/hapusdata';

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
                            $('#datatable-featuresultimate').DataTable().ajax.reload();
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