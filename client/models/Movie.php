<?php

namespace movie;
require_once './Api.php';

use api\Api;


class Movie
{
    private $api, $accessToken;

    public function __construct()
    {
        $this->api = new Api();
        $this->accessToken = $this->api->getAccessToken();
    }

    public function getMoviesList()
    {
        $userRentals = $this->api->get('movies', $this->accessToken);
        return json_decode($userRentals);
    }

    public function getMovie(int $movieId)
    {
        $movieResponse = file_get_contents($this->api->getSiteUrl('movies') . $movieId);
        return json_decode($movieResponse);
    }
}