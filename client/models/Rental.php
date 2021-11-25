<?php

namespace rental;

include_once dirname(__DIR__) . '/Api.php';

use api\Api;


class Rental
{
    private $api, $accessToken;

    public function __construct()
    {
        $this->api = new Api();
        $this->accessToken = $this->api->getAccessToken();
    }

    public function getUserRentals()
    {
        $userRentals = $this->api->get('rentals', $this->accessToken);
        return json_decode($userRentals);
    }

    public function rentMovie(int $movieID)
    {
        $data = array("movie_id" => $movieID);
        $userRentals = $this->api->post('rent', $data, $this->accessToken);
        return json_decode($userRentals);
    }


}