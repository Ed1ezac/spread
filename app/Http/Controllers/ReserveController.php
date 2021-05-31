<?php

namespace App\Http\Controllers;

use App\Model\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\ReserveCreationRequest;
use App\Http\Middleware\ReserveDeductionRequest;
use App\Http\Middleware\ReserveIncrementRequest;

class ReserveController extends Controller
{
    //USE DEDICATED MIDDLEWARE
    public function create(ReserveCreationRequest $request){
        Reserve::create($request->name);
    }

    public function deduct(ReserveDeductionRequest $request){
        //transaction
    }

    public function increment(ReserveIncrementRequest $request){
        //transaction
    }
}
