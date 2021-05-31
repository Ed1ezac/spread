<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

    public function create()
    {
        $recipients = RecipientList::where([
            ['user_id', '=',Auth::id(),],
            ['status', '=', 'processed']])->get();
        return view('dashboard.create-sms', compact('recipients'));
    }

    public function scheduled(){
        $scheduled = Sms::where([
            ['user_id','=', Auth::id()],
            ['status', '=', Sms::Pending],
        ])->orderBy('send_at', 'asc')->get();
        return view('dashboard.scheduled', compact('scheduled'));
    }

    public function recipients(){
        $recipients = RecipientList::where('user_id', Auth::id())->get();
        return view('dashboard.recipients', compact('recipients'));
    }

    public function createRecipients(){
        return view('dashboard.add-recipients');
    }

    public function statistics() {
        //send_at less than now()->AddMinutes(1);
        $isAboutToSend = Sms::where([
            ['user_id', '=', Auth::id()],
            ['status', '=', Sms::Pending],
            ['send_at', '<', Carbon::now()->addMinutes(1)],
        ])->count() > 0;
        
        return view('dashboard.statistics', compact('isAboutToSend'));
    }

    public function drafts(){
        $drafts = Sms::where([
            ['user_id','=', Auth::id()],
            ['status', '=', Sms::Draft],
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
