import { Component, OnInit } from '@angular/core';
declare var $:any;

@Component({
  selector: 'app-admin',
  templateUrl: './admin.component.html',
  styleUrls: ['./admin.component.css']
})
export class AdminComponent implements OnInit {

	users: Object;
	games: Object;

  constructor() { }

  ngOnInit() {
  	$('#admin-plays').DataTable();
    $('#admin-users').DataTable({
    	'ajax': "assets/ajax.txt",
    });
    var tabpanel;
    $('.tabTriger').on('click', function() {
    	tabpanel = "#"+$(this).attr('aria-controls');
    	console.log(tabpanel);
    	tabpanel.tab('show');
    });
  }

}
