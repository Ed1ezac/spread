<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use App\Models\ReserveRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReserveCreationRequest;
use App\Http\Requests\Admin\CreditReserveRequest;
use App\Http\Requests\Admin\DeductReserveRequest;

class ReserveController extends Controller
{
    private static $retryAttempts = 50;
    //USE DEDICATED Request
    public function create(ReserveCreationRequest $request){
        Reserve::create($request->name);
    }

    public function editReserve(){
        $reserve = Reserve::first();
        return view('admin.edit-reserve', compact('reserve'));
    }

    public function creditReserve(CreditReserveRequest $request){
        $data = $request->validated();
        $this->increment($data['amount']);
        return redirect('/admin/funds-reserve')->with('status', 'Reserve has been incremented.');
    }

    public function deductFromReserve(DeductReserveRequest $request){
        $data = $request->validated();
        $this->deduct($data['amount']);
        return redirect('/admin/funds-reserve')->withErrors('Reserve has been decremented.');
    }

    public function deduct($amount){
        DB::transaction(function() use ($amount) {
            $reserve = Reserve::find(1);
            $reserve->decrement('amount', $amount);
            //
            $reserve->recordEvent([
                'reserve_id' => 1, 
                'triggering_user_id' => Auth::id(), 
                'event' => ReserveRecord::Deduction, 
                'amount' => $amount
            ]);
        }, self::$retryAttempts);
    }

    public function increment($amount){
        DB::transaction(function() use ($amount) {
            $reserve = Reserve::find(1);
            $reserve->increment('amount', $amount);

            $reserve->recordEvent([
                'reserve_id' => 1, 
                'triggering_user_id' => Auth::id(), 
                'event' => ReserveRecord::Increment, 
                'amount' => $amount
            ]);
        }, self::$retryAttempts);
    }
}
