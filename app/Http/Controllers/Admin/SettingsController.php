<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    public function index() {
        $sysmsg = $this->getSysMsg();
        $expiryDate = '';
        $expiryTime = '';

        return view('admin.settings.index', compact('sysmsg', 'expiryTime', 'expiryDate'));
    }

    public function setSysMsg(Request $request) {
        $sysmsg = $request['sysmsg'];
        $expiryDate = $request['expiryDate'];
        $expiryTime = $request['expiryTime'];
        $expiry = Carbon::createFromTimestamp(strtotime($expiryDate . $expiryTime));

        Cache::put('sysmsg', $sysmsg, $expiry);

        return redirect()->route('admin.settings');
    }

    public function clearSysMsg() {
        Cache::forget('sysmsg');
    }

    public function getSysMsg() {
        return Cache::get('sysmsg');
    }
}
