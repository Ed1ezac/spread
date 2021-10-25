<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateSenderNameRequest;

class SenderNamesController extends Controller
{
    //

    public function registerName(){

        return view('dashboard.add-sender-name');
    }

    public function createName(CreateSenderNameRequest $request){
        ///
        dd($request->validated());
    }

    public function updateName(){
        ///

    }

    public function deleteName(){

    }

}
