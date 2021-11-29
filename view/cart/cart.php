<div class="container-md mt-3 pb-2 shadow-sm border border-warning">
    <div class="row bg-warning p-2">
        <h5 class="text-center m-0"><i class="fas fa-shopping-cart text-dark me-2"></i>Your Cart</h5>
    </div>
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
    <div id="cartContainer">
        <?php
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->device->price * $cart->quantity;
        ?>
            <div id="<?php echo $cart->id ?>">
                <div class="row border" style="height: 140px;">
                    <div class="col col-3 col-md-2 align-self-center">
                        <img src="<?php echo $cart->device->image_url ?>" alt="<?php echo $cart->device->name ?>" style="object-fit: contain; width: 100%; height: 100px">
                    </div>
                    <div class="col col-7 col-md-5 align-self-center">
                        <h5><?php echo $cart->device->name ?></h5>
                        <p class="text-danger fs-5 d-block d-md-none">$<?php echo $cart->device->price ?></p>
                        <div class="input-group row my-3">
                            <div class="col-12 d-flex">
                                <button class="btn btn-light btn-sm" type="button" onclick="setItemQuantity(<?php echo $cart->device->id ?>, -1)">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" min="1" max="30" class="form-control text-center" id="inputAmount" name="amount" style="max-width: 30%;" value="<?php echo $cart->quantity ?>">
                                <button class="btn btn-light btn-sm" type="button" onclick="setItemQuantity(<?php echo $cart->device->id ?>, 1)">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col d-none d-md-block col-md-2 align-self-center">
                        <p class="text-danger fs-5 m-0" name="price">$<?php echo $cart->device->price * $cart->quantity ?></p>
                    </div>
                    <div class="col col-2 align-self-center">
                        <button class="btn" id="dropdownMenuButton2" onclick="removeItem(<?php echo $cart->device->id ?>)">
                            <h4 class="text-danger"><i class="fas fa-trash-alt"></i></h4>
                        </button>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="row justify-content-between my-3">
        <div class="col col-3 d-flex justify-content-end align-items-center">
            <p class="m-0">Total:</p>
        </div>
        <div class="col col-3 d-flex justify-content-start align-items-center">
            <h5 class="text-danger fs-4 m-0" id="total">$<?php echo $total ?></h5>
        </div>
        <div class="col col-6 d-grid align-items-center">
            <button class="btn btn-danger" onclick="orderItems()">
                Order Now
            </button>
        </div>
    </div>
</div>
<script>
    let items = <?php echo json_encode($carts) ?>;
    let loading = false;

    function getTotalPrice() {
        let total = 0;
        for (item of items) {
            total += item.quantity * item.device.price;
        }
        return total;
    }

    function setItemQuantity(deviceId, change) {
        if (loading) {
            return;
        }
        loading = true;
        const item = items.find(item => item.device_id === deviceId);
        if (!item) {
            loading = false;
            return;
        }
        if (item.quantity <= 1 && change === -1) {
            loading = false;
            return;
        }
        if (item.quantity >= 30 && change === 1) {
            loading = false;
            return;
        }
        $.post("/cart/add", {
            device_id: deviceId,
            quantity: change,
        }).done((data, textStatus, xhr) => {
            const f = items.find(item => item.id === data.cart.id);
            const oldQuantity = f.quantity;
            f.quantity = data.cart.quantity;
            $("#" + f.id).find("[name='amount']").val(f.quantity);
            $("#" + f.id).find("[name='price']").text("$" + (f.quantity * f.device.price));
            $("#total").text("$" + getTotalPrice());
        }).fail((xhr) => {
            showGlobalDangerToast(xhr.responseJSON.message);
        }).always(() => {
            loading = false;
        });
    }

    function removeItem(deviceId) {
        if (loading) {
            return;
        }
        loading = true;
        const item = items.find(item => item.device_id === deviceId);
        if (!item) {
            loading = false;
            return;
        }
        $.post("/cart/remove", {
            device_id: deviceId,
        }).done((data, textStatus, xhr) => {
            const f = items.indexOf(it => it.id === item.id);
            $("#" + item.id).remove();
            items.splice(f, 1);
            $("#total").text("$" + getTotalPrice());
            showGlobalSuccessToast("Item removed successfully");
        }).fail((xhr) => {
            showGlobalDangerToast(xhr.responseJSON.message);
        }).always(() => {
            loading = false;
        });
    }

    function orderItems() {
        if (loading) {
            return;
        }
        loading = true;
        $.post("/order/add", {
            
        }).done((data, textStatus, xhr) => {
            for (item of items) {
                $("#" + item.id).remove();
            }
            items = [];
            $("#total").text("$" + 0);
            showGlobalSuccessToast("Order items successfully");
            console.log(data);
        }).fail((xhr) => {
            showGlobalDangerToast(xhr.responseJSON.message);
        }).always(() => {
            loading = false;
        });
    }
</script>