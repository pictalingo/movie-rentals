<?php

namespace api;

class Api
{


    private $url;

    public function __construct()
    {
        $protocol = "http://";
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $protocol = "https://";

        $this->url = $protocol . $_SERVER['HTTP_HOST'];

    }

    public function getSiteUrl($endpoint): string
    {
        return $this->url . '/api/' . $endpoint . '/';
    }

    public function post($endpoint, $data)
    {

        $curl = curl_init($this->getSiteUrl($endpoint));

        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    public function get($endpoint, $authorization)
    {

        $curl = curl_init($this->getSiteUrl($endpoint));

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer ".$authorization
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    public function getAccessToken()
    {
        $user = array("username" => "admin", "password" => "admq1w2e3");
        $token = json_decode($this->post('token', $user));
        return $token->access;

    }

}
