<?php

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::post('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/manage', 'ManagementController@index')->name('manage');
Route::delete('/manage/delete/{id}', 'ManagementController@delete')->name('manage.delete');
Route::get('/manage/disable/{id}', 'ManagementController@toggleDisable')->name('manage.disable');
Route::get('/manage/invite', 'ManagementController@showInvite')->name('manage.show.invite');
Route::post('/manage/invite', 'ManagementController@invite')->name('manage.invite');
