<div class="container-fluid">
    <div class="row">
        <div class="col col-md-3 col-lg-2 d-none d-md-block p-3 shadow sidebar">
            <div class="row justify-content-center">
                <span class="text-center fs-5">Menu</span>
            </div>
            <hr />
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="/admin"><i class="fas fa-home me-2"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/devices"><i class="fas fa-mobile-alt me-2"></i> Devices</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/admin/users"><i class="fas fa-user me-2"></i> Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/admin/order"><i class="fas fa-shopping-bag me-2"></i> Orders</a>
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
            <div class="row bg-light p-2">
                <h5 class="text-center m-0"><i class="fas fa-shopping-bag"></i> Orders</h5>
            </div>
            <div id="adminOrderAlert"></div>
            <ul class="nav nav-tabs nav-fill mt-3" id="myTab" role="tablist" style="white-space: nowrap; flex-wrap: nowrap; overflow-x: auto; overflow-y: hidden; ">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab" aria-controls="pending" aria-selected="true">
                        <i class="fas fa-clock"></i> Pending
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="delivering-tab" data-bs-toggle="tab" data-bs-target="#delivering" type="button" role="tab" aria-controls="delivering" aria-selected="false">
                        <i class="fas fa-shipping-fast"></i> Delivering
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab" aria-controls="completed" aria-selected="false">
                        <i class="fas fa-check-circle"></i> Completed
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="cancelled-tab" data-bs-toggle="tab" data-bs-target="#cancelled" type="button" role="tab" aria-controls="cancelled" aria-selected="false">
                        <i class="fas fa-times-circle"></i> Cancelled
                    </button>
                </li>
            </ul>
            <div class="tab-content" style="min-height: 200px;">
                <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                    <div class="row p-3">
                        <div class="col col-3 col-md-2 d-flex justify-content-center">
                            <h5 class="m-0"><i class="fas fa-box"></i></h5>
                        </div>
                        <div class="col col-7 col-md-5">
                            Product
                        </div>
                        <div class="col d-none d-md-block col-md-2">
                            Price
                        </div>
                        <div class="col col-2">
                            Action
                        </div>
                    </div>
                    <div id="orders-PENDING">
                        <?php

                        foreach ($orders as $order) {
                            if ($order->status === "PENDING") {
                        ?>
                                <div class="row border p-3" style="min-height: 140px;" id="order-<?php echo $order->id ?>">
                                    <div class="col col-3 col-md-2 align-self-center">
                                        <a href="/device?id=<?php echo $order->device_id ?>">
                                            <img src="<?php echo $order->device->image_url ?>" alt="<?php echo $order->id ?>" style="object-fit: contain; width: 100%; height: 100px">
                                        </a>
                                    </div>
                                    <div class="col col-7 col-md-5 align-self-center">
                                        <h5><?php echo $order->device->name ?></h5>
                                        <p class="text-danger fs-5 d-md-none">$<?php echo number_format($order->price, 2, ".", "") ?></p>
                                        <p>Amount: <?php echo $order->quantity ?></p>
                                        <button class="btn btn-secondary btn-sm" onclick="showUserInfoModal(<?php echo $order->id ?>)">Customer Info</button>
                                    </div>
                                    <div class="col d-none d-md-block col-md-2 align-self-center">
                                        <p class="text-danger fs-5 m-0">$<?php echo number_format($order->price, 2, ".", "") ?></p>
                                    </div>
                                    <div class="col col-2 align-self-center dropdown">
                                        <button class="btn" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                            <li><button class="dropdown-item" onclick="showDeliverModal(<?php echo $order->id ?>)">Deliver</button></li>
                                            <li><button class="dropdown-item" onclick="showCancelModal(<?php echo $order->id ?>)">Cancel</button></li>
                                        </ul>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="delivering" role="tabpanel" aria-labelledby="delivering-tab">
                    <div class="row shadow-sm p-3">
                        <div class="col col-3 col-md-2 d-flex justify-content-center">
                            <h5 class="m-0"><i class="fas fa-box"></i></h5>
                        </div>
                        <div class="col col-7 col-md-5">
                            Product
                        </div>
                        <div class="col d-none d-md-block col-md-2">
                            Price
                        </div>
                        <div class="col col-2">
                            Action
                        </div>
                    </div>
                    <div id="orders-DELIVERING">
                        <?php

                        foreach ($orders as $order) {
                            if ($order->status === "DELIVERING") {
                        ?>
                                <div class="row border p-3" style="min-height: 140px;" id="order-<?php echo $order->id ?>">
                                    <div class="col col-3 col-md-2 align-self-center">
                                        <a href="/device?id=<?php echo $order->device_id ?>">
                                            <img src="<?php echo $order->device->image_url ?>" alt="<?php echo $order->id ?>" style="object-fit: contain; width: 100%; height: 100px">
                                        </a>
                                    </div>
                                    <div class="col col-7 col-md-5 align-self-center">
                                        <h5><?php echo $order->device->name ?></h5>
                                        <p class="text-danger fs-5 d-md-none">$<?php echo number_format($order->price, 2, ".", "") ?></p>
                                        <p>Amount: <?php echo $order->quantity ?></p>
                                        <button class="btn btn-secondary btn-sm" onclick="showUserInfoModal(<?php echo $order->id ?>)">Customer Info</button>
                                    </div>
                                    <div class="col d-none d-md-block col-md-2 align-self-center">
                                        <p class="text-danger fs-5 m-0">$<?php echo number_format($order->price, 2, ".", "") ?></p>
                                    </div>
                                    <div class="col col-2 align-self-center dropdown">
                                        <button class="btn" id="dropdownMenuButtonDelivering" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonDelivering">
                                            <li><button class="dropdown-item" onclick="showCompleteModal(<?php echo $order->id ?>)">Complete Order</button></li>
                                        </ul>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                    <div class="row shadow-sm p-3">
                        <div class="col col-3 col-md-2 d-flex justify-content-center">
                            <h5 class="m-0"><i class="fas fa-box"></i></h5>
                        </div>
                        <div class="col col-7 col-md-5">
                            Product
                        </div>
                        <div class="col d-none d-md-block col-md-2">
                            Price
                        </div>
                        <div class="col col-2">
                            Action
                        </div>
                    </div>
                    <div id="orders-COMPLETED">
                        <?php

                        foreach ($orders as $order) {
                            if ($order->status === "COMPLETED") {
                        ?>
                                <div class="row border p-3" style="min-height: 140px;" id="order-<?php echo $order->id ?>">
                                    <div class="col col-3 col-md-2 align-self-center">
                                        <a href="/device?id=<?php echo $order->device_id ?>">
                                            <img src="<?php echo $order->device->image_url ?>" alt="<?php echo $order->id ?>" style="object-fit: contain; width: 100%; height: 100px">
                                        </a>
                                    </div>
                                    <div class="col col-7 col-md-5 align-self-center">
                                        <h5><?php echo $order->device->name ?></h5>
                                        <p class="text-danger fs-5 d-md-none">$<?php echo number_format($order->price, 2, ".", "") ?></p>
                                        <p>Amount: <?php echo $order->quantity ?></p>
                                        <button class="btn btn-secondary btn-sm" onclick="showUserInfoModal(<?php echo $order->id ?>)">Customer Info</button>
                                    </div>
                                    <div class="col d-none d-md-block col-md-2 align-self-center">
                                        <p class="text-danger fs-5 m-0">$<?php echo number_format($order->price, 2, ".", "") ?></p>
                                    </div>
                                    <div class="col col-2 align-self-center dropdown">
                                        <button class="btn" id="dropdownMenuButtonCompleted" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonCompleted">
                                            <li><button class="dropdown-item">No Action</button></li>
                                        </ul>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
                    <div class="row shadow-sm p-3">
                        <div class="col col-3 col-md-2 d-flex justify-content-center">
                            <h5 class="m-0"><i class="fas fa-box"></i></h5>
                        </div>
                        <div class="col col-9 col-md-5">
                            Product
                        </div>
                        <div class="col d-none d-md-block col-md-2">
                            Price
                        </div>
                        <div class="col col-md-3 d-none d-md-block">
                            Reason
                        </div>
                    </div>
                    <div id="orders-CANCELLED">
                        <?php

                        foreach ($orders as $order) {
                            if ($order->status === "CANCELLED") {
                        ?>
                                <div class="row border py-3" style="min-height: 140px;" id="order-<?php echo $order->id ?>">
                                    <div class="col col-3 col-md-2 align-self-center">
                                        <a href="/device?id=<?php echo $order->device_id ?>">
                                            <img src="<?php echo $order->device->image_url ?>" alt="<?php echo $order->id ?>" style="object-fit: contain; width: 100%; height: 100px">
                                        </a>
                                    </div>
                                    <div class="col col-9 col-md-5 align-self-center">
                                        <h5><?php echo $order->device->name ?></h5>
                                        <p class="text-danger fs-5 d-md-none">$<?php echo number_format($order->price, 2, ".", "") ?></p>
                                        <p>Amount: <?php echo $order->quantity ?></p>
                                        <button class="btn btn-secondary btn-sm" onclick="showUserInfoModal(<?php echo $order->id ?>)">Customer Info</button>
                                    </div>
                                    <div class="col d-none d-md-block col-md-2 align-self-center">
                                        <p class="text-danger fs-5 m-0">$<?php echo number_format($order->price, 2, ".", "") ?></p>
                                    </div>
                                    <div class="col d-none d-md-block col-md-2 align-self-center">
                                        <?php echo isset($order->cancellation_reason) && strlen($order->cancellation_reason > 0) ? $order->cancellation_reason : "No reason specified." ?>
                                    </div>
                                </div>
                                <div class="row p-3 align-self-center d-md-none">
                                    <p>Reason: <span class="fw-bold"><?php echo isset($order->cancellation_reason) && strlen($order->cancellation_reason > 0) ? $order->cancellation_reason : "No reason specified." ?></span></p>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    </div>
</div>
<script>
    const orders = <?php echo json_encode($orders) ?>;

    function updateOrders() {
        $("#orders-PENDING").empty().append(

        );
    }

    function showModal(id, dialog) {
        const modal = $("#" + id);
        if (!modal) {
            return;
        }
        modal.empty().append(dialog);
        const myModalEl = document.getElementById(id);
        const m = new bootstrap.Modal(myModalEl);
        m.show();
    }

    function showUserInfoModal(orderId) {
        const order = orders.find(order => order.id === orderId);
        if (!order) {
            return;
        }
        const user = order.user;
        if (!user) {
            return;
        }
        const dialog = `
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Customer Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="fw-bold">Username: ${user.username}</p>
                        <p>Full Name: ${user.name}</p>
                        <p>Phone Number: ${user.phone}</p>
                        <p>Address: ${user.address}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        `;
        showModal("modal", dialog);
    }

    function showDeliverModal(orderId) {
        const order = orders.find(order => order.id === orderId);
        if (!order) {
            showAlert("adminOrderAlert", "Some error has happened");
            return;
        }
        const user = order.user;
        if (!user) {
            showAlert("adminOrderAlert", "Some error has happened");
            return;
        }
        const dialog = `
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Cancel Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure to mark this as delivering?</p>
                        <h6>Product: ${order.device.name}</h6>
                        <p>Amount: ${order.quantity}</p>
                        <hr/>
                        <h6>Customer Info</h6>
                        <p>Full Name: ${user.name}</p>
                        <p>Phone Number: ${user.phone}</p>
                        <p>Address: ${user.address}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="deliverOrder(${order.id})">Deliver Order</button>
                    </div>
                </div>
            </div>
        `;
        showModal("modal", dialog);
    }

    function showCompleteModal(orderId) {
        const order = orders.find(order => order.id === orderId);
        if (!order) {
            showAlert("adminOrderAlert", "Some error has happened");
            return;
        }
        const user = order.user;
        if (!user) {
            showAlert("adminOrderAlert", "Some error has happened");
            return;
        }
        const dialog = `
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Complete Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure to mark this as completed?</p>
                        <h6>Product: ${order.device.name}</h6>
                        <p>Amount: ${order.quantity}</p>
                        <hr/>
                        <h6>Customer Info</h6>
                        <p>Full Name: ${user.name}</p>
                        <p>Phone Number: ${user.phone}</p>
                        <p>Address: ${user.address}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="completeOrder(${order.id})">Complete Order</button>
                    </div>
                </div>
            </div>
        `;
        showModal("modal", dialog);
    }

    function showCancelModal(cancellingOrderId) {
        const order = orders.find(order => order.id === cancellingOrderId);
        if (!order) {
            return;
        }
        const dialog = `
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Cancel Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure to cancel this order?</p>
                        <h6>Product: ${order.device.name}</h6>
                        <p>Amount: ${order.quantity}</p>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Specify a reason" id="floatingTextarea" style="height: 100px"></textarea>
                            <label for="floatingTextarea">Cancellation Reason</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="cancelOrder(${order.id})">Cancel Order</button>
                    </div>
                </div>
            </div>
        `;
        showModal("modal", dialog);
    }

    function cancelOrder(orderId) {
        const reasonText = $("#floatingTextarea");
        let reason = null;
        if (reasonText) {
            reason = reasonText.val();
        }
        $.post("/admin/order/cancel", {
            order_id: orderId,
            cancellation_reason: reason,
        }).done((data, textStatus, xhr) => {
            const i = orders.indexOf(order => order.id === orderId);
            const order = data.order;
            console.log(data);
            orders[i] = order;
            const orderElem = $("#order-" + order.id);
            orderElem.remove();
            const newOrder = (`
                <div class="row border p-3" style="min-height: 140px;" id="order-${order.id}">
                    <div class="col col-3 col-md-2 align-self-center">
                        <a href="/device?id=${order.device.id}">
                            <img src="${order.device.image_url}" alt="${order.device.id}" style="object-fit: contain; width: 100%; height: 100px">
                        </a>
                    </div>
                    <div class="col col-7 col-md-5 align-self-center">
                        <h5>${order.device.name}</h5>
                        <p class="text-danger fs-5 d-md-none">$${order.device.price.toFixed(2)}</p>
                        <p>Amount: ${order.quantity}</p>
                        <button class="btn btn-secondary btn-sm" onclick="showUserInfoModal(${order.id})">Customer Info</button>
                    </div>
                    <div class="col d-none d-md-block col-md-2 align-self-center">
                        <p class="text-danger fs-5 m-0">$${order.device.price.toFixed(2)}</p>
                    </div>
                    <div class="col d-none d-md-block col-md-2 align-self-center">
                        ${(order.cancellation_reason) && order.cancellation_reason.length > 0 ? order.cancellation_reason : "No reason specified."}
                    </div>
                </div>
                <div class="row p-3 align-self-center d-md-none">
                    <p>Reason: <span class="fw-bold"><?php echo isset($order->cancellation_reason) && strlen($order->cancellation_reason > 0) ? $order->cancellation_reason : "No reason specified." ?></span></p>
                </div>
            `);
            $("#orders-CANCELLED").prepend(newOrder);
            showAlert("adminOrderAlert", data.message, "success");
        }).fail((xhr) => {
            showAlert("adminOrderAlert", xhr.responseJSON.message, "fail");
        });
    }

    function deliverOrder(orderId) {
        $.post("/admin/order/update-status", {
            order_id: orderId,
            status: "DELIVERING",
        }).done((data, textStatus, xhr) => {
            const i = orders.indexOf(order => order.id === orderId);
            const order = data.order;
            console.log(order);
            orders[i] = order;
            const orderElem = $("#order-" + order.id);
            orderElem.remove();
            const newOrder = (`
                <div class="row border p-3" style="min-height: 140px;" id="order-${order.id}">
                    <div class="col col-3 col-md-2 align-self-center">
                        <a href="/device?id=${order.device.id}">
                            <img src="${order.device.image_url}" alt="${order.device.id}" style="object-fit: contain; width: 100%; height: 100px">
                        </a>
                    </div>
                    <div class="col col-7 col-md-5 align-self-center">
                        <h5>${order.device.name}</h5>
                        <p class="text-danger fs-5 d-md-none">$${order.device.price.toFixed(2)}</p>
                        <p>Amount: ${order.quantity}</p>
                        <button class="btn btn-secondary btn-sm" onclick="showUserInfoModal(${order.id})">Customer Info</button>
                    </div>
                    <div class="col d-none d-md-block col-md-2 align-self-center">
                        <p class="text-danger fs-5 m-0">$${order.device.price.toFixed(2)}</p>
                    </div>
                    <div class="col col-2 align-self-center dropdown">
                        <button class="btn" id="dropdownMenuButtonDelivering" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonDelivering">
                        <li><button class="dropdown-item" onclick="showCompleteModal(<?php echo $order->id ?>)">Complete Order</button></li>
                        </ul>
                    </div>
                </div>
            `);
            $("#orders-DELIVERING").prepend(newOrder);
            showAlert("adminOrderAlert", data.message, "success");
        }).fail((xhr) => {
            showAlert("adminOrderAlert", xhr.responseJSON.message, "fail");
        });
    }

    function completeOrder(orderId) {
        $.post("/admin/order/update-status", {
            order_id: orderId,
            status: "COMPLETED",
        }).done((data, textStatus, xhr) => {
            const i = orders.indexOf(order => order.id === orderId);
            const order = data.order;
            orders[i] = order;
            const orderElem = $("#order-" + order.id);
            orderElem.remove();
            const newOrder = (`
                <div class="row border p-3" style="min-height: 140px;" id="order-${order.id}">
                    <div class="col col-3 col-md-2 align-self-center">
                        <a href="/device?id=${order.device.id}">
                            <img src="${order.device.image_url}" alt="${order.device.id}" style="object-fit: contain; width: 100%; height: 100px">
                        </a>
                    </div>
                    <div class="col col-7 col-md-5 align-self-center">
                        <h5>${order.device.name}</h5>
                        <p class="text-danger fs-5 d-md-none">$${order.device.price.toFixed(2)}</p>
                        <p>Amount: ${order.quantity}</p>
                        <button class="btn btn-secondary btn-sm" onclick="showUserInfoModal(${order.id})">Customer Info</button>
                    </div>
                    <div class="col d-none d-md-block col-md-2 align-self-center">
                        <p class="text-danger fs-5 m-0">$${order.device.price.toFixed(2)}</p>
                    </div>
                    <div class="col col-2 align-self-center dropdown">
                        <button class="btn" id="dropdownMenuButtonCompleted" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonCompleted">
                            <li><button class="dropdown-item">No Action</button></li>
                        </ul>
                    </div>
                </div>
            `);
            $("#orders-COMPLETED").prepend(newOrder);
            showAlert("adminOrderAlert", data.message, "success");
        }).fail((xhr) => {
            showAlert("adminOrderAlert", xhr.responseJSON.message, "fail");
        });
    }

    function showAlert(id, message = "Unknown message", type = "fail") {
        const alert = $("#" + id);
        if (!alert) {
            return;
        }
        if (type === "success") {
            alert.empty().append(`<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle-fill"></i> ${message}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`);
        } else {
            alert.empty().append(`<div class="alert alert-danger alert-dismissible fade show" role="alert" id="orderAlertFail"><i class="bi bi-exclamation-circle-fill"></i> ${message}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`);
        }

        alert.show();
    }

    function removeOrder(id) {
        const order = $("#order-" + id);
        if (!order) {
            return;
        }
        order.remove();
    }
</script>