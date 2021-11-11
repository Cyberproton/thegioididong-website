<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-2 d-none d-sm-block">
            <div class="list-group">
                <a href="/admin/devices" class="list-group-item list-group-item-action bg-warning">
                    Devices
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Orders</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">News</a>
            </div>
        </div>
        <div class="col-xs-12 col-md-10">
            <?php if ($device) { ?>
                <div class="container mt-3">

                    <?php if (isset($message) && $is_successful) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill"></i>
                            <?php echo "$message" ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>

                    <?php if (isset($message) && !$is_successful) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle-fill"></i>
                            <?php echo "$message" ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-center">Editor for device <?php echo $device->name;
                                                                    echo " --- ID: " . $device->id; ?></h4>
                        <a class="btn btn-dark" href="/admin/device/?id=<?php echo $device->id ?>">Detail</a>
                    </div>
                    <hr class="text-primary" />
                    <form id="form" action="/admin/device/edit/?id=<?php echo $device->id ?>" method="post">
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select require class="form-select mb-3" id="category" name="category_id">
                                <option selected value="-1">Select device category...</option>
                                <?php foreach ($categories as $category) { ?>
                                    <option value=<?php echo $category->id ?>><?php echo $category->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name...">
                        </div>
                        <div class="mb-3">
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="brand" name="manufacturer" placeholder="Enter product brand (Apple, Samsung, etc)..." value=<?php echo $device->manufacturer ?>>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-8 mb-3">
                                <label for="image" class="form-label">Image URL</label>
                                <input type="text" class="form-control" id="image" name="image_url" placeholder="Enter image url..." value=<?php echo $device->image_url ?>>
                            </div>
                            <img class="col-2 zoom-on-hover" src=<?php echo $device->image_url ?> alt="<?php echo $device->name ?>" style="max-width: 100%;" />
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description about the device..." value=<?php echo $device->description ?>></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Enter selling price..." value=<?php echo $device->price ?>>
                        </div>
                        <div class="mb-5">
                            <label for="value" class="form-label">Value</label>
                            <input type="number" class="form-control" id="value" name="value" placeholder="Enter real value..." value=<?php echo $device->value ?>>
                        </div>
                        <div class="d-grid d-flex gap-3 justify-content-center">
                            <button class="btn btn-warning" type="submit">Update Device</button>
                            <button class="btn btn-danger" onclick="resetForm()" type="button">Reset</button>
                        </div>
                    </form>
                </div>
            <?php } else { ?>
                <div class="d-flex justify-content-center m-5">
                    <h3>Không tìm thấy sản phẩm</h3>
                </div>
                <div class="d-flex justify-content-center">
                    <a class="btn btn-dark" href="/admin/devices" role="button">Quay lại trang sản phẩm</a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(() => resetForm());

    function resetForm() {
        $("#category").val("<?php echo $device->category_id ?>");
        $("#name").val("<?php echo $device->name ?>");
        $("#brand").val("<?php echo $device->manufacturer ?>");
        $("#image").val("<?php echo $device->image_url ?>");
        $("#description").val("<?php echo $device->description ?>");
        $("#price").val("<?php echo $device->price ?>");
        $("#value").val("<?php echo $device->value ?>");
    }
</script>