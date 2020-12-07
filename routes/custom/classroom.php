<?php

Route::prefix('classroom')->group(function () {

    // Get all classrooms for the user
    Route::get('/', 'ClassroomController@index')->name('classroom');

    // Make new classroom
    Route::get('/create', 'ClassroomController@create')->name('classroom.create');
    Route::post('/create', 'ClassroomController@store')->name('classroom.store');

    Route::middleware('users.classroom')->group(function () {

        Route::get('/results/{id}', 'ClassroomController@results')->name('classroom.results');

        // edit existing classroom
        Route::get('/edit/{id}', 'ClassroomController@edit')->name('classroom.edit');
        Route::post('/edit/{id}', 'ClassroomController@update')->name('classroom.update');


        // show the classroom for the user
        Route::get('/{id}', 'ClassroomController@show')->name('classroom.show');

        // delete existing classroom
        Route::delete('/{id}', 'ClassroomController@delete')->name('classroom.delete');
    });



});
