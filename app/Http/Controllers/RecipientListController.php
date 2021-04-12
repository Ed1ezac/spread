<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\RecipientList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RecipientListController extends Controller
{
    //
    public function create(Request $request){
        //validation
        $validator = Validator::make($request->all(),[
            'collection_name' => ['required','max:20'],
            'data-file' => ['required','mimes:csv,xls,xxls','max:10250'],//max:10250 less than 10MB 
        ]);
        //bailOrContinue
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        //storage
        $path = $request->file('data-file')->store('shelf');
        //databse
        RecipientList::create([
            'user_id' => Auth::id(),
            'name' => $request->input('collection_name'),
            'file_path' => $path,
        ]);
        
        return redirect('/recipients')
                ->with('status', 'The recipient list has been uploaded successfully!');
    }
    
    public function get(){
        
    }

    public function deleteList(){

    }

}
