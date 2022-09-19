//Datatables server side
$(document).ready( function () {
    var url = '/billing/invoicecontroller/ajax_list';
    var table = $('#datatable-billinginvoice').DataTable({ 
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
          "url": BASE_URL + url,
          "type": "POST",
          "data": function ( data ) {
            data.stdate = $('#billinginv_filterstdate').val();
            data.eddate = $('#billinginv_filtereddate').val();
          }
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

//Fungsi filter data
$(document).ready(function() {
    $('.formFilterbillinginv').submit(function(e) {
        e.preventDefault();

        var stdate = $('#billinginv_filterstdate').val();
        var eddate = $('#billinginv_filtereddate').val();      

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // data: this.data,
            dataType: "json",
            beforeSend: function() {
                $('.btnfilterbillinginv').prop('disabled', true);
                $('.btnfilterbillinginv').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnfilterbillinginv').prop('disabled', false);
                $('.btnfilterbillinginv').html('Filter Data');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.billinginv_filterstdate){
                        $('#billinginv_filterstdate').addClass('is-invalid');
                        $('.errorFeaturesfilterstdate').html(response.error.billinginv_filterstdate);
                    }
                    else
                    {
                        $('#billinginv_filterstdate').removeClass('is-invalid');
                        $('.errorFeaturesfilterstdate').html('');
                    }

                    if (response.error.billinginv_filtereddate){
                        $('#billinginv_filtereddate').addClass('is-invalid');
                        $('.errorFeaturesfiltereddate').html(response.error.billinginv_filtereddate);
                    }
                    else
                    {
                        $('#billinginv_filtereddate').removeClass('is-invalid');
                        $('.errorFeaturesfiltereddate').html('');
                    }
                }
                else
                {
                    $('#datatable-billinginvoice').DataTable().ajax.reload();
                    var element = document.getElementById("filterdate");
                    var stdateParts = stdate.split("/");
                    var eddateParts = eddate.split("/");
                    
                    var stdateFormat = stdateParts[1] + '-' + stdateParts[0] + '-' + stdateParts[2];
                    var eddateFormat = eddateParts[1] + '-' + eddateParts[0] + '-' + eddateParts[2];
                    element.innerHTML = "Periode " + stdateFormat + " sampai " + eddateFormat;
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
});