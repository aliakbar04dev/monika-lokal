$('#packageprice_fitur').summernote({
    placeholder: 'Masukkan pesan disini ...',
    tabsize: 2,
    height: 100
});

// Format rupiah inputan add
var add_harganonmember_bulanan = document.getElementById('packageprice_harganonmemberbulanan');
var add_tmpharganonmember_bulanan = document.getElementById('packageprice_hargatmpnonmemberbulanan');

var add_hargakoperasi_bulanan = document.getElementById('packageprice_hargakoperasibulanan');
var add_tmphargakoperasi_bulanan = document.getElementById('packageprice_hargatmpkoperasibulanan');

var add_hargakomunitas_bulanan = document.getElementById('packageprice_hargakomunitasbulanan');
var add_tmphargakomunitas_bulanan = document.getElementById('packageprice_hargatmpkomunitasbulanan');

var add_hargamemberdual_bulanan = document.getElementById('packageprice_hargamemberdualbulanan');
var add_tmphargamemberdual_bulanan = document.getElementById('packageprice_hargatmpmemberdualbulanan');

var add_harganonmember_tahunan = document.getElementById('packageprice_harganonmembertahunan');
var add_tmpharganonmember_tahunan = document.getElementById('packageprice_hargatmpnonmembertahunan');

var add_hargakoperasi_tahunan = document.getElementById('packageprice_hargakoperasitahunan');
var add_tmphargakoperasi_tahunan = document.getElementById('packageprice_hargatmpkoperasitahunan');

var add_hargakomunitas_tahunan = document.getElementById('packageprice_hargakomunitastahunan');
var add_tmphargakomunitas_tahunan = document.getElementById('packageprice_hargatmpkomunitastahunan');

var add_hargamemberdual_tahunan = document.getElementById('packageprice_hargamemberdualtahunan');
var add_tmphargamemberdual_tahunan = document.getElementById('packageprice_hargatmpmemberdualtahunan');

add_harganonmember_bulanan.addEventListener('keyup', function(e) {
    add_harganonmember_bulanan.value = formatRupiah(this.value, 'Rp. ');
    add_tmpharganonmember_bulanan.value = formatAngka(add_harganonmember_bulanan.value);
});

add_hargakoperasi_bulanan.addEventListener('keyup', function(e) {
    add_hargakoperasi_bulanan.value = formatRupiah(this.value, 'Rp. ');
    add_tmphargakoperasi_bulanan.value = formatAngka(add_hargakoperasi_bulanan.value);
});

add_hargakomunitas_bulanan.addEventListener('keyup', function(e) {
    add_hargakomunitas_bulanan.value = formatRupiah(this.value, 'Rp. ');
    add_tmphargakomunitas_bulanan.value = formatAngka(add_hargakomunitas_bulanan.value);
});

add_hargamemberdual_bulanan.addEventListener('keyup', function(e) {
    add_hargamemberdual_bulanan.value = formatRupiah(this.value, 'Rp. ');
    add_tmphargamemberdual_bulanan.value = formatAngka(add_hargamemberdual_bulanan.value);
});

add_harganonmember_tahunan.addEventListener('keyup', function(e) {
    add_harganonmember_tahunan.value = formatRupiah(this.value, 'Rp. ');
    add_tmpharganonmember_tahunan.value = formatAngka(add_harganonmember_tahunan.value);
});

add_hargakoperasi_tahunan.addEventListener('keyup', function(e) {
    add_hargakoperasi_tahunan.value = formatRupiah(this.value, 'Rp. ');
    add_tmphargakoperasi_tahunan.value = formatAngka(add_hargakoperasi_tahunan.value);
});

add_hargakomunitas_tahunan.addEventListener('keyup', function(e) {
    add_hargakomunitas_tahunan.value = formatRupiah(this.value, 'Rp. ');
    add_tmphargakomunitas_tahunan.value = formatAngka(add_hargakomunitas_tahunan.value);
});

add_hargamemberdual_tahunan.addEventListener('keyup', function(e) {
    add_hargamemberdual_tahunan.value = formatRupiah(this.value, 'Rp. ');
    add_tmphargamemberdual_tahunan.value = formatAngka(add_hargamemberdual_tahunan.value);
});

// Format rupiah inputan edit
var add_harganonmember_bulananubah = document.getElementById('packageprice_harganonmemberbulananubah');
var add_tmpharganonmember_bulananubah = document.getElementById('packageprice_hargatmpnonmemberbulananubah');

var add_hargakoperasi_bulananubah = document.getElementById('packageprice_hargakoperasibulananubah');
var add_tmphargakoperasi_bulananubah = document.getElementById('packageprice_hargatmpkoperasibulananubah');

var add_hargakomunitas_bulananubah = document.getElementById('packageprice_hargakomunitasbulananubah');
var add_tmphargakomunitas_bulananubah = document.getElementById('packageprice_hargatmpkomunitasbulananubah');

var add_hargamemberdual_bulananubah = document.getElementById('packageprice_hargamemberdualbulananubah');
var add_tmphargamemberdual_bulananubah = document.getElementById('packageprice_hargatmpmemberdualbulananubah');

var add_harganonmember_tahunanubah = document.getElementById('packageprice_harganonmembertahunanubah');
var add_tmpharganonmember_tahunanubah = document.getElementById('packageprice_hargatmpnonmembertahunanubah');

var add_hargakoperasi_tahunanubah = document.getElementById('packageprice_hargakoperasitahunanubah');
var add_tmphargakoperasi_tahunanubah = document.getElementById('packageprice_hargatmpkoperasitahunanubah');

var add_hargakomunitas_tahunanubah = document.getElementById('packageprice_hargakomunitastahunanubah');
var add_tmphargakomunitas_tahunanubah = document.getElementById('packageprice_hargatmpkomunitastahunanubah');

var add_hargamemberdual_tahunanubah = document.getElementById('packageprice_hargamemberdualtahunanubah');
var add_tmphargamemberdual_tahunanubah = document.getElementById('packageprice_hargatmpmemberdualtahunanubah');

add_harganonmember_bulananubah.addEventListener('keyup', function(e) {
    add_harganonmember_bulananubah.value = formatRupiah(this.value, 'Rp. ');
    add_tmpharganonmember_bulananubah.value = formatAngka(add_harganonmember_bulananubah.value);
});

add_hargakoperasi_bulananubah.addEventListener('keyup', function(e) {
    add_hargakoperasi_bulananubah.value = formatRupiah(this.value, 'Rp. ');
    add_tmphargakoperasi_bulananubah.value = formatAngka(add_hargakoperasi_bulananubah.value);
});

add_hargakomunitas_bulananubah.addEventListener('keyup', function(e) {
    add_hargakomunitas_bulananubah.value = formatRupiah(this.value, 'Rp. ');
    add_tmphargakomunitas_bulananubah.value = formatAngka(add_hargakomunitas_bulananubah.value);
});

add_hargamemberdual_bulananubah.addEventListener('keyup', function(e) {
    add_hargamemberdual_bulananubah.value = formatRupiah(this.value, 'Rp. ');
    add_tmphargamemberdual_bulananubah.value = formatAngka(add_hargamemberdual_bulananubah.value);
});

add_harganonmember_tahunanubah.addEventListener('keyup', function(e) {
    add_harganonmember_tahunanubah.value = formatRupiah(this.value, 'Rp. ');
    add_tmpharganonmember_tahunanubah.value = formatAngka(add_harganonmember_tahunanubah.value);
});

add_hargakoperasi_tahunanubah.addEventListener('keyup', function(e) {
    add_hargakoperasi_tahunanubah.value = formatRupiah(this.value, 'Rp. ');
    add_tmphargakoperasi_tahunanubah.value = formatAngka(add_hargakoperasi_tahunanubah.value);
});

add_hargakomunitas_tahunanubah.addEventListener('keyup', function(e) {
    add_hargakomunitas_tahunanubah.value = formatRupiah(this.value, 'Rp. ');
    add_tmphargakomunitas_tahunanubah.value = formatAngka(add_hargakomunitas_tahunanubah.value);
});

add_hargamemberdual_tahunanubah.addEventListener('keyup', function(e) {
    add_hargamemberdual_tahunanubah.value = formatRupiah(this.value, 'Rp. ');
    add_tmphargamemberdual_tahunanubah.value = formatAngka(add_hargamemberdual_tahunanubah.value);
});

//Datatables server side
$(document).ready( function () {
    var url = '/package/pricecontroller/ajax_list';
    var table = $('#datatable-packageprice').DataTable({
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
            "widht": '100',
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
function generatekodepackageprice() {
    var url = "/package/pricecontroller/getdata";
    $.ajax({
        url: BASE_URL + url,
        dataType: "JSON",
        success: function(response) {
            $('#packageprice_kode').val(response.kodegen);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal add data
$(document).ready(function() {
    $('.formModaltambahpackageprice').submit(function(e) {
        e.preventDefault();
		
		let data = new FormData(this);

        $('.packageprice_isactive').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('packageprice_isactive', 1);
            }
            else
            {
                // alert(0);
                data.append('packageprice_isactive', 0);
            }
        });
		
		var plainText = $($("#packageprice_fitur").summernote("code")).text()
		data.append('packageprice_plaintext', plainText);

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
                $('.btnmodaltambahpackageprice').prop('disabled', true);
                $('.btnmodaltambahpackageprice').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodaltambahpackageprice').prop('disabled', false);
                $('.btnmodaltambahpackageprice').html('Simpan');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.packageprice_kode){
                        $('#packageprice_kode').addClass('is-invalid');
                        $('.errorPackagapricekode').html(response.error.packageprice_kode);
                    }
                    else
                    {
                        $('#packageprice_kode').removeClass('is-invalid');
                        $('.errorPackagapricekode').html('');
                    }

                    if (response.error.packageprice_harganonmemberbulanan){
                        $('#packageprice_harganonmemberbulanan').addClass('is-invalid');
                        $('.errorPackagapriceharganonmemberbulanan').html(response.error.packageprice_harganonmemberbulanan);
                    }
                    else
                    {
                        $('#packageprice_harganonmemberbulanan').removeClass('is-invalid');
                        $('.errorPackagapriceharganonmemberbulanan').html('');
                    }

                    if (response.error.packageprice_hargakoperasibulanan){
                        $('#packageprice_hargakoperasibulanan').addClass('is-invalid');
                        $('.errorPackagapricehargakoperasibulanan').html(response.error.packageprice_hargakoperasibulanan);
                    }
                    else
                    {
                        $('#packageprice_hargakoperasibulanan').removeClass('is-invalid');
                        $('.errorPackagapricehargakoperasibulanan').html('');
                    }

                    if (response.error.packageprice_hargakomunitasbulanan){
                        $('#packageprice_hargakomunitasbulanan').addClass('is-invalid');
                        $('.errorPackagapricehargakomunitasbulanan').html(response.error.packageprice_hargakomunitasbulanan);
                    }
                    else
                    {
                        $('#packageprice_hargakomunitasbulanan').removeClass('is-invalid');
                        $('.errorPackagapricehargakomunitasbulanan').html('');
                    }

                    if (response.error.packageprice_hargamemberdualbulanan){
                        $('#packageprice_hargamemberdualbulanan').addClass('is-invalid');
                        $('.errorPackagapricehargamemberdualbulanan').html(response.error.packageprice_hargamemberdualbulanan);
                    }
                    else
                    {
                        $('#packageprice_hargamemberdualbulanan').removeClass('is-invalid');
                        $('.errorPackagapricehargamemberdualbulanan').html('');
                    }

                    if (response.error.packageprice_harganonmembertahunan){
                        $('#packageprice_harganonmembertahunan').addClass('is-invalid');
                        $('.errorPackagapriceharganonmembertahunan').html(response.error.packageprice_harganonmembertahunan);
                    }
                    else
                    {
                        $('#packageprice_harganonmembertahunan').removeClass('is-invalid');
                        $('.errorPackagapriceharganonmembertahunan').html('');
                    }

                    if (response.error.packageprice_hargakoperasitahunan){
                        $('#packageprice_hargakoperasitahunan').addClass('is-invalid');
                        $('.errorPackagapricehargakoperasitahunan').html(response.error.packageprice_hargakoperasitahunan);
                    }
                    else
                    {
                        $('#packageprice_hargakoperasitahunan').removeClass('is-invalid');
                        $('.errorPackagapricehargakoperasitahunan').html('');
                    }

                    if (response.error.packageprice_hargakomunitastahunan){
                        $('#packageprice_hargakomunitastahunan').addClass('is-invalid');
                        $('.errorPackagapricehargakomunitastahunan').html(response.error.packageprice_hargakomunitastahunan);
                    }
                    else
                    {
                        $('#packageprice_hargakomunitastahunan').removeClass('is-invalid');
                        $('.errorPackagapricehargakomunitastahunan').html('');
                    }

                    if (response.error.packageprice_hargamemberdualtahunan){
                        $('#packageprice_hargamemberdualtahunan').addClass('is-invalid');
                        $('.errorPackagapricehargamemberdualtahunan').html(response.error.packageprice_hargamemberdualtahunan);
                    }
                    else
                    {
                        $('#packageprice_hargamemberdualtahunan').removeClass('is-invalid');
                        $('.errorPackagapricehargamemberdualtahunan').html('');
                    }
					
					if (response.error.packageprice_poin){
                        $('#packageprice_poin').addClass('is-invalid');
                        $('.errorPackagapricepoin').html(response.error.packageprice_poin);
                    }
                    else
                    {
                        $('#packageprice_poin').removeClass('is-invalid');
                        $('.errorPackagapricepoin').html('');
                    }
					
					if (response.error.packageprice_level){
                        $('#packageprice_level').addClass('is-invalid');
                        $('.errorPackagepricelevel').html(response.error.packageprice_level);
                    }
                    else
                    {
                        $('#packageprice_level').removeClass('is-invalid');
                        $('.errorPackagepricelevel').html('');
                    }
                }
                else
                {
                    $('#modaltambahpackageprice').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        // window.location = response.success.link;
                        // refreshTable();
						$('#packageprice_deskripsi').val('');
						$('#packageprice_fitur').summernote({value: ''});
                        $('#packageprice_harganonmemberbulanan').val('');
                        $('#packageprice_hargatmpnonmemberbulanan').val('');

                        $('#packageprice_hargakoperasibulanan').val('');
                        $('#packageprice_hargatmpkoperasibulanan').val('');

                        $('#packageprice_hargakomunitasbulanan').val('');
                        $('#packageprice_hargatmpkomunitasbulanan').val('');

                        $('#packageprice_hargamemberdualbulanan').val('');
                        $('#packageprice_hargatmpmemberdualbulanan').val('');

                        $('#packageprice_harganonmembertahunan').val('');
                        $('#packageprice_hargatmpnonmembertahunan').val('');

                        $('#packageprice_hargakoperasitahunan').val('');
                        $('#packageprice_hargatmpkoperasitahunan').val('');

                        $('#packageprice_hargakomunitastahunan').val('');
                        $('#packageprice_hargatmpkomunitastahunan').val('');

                        $('#packageprice_hargamemberdualtahunan').val('');
                        $('#packageprice_hargatmpmemberdualtahunan').val('');

						$('#packageprice_poin').val('');
						$('#packageprice_level').val('');
                        $('#datatable-packageprice').DataTable().ajax.reload();
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
function editpackageprice($kode) {
    var url = "/package/pricecontroller/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#packageprice_kodeubah').val(response.success.kode);
            $('#packageprice_kodeuserubah').val(response.success.user_level);
			$('#packageprice_levelubah').val(response.success.title);
			$('#packageprice_deskripsiubah').val(response.success.deskripsi);
            $('#packageprice_harganonmemberbulananubah').val(formatRupiah(response.success.harga_nonmember_bulanan, 'Rp. '));
            $('#packageprice_hargatmpnonmemberbulananubah').val(response.success.harga_nonmember_bulanan);

            $('#packageprice_hargakoperasibulananubah').val(formatRupiah(response.success.harga_koperasi_bulanan, 'Rp. '));
            $('#packageprice_hargatmpkoperasibulananubah').val(response.success.harga_koperasi_bulanan);

            $('#packageprice_hargakomunitasbulananubah').val(formatRupiah(response.success.harga_komunitas_bulanan, 'Rp. '));
            $('#packageprice_hargatmpkomunitasbulananubah').val(response.success.harga_komunitas_bulanan);

            $('#packageprice_hargamemberdualbulananubah').val(formatRupiah(response.success.harga_dualmember_bulanan, 'Rp. '));
            $('#packageprice_hargatmpmemberdualbulananubah').val(response.success.harga_dualmember_bulanan);

            $('#packageprice_harganonmembertahunanubah').val(formatRupiah(response.success.harga_nonmember_tahunan, 'Rp. '));
            $('#packageprice_hargatmpnonmembertahunanubah').val(response.success.harga_nonmember_tahunan);

            $('#packageprice_hargakoperasitahunanubah').val(formatRupiah(response.success.harga_koperasi_tahunan, 'Rp. '));
            $('#packageprice_hargatmpkoperasitahunanubah').val(response.success.harga_koperasi_tahunan);

            $('#packageprice_hargakomunitastahunanubah').val(formatRupiah(response.success.harga_komunitas_tahunan, 'Rp. '));
            $('#packageprice_hargatmpkomunitastahunanubah').val(response.success.harga_komunitas_tahunan);

            $('#packageprice_hargamemberdualtahunanubah').val(formatRupiah(response.success.harga_dualmember_tahunan, 'Rp. '));
            $('#packageprice_hargatmpmemberdualtahunanubah').val(response.success.harga_dualmember_tahunan);

			$('#packageprice_poinubah').val(response.success.poin);
            $('#packageprice_durasiubah').val(response.success.bulan);
			$('#packageprice_fiturubah').summernote('insertText', response.success.fitur);
			if (response.success.is_ready == 1)
            {
                $('#packageprice_isactiveubah').prop("checked", true);
            }
            else
            {
                $('#packageprice_isactiveubah').prop("checked", false);
            }
			
			$('#packageprice_harganonmemberbulananubah').removeClass('is-invalid');
            $('.errorPackagapriceharganonmemberbulananubah').html('');

            $('#packageprice_hargakoperasibulananubah').removeClass('is-invalid');
            $('.errorPackagapricehargakoperasibulananubah').html('');

            $('#packageprice_hargakomunitasbulananubah').removeClass('is-invalid');
            $('.errorPackagapricehargakomunitasbulananubah').html('');

            $('#packageprice_hargamemberdualbulananubah').removeClass('is-invalid');
            $('.errorPackagapricehargamemberdualbulananubah').html('');

            $('#packageprice_harganonmembertahunanubah').removeClass('is-invalid');
            $('.errorPackagapriceharganonmembertahunanubah').html('');

            $('#packageprice_hargakoperasitahunanubah').removeClass('is-invalid');
            $('.errorPackagapricehargakoperasitahunanubah').html('');

            $('#packageprice_hargakomunitastahunanubah').removeClass('is-invalid');
            $('.errorPackagapricehargakomunitastahunanubah').html('');

            $('#packageprice_hargamemberdualtahunanubah').removeClass('is-invalid');
            $('.errorPackagapricehargamemberdualtahunanubah').html('');
			
			$('#packageprice_poinubah').removeClass('is-invalid');
            $('.errorPackagapricepoinubah').html('');

            $('#packageprice_levelubah').removeClass('is-invalid');
            $('.errorPackagepricelevelubah').html('');

            $('#modalubahpackageprice').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi modal update data
$(document).ready(function() {
    $('.formModalubahpackageprice').submit(function(e) {
        e.preventDefault();
		
		let data = new FormData(this);

        $('.packageprice_isactiveubah').each(function() {
            if ($(this).is(":checked"))
            {
                // alert(1);
                data.append('packageprice_isactiveubah', 1);
            }
            else
            {
                // alert(0);
                data.append('packageprice_isactiveubah', 0);
            }
        });
		
		//var plainText = $($("#packageprice_fiturubah").code()).text();
		var plainText = $($("#packageprice_fiturubah").summernote("code")).text()
		data.append('packageprice_plaintextubah', plainText);

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
                $('.btnmodalubahpackageprice').prop('disabled', true);
                $('.btnmodalubahpackageprice').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahpackageprice').prop('disabled', false);
                $('.btnmodalubahpackageprice').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.packageprice_harganonmemberbulananubah){
                        $('#packageprice_harganonmemberbulananubah').addClass('is-invalid');
                        $('.errorPackagapriceharganonmemberbulananubah').html(response.error.packageprice_harganonmemberbulananubah);
                    }
                    else
                    {
                        $('#packageprice_harganonmemberbulananubah').removeClass('is-invalid');
                        $('.errorPackagapriceharganonmemberbulananubah').html('');
                    }

                    if (response.error.packageprice_hargakoperasibulananubah){
                        $('#packageprice_hargakoperasibulananubah').addClass('is-invalid');
                        $('.errorPackagapricehargakoperasibulananubah').html(response.error.packageprice_hargakoperasibulananubah);
                    }
                    else
                    {
                        $('#packageprice_hargakoperasibulananubah').removeClass('is-invalid');
                        $('.errorPackagapricehargakoperasibulananubah').html('');
                    }

                    if (response.error.packageprice_hargakomunitasbulananubah){
                        $('#packageprice_hargakomunitasbulananubah').addClass('is-invalid');
                        $('.errorPackagapricehargakomunitasbulananubah').html(response.error.packageprice_hargakomunitasbulananubah);
                    }
                    else
                    {
                        $('#packageprice_hargakomunitasbulananubah').removeClass('is-invalid');
                        $('.errorPackagapricehargakomunitasbulananubah').html('');
                    }

                    if (response.error.packageprice_hargamemberdualbulananubah){
                        $('#packageprice_hargamemberdualbulananubah').addClass('is-invalid');
                        $('.errorPackagapricehargamemberdualbulananubah').html(response.error.packageprice_hargamemberdualbulananubah);
                    }
                    else
                    {
                        $('#packageprice_hargamemberdualbulananubah').removeClass('is-invalid');
                        $('.errorPackagapricehargamemberdualbulananubah').html('');
                    }

                    if (response.error.packageprice_harganonmembertahunanubah){
                        $('#packageprice_harganonmembertahunanubah').addClass('is-invalid');
                        $('.errorPackagapriceharganonmembertahunanubah').html(response.error.packageprice_harganonmembertahunanubah);
                    }
                    else
                    {
                        $('#packageprice_harganonmembertahunanubah').removeClass('is-invalid');
                        $('.errorPackagapriceharganonmembertahunanubah').html('');
                    }

                    if (response.error.packageprice_hargakoperasitahunanubah){
                        $('#packageprice_hargakoperasitahunanubah').addClass('is-invalid');
                        $('.errorPackagapricehargakoperasitahunanubah').html(response.error.packageprice_hargakoperasitahunanubah);
                    }
                    else
                    {
                        $('#packageprice_hargakoperasitahunanubah').removeClass('is-invalid');
                        $('.errorPackagapricehargakoperasitahunanubah').html('');
                    }

                    if (response.error.packageprice_hargakomunitastahunanubah){
                        $('#packageprice_hargakomunitastahunanubah').addClass('is-invalid');
                        $('.errorPackagapricehargakomunitastahunanubah').html(response.error.packageprice_hargakomunitastahunanubah);
                    }
                    else
                    {
                        $('#packageprice_hargakomunitastahunanubah').removeClass('is-invalid');
                        $('.errorPackagapricehargakomunitastahunanubah').html('');
                    }

                    if (response.error.packageprice_hargamemberdualtahunanubah){
                        $('#packageprice_hargamemberdualtahunanubah').addClass('is-invalid');
                        $('.errorPackagapricehargamemberdualtahunanubah').html(response.error.packageprice_hargamemberdualtahunanubah);
                    }
                    else
                    {
                        $('#packageprice_hargamemberdualtahunanubah').removeClass('is-invalid');
                        $('.errorPackagapricehargamemberdualtahunanubah').html('');
                    }
					
					if (response.error.packageprice_poinubah){
                        $('#packageprice_poinubah').addClass('is-invalid');
                        $('.errorPackagapricepoinubah').html(response.error.packageprice_poinubah);
                    }
                    else
                    {
                        $('#packageprice_poinubah').removeClass('is-invalid');
                        $('.errorPackagapricepoinubah').html('');
                    }
					
					if (response.error.packageprice_levelubah){
                        $('#packageprice_levelubah').addClass('is-invalid');
                        $('.errorPackagepricelevelubah').html(response.error.packageprice_levelubah);
                    }
                    else
                    {
                        $('#packageprice_levelubah').removeClass('is-invalid');
                        $('.errorPackagepricelevelubah').html('');
                    }
                }
                else
                {
                    $('#modalubahpackageprice').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#packageprice_deskripsiubah').val('');
						$('#packageprice_fiturubah').summernote({value: ''});
                        $('#packageprice_harganonmemberbulananubah').val('');
                        $('#packageprice_hargatmpnonmemberbulananubah').val('');

                        $('#packageprice_hargakoperasibulananubah').val('');
                        $('#packageprice_hargatmpkoperasibulananubah').val('');

                        $('#packageprice_hargakomunitasbulananubah').val('');
                        $('#packageprice_hargatmpkomunitasbulananubah').val('');

                        $('#packageprice_hargamemberdualbulananubah').val('');
                        $('#packageprice_hargatmpmemberdualbulananubah').val('');

                        $('#packageprice_harganonmembertahunanubah').val('');
                        $('#packageprice_hargatmpnonmembertahunanubah').val('');

                        $('#packageprice_hargakoperasitahunanubah').val('');
                        $('#packageprice_hargatmpkoperasitahunanubah').val('');

                        $('#packageprice_hargakomunitastahunanubah').val('');
                        $('#packageprice_hargatmpkomunitastahunanubah').val('');

                        $('#packageprice_hargamemberdualtahunanubah').val('');
                        $('#packageprice_hargatmpmemberdualtahunanubah').val('');

						$('#packageprice_poinubah').val('');
						$('#packageprice_levelubah').val('');
                        $('#datatable-packageprice').DataTable().ajax.reload();
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