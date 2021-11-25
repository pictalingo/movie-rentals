<div class="d-flex justify-content-between flex-md-row card movie-card">
    <div class="card-image">
        <img src="<?php echo $movie->image; ?>" alt=""/>
    </div>
    <div class="card-body d-flex flex-column justify-content-between">
        <div class="top">
            <h5 class="card-title mb-3">
                <?php echo $movie->name; ?>
            </h5>
            <h6 class="card-subtitle mb-3">
                <strong><?php echo $movie->score; ?></strong>/<small>10</small>
            </h6>
            <p class="card-text">
                <?php echo $movie->overview; ?>
            </p>
        </div>
        <div class="actions-block d-flex justify-content-between align-items-center">

            <?php if (is_null($movie->rent_days_left) or $movie->rent_days_left <= 0): ?>
                <form action="/" method="post">
                    <input type="hidden" name="movie_id" value="<?php echo $movie->id;?>">
                    <button type="submit" class="btn btn-outline-primary">Rent for 7 days</button>
                </form>
            <?php else: ?>
                <strong><?php echo 'You have ' . $movie->rent_days_left . ' days left'; ?></strong>
            <?php endif; ?>

            <a href="/movie/?id=<?php echo $movie->id; ?>" class="card-link">Read more</a>
        </div>
    </div>
</div> <!-- card movie block -->