<?php

namespace App\Helpers;

use App\Helpers\Orange;
use App\Traits\CallsOrangeApi;
use App\Models\SmsApiToken as Token;

class TokenPuller{
    use CallsOrangeApi;
    private $token;
    private $orange;

    public function __invoke(){
        $token = Token::first();
        $this->orange = new Orange();
        $this->pullTokenFromOrange();
        $this->pushTokenIntoDatabase();
    }

    private function pullTokenFromOrange(){
        $response = $this->orange->requestApiToken();

        if (!empty($response['access_token'])) {
            $this->token = $response['access_token'];
        }else{
            $this->token = '';
        }

        return $response;
    }

    private function pushTokenIntoDatabase(){
        if(!empty($this->token)){
            $currentToken = Token::first();
            $currentToken->update(['value' => $this->token]);
        }
    }

}