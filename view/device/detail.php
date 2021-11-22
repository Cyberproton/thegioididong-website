<div class="container-md">
    <div class="row mb-5 py-5 shadow">
        <div class="col col-12 col-md-6">
            <img src="<?php echo $device->image_url ?>" style="object-fit: contain; width: 100%; height: 300px" />
        </div>
        <div class="col col-12 col-md-6">
            <h3 class="text-center"><?php echo $device->name ?></h3>
            <hr />
            <h4>Price: </h4>
            <h2 class="text-danger">$<?php echo $device->price ?></h2>
            <div class="row my-3">
                <div class="col col-4">
                    <p class="m-0 fs-5">Rating</p>
                </div>
                <div class="col col-8 d-flex align-items-center">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>
            <div class="input-group row mb-3">
                <label for="inputAmount" class="col-4 col-form-label fs-5">Select amount</label>
                <div class="col-8 d-flex">
                    <button class="btn btn-light btn-sm" type="button" onclick="changeAmount(-1)">
                        <i class="fas fa-minus"></i>
                    </button>
                    <input type="number" min="1" max="30" class="form-control text-center" id="inputAmount" style="width: 30%;" value="1">
                    <button class="btn btn-light btn-sm" type="button" onclick="changeAmount(1)">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="d-grid">
                <button class="btn btn-warning btn-lg">Order Now</button>
            </div>
        </div>
    </div>
    <div class="row p-3 mb-5 shadow-sm">
        <div class="col col-12 col-md-6">
            <h5>Description: </h5>
            <p class="fs-5"><?php echo $device->description ?></p>
        </div>
        <div class="col col-12 col-md-6">
            <h5>Specifications: </h5>
            <p class="fs-5"><?php echo $device->description ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col col-md-8 border px-3">
            <h4 class="mb-3 py-3">Reviews</h4>
            <div class="row">
                <h5 class="">Tôi: </h5>
                <div class="d-flex align-items-center my-2">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="fs-5">Rất tốt</p>
            </div>
            <hr />
            <div class="row">
                <h5 class="">Ai Đó: </h5>
                <div class="d-flex align-items-center my-2">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="fs-5">Tệ </p>
            </div>
            <div class="d-grid col-6 mx-auto my-3">
                <button class="btn btn-dark btn-lg">Write a review</button>
            </div>
        </div>
    </div>
    <div class="row my-3">
        <div class="col col-md-8 border px-3 my-3">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="py-3">Comments</h4>
                <button class="btn btn-primary">Submit comment</button>
            </div>
            <textarea id="commentInput" class="form-control mb-3" aria-label="With textarea" placeholder="Leave a comment" style="height: 150px;"></textarea>
            <h4 class="mb-3 py-3 text-secondary">See what others say</h4>
            <div class="row">
                <h5 class="">Tôi: </h5>
                <p class="fs-5">Rất tốt</p>
            </div>
            <hr />
            <div class="row">
                <h5 class="">Ai Đó: </h5>
                <p class="fs-5">Tệ </p>
            </div>
            <div class="d-grid col-8 col-md-6 mx-auto my-3">
                <a class="btn btn-dark btn-lg" href="#commentInput">Leave a comment</a>
            </div>
        </div>
    </div>
</div>
<script>
    function changeAmount(am) {
        const amount = $("#inputAmount");
        const next = parseInt(amount.val()) + am;
        if (next <= 0 || next >= 31) {
            return;
        }
        amount.val(next);
    }
</script>