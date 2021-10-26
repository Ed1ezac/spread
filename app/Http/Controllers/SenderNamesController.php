<?php

namespace App\Http\Controllers;

use App\Models\SenderName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateSenderNameRequest;

class SenderNamesController extends Controller
{
    //
    public function registerName(){

        return view('dashboard.add-sender-name');
    }

    public function createName(CreateSenderNameRequest $request){
        $validated = $request->validated();
        SenderName::create([
            'user_id' => Auth::id(),
            'sender_name' => $validated['sender-name'],
            'reason' => $validated['reason'],
            'company_name' => $validated['company-name'],
            'company_address' => $validated['company-address'],
            'company_tax_number' => $validated['tax-number'],
            'company_contact_number' => $validated['contact']
        ]);
        
        return redirect('/settings')->with('status', 'Sender name registered, pending approval');

    }

    public function updateName(){
        ///

    }

    public function deleteName(){

    }

}
