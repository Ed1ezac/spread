<?php

namespace App\Http\Controllers;

use App\Model\Reserve;
use App\Model\ReserveRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReserveCreationRequest;
use App\Http\Requests\ReserveDeductionRequest;
use App\Http\Requests\ReserveIncrementRequest;

class ReserveController extends Controller
{
    //USE DEDICATED Request
    /*public function create(ReserveCreationRequest $request){
        Reserve::create($request->name);
    }*/
    public function deduct(ReserveDeductionRequest $request){
        //transaction
        $amount = $request->amount;
        DB::transaction(function() use ($amount) {
            $reserve = Reserve::find(1);
            $userFunds = DB::table('funds')->where('user_id', Auth::id())->first();
            //--
            $reserve->decrement('amount', $amount);
            $userFunds->increment('amount', $amount);
            //
            $reserve->recordEvent([
                'reserve_id' => 1, 
                'triggering_user_id' => Auth::id(), 
                'event' => ReserveRecord::Deduction, 
                'amount' => $amount
            ]);
        });
    }

    public function increment(ReserveIncrementRequest $request){
        //transaction
        $amount = $request->amount;
        DB::transaction(function() use ($amount) {
            $reserve = Reserve::find(1);
            $reserve->increment('amount', $amount);

            $reserve->recordEvent([
                'reserve_id' => 1, 
                'triggering_user_id' => Auth::id(), 
                'event' => ReserveRecord::Increment, 
                'amount' => $amount
            ]);
        });
    }
}
