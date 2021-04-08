<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecipientList;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $recipients = RecipientList::where('user_id', Auth::id())->get();
        return view('dashboard.create-sms', compact('recipients'));
    }

    public function scheduled(){
        return view('dashboard.scheduled');
    }

    public function recipients(){
        return view('dashboard.recipients');
    }

    public function createRecipients(){
        return view('dashboard.add-recipients');
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
