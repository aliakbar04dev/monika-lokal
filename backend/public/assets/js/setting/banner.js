//Datatables server side
$(document).ready( function () {
    var url = '/setting/bannercontroller/ajax_list';
    var table = $('#datatable-settingbanner').DataTable({ 
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

$('#settingbanner_deskripsi').summernote({
    placeholder: 'Masukkan pesan disini ...',
    tabsize: 2,
    height: 100
  });

/* $('#settingbanner_deskripsiubah').summernote({
    placeholder: 'Masukkan pesan disini ...',
    tabsize: 2,
    height: 100
  }); */

//Fungsi generate kode
function generatekodesettingbanner() {
    var url = "/setting/bannercontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#settingbanner_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahsettingbanner').submit(function(e) {
        e.preventDefault();

        let data = new FormData(this);

        $('.settingbanner_isactive').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('settingbanner_isactive', 1);
            }
            else
            {
                // alert(0);
                data.append('settingbanner_isactive', 0);
            }
        });

        // melihat isi data
        // for(let [name, value] of data)
        // {
        //     alert(`${name} = ${value}`);
        // }

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
                $('.btnmodaltambahsettingbanner').prop('disabled', true);
                $('.btnmodaltambahsettingbanner').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahsettingbanner').prop('disabled', false);
                $('.btnmodaltambahsettingbanner').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.settingbanner_kode){
                        $('#settingbanner_kode').addClass('is-invalid');
                        $('.errorSettingbannerKode').html(response.error.settingbanner_kode);
                    }
                    else
                    {
                        $('#settingbanner_kode').removeClass('is-invalid');
                        $('.errorSettingbannerKode').html('');
                    }

                    if (response.error.settingbanner_nama){
                        $('#settingbanner_nama').addClass('is-invalid');
                        $('.errorSettingbannertNama').html(response.error.settingbanner_nama);
                    }
                    else
                    {
                        $('#settingbanner_nama').removeClass('is-invalid');
                        $('.errorSettingbannertNama').html('');
                    }

                    if (response.error.settingbanner_gambar){
                        $('#settingbanner_gambar').addClass('is-invalid');
                        $('.errorSettingbannerGambar').html(response.error.settingbanner_gambar);
                    }
                    else
                    {
                        $('#settingbanner_gambar').removeClass('is-invalid');
                        $('.errorSettingbannerGambar').html('');
                    }
                }
                else
                {
                    $('#modaltambahsettingbanner').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#settingbanner_nama').val('');
                        $('#settingbanner_nama').val('');
                        $('#settingbanner_deskripsi').val('');
                        $('#settingbanner_gambar').val('');
                        $('#datatable-settingbanner').DataTable().ajax.reload();
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
function editsettingbanner($kode) {
    var url = "/setting/bannercontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#settingbanner_kodeubah').val(response.success.kode);
            $('#settingbanner_namaubah').val(response.success.judul);
			$('#settingbanner_deskripsiubah').summernote('insertText', response.success.deskripsi);
            //$('#settingbanner_deskripsiubah').val(response.success.deskripsi);
            $('#settingbanner_linkubah').val(response.success.link);

            $('#settingbanner_namaubah').removeClass('is-invalid');
            $('.errorSettingbannertNamaubah').html('');

            $('#modalubahsettingbanner').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi select gambar 
function changeimgsettingbanner($kode) {
    var url = "/setting/bannercontroller/pilihgambar";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#settingbannerimg_kodeubah').val(response.success.kode);
            $('#settingbannerimg_recentimg').attr("src", response.success.gambar);
            if (response.success.status == 1)
            {
                $('#settingbannerimg_isactive').prop("checked", true);
            }
            else
            {
                $('#settingbannerimg_isactive').prop("checked", false);
            }

            $('#settingbannerimg_gambar').removeClass('is-invalid');
            $('.errorSettingbannerimgGambar').html('');

            $('#modalubahimgsettingbanner').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahsettingbanner').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahsettingbanner').prop('disabled', true);
                $('.btnmodalubahsettingbanner').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahsettingbanner').prop('disabled', false);
                $('.btnmodalubahsettingbanner').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.settingbanner_namaubah){
                        $('#settingbanner_namaubah').addClass('is-invalid');
                        $('.errorSettingbannertNamaubah').html(response.error.settingbanner_namaubah);
                    }
                    else
                    {
                        $('#settingbanner_namaubah').removeClass('is-invalid');
                        $('.errorSettingbannertNamaubah').html('');
                    }
                }
                else
                {
                    $('#modalubahsettingbanner').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-settingbanner').DataTable().ajax.reload();
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
    $('.formModalubahimgsettingbanner').submit(function(e) {
        e.preventDefault();

        let data = new FormData(this);

        $('.settingbannerimg_isactive').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('settingbannerimg_isactive', 1);
            }
            else
            {
                // alert(0);
                data.append('settingbannerimg_isactive', 0);
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
                $('.btnmodalubahimgsettingbanner').prop('disabled', true);
                $('.btnmodalubahimgsettingbanner').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahimgsettingbanner').prop('disabled', false);
                $('.btnmodalubahimgsettingbanner').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.settingbannerimg_gambar){
                        $('#settingbannerimg_gambar').addClass('is-invalid');
                        $('.errorSettingbannerimgGambar').html(response.error.settingbannerimg_gambar);
                    }
                    else
                    {
                        $('#settingbannerimg_gambar').removeClass('is-invalid');
                        $('.errorSettingbannerimgGambar').html('');
                    }
                }
                else
                {
                    $('#modalubahimgsettingbanner').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        window.location = response.success.link;
                        // $('#datatable-settingbanner').DataTable().ajax.reload();
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
function deletesettingbanner($kode) {
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
            var url =  '/setting/bannercontroller/hapusdata';

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
                            $('#datatable-settingbanner').DataTable().ajax.reload();
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