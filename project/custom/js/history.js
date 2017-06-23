"use strict";
$(window).on('load', function(){   
    var gamesTable = $('#jogos').DataTable({
    	  "columnDefs": [{
            "orderable": false,
            "targets"  : -1
        }],
        paging: false,
        searching: false,
        "ajax": baseURL + "index.php/game/getGamesHistory",
	});
    setInterval( function () {
        gamesTable.ajax.reload();
    }, 5000 );
});