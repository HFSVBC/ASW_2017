"use strict"
$(window).on('load', function(){
	$('#admin-users, #admin-plays').DataTable({
    	"columnDefs": [{
              "orderable": false,
              "targets"  : -1
         }]
	});
});
