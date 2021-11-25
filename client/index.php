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

$index = 0;
foreach ($movieClass->getMoviesList() as $movie):

    if ($index % 2 == 0):

        if ($index > 0 and $index % 2 == 0) {
            echo '</div>';
        }
?>

        <div class="d-flex justify-content-center movies-line">

<?php
    endif;
    include 'includes/card.php';
    if ($index > 0 and $index % 2 == 0):
?>

        </div><!-- movies-line -->

<?php
    endif;
    $index++;
endforeach;

include_once 'includes/footer.php';
