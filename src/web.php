<?php

use App\Route;

Route::get("/", "MainController@indexPage");

Route::get("/users/sign-in", "UserController@signInPage");
Route::post("/users/sign-in", "UserController@signIn");

Route::get("/users/logout", "UserController@logout");

Route::connect();