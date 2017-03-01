import { Component, OnInit } from '@angular/core';
import { ValidateService } from '../../services/validate.service';
import { AuthService } from '../../services/auth.service';
import { FlashMessagesService } from 'angular2-flash-messages';
import { Router } from '@angular/router'

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
	fName    : String;
	lName    : String;
	username : String;
	email    : String;
	password : String;
	sex      : String;
	birthDate: String;
	country  : String;
	county   : String;
	district : String;

  constructor(
  	private validateService: ValidateService,
  	private authService    : AuthService,
  	private flashMessage   : FlashMessagesService,
  	private router         : Router
  ) { }

  ngOnInit() {
  }

  onRegisterSubmit() {
  	const user = {
  		fName    : this.fName,
			lName    : this.lName,
			username : this.username,
			email    : this.email,
			password : this.password,
			sex      : this.sex,
			birthDate: this.birthDate,
			country  : this.country,
			county   : this.county,
			district : this.district
  	}
  	// Required Fields
  	if(!this.validateService.validateRegister(user)){
  		this.flashMessage.show("Please fill in all fields", {cssClass: 'alert-danger', timeout: 10000});
  		return false;
  	}
  	// email validation
  	if(!this.validateService.validateEmail(user.email)){
  		this.flashMessage.show("Please fill in a valid email", {cssClass: 'alert-danger', timeout: 10000});
  		return false;
  	}

  	// Register User
  	this.authService.registerUser(user).subscribe(data => {
  		if(data.success){
  			this.flashMessage.show("You are now registered and can now log in", {cssClass: 'alert-success', timeout: 10000});
  			this.router.navigate(['/login']);
  		}else{
  			this.flashMessage.show("Something went wrong", {cssClass: 'alert-danger', timeout: 10000});
  			this.router.navigate(['/register']);
  		}
  	});
  }

}
