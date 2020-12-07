<?php

namespace App\Http\Controllers\Admin;

use App\Subscription;
use App\School;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function __construct(){
        $this->middleware('auth:admin');
    }


    /**
     * Show Admin Dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $schools = School::all();
        return view('admin.home', compact('schools'));
    }


}
