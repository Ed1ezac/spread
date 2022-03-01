<?php

namespace App\Helpers;

use App\Traits\CallsOrangeApi;

class Orange{
    use CallsOrangeApi;

    const BASE_URL = 'https://api.orange.com';
    const API_NUMBER = '75275918';//our api num
    protected $token = ''; 

    /** constructor 
     * @param  array  $config: An associative array with: token, and verifyPeerSSL
     * @return void
     */
    public function __construct($config = array())
    {
        if (array_key_exists('token', $config)) {
            $this->token = $config['token'];
        }
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token){
        $this->token = $token;
    }

    public function requestApiToken(){
        $url = self::BASE_URL .'/oauth/v3/token';
        $headers = array('Authorization: '. \Config::get('app.oheader'));
        $args = array('grant_type' => 'client_credentials');
        return $this->callApi($headers, $args, $url, 'POST', 200);
    }

    /**
     * Sends SMS.
     * @param  string  $senderAddress The receiver address in this format:
     *         "tel:+22500000000"
     * @param  string  $receiverAddress The receiver address in this format:
     *         "tel:+22500000000"
     * @param  string  $message The content of the SMS, must not exceed
     *         160 characters         
     * @param  string  $senderName The sender name
     * @return array
     */
    public function sendSms(
        $senderAddress,
        $receiverAddress,
        $message,
        $senderName = ''
    ) {
        $url = self::BASE_URL . '/smsmessaging/v1/outbound/' . urlencode($senderAddress)
            . '/requests';

        $headers = array(
            'Authorization: Bearer ' . $this->getToken(),
            'Content-Type: application/json'
        );

        if (!empty($senderName)) {
            $args = array(
                'outboundSMSMessageRequest' => array(
                    'address'                   => $receiverAddress,
                    'senderAddress'             => $senderAddress,
                    'senderName'                => urlencode($senderName),
                    'outboundSMSTextMessage'    => array(
                        'message' => $message
                    )
                )
            );
        } else {
            $args = array(
                'outboundSMSMessageRequest' => array(
                    'address'                   => $receiverAddress,
                    'senderAddress'             => $senderAddress,
                    'outboundSMSTextMessage'    => array(
                        'message' => $message
                    )
                )
            );
        }

        return $this->callApi($headers, $args, $url, 'POST', 201, true);
    }

    /**
     * Lists SMS usage statistics per application.
     * @param  array  $args  An associative array to filter the results, containing
     *         country (the international 3 digits country code) and/or
     *         appid (you can retrieve your application ID from your 
     *         dashboard application)
     * @return array
     */
    public function getAdminStats($args = null)
    {   
        $url = self::BASE_URL . '/sms/admin/v1/statistics';
        $headers = array('Authorization: Bearer ' . $this->getToken());

        return $this->callApi($headers, $args, $url, 'GET', 200);
    }

    /**
     * Displays how many SMS you can still send.
     * @param  string  $country  The country to filter on (the international 3 digits 
     *         country)
     * @return array
     */
    public function getAdminContracts($country = '')
    {
        $url = self::BASE_URL . '/sms/admin/v1/contracts';

        $headers = array('Authorization: Bearer ' . $this->getToken());
        $args = null;
        if (!empty($country)) {
            $args = array('country' => $country);
        }

        return $this->callApi($headers, $args, $url, 'GET', 200);
    }

    /**
     * Lists your purchase history.
     * @param  string  $country  The country to filter on (the international 3 digits
     *         country)
     * @return array
     */
    public function getAdminPurchasedBundles($country = '')
    {
        $url = self::BASE_URL . '/sms/admin/v1/purchaseorders';

        $headers = array('Authorization: Bearer ' . $this->getToken());

        $args = null;
        if (!empty($country)) {
            $args = array('country' => $country);
        }

        return $this->callApi($headers, $args, $url, 'GET', 200);
    }
}