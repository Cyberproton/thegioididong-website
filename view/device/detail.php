<div class="container-md">
    <div class="row mb-5 py-5 shadow">
        <?php if (!isset($device) || $device->is_deleted) { ?>
            <div class="container my-5 text-center" style="min-height: 500px;">
                <h1><i class="fas fa-exclamation-triangle"></i></h1>
                <h1 class="mb-5">This product does not exist</h1>
                <p>Something wrong has happened.</p>
                <p>Please contact your admin for more information.</p>
            </div>
        <?php
            return;
        } ?>
        <div class="col col-12 col-md-6">
            <?php if (isset($device->image_url) && strlen($device->image_url) > 0) { ?>
                <img src="<?php echo $device->image_url ?>" style="object-fit: contain; width: 100%; height: 300px" />
            <?php } ?>
        </div>
        <div class="col col-12 col-md-6">
            <h4 class="text-center"><?php echo $device->name ?></h4>
            <hr />
            <h5>Price: </h5>
            <h3 class="text-danger">$<?php echo $device->price ?></h3>
            <div class="row my-3">
                <div class="col col-4">
                    <p class="m-0">Rating</p>
                </div>
                <div class="col col-8 d-flex align-items-center" id="ratingStars">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>
            <div class="input-group row mb-3">
                <label for="inputAmount" class="col-4 col-form-label">Select amount</label>
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
                <button class="btn btn-warning mt-3" id="addToCartButton">
                    <div class="d-flex align-items-center justify-content-center">
                        <div id="loadingSpinner" class="spinner-border text-dark me-2" role="status">
                        </div>
                        Order Now
                    </div>
                </button>
            </div>
        </div>
    </div>
    <div class="row p-3 mb-5 shadow-sm">
        <div class="col col-12 col-md-6">
            <h5>Description: </h5>
            <p><?php echo $device->description ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col col-md-8 border px-3">
            <h5 class="mb-3 py-3">Reviews</h5>
            <div id="reviewContainer">

            </div>
            <div class="d-grid col-6 mx-auto my-3">
                <button class="btn btn-dark" id="writeReviewBtn">Write a review</button>
            </div>
        </div>
    </div>
    <!--
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
    -->
</div>
<script>
    const deviceId = <?php echo $device->id ?>;
    const reviews = <?php echo json_encode($ratings) ?>;
    const isLoggedIn = <?php echo $is_logged_in ? "true" : "false"; ?>;
    const hasOrdered = <?php echo $has_ordered ? "true" : "false"; ?>;
    const user_id = <?php echo $_SESSION["user_id"] ?? "null" ?>;
    let addingToCart = false;
    let isRating = false;

    console.log(reviews);
    console.log(isLoggedIn);
    console.log(hasOrdered);

    $("#addToCartButton").click(() => {
        addToCart();
    });

    $("#writeReviewBtn").click(() => {
        if (!isLoggedIn) {
            showGlobalDangerToast("You need to login to perform this action");
            return;
        }
        if (!hasOrdered) {
            showGlobalDangerToast("You haven't order this product yet!");
            return;
        }
        openReviewModal();
    });

    hideSpinner();
    updateReviews();
    updateRatingStars();

    function showSpinner() {
        $("#loadingSpinner").show();
    }

    function hideSpinner() {
        $("#loadingSpinner").hide();
    }

    function changeAmount(am) {
        const amount = $("#inputAmount");
        const next = parseInt(amount.val()) + am;
        if (next <= 0 || next >= 31) {
            return;
        }
        amount.val(next);
    }

    const addToCart = () => {
        if (addingToCart) {
            return;
        }
        const amount = $("#inputAmount").val();
        addingToCart = true;
        showSpinner();
        $.post("/cart/add", {
            device_id: deviceId,
            quantity: amount,
        }).done((data, textStatus, xhr) => {
            showGlobalSuccessToast("Add to cart successfully");
            console.log(data);
        }).fail((xhr) => {
            showGlobalDangerToast(xhr.responseJSON.message);
        }).always(() => {
            addingToCart = false;
            hideSpinner();
        });
    };

    function getReviewElement(review) {
        const starElems = [];
        for (let i = 1; i <= 5; i++) {
            if (i <= review.value) {
                starElems.push(`
                        <i class="fas fa-star text-warning"></i>
                    `);
            } else {
                starElems.push(`
                        <i class="fas fa-star"></i>
                    `);
            }
        }
        return (`
            <div class="row" id=${review.id}>
                <p class="fw-bold mb-0">${review.user.username}</p>
                <div class="d-flex align-items-center my-2">
                    ${starElems.join(" ")}
                </div>
                <p>${review.content}</p>
            </div>
        `);
    }

    function updateReviews() {
        const container = $("#reviewContainer");
        const reviewElems = [];
        for (const review of reviews) {
            const starElems = [];
            for (let i = 1; i <= 5; i++) {
                if (i <= review.value) {
                    starElems.push(`
                        <i class="fas fa-star text-warning"></i>
                    `);
                } else {
                    starElems.push(`
                        <i class="fas fa-star"></i>
                    `);
                }
            }
            reviewElems.push(`
                <div class="row" id=${review.id}>
                    <p class="fw-bold mb-0">${review.user.username}</p>
                    <div class="d-flex align-items-center my-2">
                        ${starElems.join(" ")}
                    </div>
                    <p>${review.content}</p>
                </div>
            `)
        }
        container.empty().append(reviewElems);
    }

    function updateRatingStars() {
        let total = 0;
        for (const review of reviews) {
            total += review.value;
        }
        total = total / reviews.length;
        const starElems = [];
        for (let i = 1; i <= 5; i++) {
            if (i <= total) {
                starElems.push(`
                    <i class="fas fa-star text-warning"></i>
                `);
            } else {
                starElems.push(`
                    <i class="fas fa-star"></i>
                `);
            }
        }
        $("#ratingStars").empty().append(starElems.join(" "));
    }

    function openReviewModal() {
        const myReview = reviews.find(review => review.user_id === user_id);
        let star = null;
        if (myReview) {
            star = myReview.value;
        }
        showGlobalModal("Write a Review", `
            <div class="d-flex align-items-center my-2">
                <p class="m-0 me-2">Rating: </p>
                <div class="rate">
                    <input type="radio" id="star5" name="rate" value="5" ${!star || star === 5 ? "checked" : ""} />
                    <label for="star5" title="text">5 stars</label>
                    <input type="radio" id="star4" name="rate" value="4" ${star === 4 ? "checked" : ""} />
                    <label for="star4" title="text">4 stars</label>
                    <input type="radio" id="star3" name="rate" value="3" ${star === 3 ? "checked" : ""} />
                    <label for="star3" title="text">3 stars</label>
                    <input type="radio" id="star2" name="rate" value="2" ${star === 2 ? "checked" : ""} />
                    <label for="star2" title="text">2 stars</label>
                    <input type="radio" id="star1" name="rate" value="1" ${star === 1 ? "checked" : ""} />
                    <label for="star1" title="text">1 star</label>
                </div>
            </div>
            <p>Let others know how you feel about this product.</p>
            <div class="form-floating">
                <textarea id="reviewTextarea" class="form-control" placeholder="Leave a comment here" style="height: 200px;"></textarea>
                <label for="reviewTextarea">Review</label>
            </div>
        `, `
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-warning" data-bs-dismiss="modal" onclick="rate()">Save</button>
        `, "warning");
    }

    function rate() {
        if (isRating) {
            return;
        }
        isRating = true;
        const star = $("[name='rate']:checked").val();
        let review = $("#reviewTextarea").val();
        if (!review) review = "";
        $.post("/rating/add", {
            device_id: deviceId,
            value: star,
            content: review,
        }).done((data, textStatus, xhr) => {
            showGlobalSuccessToast("Rate device successfully");
            const rating = data.rating;
            const container = $("#reviewContainer");
            console.log(data);
            const i = reviews.findIndex(review => review.id == rating.id);
            if (i < 0) {
                reviews.unshift(rating);
            } else {
                reviews[i] = rating;
            }
            container.find(`[id=${rating.id}]`).remove();
            container.prepend(getReviewElement(rating));
            updateRatingStars();
        }).fail((xhr) => {
            console.log(xhr.responseText);
            showGlobalDangerToast(xhr.responseJSON.message);
        }).always(() => {
            isRating = false;
        });
    }
</script>