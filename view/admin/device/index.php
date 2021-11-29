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
            <div id="page-alert" class="alert alert-success alert-dismissible" role="alert"></div>
            <div class="row justify-content-between">
                <div class="col-8">
                    <h4><i class="fas fa-mobile-alt me-2"></i> All Products</h4>
                </div>
                <div class="col-4">
                    <div class="d-flex justify-content-end">
                        <a href="/admin/device/add" class="btn btn-dark btn-sm"><i class="fas fa-plus"></i> Add</a>
                    </div>
                </div>
                <div class="col col-12 col-md-6 my-3 d-flex">
                    <input name="key" class="form-control me-2" type="search" id="search" placeholder="Search by name" aria-label="Search">
                    <button class="btn btn-outline-dark" type="button" onclick="filter()"><i class="fas fa-search"></i></button>
                </div>
                <div class="col col-12 col-md-6 my-3">
                    <div class="row justify-content-end">
                        <div class="col col-2 d-none d-md-block"></div>
                        <div class="col col-4 col-sm-3">
                            <label for="sort" class="col-form-label">Category</label>
                        </div>
                        <div class="col col-6">
                            <select id="categorySelect" class="form-select" aria-label="Default select example" onchange="filter()">
                                <option value="-1" selected>All</option>
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
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
            <ol class="list-group list-group-numbered my-3" id="deviceContainer">
            </ol>
        </div>
    </div>
</div>
<script>
    const devices = <?php echo json_encode($devices) ?>;
    let keyword = "";
    let categoryKey = "";

    $(document).ready(() => {
        $("#page-alert").hide();
    });

    filter();

    function filter() {
        keyword = $("#search").val();
        categoryKey = $("#categorySelect").val();
        const elems = devices.filter(device => 
            device.is_deleted != true &&
            (!categoryKey || categoryKey == -1 || device.category_id == categoryKey) && 
            (!keyword || keyword.length === 0 || device.name.toLowerCase().includes(keyword.toLowerCase()))
        ).map(device => (
            `<li id='device-id-${device.id}' class='list-group-item d-flex justify-content-between align-items-center dark-on-hover'>
                <div class='col-8 ms-2 me-auto'>
                    <div class='col-9'>
                        <div class='fw-bold'>${device.name}</div>
                        <div>${device.description && device.description.length > 80 ? device.description.substring(0, 80) + "..." : device.description ? device.description : "No description"}</div>
                        <div class='fw-bold'>$${device.price}</div>
                    </div>
                </div>
                <div class='col-3 d-flex align-items-center justify-content-end'>
                    <div class='btn-group' role='group'>
                        <a href='device/?id=${device.id}' class='btn btn-warning btn-sm'>Chi tiết</a>
                        <button name='delete-button' class='btn btn-danger btn-sm' onclick='deleteDevice(${device.id})'>
                            <span name='delete-spinner-$id' class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='display: none;'></span>
                            Xóa
                        </button>
                    </div>
                </div>
            </li>`
        ));
        //console.log()
        $("#deviceContainer").empty().append(elems);
    }

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
                $("[name=delete-button]").prop("disabled", false);
            })
            .fail((xhr) => {
                showAlert("Something wrong has happened. Please try again!", "alert-danger");
                spinners.hide();
                $("[name=delete-button]").prop("disabled", false);
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