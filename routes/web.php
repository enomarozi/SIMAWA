<?php

use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;


Route::GET('/',[HomeController::class, 'login']);
Route::GET('/login',[HomeController::class, 'login'])->name("login");
Route::POST('/loginAction',[HomeController::class, 'loginAction'])->name("loginAction");
Route::GET('/cmVnaXN0cmF0aW9u',[HomeController::class, 'registration'])->name("registration");
Route::POST('/registrationAction',[HomeController::class, 'registrationAction'])->name("registrationAction");
Route::GET('/index', [HomeController::class, 'index'])->name("index");
Route::GET('/talenta', [HomeController::class, 'talenta']);
Route::GET('/profile',[HomeController::class, 'profile'])->name("profile");
Route::GET('/logout', [HomeController::class, 'logout'])->name("logout");