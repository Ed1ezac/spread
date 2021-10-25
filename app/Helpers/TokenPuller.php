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
        $this->pullTokenFromOrange();
        $this->pushTokenIntoDatabase();
    }

    private function pullTokenFromOrange(){
        $url = 'https://api.orange.com/oauth/v2/token';
        $headers = array('Authorization: '. env('ORANGE_AUTH_HEADER'));
        //array('Authorization: Basic ' . base64_encode($credentials));
        $args = array('grant_type' => 'client_credentials');
        $response = $this->callApi($headers, $args, $url, 'POST', 200);

        if (!empty($response['access_token'])) {
            $this->token = $response['access_token'];
        }

        return $response;
    }

    private function pushTokenIntoDatabase(){
        //update database
        $currentToken = Token::first();
        $currentToken->update(['value' => $this->token]);
    }

    private function updateDatabase($token){
        $this->token->update(['value' => $token]);
    }
}