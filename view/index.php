<div class="container">
    <h1>Search result for: ?</h1>
    <form id="filter" method="post" action="/search">
        <select name="category" class="form-select" aria-label="Default select example">
            <option selected value="-1">Choose a category</option>
            <?php
            if (isset($categories)) {
                foreach ($categories as $category) {
                    echo '<option value="' . $category->id . '">' . $category->name . '</option>';
                }
            }
            ?>
        </select>
        <button class="btn btn-primary" type="submit">Apply</button>
    </form>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        <?php
        foreach ($devices as $device) {
        ?>
            <div class="col">
                <div class="card">
                    <img src="<?php echo $device->image_url ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $device->name ?></h5>
                        <h5><?php echo $device->price ?>$</h5>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<script>
    $("#filter").submit((event) => {
        $(this).append('<input type="hidden" name="product_name" value="<?php echo $device_name ?>">');
        return true;
    });
</script>