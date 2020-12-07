<?php

Route::prefix('/admin')
    ->name('admin.')
    ->namespace('Admin')
    ->group(function() {

    /**
     * Admin Authentication Routes
     */
    Route::namespace('Auth')
        ->group(function () {

            //Login Routes
        Route::get('/login','LoginController@showLoginForm')
->name('login');
        Route::post('/login','LoginController@login');
        Route::post('/logout','LoginController@logout')
->name('logout');

        //Forgot Password Routes
        Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')
->name('password.request');
        Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')
->name('password.email');

        //Reset Password Routes
        Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')
->name('password.reset');
        Route::post('/password/reset','ResetPasswordController@reset')
->name('password.update');

    });

    /**
     * Secure all routes behind the Admin middleware
     */
    Route::middleware('auth:admin')
        ->group(function () {

        Route::get('/', 'AdminController@index')
            ->name('home');
        Route::get('/home', 'AdminController@index')
            ->name('home');


        /**
         * School Admin Routes
         */
        Route::get('/school/{id}', 'SchoolController@show')
            ->name('school.show');

        Route::delete('/school/{id}', 'SchoolController@delete')
            ->name('school.delete');

        Route::get('/school/disable/{id}', 'SchoolController@toggleDisable')
            ->name('school.disable');

        Route::get('/school', 'SchoolController@create')
            ->name('school.create');
        Route::post('/school', 'SchoolController@store')
            ->name('school.store');

        Route::get('/school/edit/{id}', 'SchoolController@edit')
            ->name('school.edit');
        Route::post('/school/edit/{id}', 'SchoolController@update')
            ->name('school.update');

        /**
         * Subscription Admin Routes
         */
        Route::get('/subscription/school/{id}', 'SubscriptionController@create')
            ->name('subscription.create');
        Route::post('/subscription/school/{id}', 'SubscriptionController@save')
            ->name('subscription.save');

        /**
         * Teacher Admin Routes
         */
        Route::get('/teacher/{id}', 'TeacherController@show')
            ->name('teacher.show');
        Route::post('/teacher/{id}', 'TeacherController@update')
            ->name('teacher.update');

        Route::get('/teacher/invite/school/{schoolId}', 'TeacherController@showInvite')
            ->name('teacher.showInvite');
        Route::post('/teacher/invite/school/{schoolId}', 'TeacherController@invite')
            ->name('teacher.invite');
        Route::get('/teacher/reinvite/{id}', 'TeacherController@reinvite')
            ->name('teacher.reinvite');

        Route::get('/teacher/disable/{id}', 'TeacherController@toggleDisable')
            ->name('teacher.disable');

        Route::delete('/teacher/delete/{id}', 'TeacherController@delete')
            ->name('teacher.delete');

        Route::get('/teacher/reset/password/{id}', 'TeacherController@resetPasswordLink')
            ->name('teacher.reset.password');


        /**
         * Admin Profile Routes
         */
        Route::get('/profile', 'ProfileController@index')
            ->name('profile');
        Route::post('/profile', 'ProfileController@update')
            ->name('profile.update');

        /**
         * Settings Routes
         */
        Route::get('/settings', 'SettingsController@index')
            ->name('settings');
        Route::post('/settings/set/sysmsg', 'SettingsController@setSysMsg')
            ->name('setSysMsg');
        Route::get('/settings/forget/sysmsg', 'SettingsController@index')
            ->name('forgetSysMsg');


        /**
         * Queued Jobs / Failed Jobs Routes
         */
        Route::get('/queue', 'QueueController@index')
            ->name('queue');
    //    Route::get('/queuefailed', 'QueueController@failedIndex')->name('queue.failed.jobs');

    });
    //TODO make admin profile manager, view failed jobs, real delete users.
});
