"use strict"
$(window).on('load', function(){
	var userAdminTable = $('#admin-users').DataTable({
    	"columnDefs": [{
              "orderable": false,
              "targets"  : -1
         }],
         "ajax": "http://appserver-01.alunos.di.fc.ul.pt/~asw004/projeto/index.php/user/getUserDataAdmin",
	});
	setInterval( function () {
    	userAdminTable.ajax.reload();
	}, 5000 );

	var gamesAdminTable = $('#admin-plays').DataTable({
    	"columnDefs": [{
              "orderable": false,
              "targets"  : -1
         }],
         "ajax": "http://appserver-01.alunos.di.fc.ul.pt/~asw004/projeto/index.php/user/getGamesDataAdmin",
	});
	setInterval( function () {
    	gamesAdminTable.ajax.reload();
	}, 5000 ); 
});
