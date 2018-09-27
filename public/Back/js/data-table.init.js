$(document).ready(function() {
    var table = $('#data-table').DataTable( {
        responsive: true,
        "bFilter": false
    } );
 
    new $.fn.dataTable.FixedHeader( table );
} );