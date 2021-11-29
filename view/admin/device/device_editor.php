<div class="container-fluid">
    <div class="row">
        <div class="col col-md-3 col-lg-2 d-none d-md-block p-3 shadow sidebar">
            <div class="row justify-content-center">
                <span class="text-center fs-5">Menu</span>
            </div>
            <hr />
            <ul class="nav nav-pills flex-column sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/admin"><i class="fas fa-home me-2"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/admin/devices"><i class="fas fa-mobile-alt me-2"></i> Devices</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/admin/users"><i class="fas fa-user me-2"></i> Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/order"><i class="fas fa-shopping-bag me-2"></i> Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/news"><i class="fas fa-newspaper me-2"></i> News</a>
                </li>
                <hr />
                <li class="nav-item">
                    <a class="nav-link" href="/admin/user?id=<?php echo $_SESSION["admin_id"] ?>"><i class="fas fa-id-card me-2"></i> Account</a>
                </li>
                <li class="nav-item">
                    <form action="/admin/logout" method="post">
                        <button class="nav-link text-danger" type="submit"><i class="fas fa-sign-in-alt me-2"></i> Logout</a>
                    </form>
                </li>
            </ul>
        </div>
        <div class="col col-12 col-md-9 col-lg-10 my-3">
            <?php if (isset($device) && $device->is_deleted !== true) { ?>
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
                    <form class="needs-validation" method="post" action="/admin/device/edit?id=<?php echo $device->id ?>" novalidate>
                        <div class="form-floating mb-3 has-validation">
                            <select class="form-select" id="validationCustom04" name="category_id" required>
                                <?php foreach ($categories as $category) { ?>
                                    <option value=<?php echo $category->id ?> <?php if ($device->category_id === $category->id) echo "selected" ?>><?php echo $category->name ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid category.
                            </div>
                            <label for="categoryInput">Category <span class="text-danger">(*)</span></label>
                            <div id="categoryHelpBlock" class="form-text">
                                Device category.
                            </div>
                        </div>
                        <div class="form-floating mb-3 has-validation">
                            <input type="text" class="form-control" id="nameInput" name="name" placeholder="name@example.com" pattern="[a-zA-Z0-9-_. ]{3,64}" required aria-describedby="nameHelpBlock" value="<?php echo $device->name ?>">
                            <label for="nameInput">Name <span class="text-danger">(*)</span></label>
                            <div class="invalid-feedback">
                                Invalid name
                            </div>
                            <div id="nameHelpBlock" class="form-text">
                                Name must be 3-64 characters long, contain letters and numbers, and must not contain special characters.
                            </div>
                        </div>
                        <div class="form-floating mb-3 has-validation">
                            <input type="number" class="form-control" id="priceInput" name="price" placeholder="name@example.com" required aria-describedby="priceHelpBlock" value="<?php echo $device->price ?>">
                            <label for="priceInput">Price <span class="text-danger">(*)</span></label>
                            <div class="invalid-feedback">
                                Invalid price
                            </div>
                            <div id="priceHelpBlock" class="form-text">
                                Device selling price.
                            </div>
                        </div>
                        <div class="form-floating mb-3 has-validation">
                            <input type=number class="form-control" id="valueInput" name="value" placeholder="name@example.com" required aria-describedby="valueHelpBlock" value="<?php echo $device->value ?>">
                            <label for="valueInput">Value <span class="text-danger">(*)</span></label>
                            <div class="invalid-feedback">
                                Invalid value
                            </div>
                            <div id="valueHelpBlock" class="form-text">
                                Device real value.
                            </div>
                        </div>
                        <div class="form-floating mb-3 has-validation">
                            <input type="text" class="form-control" id="manufacturerInput" name="manufacturer" placeholder="name@example.com" pattern="[a-zA-Z0-9-_. ]{3,64}" aria-describedby="manufacturerHelpBlock" value="<?php echo $device->manufacturer ?? "" ?>">
                            <label for="manufacturerInput">Manufacturer</label>
                            <div class="invalid-feedback">
                                Invalid manufacturer
                            </div>
                            <div id="manufacturerHelpBlock" class="form-text">
                                Manufacturer must be 3-64 characters long, contain letters and numbers, and must not contain special characters.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-8 col-md-10">
                                <div class="form-floating mb-3 has-validation">
                                    <input type="text" class="form-control" id="imageUrlInput" name="image_url" placeholder="News image" aria-describedby="imageHelpBlock" value="<?php echo $device->image_url ?? "" ?>">
                                    <label for="imageUrlInput">Image URL</label>
                                    <div class="invalid-feedback">
                                        Invalid URL
                                    </div>
                                    <div id="imageHelpBlock" class="form-text">
                                        Device image.
                                    </div>
                                </div>
                            </div>
                            <div class="col col-4 col-md-2">
                                <button class="btn btn-primary" type="button" id="imagePreviewBtn">Preview</button>
                            </div>
                        </div>
                        <div class="form-floating mb-3 has-validation">
                            <textarea name="description" class="form-control" placeholder="The news description" id="descriptionInput" aria-describedby="descriptionHelpBlock" style="height: 200px;"></textarea>
                            <label for="descriptionInput">Description</label>
                            <div class="invalid-feedback">
                                Invalid description
                            </div>
                            <div id="descriptionHelpBlock" class="form-text">
                                The device description.
                            </div>
                        </div>
                        <p class="text-muted fs-6"><span class="text-danger">(*)</span> Required field</p>
                        <div class="row my-5">
                            <div class="col col-12 col-md-8 d-grid my-2">
                                <button class="btn btn-warning" type="submit">
                                    Update Device
                                </button>
                            </div>
                            <div class="col col-12 col-md-4 d-grid my-2">
                                <button class="btn btn-outline-secondary" type="button" onclick="resetForm()">
                                    Reset
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            <?php } else { ?>
                <div class="d-flex justify-content-center m-5">
                    <h3>This device does not exist</h3>
                </div>
                <div class="d-flex justify-content-center">
                    <a class="btn btn-dark" href="/admin/devices" role="button">Back to Device Manager</a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(() => resetForm());

    function resetForm() {
        $("#categoryInput").val("<?php echo $device->category_id ?>");
        $("#nameInput").val("<?php echo $device->name ?>");
        $("#manufacturerInput").val("<?php echo $device->manufacturer ?>");
        $("#imageUrlInput").val("<?php echo $device->image_url ?>");
        $("#descriptionInput").val("<?php echo $device->description ?>");
        $("#priceInput").val("<?php echo $device->price ?>");
        $("#valueInput").val("<?php echo $device->value ?>");
    }

    $("#imagePreviewBtn").click(() => showImagePreviewModal());

    function showImagePreviewModal() {
        const imageUrl = $("#imageUrlInput").val();
        showImagePreview(imageUrl);
    }
</script>