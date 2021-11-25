<?php

namespace rental;
require_once '../Api.php';

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

}