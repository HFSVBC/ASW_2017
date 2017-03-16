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
	}, 50000 );

	var gamesAdminTable = $('#admin-plays').DataTable({
    	"columnDefs": [{
              "orderable": false,
              "targets"  : -1
         }],
         "ajax": "http://appserver-01.alunos.di.fc.ul.pt/~asw004/projeto/index.php/user/getGamesDataAdmin",
	});
	setInterval( function () {
    	gamesAdminTable.ajax.reload();
	}, 50000 ); 

    $('body').on('click', '.details-user', function(){
        var id = $(this).attr('data-userId');
        console.log(id);
        loadUserData_admin(id);
    });
});
var loadUserData_admin = function(id){
    var data = {id: id};
    $.ajax({
        url:  baseURL+"index.php/user/getUserDetails",
        type: "post",
        data: data, 
        dataType: 'json',
        success:function(response) {
            if(response.success === true) {
                var data = response.messages;
                console.log(data);
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
