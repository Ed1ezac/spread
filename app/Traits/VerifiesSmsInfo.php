<?php

namespace App\Traits;

use App\Models\SenderName;
use App\Models\RecipientList;
use Illuminate\Support\Facades\Auth;

trait VerifiesSmsInfo{

    protected function isUsersSenderName($name){
        if($name == "Spread")
            return true;
            
        $names = SenderName::where('user_id', Auth::id())->pluck('sender_name')->toArray();
        return in_array($name, $names);  
    }

    protected function isUsersRecipientListId($listId){
        return RecipientList::where([
            ['id','=', $listId],
            ['user_id', '=', Auth::id()],
        ])->count() > 0;
    }
}