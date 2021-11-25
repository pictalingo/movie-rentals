<?php

require_once '../models/Rental.php';

use rental\Rental;

$rentalClass = new Rental();

include_once '../includes/header.php';

$index = 1;

echo '<div class="d-flex justify-content-center movies-line">';

foreach ($rentalClass->getUserRentals() as $movie):

    include '../includes/card.php';

    if ($index % 2 == 0) {
        if ($index > 0) {
            echo '</div>';
        }
        echo '<div class="d-flex justify-content-center movies-line">';
    }

    $index++;
endforeach;

echo '</div>';

include_once '../includes/footer.php';
