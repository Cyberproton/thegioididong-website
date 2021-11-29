<div class="container-md mt-3 pb-2 shadow">
    <div class="row bg-light p-2">
        <h5 class="text-center m-0"><i class="fas fa-shopping-bag"></i> Your Orders</h5>
    </div>
    <?php if (isset($is_successful)) {
        if ($is_successful === true) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle-fill"></i> Your info has been updated<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-circle-fill"></i> ' . $message . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }
    } ?>
    <div id="orderAlertSuccess"></div>
    <div id="orderAlertFail"></div>
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
                <i class="fas fa-check-circle"></i> Cancelled
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
            <?php
            if (sizeof(array_filter($orders, function ($order) {
                return $order->status === "PENDING";
            })) < 1) {
                echo '<h4 class="text-center mt-3">No Orders</h4>';
            }

            foreach ($orders as $order) {
                if ($order->status === "PENDING") {
            ?>
                    <div class="row border" style="height: 140px;" id="order-<?php echo $order->id ?>">
                        <div class="col col-3 col-md-2 align-self-center">
                            <a href="/device?id=<?php echo $order->device_id ?>">
                                <img src="<?php echo $order->device->image_url ?>" alt="<?php echo $order->id ?>" style="object-fit: contain; width: 100%; height: 100px">
                            </a>
                        </div>
                        <div class="col col-7 col-md-5 align-self-center">
                            <h5><?php echo $order->device->name ?></h5>
                            <p class="text-danger fs-5 d-md-none">$<?php echo number_format($order->price, 2, ".", "") ?></p>
                            <p>Amount: <?php echo $order->quantity ?></p>
                        </div>
                        <div class="col d-none d-md-block col-md-2 align-self-center">
                            <p class="text-danger fs-5 m-0">$<?php echo number_format($order->price, 2, ".", "") ?></p>
                        </div>
                        <div class="col col-2 align-self-center dropdown">
                            <button class="btn" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <li><button class="dropdown-item" onclick="showCancelModal(<?php echo $order->id ?>)">Cancel</button></li>
                            </ul>
                        </div>
                    </div>
            <?php }
            } ?>
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
            <?php
            if (sizeof(array_filter($orders, function ($order) {
                return $order->status === "DELIVERING";
            })) < 1) {
                echo '<h4 class="text-center mt-3">No Orders</h4>';
            }

            foreach ($orders as $order) {
                if ($order->status === "DELIVERING") {
            ?>
                    <div class="row border" style="height: 140px;" id="order-<?php echo $order->id ?>">
                        <div class="col col-3 col-md-2 align-self-center">
                            <a href="/device?id=<?php echo $order->device_id ?>">
                                <img src="<?php echo $order->device->image_url ?>" alt="<?php echo $order->id ?>" style="object-fit: contain; width: 100%; height: 100px">
                            </a>
                        </div>
                        <div class="col col-7 col-md-5 align-self-center">
                            <h5><?php echo $order->device->name ?></h5>
                            <p class="text-danger fs-5 d-md-none">$<?php echo number_format($order->price, 2, ".", "") ?></p>
                            <p>Amount: <?php echo $order->quantity ?></p>
                        </div>
                        <div class="col d-none d-md-block col-md-2 align-self-center">
                            <p class="text-danger fs-5 m-0">$<?php echo number_format($order->price, 2, ".", "") ?></p>
                        </div>
                        <div class="col col-2 align-self-center dropdown">
                            <button class="btn" id="dropdownMenuButtonDelivering" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonDelivering">
                                <li><button class="dropdown-item">No Action</button></li>
                            </ul>
                        </div>
                    </div>
            <?php }
            } ?>
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
            <?php
            if (sizeof(array_filter($orders, function ($order) {
                return $order->status === "COMPLETED";
            })) < 1) {
                echo '<h4 class="text-center mt-3">No Orders</h4>';
            }

            foreach ($orders as $order) {
                if ($order->status === "COMPLETED") {
            ?>
                    <div class="row border" style="height: 140px;" id="order-<?php echo $order->id ?>">
                        <div class="col col-3 col-md-2 align-self-center">
                            <a href="/device?id=<?php echo $order->device_id ?>">
                                <img src="<?php echo $order->device->image_url ?>" alt="<?php echo $order->id ?>" style="object-fit: contain; width: 100%; height: 100px">
                            </a>
                        </div>
                        <div class="col col-7 col-md-5 align-self-center">
                            <h5><?php echo $order->device->name ?></h5>
                            <p class="text-danger fs-5 d-md-none">$<?php echo number_format($order->price, 2, ".", "") ?></p>
                            <p>Amount: <?php echo $order->quantity ?></p>
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
            <?php
            if (sizeof(array_filter($orders, function ($order) {
                return $order->status === "CANCELLED";
            })) < 1) {
                echo '<h4 class="text-center mt-3">No Orders</h4>';
            }

            foreach ($orders as $order) {
                if ($order->status === "CANCELLED") {
            ?>
                    <div class="row border py-2" style="height: 140px;" id="order-<?php echo $order->id ?>">
                        <div class="col col-3 col-md-2 align-self-center">
                            <a href="/device?id=<?php echo $order->device_id ?>">
                                <img src="<?php echo $order->device->image_url ?>" alt="<?php echo $order->id ?>" style="object-fit: contain; width: 100%; height: 100px">
                            </a>
                        </div>
                        <div class="col col-9 col-md-5 align-self-center">
                            <h5><?php echo $order->device->name ?></h5>
                            <p class="text-danger fs-5 d-md-none">$<?php echo number_format($order->price, 2, ".", "") ?></p>
                            <p>Amount: <?php echo $order->quantity ?></p>
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
    <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    </div>
</div>
<script>
    const orders = <?php echo json_encode($orders) ?>;

    function showCancelModal(cancellingOrderId) {
        const modal = $("#cancelOrderModal");
        if (!modal) {
            return;
        }
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="cancelOrder(${order.id})">Cancel</button>
                    </div>
                </div>
            </div>
        `;
        modal.empty().append(dialog);
        var myModalEl = document.getElementById('cancelOrderModal');
        var m = new bootstrap.Modal(myModalEl);
        m.toggle();
    }

    function cancelOrder(orderId) {
        $.post("/order/cancel", {
            order_id: orderId
        }).done((data, textStatus, xhr) => {
            removeOrder(orderId);
            showAlert("orderAlertSuccess", data.message, "success");
        }).fail((xhr) => {
            showAlert("orderAlertFail", xhr.responseJSON.message, "fail");
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