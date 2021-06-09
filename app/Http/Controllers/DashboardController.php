<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sms;
use App\Models\User;
use App\Models\Funds;
use Illuminate\Http\Request;
use App\Models\RecipientList;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(RecipientList $list)
    {
        $this->middleware('auth');
    }

    public function create(){
        $recipients = RecipientList::mine()->withStatus(RecipientList::Processed)->get();
        return view('dashboard.create-sms', compact('recipients'));
    }

    public function scheduled(){
        $scheduled = Sms::mine()->withStatus(Sms::Pending)
            ->orderBy('send_at', 'asc')->get();
        return view('dashboard.scheduled', compact('scheduled'));
    }

    public function recipients(){
        $recipients = RecipientList::mine()->get();
        return view('dashboard.recipients', compact('recipients'));
    }

    public function statistics() {
        $isAboutToSend = Sms::mine()->withStatus(Sms::Pending)
            ->where([['send_at', '<', Carbon::now()->addMinutes(1)]])
            ->count() > 0;
            // ->orWhere([
            //     ['status', '=', Sms::Aborted],
            //     ['updated_at', '>', Carbon::now()->subMinutes(1)]
            // ])
            
        return view('dashboard.statistics', compact('isAboutToSend'));
    }

    public function drafts(){
        $drafts = Sms::mine()->withStatus(Sms::Draft)->orderBy('created_at', 'desc')->get();
        return view('dashboard.drafts', compact('drafts'));
    }

    public function funds(){
        $funds = Auth::user()->funds;
        return view('dashboard.funds', compact('funds'));
    }

}
