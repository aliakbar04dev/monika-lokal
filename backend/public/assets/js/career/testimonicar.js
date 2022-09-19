//Datatables server side
$(document).ready( function () {
    var url = '/career/TestimoniController/ajax_list';
    var table = $('#datatable-careertestimoni').DataTable({ 
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
function generatekodecareertestimoni() {
    var url = "/career/TestimoniController/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#careertestimoni_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahcareertestimoni').submit(function(e) {
        e.preventDefault();
		
		let data = new FormData(this);
		
		$('.careertestimoni_ishighlight').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('careertestimoni_ishighlight', 1);
            }
            else
            {
                // alert(0);
                data.append('careertestimoni_ishighlight', 0);
            }
        });
		
		$('.careertestimoni_isactive').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('careertestimoni_isactive', 1);
            }
            else
            {
                // alert(0);
                data.append('careertestimoni_isactive', 0);
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
            //data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodaltambahcareertestimoni').prop('disabled', true);
                $('.btnmodaltambahcareertestimoni').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahcareertestimoni').prop('disabled', false);
                $('.btnmodaltambahcareertestimoni').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.careertestimoni_kode){
                        $('#careertestimoni_kode').addClass('is-invalid');
                        $('.errorCareertestimoniKode').html(response.error.careertestimoni_kode);
                    }
                    else
                    {
                        $('#careertestimoni_kode').removeClass('is-invalid');
                        $('.errorCareertestimoniKode').html('');
                    }

                    if (response.error.careertestimoni_nama){
                        $('#careertestimoni_nama').addClass('is-invalid');
                        $('.errorCareertestimoniNama').html(response.error.careertestimoni_nama);
                    }
                    else
                    {
                        $('#careertestimoni_nama').removeClass('is-invalid');
                        $('.errorCareertestimoniNama').html('');
                    }
					
					if (response.error.careertestimoni_divisi){
                        $('#careertestimoni_divisi').addClass('is-invalid');
                        $('.errorCareertestimoniDivisi').html(response.error.careertestimoni_divisi);
                    }
                    else
                    {
                        $('#careertestimoni_divisi').removeClass('is-invalid');
                        $('.errorCareertestimoniDivisi').html('');
                    }
					
					if (response.error.careertestimoni_content){
                        $('#careertestimoni_content').addClass('is-invalid');
                        $('.errorCareertestimoniContent').html(response.error.careertestimoni_content);
                    }
                    else
                    {
                        $('#careertestimoni_content').removeClass('is-invalid');
                        $('.errorCareertestimoniContent').html('');
                    }
					
					if (response.error.careertestimoni_gambar){
                        $('#careertestimoni_gambar').addClass('is-invalid');
                        $('.errorCareertestimoniGambar').html(response.error.careertestimoni_gambar);
                    }
                    else
                    {
                        $('#careertestimoni_gambar').removeClass('is-invalid');
                        $('.errorCareertestimoniGambar').html('');
                    }
                }
                else
                {
                    $('#modaltambahcareertestimoni').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#careertestimoni_nama').val('');
						$('#careertestimoni_divisi').val('');
						$('#careertestimoni_content').val('');
                        $('#datatable-careertestimoni').DataTable().ajax.reload();
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
function editcareertestimoni($kode) {
    var url = "/career/TestimoniController/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#careertestimoni_kodeubah').val(response.success.kode);
            $('#careertestimoni_namaubah').val(response.success.nama);
			$('#careertestimoni_divisiubah').val(response.success.divisi);
			$('#careertestimoni_contentubah').val(response.success.testimoni);

            $('#careertestimoni_namaubah').removeClass('is-invalid');
            $('.errorCareertestimoniNamaubah').html('');
			
			$('#careertestimoni_divisiubah').removeClass('is-invalid');
            $('.errorCareertestimoniDivisiubah').html('');
			
			$('#careertestimoni_contentubah').removeClass('is-invalid');
            $('.errorCareertestimoniContentubah').html('');

            $('#modalubahcareertestimoni').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi select gambar 
function changeimgcareertestimoni($kode) {
    var url = "/career/TestimoniController/pilihgambar";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#careertestimoniimg_kodeubah').val(response.success.kode);
            $('#careertestimoniimg_recentimg').attr("src", response.success.gambar);
            if (response.success.is_highlight == 1)
            {
                $('#careertestimoniimg_ishighlightubah').prop("checked", true);
            }
            else
            {
                $('#careertestimoniimg_ishighlightubah').prop("checked", false);
            }
			
			if (response.success.publish == 1)
            {
                $('#careertestimoniimg_isactiveubah').prop("checked", true);
            }
            else
            {
                $('#careertestimoniimg_isactiveubah').prop("checked", false);
            }

            $('#careertestimoniimg_gambarubah').removeClass('is-invalid');
            $('.errorCareertestimoniimgGambarubah').html('');

            $('#modalubahimgcareertestimoni').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahcareertestimoni').submit(function(e) {
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
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahcareertestimoni').prop('disabled', true);
                $('.btnmodalubahcareertestimoni').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahcareertestimoni').prop('disabled', false);
                $('.btnmodalubahcareertestimoni').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.careertestimoni_namaubah){
                        $('#careertestimoni_namaubah').addClass('is-invalid');
                        $('.errorCareertestimoniNamaubah').html(response.error.careertestimoni_namaubah);
                    }
                    else
                    {
                        $('#careertestimoni_namaubah').removeClass('is-invalid');
                        $('.errorCareertestimoniNamaubah').html('');
                    }
					
					if (response.error.careertestimoni_divisiubah){
                        $('#careertestimoni_divisiubah').addClass('is-invalid');
                        $('.errorCareertestimoniDivisiubah').html(response.error.careertestimoni_divisiubah);
                    }
                    else
                    {
                        $('#careertestimoni_divisiubah').removeClass('is-invalid');
                        $('.errorCareertestimoniDivisiubah').html('');
                    }
					
					if (response.error.careertestimoni_contentubah){
                        $('#careertestimoni_contentubah').addClass('is-invalid');
                        $('.errorCareertestimoniContentubah').html(response.error.careertestimoni_contentubah);
                    }
                    else
                    {
                        $('#careertestimoni_contentubah').removeClass('is-invalid');
                        $('.errorCareertestimoniContentubah').html('');
                    }
                }
                else
                {
                    $('#modalubahcareertestimoni').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-careertestimoni').DataTable().ajax.reload();
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

//Fungsi modal update gambar
$(document).ready(function() {
    $('.formModalubahimgcareertestimoni').submit(function(e) {
        e.preventDefault();

        let data = new FormData(this);

        $('.careertestimoniimg_ishighlightubah').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('careertestimoniimg_ishighlightubah', 1);
            }
            else
            {
                // alert(0);
                data.append('careertestimoniimg_ishighlightubah', 0);
            }
        });
		
		$('.careertestimoniimg_isactiveubah').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('careertestimoniimg_isactiveubah', 1);
            }
            else
            {
                // alert(0);
                data.append('careertestimoniimg_isactiveubah', 0);
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
                $('.btnmodalubahimgcareertestimoni').prop('disabled', true);
                $('.btnmodalubahimgcareertestimoni').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahimgcareertestimoni').prop('disabled', false);
                $('.btnmodalubahimgcareertestimoni').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.careertestimoniimg_gambarubah){
                        $('#careertestimoniimg_gambarubah').addClass('is-invalid');
                        $('.errorCareertestimoniimgGambarubah').html(response.error.careertestimoniimg_gambarubah);
                    }
                    else
                    {
                        $('#careertestimoniimg_gambarubah').removeClass('is-invalid');
                        $('.errorCareertestimoniimgGambarubah').html('');
                    }
                }
                else
                {
                    $('#modalubahimgcareertestimoni').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        window.location = response.success.link;
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
function deletecareertestimoni($kode) {
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
            var url =  '/career/TestimoniController/hapusdata';

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
                            $('#datatable-careertestimoni').DataTable().ajax.reload();
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