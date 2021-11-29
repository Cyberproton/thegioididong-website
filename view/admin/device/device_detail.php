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
        <div class="col col-12 col-md-9 col-lg-10 mt-3">
            <?php if (isset($device) && $device->is_deleted !== true) { ?>
                <div class="container mt-3">
                    <div id="page-alert" class="alert alert-success alert-dismissible" role="alert">

                    </div>
                    <div class="row gx-5">
                        <div class="col col-12 col-md-4">
                        <?php if (isset($device->image_url) && strlen($device->image_url) > 0) { ?>
                            <img src=<?php echo $device->image_url ?> alt="<?php echo $device->name ?>" style="max-width: 100%;" />
                        <?php } ?>
                        </div>
                        <div class="col col-12 col-md-8">
                            <h4 class="text-center mt-3"><?php echo $device->name ?></h4>
                            <div class="d-flex justify-content-center">
                                <a href="/admin/device/edit/?id=<?php echo $device->id ?>" class="btn btn-warning me-1">Edit Product</a>
                                <button class="btn btn-danger ms-1" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete Product</button>
                            </div>
                            <hr />
                            <h5 class="my-3">Brand: <?php echo $device->manufacturer ?></h5>
                            <h5>Description</h5>
                            <p><?php echo substr($device->description, 0, 200) . "..." ?></p>
                            <hr />
                            <h5>Price: <span class="text-danger"><?php echo $device->price . "$" ?></span></h5>
                            <h5>Real Value: <span class="text-danger"><?php echo $device->value . "$" ?></span></h5>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Please confirm before delete the device</p>
                                <h5>ID: <?php echo $device->id ?> </h5>
                                <h5>Name: <?php echo $device->name ?> </h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button id="delete-button" type="button" class="btn btn-danger" onclick="deleteDevice()">
                                    <span id="delete-spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
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
    $(document).ready(() => {
        $("#page-alert").hide();
    });

    function deleteDevice() {
        $("#delete-spinner").show();
        const deleteButton = $("#deleteButton");
        deleteButton.prop("disabled", true);
        $.ajax({
                url: "/admin/device/delete/?id=<?php echo $device->id ?>",
                type: "post",
                data: {
                    id: "<?php echo $device->id ?>",
                },
            })
            .done((data, textStatus, xhr) => {
                $("#delete-spinner").hide();
                deleteButton.removeProp("disabled");
                window.location.href = "/admin/devices";
            })
            .fail((xhr) => {
                showAlert("Something wrong has happened. Please try again!", "alert-danger");
                $("#delete-spinner").hide();
                deleteButton.removeProp("disabled");
            });
    }

    function showAlert(message, style) {
        const alert = $("#page-alert");
        alert.html('<i class="bi bi-info-circle-fill"></i> ' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');
        alert.removeClass();
        alert.addClass("alert alert-dismissible " + style);
        alert.show();
    }
</script>