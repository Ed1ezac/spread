<?php

namespace App\Http\Controllers;

use App\Models\Sms;
use App\Models\Funds;
use App\Traits\SendsMail;
use App\Models\FundsRecord;
use Illuminate\Http\Request;
use App\Mail\PaymentSuccess;
use App\Helpers\FundsProcessing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FundsController extends Controller
{
    use SendsMail;
    private $fundsProcessor;

    public function __construct(FundsProcessing $fundsProcessor)
    {
        $this->fundsProcessor = $fundsProcessor;
    }

    public function pay(){
        if(!Auth::user()->hasRole('client')){
            return redirect()->back();
        }
        return view('dashboard.add-funds');
    }

    public function fundsDetails(Request $request){
        //go straight
        $record = FundsRecord::mine()->withOrderNo($request->input('order_no'))->first();
        $sms = Sms::mine()->withOrderId($request->input('order_no'))->first();
        return view('dashboard.funds-details', compact('record', 'sms'));
    }

    public function buyFunds(Request $request){
        //$this->incrementFunds();
        $validator = $this->validateFunds();
        if($validator->fails()){
            return back()->withErrors($validator);
        }
        $this->fundsProcessor->incrementUserFunds(Auth::id(), $request->quantity);
        $this->sendEmail($request->user()->email, new PaymentSuccess($request->input('cost'), $request->input('quantity')));
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
            'quantity' => ['required','integer','min:20'],
        ],$messages = [
            'quantity.min'=> 'The :attribute must be at least 20 sms.',
        ]);
    }
}
