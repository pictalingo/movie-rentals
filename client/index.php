<?php

require_once 'models/Movie.php';
require_once 'models/Rental.php';

use movie\Movie;
use rental\Rental;

$movieClass = new Movie();
$rentalClass = new Rental();

if (isset($_POST['movie_id'])):
    $rentalClass->rentMovie($_POST['movie_id']);
endif;

include_once 'includes/header.php';

$index = 1;

echo '<div class="d-flex justify-content-center movies-line">';

foreach ($movieClass->getMoviesList() as $movie):

    include 'includes/card.php';

    if ($index % 2 == 0) {
        if ($index > 0) {
            echo '</div>';
        }
        echo '<div class="d-flex justify-content-center movies-line">';
    }

    $index++;
endforeach;

echo '</div>';

include_once 'includes/footer.php';
