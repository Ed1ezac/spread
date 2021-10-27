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

    //-------Admin Routes
    public function getNames(){
        $senderNames = SenderName::latest()->paginate(7);
        return view('admin.sender-names', compact('senderNames'));
    }

    public function senderNameDetails($id){
        $senderName = SenderName::find($id);

        return view('admin.edit-sender-name', compact('senderName'));
    }


    public function updateStatus(Request $request){
        //
        $name = SenderName::find($request->input('sender_name_id'));
        if($name->status == SenderName::Pending){
            $name->update(['status' => SenderName::Approved]);
        }else{
            $name->update(['status' => SenderName::Pending]); 
        }
        return back()->with('status', 'The Sender name has been updated successfully.');
    }

    public function rejectName(Request $request){
        $name = SenderName::find($request->input('sender_name_id'));
        $name->update(['status' => SenderName::Rejected]);

        return back()->withErrors('The Sender name has been rejected!');
    }

    public function deleteName(){

    }

}
