<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.create-sms');
    }

    public function scheduled(){
        return view('dashboard.scheduled');
    }

    public function recipients(){
        return view('dashboard.recipients');
    }

    public function drafts(){
        return view('dashboard.drafts');
    }

    public function summary(){
        return view('dashboard.summary');
    }

    public function funds(){
        return view('dashboard.funds');
    }

    public function pay(){
        return view('dashboard.pay');
    }
}
