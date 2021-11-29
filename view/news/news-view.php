<div class="container-md mt-3 pb-2 shadow">
    <?php if (!isset($model)) { ?>
        <div class="container my-5 text-center" style="min-height: 500px;">
            <h1><i class="fas fa-exclamation-triangle"></i></h1>
            <h1 class="mb-5">This news does not exist</h1>
            <p>Something wrong has happened.</p>
            <p>Please contact your admin for more information.</p>
        </div>
    <?php
        return;
    } ?>
    <div class="row">
        <div class="col col-12 col-md-8 mx-auto">
            <h2 class="text-center fw-bold mt-5 mb-3"><?php echo $model->title ?></h2>
            <p class="text-muted text-center"><?php echo $model->classification ?> | Post on <?php echo $model->date ?></p>
            <?php if (isset($model->image_url) && strlen($model->image_url > 0)) { ?>
                <img src="<?php echo $model->image_url; ?>" class="img-fluid rounded news-img mx-auto d-block" alt="News">
            <?php } ?>
            <p class="mt-5"><?php echo $model->content ?></p>
        </div>
    </div>
</div>