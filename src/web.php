<?php

use App\Route;

Route::get("/", "MainController@indexPage");

Route::get("/biff-2019/overview", "MainController@overviewPage");
Route::get("/biff-2019/event-info", "MainController@eventPage");

Route::get("/biff-2019/entry", "EntryController@entryPage");
Route::post("/biff-2019/entry", "EntryController@entry");
Route::get("/biff-2019/entry-graph", "EntryController@entryGraph");

Route::Get("/biff-2019/calender", "ScheduleController@calenderPage");

Route::get("/users/sign-in", "UserController@signInPage");
Route::post("/users/sign-in", "UserController@signIn");

Route::get("/users/logout", "UserController@logout");

Route::connect();