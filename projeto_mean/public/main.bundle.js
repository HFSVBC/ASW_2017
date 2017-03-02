webpackJsonp([1,4],{

/***/ 333:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ValidateService; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};

var ValidateService = (function () {
    function ValidateService() {
    }
    ValidateService.prototype.validateRegister = function (user) {
        if (user.fName == undefined || user.lName == undefined || user.username == undefined || user.email == undefined || user.password == undefined || user.sex == undefined || user.birthDate == undefined || user.country == undefined) {
            return false;
        }
        else {
            return true;
        }
    };
    ValidateService.prototype.validateEmail = function (email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    };
    ValidateService = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Injectable"])(), 
        __metadata('design:paramtypes', [])
    ], ValidateService);
    return ValidateService;
}());
//# sourceMappingURL=/home/asw17/ASW_Proj/angular-src/src/validate.service.js.map

/***/ }),

/***/ 388:
/***/ (function(module, exports) {

function webpackEmptyContext(req) {
	throw new Error("Cannot find module '" + req + "'.");
}
webpackEmptyContext.keys = function() { return []; };
webpackEmptyContext.resolve = webpackEmptyContext;
module.exports = webpackEmptyContext;
webpackEmptyContext.id = 388;


/***/ }),

/***/ 389:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_platform_browser_dynamic__ = __webpack_require__(476);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__environments_environment__ = __webpack_require__(516);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__app_app_module__ = __webpack_require__(507);




if (__WEBPACK_IMPORTED_MODULE_2__environments_environment__["a" /* environment */].production) {
    __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_1__angular_core__["enableProdMode"])();
}
__webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_platform_browser_dynamic__["a" /* platformBrowserDynamic */])().bootstrapModule(__WEBPACK_IMPORTED_MODULE_3__app_app_module__["a" /* AppModule */]);
//# sourceMappingURL=/home/asw17/ASW_Proj/angular-src/src/main.js.map

/***/ }),

/***/ 506:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AppComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};

var AppComponent = (function () {
    function AppComponent() {
        this.title = 'app works!';
    }
    AppComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-root',
            template: __webpack_require__(683),
            styles: [__webpack_require__(675)]
        }), 
        __metadata('design:paramtypes', [])
    ], AppComponent);
    return AppComponent;
}());
//# sourceMappingURL=/home/asw17/ASW_Proj/angular-src/src/app.component.js.map

/***/ }),

/***/ 507:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_platform_browser__ = __webpack_require__(150);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_forms__ = __webpack_require__(467);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_http__ = __webpack_require__(206);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__angular_router__ = __webpack_require__(78);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__app_component__ = __webpack_require__(506);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__components_navbar_navbar_component__ = __webpack_require__(512);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__components_login_login_component__ = __webpack_require__(511);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8__components_register_register_component__ = __webpack_require__(514);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_9__components_home_home_component__ = __webpack_require__(510);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_10__components_dashboard_dashboard_component__ = __webpack_require__(508);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_11__components_profile_profile_component__ = __webpack_require__(513);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_12__components_footer_footer_component__ = __webpack_require__(509);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_13__services_validate_service__ = __webpack_require__(333);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_14__services_auth_service__ = __webpack_require__(80);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_15_angular2_flash_messages__ = __webpack_require__(153);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_15_angular2_flash_messages___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_15_angular2_flash_messages__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_16__guards_auth_guard__ = __webpack_require__(515);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AppModule; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};

















var appRoutes = [
    { path: '', component: __WEBPACK_IMPORTED_MODULE_9__components_home_home_component__["a" /* HomeComponent */] },
    { path: 'register', component: __WEBPACK_IMPORTED_MODULE_8__components_register_register_component__["a" /* RegisterComponent */] },
    { path: 'login', component: __WEBPACK_IMPORTED_MODULE_7__components_login_login_component__["a" /* LoginComponent */] },
    { path: 'dashboard', component: __WEBPACK_IMPORTED_MODULE_10__components_dashboard_dashboard_component__["a" /* DashboardComponent */], canActivate: [__WEBPACK_IMPORTED_MODULE_16__guards_auth_guard__["a" /* AuthGuard */]] },
    { path: 'profile', component: __WEBPACK_IMPORTED_MODULE_11__components_profile_profile_component__["a" /* ProfileComponent */], canActivate: [__WEBPACK_IMPORTED_MODULE_16__guards_auth_guard__["a" /* AuthGuard */]] },
];
var AppModule = (function () {
    function AppModule() {
    }
    AppModule = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_1__angular_core__["NgModule"])({
            declarations: [
                __WEBPACK_IMPORTED_MODULE_5__app_component__["a" /* AppComponent */],
                __WEBPACK_IMPORTED_MODULE_6__components_navbar_navbar_component__["a" /* NavbarComponent */],
                __WEBPACK_IMPORTED_MODULE_7__components_login_login_component__["a" /* LoginComponent */],
                __WEBPACK_IMPORTED_MODULE_8__components_register_register_component__["a" /* RegisterComponent */],
                __WEBPACK_IMPORTED_MODULE_9__components_home_home_component__["a" /* HomeComponent */],
                __WEBPACK_IMPORTED_MODULE_10__components_dashboard_dashboard_component__["a" /* DashboardComponent */],
                __WEBPACK_IMPORTED_MODULE_11__components_profile_profile_component__["a" /* ProfileComponent */],
                __WEBPACK_IMPORTED_MODULE_12__components_footer_footer_component__["a" /* FooterComponent */]
            ],
            imports: [
                __WEBPACK_IMPORTED_MODULE_0__angular_platform_browser__["a" /* BrowserModule */],
                __WEBPACK_IMPORTED_MODULE_2__angular_forms__["a" /* FormsModule */],
                __WEBPACK_IMPORTED_MODULE_3__angular_http__["HttpModule"],
                __WEBPACK_IMPORTED_MODULE_4__angular_router__["a" /* RouterModule */].forRoot(appRoutes),
                __WEBPACK_IMPORTED_MODULE_15_angular2_flash_messages__["FlashMessagesModule"]
            ],
            providers: [__WEBPACK_IMPORTED_MODULE_13__services_validate_service__["a" /* ValidateService */], __WEBPACK_IMPORTED_MODULE_14__services_auth_service__["a" /* AuthService */], __WEBPACK_IMPORTED_MODULE_16__guards_auth_guard__["a" /* AuthGuard */]],
            bootstrap: [__WEBPACK_IMPORTED_MODULE_5__app_component__["a" /* AppComponent */]]
        }), 
        __metadata('design:paramtypes', [])
    ], AppModule);
    return AppModule;
}());
//# sourceMappingURL=/home/asw17/ASW_Proj/angular-src/src/app.module.js.map

/***/ }),

/***/ 508:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return DashboardComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};

var DashboardComponent = (function () {
    function DashboardComponent() {
    }
    DashboardComponent.prototype.ngOnInit = function () {
    };
    DashboardComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-dashboard',
            template: __webpack_require__(684),
            styles: [__webpack_require__(676)]
        }), 
        __metadata('design:paramtypes', [])
    ], DashboardComponent);
    return DashboardComponent;
}());
//# sourceMappingURL=/home/asw17/ASW_Proj/angular-src/src/dashboard.component.js.map

/***/ }),

/***/ 509:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return FooterComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};

var FooterComponent = (function () {
    function FooterComponent() {
    }
    FooterComponent.prototype.ngOnInit = function () {
    };
    FooterComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-footer',
            template: __webpack_require__(685),
            styles: [__webpack_require__(677)]
        }), 
        __metadata('design:paramtypes', [])
    ], FooterComponent);
    return FooterComponent;
}());
//# sourceMappingURL=/home/asw17/ASW_Proj/angular-src/src/footer.component.js.map

/***/ }),

/***/ 510:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return HomeComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};

var HomeComponent = (function () {
    function HomeComponent() {
    }
    HomeComponent.prototype.ngOnInit = function () {
    };
    HomeComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-home',
            template: __webpack_require__(686),
            styles: [__webpack_require__(678)]
        }), 
        __metadata('design:paramtypes', [])
    ], HomeComponent);
    return HomeComponent;
}());
//# sourceMappingURL=/home/asw17/ASW_Proj/angular-src/src/home.component.js.map

/***/ }),

/***/ 511:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_angular2_flash_messages__ = __webpack_require__(153);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_angular2_flash_messages___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_angular2_flash_messages__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__services_auth_service__ = __webpack_require__(80);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_router__ = __webpack_require__(78);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return LoginComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};




var LoginComponent = (function () {
    function LoginComponent(flashMessage, authService, router) {
        this.flashMessage = flashMessage;
        this.authService = authService;
        this.router = router;
    }
    LoginComponent.prototype.ngOnInit = function () {
    };
    LoginComponent.prototype.onLoginSubmit = function () {
        var _this = this;
        var user = {
            username: this.username,
            password: this.password
        };
        this.authService.authenticateUser(user).subscribe(function (data) {
            if (data.success) {
                _this.authService.storeUserData(data.token, data.user);
                _this.flashMessage.show("You are now logged in", { cssClass: 'alert-success', timeout: 10000 });
                _this.router.navigate(['/dashboard']);
            }
            else {
                _this.flashMessage.show(data.msg, { cssClass: 'alert-danger', timeout: 10000 });
                _this.router.navigate(['/login']);
            }
        });
    };
    LoginComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-login',
            template: __webpack_require__(687),
            styles: [__webpack_require__(679)]
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1_angular2_flash_messages__["FlashMessagesService"] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1_angular2_flash_messages__["FlashMessagesService"]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2__services_auth_service__["a" /* AuthService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__services_auth_service__["a" /* AuthService */]) === 'function' && _b) || Object, (typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_3__angular_router__["b" /* Router */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__angular_router__["b" /* Router */]) === 'function' && _c) || Object])
    ], LoginComponent);
    return LoginComponent;
    var _a, _b, _c;
}());
//# sourceMappingURL=/home/asw17/ASW_Proj/angular-src/src/login.component.js.map

/***/ }),

/***/ 512:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_angular2_flash_messages__ = __webpack_require__(153);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_angular2_flash_messages___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_angular2_flash_messages__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__services_auth_service__ = __webpack_require__(80);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_router__ = __webpack_require__(78);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return NavbarComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};




var NavbarComponent = (function () {
    function NavbarComponent(flashMessage, authService, router) {
        this.flashMessage = flashMessage;
        this.authService = authService;
        this.router = router;
    }
    NavbarComponent.prototype.ngOnInit = function () {
        this.user = this.authService.getLoggedInProfile();
    };
    NavbarComponent.prototype.onLogoutClick = function () {
        this.authService.logout();
        this.flashMessage.show("You are now logged out", { cssClass: 'alert-success', timeout: 10000 });
        this.router.navigate(['/login']);
        return false;
    };
    NavbarComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-navbar',
            template: __webpack_require__(688),
            styles: [__webpack_require__(680)]
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1_angular2_flash_messages__["FlashMessagesService"] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1_angular2_flash_messages__["FlashMessagesService"]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2__services_auth_service__["a" /* AuthService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__services_auth_service__["a" /* AuthService */]) === 'function' && _b) || Object, (typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_3__angular_router__["b" /* Router */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3__angular_router__["b" /* Router */]) === 'function' && _c) || Object])
    ], NavbarComponent);
    return NavbarComponent;
    var _a, _b, _c;
}());
//# sourceMappingURL=/home/asw17/ASW_Proj/angular-src/src/navbar.component.js.map

/***/ }),

/***/ 513:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__services_auth_service__ = __webpack_require__(80);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_router__ = __webpack_require__(78);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ProfileComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var ProfileComponent = (function () {
    function ProfileComponent(authService, router) {
        this.authService = authService;
        this.router = router;
    }
    ProfileComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.authService.getProfile().subscribe(function (profile) {
            _this.user = profile.user;
        }, function (err) {
            console.log(err);
            return false;
        });
    };
    ProfileComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-profile',
            template: __webpack_require__(689),
            styles: [__webpack_require__(681)]
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__services_auth_service__["a" /* AuthService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__services_auth_service__["a" /* AuthService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2__angular_router__["b" /* Router */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__angular_router__["b" /* Router */]) === 'function' && _b) || Object])
    ], ProfileComponent);
    return ProfileComponent;
    var _a, _b;
}());
//# sourceMappingURL=/home/asw17/ASW_Proj/angular-src/src/profile.component.js.map

/***/ }),

/***/ 514:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__services_validate_service__ = __webpack_require__(333);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__services_auth_service__ = __webpack_require__(80);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_angular2_flash_messages__ = __webpack_require__(153);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_angular2_flash_messages___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3_angular2_flash_messages__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__angular_router__ = __webpack_require__(78);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return RegisterComponent; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};





var RegisterComponent = (function () {
    function RegisterComponent(validateService, authService, flashMessage, router) {
        this.validateService = validateService;
        this.authService = authService;
        this.flashMessage = flashMessage;
        this.router = router;
    }
    RegisterComponent.prototype.ngOnInit = function () {
    };
    RegisterComponent.prototype.onRegisterSubmit = function () {
        var _this = this;
        var user = {
            fName: this.fName,
            lName: this.lName,
            username: this.username,
            email: this.email,
            password: this.password,
            sex: this.sex,
            birthDate: this.birthDate,
            country: this.country,
            county: this.county,
            district: this.district
        };
        // Required Fields
        if (!this.validateService.validateRegister(user)) {
            this.flashMessage.show("Please fill in all fields", { cssClass: 'alert-danger', timeout: 10000 });
            return false;
        }
        // email validation
        if (!this.validateService.validateEmail(user.email)) {
            this.flashMessage.show("Please fill in a valid email", { cssClass: 'alert-danger', timeout: 10000 });
            return false;
        }
        // Register User
        this.authService.registerUser(user).subscribe(function (data) {
            if (data.success) {
                _this.flashMessage.show("You are now registered and can now log in", { cssClass: 'alert-success', timeout: 10000 });
                _this.router.navigate(['/login']);
            }
            else {
                _this.flashMessage.show("Something went wrong", { cssClass: 'alert-danger', timeout: 10000 });
                _this.router.navigate(['/register']);
            }
        });
    };
    RegisterComponent = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-register',
            template: __webpack_require__(690),
            styles: [__webpack_require__(682)]
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__services_validate_service__["a" /* ValidateService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__services_validate_service__["a" /* ValidateService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2__services_auth_service__["a" /* AuthService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__services_auth_service__["a" /* AuthService */]) === 'function' && _b) || Object, (typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_3_angular2_flash_messages__["FlashMessagesService"] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_3_angular2_flash_messages__["FlashMessagesService"]) === 'function' && _c) || Object, (typeof (_d = typeof __WEBPACK_IMPORTED_MODULE_4__angular_router__["b" /* Router */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_4__angular_router__["b" /* Router */]) === 'function' && _d) || Object])
    ], RegisterComponent);
    return RegisterComponent;
    var _a, _b, _c, _d;
}());
//# sourceMappingURL=/home/asw17/ASW_Proj/angular-src/src/register.component.js.map

/***/ }),

/***/ 515:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_router__ = __webpack_require__(78);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__services_auth_service__ = __webpack_require__(80);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AuthGuard; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var AuthGuard = (function () {
    function AuthGuard(authService, router) {
        this.authService = authService;
        this.router = router;
    }
    AuthGuard.prototype.canActivate = function () {
        if (this.authService.loggedIn()) {
            return true;
        }
        else {
            this.router.navigate(['/login']);
            return false;
        }
    };
    AuthGuard = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Injectable"])(), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_2__services_auth_service__["a" /* AuthService */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_2__services_auth_service__["a" /* AuthService */]) === 'function' && _a) || Object, (typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_1__angular_router__["b" /* Router */] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__angular_router__["b" /* Router */]) === 'function' && _b) || Object])
    ], AuthGuard);
    return AuthGuard;
    var _a, _b;
}());
//# sourceMappingURL=/home/asw17/ASW_Proj/angular-src/src/auth.guard.js.map

/***/ }),

/***/ 516:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return environment; });
// The file contents for the current environment will overwrite these during build.
// The build system defaults to the dev environment which uses `environment.ts`, but if you do
// `ng build --env=prod` then `environment.prod.ts` will be used instead.
// The list of which env maps to which file can be found in `angular-cli.json`.
var environment = {
    production: false
};
//# sourceMappingURL=/home/asw17/ASW_Proj/angular-src/src/environment.js.map

/***/ }),

/***/ 675:
/***/ (function(module, exports) {

module.exports = ""

/***/ }),

/***/ 676:
/***/ (function(module, exports) {

module.exports = ""

/***/ }),

/***/ 677:
/***/ (function(module, exports) {

module.exports = "/*footer\n-----------------------------------------------*/\n#footerAndCopyright{\n\tbackground: #212121;\n\tposition: fixed;\n\twidth: 100%;\n\tbottom: 0;\n\tleft: 0;\n}\n#footerAndCopyright > p{\n\tcolor: #616161;\n\tmargin: 10px 0;\n}"

/***/ }),

/***/ 678:
/***/ (function(module, exports) {

module.exports = ".coponentCont{\n\tbackground: url(custom/images/backgroundPic.jpg) no-repeat center center fixed;\n\tbackground-size: cover;\n\tbackground-color: black;\n\tmargin-top: -20px;\n}\n#slogan{\n\twidth: 700px;\n\tcolor: #ffffff;\n\tposition: absolute;\n\ttop: 30%;\n\tleft: 50%;\n\tmargin-top: -110px;\n\tmargin-left: -350px; \n\tfont-family: 'Lobster', cursive;\n\tfont-size: 100px;\n\ttext-align: center;\n}\n#playBTN{\n\tbackground: url(custom/images/btnBack.png) no-repeat center center;\n\tbackground-size: cover;\n\tbackground-color: grey;\n\tposition: absolute;\n\ttop: 60%;\n\tleft: 50%;\n\tpadding: 5px 20px;\n\tborder-radius: 25px;\n\tfont-size: 100px;\n\tmargin-left: -169.5px;\n\tmargin-top: -76px;\n\tfont-family: 'Lobster', cursive;\n\tcursor: pointer;\n\tborder-right: solid 5px rgba(0, 0, 0, 0.7);\n\tborder-bottom: solid 5px rgba(0, 0, 0, 0.7);\n\tcolor: #ffffff;\n}\n#playBTN:active{\n\tborder: none;\n}"

/***/ }),

/***/ 679:
/***/ (function(module, exports) {

module.exports = ".coponentCont{\n\tbackground: #ffffff;\n}"

/***/ }),

/***/ 680:
/***/ (function(module, exports) {

module.exports = ""

/***/ }),

/***/ 681:
/***/ (function(module, exports) {

module.exports = "/*profile page\n-----------------------------------------------*/\n#profilePage{\n\tpadding: 0 50px;\n}\n#PP-header{\n\tbackground: #bfbfbf;\n\tpadding: 20px;\n    width: 100%;\n    position: absolute;\n    top: 50px;\n    left: 0;\n    height: 150px;\n}\n#name-Cont{\n\tpadding-left: 50px;\n}\n#SButton-cont{\n\theight: 115px;\n\tposition: relative;\n\tmargin-top: -15px;\n}\n#SButton{\n\tposition: absolute;\n    top: 50%;\n    padding: 5px 10px;\n    background: #536dfe;\n    color: #ffffff;\n    border-radius: 5px;\n    cursor: pointer;\n}\n#PP-body{\n\tmargin-top: 180px;\n}\n#mainProfCont, #leftProfCont{\n\tbackground: #ffffff;\n\tpadding: 20px 15px;\n}\n#mainProfCont{\n\tpadding-right: 10px;\n}\n#leftProfCont{\n\tpadding-left: 10px;\n}\n#avatar, #avatar > img{\n\twidth: 100%;\n}\n#avatar > img{\n\tmargin-bottom: 10px;\n}"

/***/ }),

/***/ 682:
/***/ (function(module, exports) {

module.exports = ".coponentCont{\n\tbackground: #ffffff;\n}\n/*Register From\n-----------------------------------------------*/\n#country_input-group, .country-select, #country{\n\twidth: 100%;\n}\n#country{\n\theight: 34px;\n    border: 1px solid #ccc;\n    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);\n    border-radius: 4px;\n}\n.country-select > .flag-dropdown{\n\tbackground-color: #eee;\n    border: 1px solid #ccc;\n    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);\n    border-radius: 4px 0 0 4px;\n}"

/***/ }),

/***/ 683:
/***/ (function(module, exports) {

module.exports = "<app-navbar></app-navbar>\n<div class=\"appCont\">\n\t<div class=\"container\">\n\t\t<flash-messages></flash-messages>\n\t</div>\n\t<router-outlet></router-outlet>\n</div>\n<app-footer></app-footer>"

/***/ }),

/***/ 684:
/***/ (function(module, exports) {

module.exports = "<p>\n  dashboard works!\n</p>\n"

/***/ }),

/***/ 685:
/***/ (function(module, exports) {

module.exports = "<footer id=\"footerAndCopyright\" class=\"container\">\n\t<p id=\"FC-copyright\">&copy; Copyright Poker Online, 2017-<span id=\"currentYear\"></span>. Todos os direitos reservados.</p>\n</footer>\n"

/***/ }),

/***/ 686:
/***/ (function(module, exports) {

module.exports = "<div class=\"coponentCont\">\n\t<h1 id=\"slogan\">May the flop be with you</h1>\n\t<span id=\"playBTN\">Play <span class=\"glyphicon glyphicon-play\" aria-hidden=\"true\"></span></span>\n</div>"

/***/ }),

/***/ 687:
/***/ (function(module, exports) {

module.exports = "<div class=\"coponentCont\">\n\t<div class=\"row\">\n\t\t<div  class=\"container col-md-6 col-md-offset-3\">\n\t\t\t<form (submit)=\"onLoginSubmit()\" id=\"regForm\">\n\t\t\t\t<h2 class=\"page-header\">Log In</h2>\n\t\t\t\t<div class=\"form-group\">\n\t\t\t\t    <label for=\"username\">Nome de Utilizador</label>\n\t\t\t\t    <div class=\"input-group\">\n\t\t\t\t\t    <div class=\"input-group-addon\"><span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\"></span></div>\n\t\t\t\t\t    <input type=\"text\" class=\"form-control\" id=\"username\" name=\"username\" required [(ngModel)]=\"username\">\n\t\t\t\t    </div>\n\t\t\t\t</div>\n\t\t\t\t<div class=\"form-group\">\n\t\t\t\t    <label for=\"password\">Password</label>\n\t\t\t\t    <div class=\"input-group\">\n\t\t\t\t\t    <div class=\"input-group-addon\"><span class=\"glyphicon glyphicon-lock\" aria-hidden=\"true\"></span></div>\n\t\t\t\t\t    <input type=\"password\" class=\"form-control\" id=\"password\" name=\"password\" required [(ngModel)]=\"password\">\n\t\t\t\t    </div>\n\t\t\t\t</div>\n\t\t\t\t<div class=\"checkbox\">\n\t\t\t\t\t<label>\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"rememberMe\"> Lembrar-me\n\t\t\t\t\t</label>\n\t\t\t\t</div>\n\t\t\t\t<button type=\"submit\" id=\"regInModal\" class=\"btn btn-primary\">Entrar</button>\n\t\t\t</form>\n\t\t</div>\n\t</div>\n</div>\n"

/***/ }),

/***/ 688:
/***/ (function(module, exports) {

module.exports = "<nav class=\"navbar navbar-inverse navbar-fixed-top\">\n\t<div class=\"container-fluid\">\n\t    <!-- Brand and toggle get grouped for better mobile display -->\n\t    <div class=\"navbar-header\">\n      \t\t<button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\" aria-expanded=\"false\">\n\t\t        <span class=\"sr-only\">Toggle navigation</span>\n\t\t        <span class=\"icon-bar\"></span>\n\t\t        <span class=\"icon-bar\"></span>\n\t\t        <span class=\"icon-bar\"></span>\n      \t\t</button>\n      \t\t<a class=\"navbar-brand\" [routerLink]=\"['/']\">Poker Online</a>\n    \t</div>\n\n\t    <!-- Collect the nav links, forms, and other content for toggling -->\n\t    <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">\n      \t\t<ul class=\"nav navbar-nav\">\n\t\t        \n      \t\t</ul>\n      \t\t<ul class=\"nav navbar-nav navbar-right\">\n\t        \t<li *ngIf=\"!authService.loggedIn()\" id='log-btn' [routerLinkActive]=\"['active']\" [routerLinkActiveOptions]=\"{exact:true}\"><a [routerLink]=\"['/login']\">Log In</a></li>\n\t        \t<li *ngIf=\"!authService.loggedIn()\" id='reg-btn' [routerLinkActive]=\"['active']\" [routerLinkActiveOptions]=\"{exact:true}\"><a [routerLink]=\"['/register']\">Registar</a></li>\n\t\t\t\t<li *ngIf=\"authService.loggedIn()\" class='dropdown' [routerLinkActive]=\"['active']\">\n\t\t\t\t\t<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Bem vindo, {{user.username}} <span class='caret'></span></a>\n\t\t\t\t\t<ul class='dropdown-menu'>\n\t\t\t            <li [routerLinkActive]=\"['active']\" [routerLinkActiveOptions]=\"{exact:true}\"><a [routerLink]=\"['/dashboard']\">Dashboard</a></li>\n\t\t\t            <li [routerLinkActive]=\"['active']\" [routerLinkActiveOptions]=\"{exact:true}\"><a [routerLink]=\"['/profile']\">Perfil</a></li>\n\t\t\t            <li role='separator' class='divider'></li>\n\t\t\t            <li><a (click)=\"onLogoutClick()\" href=\"#\">Log Out</a></li>\n\t\t        \t</ul>\n\t\t\t\t</li>\n      \t\t</ul>\n    \t</div><!-- /.navbar-collapse -->\n  \t</div><!-- /.container-fluid -->\n</nav>\n"

/***/ }),

/***/ 689:
/***/ (function(module, exports) {

module.exports = "<div class=\"coponentCont\">\n\t<div *ngIf=\"user\">\n\t\t<article id=\"profilePage\">\n\t\t\t<header id=\"PP-header\">\n\t\t\t\t<div class=\"row\">\n\t\t\t\t\t<div class=\"col-xs-12 col-md-10\" id=\"name-Cont\">\n\t\t\t\t\t\t<h1 id=\"nome user\">{{user.fName}} {{user.lName}}</h1>\n\t\t\t\t\t\t<h3 id=\"hPerfil\">Perfil</h3>\n\t\t\t\t\t</div>\n\t\t\t\t\t<div class=\"col-xs-12 col-md-2\" id=\"SButton-cont\">\n\t\t\t\t\t\t<span id=\"SButton\"><span class=\"glyphicon glyphicon-lock\" aria-hidden=\"true\"></span> Mudar Password</span>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t</header>\n\t\t\t<div id=\"PP-body\">\n\t\t\t\t<div class=\"row\">\n\t\t\t\t\t<form id=\"updateProfile-Form\">\n\t\t\t\t\t\t<div class=\"col-xs-12 col-md-9 container\">\n\t\t\t\t\t\t\t<div id=\"mainProfCont\">\n\t\t\t\t\t\t\t\t<div class=\"row\">\n\t\t\t\t\t\t\t\t\t<div class=\"form-group col-xs-12 col-md-6\">\n\t\t\t\t\t\t\t\t\t    <label for=\"name\">Nome</label>\n\t\t\t\t\t\t\t\t\t    <div class=\"input-group\">\n\t\t\t\t\t\t\t\t\t\t    <div class=\"input-group-addon\"><span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\"></span></div>\n\t\t\t\t\t\t\t\t\t\t    <input type=\"text\" class=\"form-control\" id=\"name\" name=\"name\" value=\"{{user.fName}}\">\n\t\t\t\t\t\t\t\t\t    </div>\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t<div class=\"form-group col-xs-12 col-md-6\">\n\t\t\t\t\t\t\t\t\t    <label for=\"surname\">Apelido</label>\n\t\t\t\t\t\t\t\t\t    <div class=\"input-group\">\n\t\t\t\t\t\t\t\t\t\t    <div class=\"input-group-addon\"><span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\"></span></div>\n\t\t\t\t\t\t\t\t\t\t    <input type=\"text\" class=\"form-control\" id=\"surname\" name=\"surname\" value=\"{{user.lName}}\">\n\t\t\t\t\t\t\t\t\t    </div>\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t<div class=\"form-group col-xs-12 col-md-6\">\n\t\t\t\t\t\t\t\t\t    <label for=\"username\">Username</label>\n\t\t\t\t\t\t\t\t\t    <div class=\"input-group\">\n\t\t\t\t\t\t\t\t\t\t    <div class=\"input-group-addon\"><span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\"></span></div>\n\t\t\t\t\t\t\t\t\t\t    <input type=\"text\" class=\"form-control\" id=\"username\" name=\"username\" value=\"{{user.username}}\" readonly>\n\t\t\t\t\t\t\t\t\t    </div>\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t<div class=\"form-group col-xs-12 col-md-6\">\n\t\t\t\t\t\t\t\t\t    <label for=\"email\">Email</label>\n\t\t\t\t\t\t\t\t\t    <div class=\"input-group\">\n\t\t\t\t\t\t\t\t\t\t    <div class=\"input-group-addon\"><span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\"></span></div>\n\t\t\t\t\t\t\t\t\t\t    <input type=\"email\" class=\"form-control\" id=\"email\" name=\"email\" value=\"{{user.email}}\">\n\t\t\t\t\t\t\t\t\t    </div>\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t<div class=\"form-group col-xs-12 col-md-6\">\n\t\t\t\t\t\t\t\t\t    <label for=\"birthDate\">Data de Nascimento *</label>\n\t\t\t\t\t\t\t\t\t    <div class=\"input-group\">\n\t\t\t\t\t\t\t\t\t\t    <div class=\"input-group-addon\"><span class=\"glyphicon glyphicon-calendar\" aria-hidden=\"true\"></span></div>\n\t\t\t\t\t\t\t\t\t\t    <input type=\"text\" class=\"form-control\" id=\"birthDate\" name=\"birthDate\" value=\"{{user.birthDate}}\" required>\n\t\t\t\t\t\t\t\t\t    </div>\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t<div class=\"form-group col-xs-12 col-md-6\">\n\t\t\t\t\t\t\t\t\t    <label for=\"sexo\">Sexo *</label>\n\t\t\t\t\t\t\t\t\t    <select class=\"form-control\" id=\"sexo\" name=\"sex\" value=\"{{user.sex}}\" required>\n\t\t\t\t\t\t\t\t\t    \t<option value=\"f\">Feminino</option>\n\t\t\t\t\t\t\t\t\t    \t<option value=\"m\">Masculino</option>\n\t\t\t\t\t\t\t\t\t    \t<option value=\"ND\" selected=\"selected\">Prefiro Não Dizer</option>\n\t\t\t\t\t\t\t\t\t    </select>\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t<div class=\"form-group col-xs-12 col-md-6\">\n\t\t\t\t\t\t\t\t\t    <label for=\"country\">País *</label>\n\t\t\t\t\t\t\t\t\t    <select class=\"form-control\" id=\"country\" name=\"country\" value=\"{{user.country}}\" required>\n\t\t\t\t\t\t\t\t\t    \t<option value=\"ND\" selected>teste</option>\n\t\t\t\t\t\t\t\t\t\t</select>\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t<div class=\"form-group col-xs-12 col-md-6\">\n\t\t\t\t\t\t\t\t\t    <label for=\"dist\">Distrito *</label>\n\t\t\t\t\t\t\t\t\t    <select class=\"form-control\" id=\"dist\" name=\"district\" value=\"{{user.district}}\">\n\t\t\t\t\t\t\t\t\t    \t<option value=\"ND\" selected>teste</option>\n\t\t\t\t\t\t\t\t\t    </select>\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t\t<div class=\"form-group col-xs-12 col-md-6\">\n\t\t\t\t\t\t\t\t\t    <label for=\"con\">Concelho *</label>\n\t\t\t\t\t\t\t\t\t    <select class=\"form-control\" id=\"con\" name=\"county\" value=\"{{user.county}}\">\n\t\t\t\t\t\t\t\t\t    \t<option value=\"ND\" selected>teste</option>\n\t\t\t\t\t\t\t\t\t    </select>\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t\t<div class=\"col-xs-12 col-md-3 container\">\n\t\t\t\t\t\t\t<div id=\"leftProfCont\">\n\t\t\t\t\t\t\t\t<div class=\"form-group\" id=\"avatar\">\n\t\t\t\t\t\t\t\t\t<label for=\"avatar\">Imagem de Perfil</label>\n\t\t\t\t\t\t\t\t\t<img src=\"http://placehold.it/400x400\">\n\t\t\t\t\t\t\t\t\t<div class=\"input-group\">\n\t\t\t\t\t\t\t\t\t\t<div class=\"input-group-addon\"><span class=\"glyphicon glyphicon-file\" aria-hidden=\"true\"></span></div>\n\t\t\t\t\t\t\t\t\t\t<input type=\"file\" class=\"form-control\" id=\"avatar\" name=\"avatar\">\n\t\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t\t\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</form>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t</article>\n\t</div>\n</div>"

/***/ }),

/***/ 690:
/***/ (function(module, exports) {

module.exports = "<div class=\"coponentCont\">\n\t<div  class=\"container\">\n\t\t<form (submit)=\"onRegisterSubmit()\" id=\"regForm\">\n\t\t\t<h2 class=\"page-header\">Register</h2>\n\t\t\t<div class=\"row\">\n\t\t\t\t<div class=\"form-group col-xs-12 col-md-6\">\n\t\t\t\t    <label for=\"name\">Nome *</label>\n\t\t\t\t    <div class=\"input-group\">\n\t\t\t\t\t    <div class=\"input-group-addon\"><span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\"></span></div>\n\t\t\t\t\t    <input type=\"text\" class=\"form-control\" id=\"name\" name=\"fName\" [(ngModel)]=\"fName\" required>\n\t\t\t\t    </div>\n\t\t\t\t</div>\n\t\t\t\t<div class=\"form-group col-xs-12 col-md-6\">\n\t\t\t\t    <label for=\"surname\">Apelido *</label>\n\t\t\t\t    <div class=\"input-group\">\n\t\t\t\t\t    <div class=\"input-group-addon\"><span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\"></span></div>\n\t\t\t\t\t    <input type=\"text\" class=\"form-control\" id=\"surname\" name=\"lName\" [(ngModel)]=\"lName\" required>\n\t\t\t\t    </div>\n\t\t\t\t</div>\n\t\t\t\t<div class=\"form-group col-xs-12 col-md-6\">\n\t\t\t\t    <label for=\"username\">Nome de Utilizador *</label>\n\t\t\t\t    <div class=\"input-group\">\n\t\t\t\t\t    <div class=\"input-group-addon\"><span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\"></span></div>\n\t\t\t\t\t    <input type=\"text\" class=\"form-control\" id=\"username\" name=\"username\" [(ngModel)]=\"username\" required>\n\t\t\t\t    </div>\n\t\t\t\t</div>\n\t\t\t\t<div class=\"form-group col-xs-12 col-md-6\">\n\t\t\t\t    <label for=\"email\">Email *</label>\n\t\t\t\t    <div class=\"input-group\">\n\t\t\t\t\t    <div class=\"input-group-addon\"><span class=\"glyphicon glyphicon-envelope\" aria-hidden=\"true\"></span></div>\n\t\t\t\t\t    <input type=\"email\" class=\"form-control\" id=\"email\" name=\"email\" [(ngModel)]=\"email\" required>\n\t\t\t\t    </div>\n\t\t\t\t</div>\n\t\t\t\t<div class=\"form-group col-xs-12 col-md-6\">\n\t\t\t\t    <label for=\"password\">Password *</label>\n\t\t\t\t    <div class=\"input-group\">\n\t\t\t\t\t    <div class=\"input-group-addon\"><span class=\"glyphicon glyphicon-lock\" aria-hidden=\"true\"></span></div>\n\t\t\t\t\t    <input type=\"password\" class=\"form-control\" id=\"password\" name=\"password\" [(ngModel)]=\"password\" required>\n\t\t\t\t    </div>\n\t\t\t\t</div>\n\t\t\t\t<div class=\"form-group col-xs-12 col-md-6\">\n\t\t\t\t    <label for=\"confPassword\">Confirmar Password *</label>\n\t\t\t\t    <div class=\"input-group\">\n\t\t\t\t\t    <div class=\"input-group-addon\"><span class=\"glyphicon glyphicon-lock\" aria-hidden=\"true\"></span></div>\n\t\t\t\t\t    <input type=\"password\" class=\"form-control\" id=\"confPassword\" name=\"confPassword\" required>\n\t\t\t\t    </div>\n\t\t\t\t</div>\n\t\t\t\t<div class=\"form-group col-xs-12 col-md-6\">\n\t\t\t\t    <label for=\"birthDate\">Data de Nascimento *</label>\n\t\t\t\t    <div class=\"input-group\">\n\t\t\t\t\t    <div class=\"input-group-addon\"><span class=\"glyphicon glyphicon-calendar\" aria-hidden=\"true\"></span></div>\n\t\t\t\t\t    <input type=\"text\" class=\"form-control\" id=\"birthDate\" name=\"birthDate\" [(ngModel)]=\"birthDate\" required>\n\t\t\t\t    </div>\n\t\t\t\t</div>\n\t\t\t\t<div class=\"form-group col-xs-12 col-md-6\">\n\t\t\t\t    <label for=\"sexo\">Sexo *</label>\n\t\t\t\t    <select class=\"form-control\" id=\"sexo\" name=\"sex\" [(ngModel)]=\"sex\" required>\n\t\t\t\t    \t<option value=\"f\">Feminino</option>\n\t\t\t\t    \t<option value=\"m\">Masculino</option>\n\t\t\t\t    \t<option value=\"ND\" selected=\"selected\">Prefiro Não Dizer</option>\n\t\t\t\t    </select>\n\t\t\t\t</div>\n\t\t\t\t<div class=\"form-group col-xs-12 col-md-6\">\n\t\t\t\t    <label for=\"country\">País *</label>\n\t\t\t\t    <select class=\"form-control\" id=\"country\" name=\"country\" [(ngModel)]=\"country\" required>\n\t\t\t\t    \t<option value=\"ND\" selected>teste</option>\n\t\t\t\t\t</select>\n\t\t\t\t</div>\n\t\t\t\t<div class=\"form-group col-xs-12 col-md-6\">\n\t\t\t\t    <label for=\"dist\">Distrito *</label>\n\t\t\t\t    <select class=\"form-control\" id=\"dist\" name=\"district\" [(ngModel)]=\"district\">\n\t\t\t\t    \t<option value=\"ND\" selected>teste</option>\n\t\t\t\t    </select>\n\t\t\t\t</div>\n\t\t\t\t<div class=\"form-group col-xs-12 col-md-6\">\n\t\t\t\t    <label for=\"con\">Concelho *</label>\n\t\t\t\t    <select class=\"form-control\" id=\"con\" name=\"county\" [(ngModel)]=\"county\">\n\t\t\t\t    \t<option value=\"ND\" selected>teste</option>\n\t\t\t\t    </select>\n\t\t\t\t</div>\n\t\t\t\t<div class=\"form-group col-md-12\">\n\t\t\t\t    <label for=\"username\">Captcha *</label>\n\t\t\t\t    <div class=\"input-group\">\n\t\t\t\t\t    <div class=\"g-recaptcha\" data-sitekey=\"6LdydxYUAAAAAITNNEGJOOkAjfAlRdyDwSW-xWvp\"></div>\n\t\t\t\t    </div>\n\t\t\t\t</div>\n\t\t\t\t<div class=\"form-group col-md-12\">\n\t\t\t\t\t<label for=\"confPolicys\">\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"confPolicys\" id=\"confPolicys\" required> Concordo com os Termos e Condições\n\t\t\t\t\t</label>\n\t\t\t\t</div>    \t\t\t\n\t\t\t</div>\n\t\t\t<button type=\"submit\" id=\"regInModal\" class=\"btn btn-primary\">Registar</button>\n\t\t</form>\n\t</div>\n</div>\n<script type=\"text/javascript\">\n\t$(window).on('load', function(){\n\t\t$(\"#regInModal\").prop('disabled', true);\n\t\t$.datetimepicker.setLocale('pt');\n\t\t$(\"#birthDate\").datetimepicker({\n\t\t\ttimepicker:false,\n\t \t\tformat:'d/m/Y',\n\t \t\tmaxDate:'+1970/01/01'//today is maximum date calendar\n\t\t});\n\t\t$(\"#country\").countrySelect({\n\t\t\t\"preferredCountries\": [\"pt\"],\n\t\t});\n\t});\n</script>"

/***/ }),

/***/ 711:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(389);


/***/ }),

/***/ 80:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_http__ = __webpack_require__(206);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_rxjs_add_operator_map__ = __webpack_require__(695);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_rxjs_add_operator_map___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2_rxjs_add_operator_map__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_angular2_jwt__ = __webpack_require__(521);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_angular2_jwt___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3_angular2_jwt__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AuthService; });
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};




var AuthService = (function () {
    function AuthService(http) {
        this.http = http;
    }
    AuthService.prototype.registerUser = function (user) {
        var headers = new __WEBPACK_IMPORTED_MODULE_1__angular_http__["Headers"]();
        headers.append('Content-Type', 'application/json');
        return this.http.post('https://home.hugocurado.info/asw17/users/register', user, { headers: headers })
            .map(function (res) { return res.json(); });
    };
    AuthService.prototype.authenticateUser = function (user) {
        var headers = new __WEBPACK_IMPORTED_MODULE_1__angular_http__["Headers"]();
        headers.append('Content-Type', 'application/json');
        return this.http.post('https://home.hugocurado.info/asw17/users/authenticate', user, { headers: headers })
            .map(function (res) { return res.json(); });
    };
    AuthService.prototype.getLoggedInProfile = function () {
        this.loadUser();
        return this.user;
    };
    AuthService.prototype.getProfile = function () {
        var headers = new __WEBPACK_IMPORTED_MODULE_1__angular_http__["Headers"]();
        this.loadToken();
        headers.append('Authorization', this.authToken);
        headers.append('Content-Type', 'application/json');
        return this.http.get('https://home.hugocurado.info/asw17/users/profile', { headers: headers })
            .map(function (res) { return res.json(); });
    };
    AuthService.prototype.storeUserData = function (token, user) {
        localStorage.setItem('id_token', token);
        localStorage.setItem('user', JSON.stringify(user));
        this.authToken = token;
        this.user = user;
    };
    AuthService.prototype.loadUser = function () {
        var user = JSON.parse(localStorage.getItem('user'));
        this.user = user;
    };
    AuthService.prototype.loadToken = function () {
        var token = localStorage.getItem('id_token');
        this.authToken = token;
    };
    AuthService.prototype.loggedIn = function () {
        return __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_3_angular2_jwt__["tokenNotExpired"])();
    };
    AuthService.prototype.logout = function () {
        this.authToken = null;
        this.user = null;
        localStorage.clear();
    };
    AuthService = __decorate([
        __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Injectable"])(), 
        __metadata('design:paramtypes', [(typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__angular_http__["Http"] !== 'undefined' && __WEBPACK_IMPORTED_MODULE_1__angular_http__["Http"]) === 'function' && _a) || Object])
    ], AuthService);
    return AuthService;
    var _a;
}());
//# sourceMappingURL=/home/asw17/ASW_Proj/angular-src/src/auth.service.js.map

/***/ })

},[711]);
//# sourceMappingURL=main.bundle.map