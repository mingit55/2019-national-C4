<?php

use App\Route;

Route::get("/", "MainController@indexPage");

Route::get("/users/{user_id}", "UserController@userPage");

Route::connect();