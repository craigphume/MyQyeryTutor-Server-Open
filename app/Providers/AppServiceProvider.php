<?php

namespace App\Providers;

use App\Classroom;
use App\Result;
use App\School;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // TODO move to a class
        view()->composer('includes.classroomlist', function ($view) {
            $classrooms = Classroom::where('school_id', Auth::user()->school_id)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
            $view->with(compact('classrooms'));
        });

        view()->composer('admin.includes.quickstats', function ($view) {
            $totalSchools = School::count();

            $newSchoolsCount = School::orderBy('created_at', 'DESC')
                ->whereDate('created_at', '>=' ,Carbon::now()->firstOfMonth())
                ->count();

            $newClassroomsCount = Classroom::orderBy('created_at', 'DESC')
            ->whereDate('created_at', '>=', Carbon::now()->firstOfMonth())
            ->count();

            $newResultsCount = Result::orderBy('created_at', 'DESC')
                ->whereDate('created_at', '>=', Carbon::now()->firstOfMonth())
                ->count();

            $newTeachers = User::orderBy('created_at', 'DESC')
                ->select('email_verified_at')
                ->whereDate('created_at', '>=', Carbon::now()->firstOfMonth())
                ->get();

            $newTeachersInvitedCount = $newTeachers->count();
            $newTeachersVerifiedCount = $newTeachers->where('email_verified_at', '<>', '')->count();

            //dd($newTeachersVerifiedCount);


            $view->with(compact(
                'totalSchools',
                'newSchoolsCount',
                'newClassroomsCount',
                'newResultsCount',
                'newTeachersInvitedCount',
                'newTeachersVerifiedCount'
            ));
        });

    }
}
