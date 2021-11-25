<?php

require_once dirname(__DIR__) . '/models/Movie.php';
require_once dirname(__DIR__) . '/models/Rental.php';

use movie\Movie;
use rental\Rental;

$movieClass = new Movie();
$rentalClass = new Rental();

if (isset($_POST['movie_id'])):
    $rentalClass->rentMovie($_POST['movie_id']);
endif;

$movie = null;
if (isset($_GET['id'])):
    $movie = $movieClass->getMovie($_GET['id']);
endif;

list($day, $month, $year) = explode('-', $movie->release_date);
$oldDateUnix = strtotime($year . '-' . $month . '-' . $day);
$movieReleaseYear = date("Y", $oldDateUnix);

include_once dirname(__DIR__) . '/includes/header.php';

?>
    <div class="d-flex justify-content-center movies-line">

<?php
        if ($movie):
?>
        <div class="d-flex justify-content-between flex-md-row card movie-card">
            <div class="card-image">
                <img src="<?php echo $movie->image; ?>" alt=""/>
            </div>
            <div class="card-body d-flex flex-column justify-content-between">
                <h1 class="card-title mb-3 font">
                    <?php echo $movie->name; ?> (<?php echo $movieReleaseYear; ?>)
                </h1>
                <div class="top">
                    <h2 class="card-subtitle mb-3">
                        <strong><?php echo $movie->score; ?></strong>/<small>10</small>
                    </h2>
                    <p class="card-text">
                        <?php echo $movie->overview; ?>
                    </p>
                </div>
                <div class="actions-block d-flex justify-content-between align-items-center">

                    <?php if (is_null($movie->rent_days_left) or $movie->rent_days_left <= 0): ?>
                        <form action="/movie/?id=<?php echo $movie->id; ?>" method="post">
                            <input type="hidden" name="movie_id" value="<?php echo $movie->id; ?>">
                            <button type="submit" class="btn btn-outline-primary">Rent for 7 days</button>
                        </form>
                    <?php else: ?>
                        <strong><?php echo 'You have ' . $movie->rent_days_left . ' days left'; ?></strong>
                    <?php endif; ?>

                </div>
            </div>
        </div> <!-- card movie block -->
<?php
    else:
        echo 'SORRY! I CANT FIND THE MOVIE!';
    endif;
?>
    </div>

<?php
    include_once dirname(__DIR__) . '/includes/footer.php';
