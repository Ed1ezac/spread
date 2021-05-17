<?php

namespace App\Http\Controllers;

use App\Models\Sms;
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
        $recipients = RecipientList::where([
            ['user_id', '=',Auth::id(),],
            ['status', '=', 'processed']])->get();
        return view('dashboard.create-sms', compact('recipients'));
    }

    public function scheduled(){
        return view('dashboard.scheduled');
    }

    public function recipients(){
        
        $recipients = RecipientList::where('user_id', Auth::id())->get();
        return view('dashboard.recipients', compact('recipients'));
    }

    public function createRecipients(){
        return view('dashboard.add-recipients');
    }

    public function drafts(){
        $drafts = Sms::where([
            ['user_id','=', Auth::id()],
            ['status', '=','draft'],
        ])->orderBy('created_at', 'desc')->get();
        return view('dashboard.drafts', compact('drafts'));
    }

    public function funds(){
        return view('dashboard.funds');
    }

    public function pay(){
        return view('dashboard.add-funds');
    }
}
