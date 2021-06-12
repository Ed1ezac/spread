<?php

namespace App\Http\Controllers;

use App\Models\Funds;
use Illuminate\Http\Request;
use App\Helpers\FundsProcessing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FundsController extends Controller
{
    private $fundsProcessor;

    public function __construct(FundsProcessing $fundsProcessor)
    {
        $this->fundsProcessor = $fundsProcessor;
    }

    public function pay(){
        return view('dashboard.add-funds');
    }

    public function buyFunds(Request $request){
        //$this->incrementFunds();
        $validator = $this->validateFunds();
        if($validator->fails()){
            return back()->withErrors($validator);
        }
        $this->fundsProcessor->incrementUserFunds(Auth::id(), $request->quantity);
        
        return redirect('/funds')->with('status', 'Funds purchased successfully.');
    }

    public function decrementFunds(){
        //after sending
        //The Sending Job handles deduction
        //just gonna leave this here in case.
    }

    private function validateFunds(){
        $request = request();
        return Validator::make($request->all(),[
            'quantity' => ['required','integer','min:5'],
        ],$messages = [
            'quantity.min'=> 'The :attribute must be at least 5 sms.',
        ]);
    }
}
