CKEDITOR.replace('careervacancy_deskripsi');
CKEDITOR.replace('careervacancy_requirement');
CKEDITOR.replace('careervacancy_benefit');

CKEDITOR.replace('careervacancy_deskripsiubah');
CKEDITOR.replace('careervacancy_requirementubah');
CKEDITOR.replace('careervacancy_benefitubah');

//Datatables server side
$(document).ready( function () {
    var url = '/career/VacancyController/ajax_list';
    var table = $('#datatable-careervacancy').DataTable({ 
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
function generatekodecareervacancy() {
    var url = "/career/VacancyController/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#careervacancy_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahcareervacancy').submit(function(e) {
        e.preventDefault();
		
		let data = new FormData(this);
	  
		data.append('careervacancy_deskripsi', CKEDITOR.instances.careervacancy_deskripsi.getData());
		data.append('careervacancy_requirement', CKEDITOR.instances.careervacancy_requirement.getData());
		data.append('careervacancy_benefit', CKEDITOR.instances.careervacancy_benefit.getData());
		
		$('.careervacancy_isactive').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('careervacancy_isactive', 1);
            }
            else
            {
                // alert(0);
                data.append('careervacancy_isactive', 0);
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
                $('.btnmodaltambahcareervacancy').prop('disabled', true);
                $('.btnmodaltambahcareervacancy').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahcareervacancy').prop('disabled', false);
                $('.btnmodaltambahcareervacancy').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.careervacancy_kode){
                        $('#careervacancy_kode').addClass('is-invalid');
                        $('.errorCareervacancyKode').html(response.error.careervacancy_kode);
                    }
                    else
                    {
                        $('#careervacancy_kode').removeClass('is-invalid');
                        $('.errorCareervacancyKode').html('');
                    }

                    if (response.error.careervacancy_posisi){
                        $('#careervacancy_posisi').addClass('is-invalid');
                        $('.errorCareervacancyPosisi').html(response.error.careervacancy_posisi);
                    }
                    else
                    {
                        $('#careervacancy_posisi').removeClass('is-invalid');
                        $('.errorCareervacancyPosisi').html('');
                    }
                }
                else
                {
                    $('#modaltambahcareervacancy').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        // window.location = response.success.link;
                        // refreshTable();
                        $('#careervacancy_posisi').val('');
                        $('#datatable-careervacancy').DataTable().ajax.reload();
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
function editcareervacancy($kode) {
    var url = "/career/VacancyController/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#careervacancy_kodeubah').val(response.success.kode);
            $('#careervacancy_posisiubah').val(response.success.nama);
			$('#careervacancy_lokasiubah').val(response.success.lokasi);
			$('#careervacancy_departemenubah').val(response.success.departemen);
			$('#careervacancy_kategoriubah').val(response.success.kategori);
			CKEDITOR.instances.careervacancy_deskripsiubah.setData(response.success.deskripsi);
			CKEDITOR.instances.careervacancy_requirementubah.setData(response.success.requirement);
			CKEDITOR.instances.careervacancy_benefitubah.setData(response.success.benefit);
			
			if (response.success.publish == 1)
            {
                $('#careervacancy_isactiveubah').prop("checked", true);
            }
            else
            {
                $('#careervacancy_isactiveubah').prop("checked", false);
            }

            $('#careervacancy_posisiubah').removeClass('is-invalid');
            $('.errorCareervacancyPosisiubah').html('');

            $('#modalubahcareervacancy').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahcareervacancy').submit(function(e) {
        e.preventDefault();
		
		let data = new FormData(this);
	  
		data.append('careervacancy_deskripsiubah', CKEDITOR.instances.careervacancy_deskripsiubah.getData());
		data.append('careervacancy_requirementubah', CKEDITOR.instances.careervacancy_requirementubah.getData());
		data.append('careervacancy_benefitubah', CKEDITOR.instances.careervacancy_benefitubah.getData());
		
		$('.careervacancy_isactiveubah').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('careervacancy_isactiveubah', 1);
            }
            else
            {
                // alert(0);
                data.append('careervacancy_isactiveubah', 0);
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
                $('.btnmodalubahcareervacancy').prop('disabled', true);
                $('.btnmodalubahcareervacancy').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahcareervacancy').prop('disabled', false);
                $('.btnmodalubahcareervacancy').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.careervacancy_posisiubah){
                        $('#careervacancy_posisiubah').addClass('is-invalid');
                        $('.errorCareervacancyPosisiubah').html(response.error.careervacancy_posisiubah);
                    }
                    else
                    {
                        $('#careervacancy_posisiubah').removeClass('is-invalid');
                        $('.errorCareervacancyPosisiubah').html('');
                    }
                }
                else
                {
                    $('#modalubahcareervacancy').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-careervacancy').DataTable().ajax.reload();
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
function deletecareervacancy($kode) {
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
            var url =  '/career/VacancyController/hapusdata';

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
                            $('#datatable-careervacancy').DataTable().ajax.reload();
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