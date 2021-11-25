<?php

require_once '../models/Rental.php';

use rental\Rental;

$rentalClass = new Rental();

include_once '../includes/header.php';

$index = 0;
foreach ($rentalClass->getUserRentals() as $movie):
    if ($index % 2 == 0):

        if ($index > 0 and $index % 2 == 0) {
            echo '</div>';
        }

?>

        <div class="d-flex justify-content-center movies-line">

<?php
    endif;

    include '../includes/card.php';

    if ($index > 0 and $index % 2 == 0):
?>
        </div><!-- movies-line -->
<?php
    endif;
    $index++;
endforeach;

include_once '../includes/footer.php';
