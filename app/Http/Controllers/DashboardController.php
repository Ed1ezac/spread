<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sms;
use App\Models\User;
use App\Models\SenderName;
use App\Models\FundsRecord;
use Illuminate\Http\Request;
use App\Models\RecipientList;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private $defaultAppName = 'Spread';
    
    public function __construct(RecipientList $list)
    {
        $this->middleware('auth');
    }

    public function create(){
        $senderNames = array($this->defaultAppName);
        $names = SenderName::where('user_id', Auth::id())
                        ->withStatus(SenderName::Approved)
                        ->pluck('sender_name');
        if(isset($names) && count($names)>0){
            foreach($names as $n){ $senderNames[] = $n;
            }
        }
         
        $recipients = RecipientList::mine()->withStatus(RecipientList::Processed)->get();
        if(!Auth::user()->hasRole('client')){
            return view('dashboard.create-sms', compact('recipients', 'senderNames'))
                ->withErrors("This user account is suspended");
        }else return view('dashboard.create-sms', compact('recipients', 'senderNames'));
    }

    public function scheduled(){
        $scheduled = Sms::mine()->withStatus(Sms::Pending)
            ->orderBy('send_at', 'asc')->get();
        if(!Auth::user()->hasRole('client')){
            return view('dashboard.scheduled', compact('scheduled'))
            ->withErrors("This user account is suspended"); 
        }else
            return view('dashboard.scheduled', compact('scheduled'));
        
    }

    public function recipients(){
        $recipients = RecipientList::mine()->get();
        if(!Auth::user()->hasRole('client')){
            return view('dashboard.recipients', compact('recipients'))
            ->withErrors('This user account is suspended'); 
        }else
            return view('dashboard.recipients', compact('recipients'));
    }

    public function statistics() {
        $isAboutToSend = Sms::mine()->withStatus(Sms::Pending)
            ->where([['send_at', '<', Carbon::now()->addMinutes(1)]])
            ->count() > 0;
            
            $history = DB::table('sms')
                        ->where('sms.user_id', Auth::id())
                        ->join('job_statuses', function ($join) {
                            $join->on('sms.id', '=', 'job_statuses.trackable_id')
                                ->where('job_statuses.queue', 'rollouts');
                        })
                        ->select('sms.*', 'job_statuses.progress_now')
                        ->latest()
                        ->paginate(7);

        if(!Auth::user()->hasRole('client')){
            return view('dashboard.statistics', compact('isAboutToSend', 'history'))
                ->withErrors('This user account is suspended'); 
        }else
            return view('dashboard.statistics', compact('isAboutToSend', 'history'));
    }

    public function drafts(){
        $drafts = Sms::mine()->withStatus(Sms::Draft)->orderBy('created_at', 'desc')->get();

        if(!Auth::user()->hasRole('client')){
            return view('dashboard.drafts', compact('drafts'))
            ->withErrors("This user account is suspended"); 
        }else
            return view('dashboard.drafts', compact('drafts'));
    }

    public function funds(){
        $funds = Auth::user()->funds;
        $history = FundsRecord::mine()->latest()->paginate(7);

        if(!Auth::user()->hasRole('client')){
            return view('dashboard.funds', compact('funds','history'))
            ->withErrors('This user account is suspended'); 
        }else
            return view('dashboard.funds', compact('funds','history'));
    }

}
