"use strict"
$(window).on('load', function(){
	$('#jogos').DataTable({
    	"columnDefs": [{
              "orderable": false,
              "targets"  : -1
         }]
	});
});
