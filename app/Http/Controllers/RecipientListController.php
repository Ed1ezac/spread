<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecipientList;
use Illuminate\Support\Facades\Validator;

class RecipientListController extends Controller
{
    //
    public function create(Request $request){
        //validation
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'max:85'],
            'data-file' => ['required','mimes:csv,xls,xxls,xlm,xla,xlc,xlt,xlw', 'max:10250'],//less than 10MB
        ]);
        //bailOrContinue
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        //storage
        $path = $request->file('file')->store('recipients');
        //databse
        $recipientsList = RecipientList::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'file_path' => $path,
        ]);
        
        return back()
                ->with('status', 'The recipient list has been uploaded successfully!');
    }
    
    public function get(){
        
    }

    public function deleteList(){

    }

}
