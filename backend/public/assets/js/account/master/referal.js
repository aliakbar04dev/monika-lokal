//Datatables server side
$(document).ready( function () {
    var url = '/account/master/referalcontroller/ajax_list';
    var table = $('#datatable-masterreferal').DataTable({ 
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

$(".unduhmasterreferal").click(function() {
  // // hope the server sets Content-Disposition: attachment!
  var url = '/public//doc/template_mreferal.xlsx';
  window.location = BASE_URL + url;
});