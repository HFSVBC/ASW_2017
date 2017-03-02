import { Component, OnInit } from '@angular/core';
import { FlashMessagesService } from 'angular2-flash-messages';
import { AuthService } from '../../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit {
  user: Object;
  
  constructor(
  	private flashMessage   : FlashMessagesService,
  	private authService    : AuthService,
  	private router         : Router
  ) { }

  ngOnInit() {
  }

  loadUser(){
    if (this.authService.loggedIn()){
      this.user = this.authService.getLoggedInProfile();
      return true;
    }else{
      this.user = null;
      return false;
    }
  }

  onLogoutClick() {
  	this.authService.logout();
  	this.flashMessage.show("You are now logged out", {cssClass: 'alert-success', timeout: 10000});
    this.router.navigate(['/login']);
    return false;
  }
}
