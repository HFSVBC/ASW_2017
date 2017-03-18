"use strict"
$(window).on('load', function(){
	var pesquisa = "NULL/NULL/NULL";
	// Setup - add a text input to each footer cell
	$('#admin-users tfoot th').each( function () {
        var title = $(this).text();
        if (title == "Saldo" || title == "D. Nascimento"){
            $(this).html( '<input type="text" readonly placeholder="'+title+'"/>' );
        }else{
            $(this).html( '<input type="text" placeholder="'+title+'" />' );
        }
    } );

	var userAdminTable = $('#admin-users').DataTable({
    	"columnDefs": [{
              "orderable": false,
              "targets"  : -1
         }],
        "ajax": baseURL + "index.php/user/getUserDataAdmin/" + pesquisa,
	});
	setInterval( function () {
    	userAdminTable.ajax.reload();
	}, 50000 );

	var gamesAdminTable = $('#admin-plays').DataTable({
    	"columnDefs": [{
              "orderable": false,
              "targets"  : -1
         }],
         "ajax": baseURL + "index.php/user/getGamesDataAdmin",
	});

	 // Apply the search
	 userAdminTable.columns().every( function () {
			 var that = this;

			 $( 'input', this.footer() ).on( 'keyup change', function () {
					 if ( that.search() !== this.value ) {
							 that
									 .search( this.value )
									 .draw();
					 }
			 } );
	 } );

	setInterval( function () {
    	gamesAdminTable.ajax.reload();
	}, 50000 );

  $('body').on('click', '.details-user', function(){
      var id = $(this).attr('data-userId');
      console.log(id);
      loadUserData_admin(id);
  });
	$('#searchAdv_btn').on('click', function(){
			var age_op = $('#InputAge').val();
			var age2_op = $('#InputAgeTill').val();
			var district_op = $('#Distritos').val();
			pesquisa = age_op + "/" + age2_op + "/" + district_op;
			userAdminTable.ajax.reload();
	});
});
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
