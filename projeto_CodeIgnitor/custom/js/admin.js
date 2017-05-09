"use strict"
$(window).on('load', function(){
    $('#InputAge').datetimepicker({
        format:'Y-m-d',
        onShow:function( ct ){
            this.setOptions({
                maxDate:$('#InputAgeTill').val()?$('#InputAgeTill').val():'+1970/01/01'
            })
        },
        timepicker:false
    }).keydown(function(e) {
        if(e.keyCode !== 8 && e.keyCode !== 46) {
            e.preventDefault();
        }
    });
    $('#InputAgeTill').datetimepicker({
        format:'Y-m-d',
        onShow:function( ct ){
            this.setOptions({
                minDate:$('#InputAge').val()?$('#InputAge').val():false
            })
        },
        timepicker:false,
        maxDate:'+1970/01/01'//today is maximum date calendar
    }).keydown(function(e) {
        if(e.keyCode !== 8 && e.keyCode !== 46) {
            e.preventDefault();
        }
    });

    // Manages districts and counties on registration form
    showConAdm($(".distAdm"));
    $(".distAdm").on("change", function(){
        showConAdm($(this));
    });

    // Users Table
    pesquisa = "NULL/NULL/NULL/NULL";
	userAdminTable = $('#admin-users').DataTable({
    	"columnDefs": [{
              "orderable": false,
              "targets"  : -1
         }],
        paging: false,
        searching: false,
        "ajax": baseURL + "index.php/user/getUserDataAdmin/" + pesquisa,
	});
	setInterval( function () {
    	userAdminTable.ajax.reload();
	}, 5000 );
    // Games Table
    pesquisaGame = "NULL";
    gamesAdminTable = $('#admin-plays').DataTable({
        "columnDefs": [{
              "orderable": false,
              "targets"  : -1
        }],
        paging: false,
        searching: false,
        "ajax": baseURL + "index.php/game/getGamesDataAdmin/" + pesquisaGame,
    });
    setInterval( function () {
        gamesAdminTable.ajax.reload();
    }, 5000 );
    // Setup - add a text input to each footer cell
    $('#admin-users tfoot th, #admin-plays tfoot th').each( function () {
        var title = $(this).text();
        if (title == "Saldo" || title == "D. Nascimento" || title == "Estado" || title == "Total de utilizadores"){
            $(this).html( '<input type="text" readonly placeholder="'+title+'"/>' );
        }else{
            $(this).html( '<input type="text" placeholder="'+title+'" />' );
        }
    } );
	// Apply the search
	userAdminTable.columns().every( function () {
		var that = this;

		$( 'input', this.footer() ).on( 'keyup change', function (){
			if ( that.search() !== this.value ) {
				that
					.search( this.value )
					.draw();
			}
		});
	});
    gamesAdminTable.columns().every( function () {
        var that = this;

        $( 'input', this.footer() ).on( 'keyup change', function (){
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        });
    });
    // advance search user
    $('.adv_search_fields').on('click, change', function(){
        adv_Search();
    });
    // advance search game
    $('.adv_search_fieldsGame').on('click, change', function(){
        adv_SearchGame();
    });
    // Load user details modal
    $('body').on('click', '.details-user', function(){
        var id = $(this).attr('data-userId');
        loadUserData_admin(id);
    });
    // Delete user modal
    $('body').on('click', '.delete-user', function(){
        var id = $(this).attr('data-userId');
        deleteUser_admin(id);
    });
    // Load user details modal
    $('body').on('click', '.details-game', function(){
        var id = $(this).attr('data-gameId');
        loadGameData_admin(id);
        gameDataInterval  = setInterval(function () {
            loadGameData_admin(id);
        }, 5000);
    });
    // Invalidade game
    $('body').on('click', '.deactivate-game', function(){
        var id = $(this).attr('data-gameId');
        var activeUpdate = $(this).attr('data-activeUpdateStatus');
        deactivateGame_admin(id, activeUpdate);
    });
    setInterval(function(){
        verifiyPot();
    },5000);
});

var pesquisa, userAdminTable, pesquisaGame, gamesAdminTable, gameDataInterval, lastGameId;

var verifiyPot = function(){
    $.ajax({
        url:  baseURL + "index.php/game/ExcedingPot",
        type: "get",
        success:function(response) {
            if(response.sucess == true){
                for(overPot in response.messages){
                    console.log(response.messages[overPot])
                }
            }
        }
    });
}

var showConAdm = function(obg){
    var distVal = $(obg).val();
    if (distVal == "NULL"){
        $(".conAdm").val("NULL");
        $("[data-parentDist]").hide();
    }else{
        $(".conAdm > option").each(function(){
            if($(this).attr("data-parentDist")==distVal || $(this).val() == "NULL"){
                $(this).show();
                $(".conAdm").val("NULL");
            }else{
                $(this).hide();
            }
        });
    }
}

var adv_Search = function(table, pesquisa){
    var age_op = $('#InputAge').val();
    if (age_op == ""){
        age_op = "NULL";
    }
    var age2_op = $('#InputAgeTill').val();
    if (age2_op == ""){
        age2_op = "NULL";
    }
    var district_op = $('#Distritos').val();
    var concelho_op = $('#concelho').val();
    pesquisa = age_op + "/" + age2_op + "/" + district_op + "/" + concelho_op;
    userAdminTable.ajax.url(baseURL + "index.php/user/getUserDataAdmin/" + pesquisa).load();

    return false;
}

var adv_SearchGame = function(table, pesquisa){
    var state_op = $('#state').val();
    
    pesquisaGame = state_op;
    gamesAdminTable.ajax.url(baseURL + "index.php/game/getGamesDataAdmin/" + pesquisaGame).load();

    return false;
}

var loadUserData_admin = function(id){
    var data = {id: id};
    $.ajax({
        url:  baseURL + "index.php/user/getUserDetails",
        type: "post",
        data: data,
        dataType: 'json',
        success:function(response) {
            if(response.success === true) {
                var data = response.messages;
                $('#name-usr-adm').val(data.fName);
                $('#surname-usr-adm').val(data.lName);
                $('#username-usr-adm').val(data.username);
                $('#email-usr-adm').val(data.email);
                $('#balance-usr-adm').val(data.balance+" €");
                $('#birthDate-usr-adm').val(data.birthDate);
                if(data.sex == 'ND'){
                    $('#sex-usr-adm').val("Prefiro não dizer");
                }else if(data.sex == 'm'){
                    $('#sex-usr-adm').val("Masculino");
                }else{
                    $('#sex-usr-adm').val("Feminino");
                }
                $('#country-usr-adm').val(data.country);
                $('#district-usr-adm').val(data.district);
                $('#county-usr-adm').val(data.county);
                $('#creationDate-usr-adm').val(data.creationDate);
                if(data.level == '0'){
                    $('#level-usr-adm').val('Admin');
                }else{
                    $('#level-usr-adm').val('Standard user');
                }
            }else{
                $("#alertError-user-admin > .message").html(response.messages);
                $("#alertError-user-admin").show();
            }
        }
    });
}

var deleteUser_admin = function(id){
    var data = {username: id};
    $.ajax({
        url:  baseURL + "index.php/user/deleteUser",
        type: "post",
        data: data,
        dataType: 'json',
        success:function(response) {
            if(response.success === true) {
                $("#alertSuccess-user-admin > .message").html(response.messages);
                $("#alertSuccess-user-admin").show();
                userAdminTable.ajax.reload();
                setTimeout(function(){
                    $(".alert-success").hide();
                }, 3000);
            }else{
                $("#alertError-user-admin > .message").html(response.messages);
                $("#alertError-user-admin").show();
                setTimeout(function(){
                    $(".alert-danger").hide();
                }, 3000);
            }
        }
    });
}
var loadGameData_admin = function(id){
    var data = {id_jogo: id};
    // console.log(lastGameId+"->"+id)
    if (id != lastGameId){
        // console.log('entrou')
        clearInterval(gameDataInterval);
    }
    $.ajax({
        url:  baseURL + "index.php/game/gameAdmInfo",
        type: "post",
        data: data,
        dataType: 'json',
        success:function(response) {
            if(response.success === true) {
                $('#name-game-adm').val(response.messages[0][0]);
                $('#desc-game-adm').val(response.messages[0][1]);
                $('#owner-game-adm').val(response.messages[0][2]);
                $('#nowPlyer-game-adm').val(response.messages[0][3]);
                $("#begin-game-adm").val(response.messages[0][4]);
                $("#end-game-adm").val(response.messages[0][5]);
                $("#potValue-game-adm").val(response.messages[0][6]);
                $("#currentBet-game-adm").val(response.messages[0][7]);
                $("#cards-game-adm").val(response.messages[0][8]);
                $("#players-game-adm").html(response.messages[0][9]);
                $("#histoy-game-adm").html(response.messages[0][10]);
                lastGameId = id;
            }else{
                $("#alertError-user-admin > .message").html(response.messages);
                $("#alertError-user-admin").show();
                setTimeout(function(){
                    $(".alert-danger").hide();
                }, 3000);
            }
        }
    });
}

var deactivateGame_admin = function(id, active){
    var data = {id_jogo: id, active: active};
    $.ajax({
        url:  baseURL + "index.php/game/deactivateGame",
        type: "post",
        data: data,
        dataType: 'json',
        success:function(response) {
            if(response.success === true) {
                $("#alertSuccess-user-admin > .message").html(response.messages);
                $("#alertSuccess-user-admin").show();
                gamesAdminTable.ajax.reload();
                setTimeout(function(){
                    $(".alert-success").hide();
                }, 3000);
            }else{
                $("#alertError-user-admin > .message").html(response.messages);
                $("#alertError-user-admin").show();
                setTimeout(function(){
                    $(".alert-danger").hide();
                }, 3000);
            }
        }
    });
}