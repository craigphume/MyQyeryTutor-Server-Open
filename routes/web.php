<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $motd = Cache::get('motd');

    return view('welcome')->with('motd', $motd);
});

Auth::routes();

Route::middleware(['auth', 'school.enabled'])->group(function () {

    include (base_path('routes/custom/teacher.php'));
    include (base_path('routes/custom/classroom.php'));

    Route::get('student/{id}', 'StudentController@show')->name('student.show');

});

include (base_path('routes/custom/admin.php'));

Route::any('test', function () {

    //Cache::add('sysmsg', 'There system will go down for maintenance at 00:00 tonight', 3600);



    return Cache::get('sysmsg');
    return 'TEST';
})->name('test');

