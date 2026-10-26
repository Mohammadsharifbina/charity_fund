<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\userController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\Entery;
use App\Http\Controllers\EnteryController;
use App\Http\Controllers\withdrawController;

Route::get('/', function () {
    return view('welcome');
});
route::view('/member','member');
route::get("/dashboard",function(){
    return view("dashboard");
}); 

route::resource("/member",MemberController::class);

route::get("/deleteMember/{id}",[GeneralController::class,"deleteMember"]);
route::get("/memberInfo/{id}",[GeneralController::class,"memberInfo"]);

route::resource("/Entery",EnteryController::class);


route::resource("/withdraw",withdrawController::class);

//user route