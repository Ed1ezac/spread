<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    //
    public function landing()
    {
        return view('home');
    }

    public function faqs(){
        return view('faq');
    }
    
    public function terms(){
        return view('terms');
    }

    public function privacy(){
        return view('privacy');
    }

    public function learnMore(){
        return view('more-info');
    }
}
