<div class="container-md mt-3">
    <?php if (strlen($search_key) < 1) { ?>
        <h3 class="mt-4 mb-3">Total <?php echo sizeof($devices) ?> products(s)</h3>
    <?php } else { ?>
        <h3 class="mt-4 mb-3">Search result for: "<?php echo $search_key ?>". Found <?php echo sizeof($devices) ?> products(s)</h3>
    <?php } ?>
    
    <div class="container my-3">
        <ul class="nav nav-pills overflow-auto" style="white-space: nowrap; flex-wrap: nowrap;">
            <span class="d-flex align-items-center me-3 fs-5">Categories: </span>
            <li class="nav-item">
                <button class="nav-link <?php if (!isset($current_category)) echo "active" ?>" aria-current="page" onclick="filterByCategory(<?php echo -1 ?>)" id="category-<?php echo -1 ?>">All</button>
            </li>
            <?php foreach ($categories as $category) { ?>
                <li class="nav-item">
                    <button class="nav-link" aria-current="page" onclick="filterByCategory(<?php echo $category->id ?>)" id="category-<?php echo $category->id ?>"><?php echo $category->name ?></button>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="container my-3">
        <ul class="nav nav-pills overflow-auto" style="white-space: nowrap; flex-wrap: nowrap;">
            <span class="d-flex align-items-center me-3 fs-5">Price: </span>
            <li class="nav-item">
                <button class="nav-link active" aria-current="page" id="price-order-des" onclick="sortByPrice('des')">High First</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" aria-current="page" id="price-order-asc" onclick="sortByPrice('asc')">Low First</button>
            </li>
        </ul>
    </div>
    <hr />
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4" id="deviceContainer">
        <?php foreach ($devices as $device) { ?>
            <div class="col">
                <div class="card h-100">
                    <img src="<?php echo $device->image_url ?>" class="card-img-top" alt="<?php echo $device->name ?>" style="height: 200px; object-fit: contain;">
                    <hr />
                    <div class="card-body">
                        <p class="card-title text-center fs-5"><?php echo $device->name ?></p>
                        <p>
                            <?php
                            if (isset($device->description) && strlen($device->description) > 0) {
                                echo substr($device->description, 0, 50) . "...";
                            } else {
                                echo "No description";
                            }
                            ?>
                        </p>

                    </div>
                    <div class="card-footer">
                        <h5 class="text-center"><?php echo $device->price ?>$</h5>
                        <div class="d-grid">
                            <a class="btn btn-warning stretched-link" href="/device?id=<?php echo $device->id ?>">Order Now</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<script>
    const devices = <?php echo json_encode($devices) ?>;
    const devicesPerPage = {};
    let currentCategory = -1;
    let priceSortMode = "des";

    function filter() {
        const res = devices
            .filter(device => currentCategory < 0 || device.category_id === currentCategory)
            .sort((first, second) => {
                return priceSortMode === "asc" ? first.price - second.price : second.price - first.price;
            })
            .map(device => createDeviceCard(device));
        $("#deviceContainer").empty().append(res).addClass("row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4");
        $('[id^="category"]').removeClass("active");
        $("#category-" + currentCategory).addClass("active");

        $('[id^="price-order"]').removeClass("active");
        $("#price-order-" + priceSortMode).addClass("active");
    }

    function filterByCategory(categoryId) {
        currentCategory = categoryId;
        filter();
    }

    function sortByPrice(order) {
        priceSortMode = order;
        filter();
    }

    function createDeviceCard(device) {
        const img = $("<img></img>")
            .addClass("card-img-top")
            .attr("src", device.image_url)
            .attr("alt", device.name)
            .css("height", "200px")
            .css("object-fit", "contain");
        const hr = $("<hr/>");
        const cardBodyDeviceName = $("<p></p>").addClass("card-title text-center fs-5").text(device.name);
        const cardBodyDescription = $("<p></p>");
        if (device.description && device.description.length > 0) {
            cardBodyDescription.text(device.description.substring(0, 43) + "...");
        } else {
            cardBodyDescription.text("No description");
        }
        const cardBody = $("<div></div>").addClass("card-body").append(cardBodyDeviceName).append(cardBodyDescription);
        const cardFooterPrice = $("<h5></h5>").addClass("text-center").text(device.price + "$");
        const link = $("<a></a>").addClass("btn btn-warning stretched-link").text("Order Now").attr("href", "/device?id=" + device.id);
        const linkContainer = $("<div></div>").addClass("d-grid").append(link);
        const cardFooter = $("<div></div>").addClass("card-footer").append(cardFooterPrice).append(linkContainer);
        const card = $("<div></div>").addClass("card h-100").append([img, hr, cardBody, cardFooter]);
        const col = $("<div></div>").addClass("col").append(card);
        return col;
    }
</script>