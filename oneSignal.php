<?php
/**
 * @author Oğuzhan ÇAKAR
 * @webSite http://www.ogzcakar.net
 * Class oneSignal
 * Date: 18.11.2016
 */

class oneSignal
{
    public $apiKey = ''; // Api Key

    private $restApiKey = ''; // Rest Api Key

    function __construct()
    {
        return $this->apiKey;
    }

    public function sendMessage($messageEn , $url = null)
    {
        $content = array(
            'en' => $messageEn
        );

        $data = array(
            'app_id' => $this->apiKey,
            'included_segments' => array('All'),
            'contents' => $content,
            'url' => $url
        );
        $data = json_encode($data);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://onesignal.com/api/v1/notifications',
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HEADER => FALSE,
            CURLOPT_POST => TRUE,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json; charset=utf-8',
                'Authorization: Basic '.$this->restApiKey
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        return 'Bildirim Gönderildi.'.$response;
    }

}