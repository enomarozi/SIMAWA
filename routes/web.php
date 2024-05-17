<?php

use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;


Route::GET('/login',[HomeController::class, 'login'])->name("login");
Route::POST('/loginAction',[HomeController::class, 'loginAction'])->name("loginAction");
Route::get('/index', [HomeController::class, 'index'])->name("index");
Route::get('/talenta', [HomeController::class, 'talenta']);
Route::get('/profile',[HomeController::class, 'profile'])->name("profile");
Route::get('/logout', [HomeController::class, 'logout'])->name("logout");