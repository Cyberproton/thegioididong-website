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
            <div id="page-alert" class="alert alert-success alert-dismissible" role="alert"></div>
            <div class="row justify-content-between">
                <div class="col-8">
                    <h4>All Products</h4>
                </div>
                <div class="col-4">
                    <div class="d-flex justify-content-end">
                        <a href="/admin/device/add" class="btn btn-dark"><i class="fas fa-plus"></i> Add</a>
                    </div>
                </div>
                <div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thêm sản phẩm</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/" method="post"></form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-warning">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ol class="list-group list-group-numbered mt-3">
                <?php
                foreach ($devices as $device) {
                    $id = $device->id;
                    $description = $device->description ? substr($device->description, 0, 50) . "..." : "Không có mô tả";
                    $price = (int) $device->price . "đ";
                    echo "
                    <li id='device-id-$id' class='list-group-item d-flex justify-content-between align-items-center dark-on-hover'>
                        <div class='col-8 ms-2 me-auto'>
                            <div class='col-9'>
                                <div class='fw-bold'>$device->name</div>
                                <div>$description</div>
                                <div class='fw-bold'>Giá: $price</div>
                            </div>
                        </div>
                        <div class='col-3 d-flex align-items-center justify-content-end'>
                            <div class='btn-group' role='group'>
                                <a href='device/?id=$id' class='btn btn-warning btn-sm'>Chi tiết</a>
                                <button name='delete-button' class='btn btn-danger btn-sm' onclick='deleteDevice($id)'>
                                    <span name='delete-spinner-$id' class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='display: none;'></span>
                                    Xóa
                                </button>
                            </div>
                        </div>
                    </li>
                ";
                }
                ?>
            </ol>

            <nav class="mt-5" aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item"><a class="page-link text-dark" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link text-dark" href="#">1</a></li>
                    <li class="page-item"><a class="page-link text-light bg-dark" href="#">2</a></li>
                    <li class="page-item"><a class="page-link text-dark" href="#">3</a></li>
                    <li class="page-item"><a class="page-link text-dark" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<script>
    $(document).ready(() => {
        $("#page-alert").hide();
    });

    function deleteDevice(id) {
        const spinners = $("[name=delete-spinner-" + id + "]");
        const buttons = $("[name=delete-button]");
        buttons.prop("disabled", true);
        spinners.show();
        $.ajax({
                url: "/admin/device/delete/?id=" + id,
                type: "post",
                data: {
                    id: id,
                },
            })
            .done((data, textStatus, xhr) => {
                showAlert("Device deleted successfully", "alert-success");
                $("#device-id-" + id).remove();
                spinners.hide();
                buttons.removeProp("disabled");
            })
            .fail((xhr) => {
                showAlert("Something wrong has happened. Please try again!", "alert-danger");
                spinners.hide();
                buttons.removeProp("disabled");
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