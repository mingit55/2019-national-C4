<?php

use App\Route;

Route::get("/", "MainController@indexPage");

Route::get("/biff-2019/overview", "MainController@overviewPage");
Route::get("/biff-2019/event-info", "MainController@eventPage");

Route::get("/biff-2019/entry", "EntryController@entryPage", "user");
Route::post("/biff-2019/entry", "EntryController@entry", "user");
Route::get("/biff-2019/entry-graph", "EntryController@entryGraph", "user");

Route::get("/biff-2019/calender", "ScheduleController@calenderPage");

Route::get("/schedules/application", "ScheduleController@applicationPage", "admin");
Route::post("/schedules/application", "ScheduleController@addSchedule", "admin");

Route::get("/schedules/{date}", "ScheduleController@detailPage");

Route::get("/biff-2019/schedules", "ScheduleController@getSchedule");

Route::get("/users/sign-in", "UserController@signInPage", "guest");
Route::post("/users/sign-in", "UserController@signIn", "guest");

Route::get("/users/logout", "UserController@logout", "user");

Route::connect();