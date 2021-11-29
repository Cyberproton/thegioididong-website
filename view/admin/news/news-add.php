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
                    <a class="nav-link" href="/admin/devices"><i class="fas fa-mobile-alt me-2"></i> Devices</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/admin/users"><i class="fas fa-user me-2"></i> Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/order"><i class="fas fa-shopping-bag me-2"></i> Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/admin/news"><i class="fas fa-newspaper me-2"></i> News</a>
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
        <div class="col col-12 col-md-9 col-lg-8 mt-3 mb-5 mx-auto">
            <?php if (isset($successful)) {
                if ($successful === true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle-fill"></i> ' . 'News Added Successfully' . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-circle-fill"></i> ' . $message . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
            } ?>
            <h4 class="text-center mt-3 mb-5"><i class="fas fa-plus"></i> Add News</h4>
            <form class="needs-validation" method="post" action="/admin/news/add" novalidate>
                <div class="form-floating mb-3 has-validation">
                    <input type="text" class="form-control" id="titleInput" name="title" placeholder="name@example.com" pattern="[a-zA-Z0-9-_. ]{6,}" required aria-describedby="titleHelpBlock">
                    <label for="titleInput">Title <span class="text-danger">(*)</span></label>
                    <div class="invalid-feedback">
                        Invalid title
                    </div>
                    <div id="titleHelpBlock" class="form-text">
                        Title must be min 6 characters long, contain letters and numbers, and must not contain special characters.
                    </div>
                </div>
                <div class="form-floating mb-3 has-validation">
                    <input type="text" class="form-control" id="classificationInput" name="classification" placeholder="name@example.com" pattern="[a-zA-Z0-9-_. ]{3,}" required aria-describedby="classificationHelpBlock">
                    <label for="classificationInput">Classification <span class="text-danger">(*)</span></label>
                    <div class="invalid-feedback">
                        Invalid classification
                    </div>
                    <div id="classificationHelpBlock" class="form-text">
                        Classification must be min 3 characters long, contain letters and numbers, and must not contain special characters.
                    </div>
                </div>
                <div class="row">
                    <div class="col col-8 col-md-10">
                        <div class="form-floating mb-3 has-validation">
                            <input type="text" class="form-control" id="imageUrlInput" name="image_url" placeholder="News image" aria-describedby="imageHelpBlock">
                            <label for="imageUrlInput">Image URL</label>
                            <div class="invalid-feedback">
                                Invalid URL
                            </div>
                            <div id="imageHelpBlock" class="form-text">
                                Image to display before content.
                            </div>
                        </div>
                    </div>
                    <div class="col col-4 col-md-2">
                        <button class="btn btn-primary" type="button" id="imagePreviewBtn">Preview</button>
                    </div>
                </div>
                <div class="form-floating mb-3 has-validation">
                    <textarea name="content" class="form-control" placeholder="The news content" id="contentInput" aria-describedby="contentHelpBlock" style="height: 500px;" required></textarea>
                    <label for="contentInput">Content <span class="text-danger">(*)</span></label>
                    <div class="invalid-feedback">
                        Invalid content
                    </div>
                    <div id="contentHelpBlock" class="form-text">
                        The news content.
                    </div>
                </div>
                <p class="text-muted fs-6"><span class="text-danger">(*)</span> Required field</p>
                <div class="d-grid mt-5">
                    <button class="btn btn-warning" type="submit">
                        Add News
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#dateInput').datepicker({
        format: "dd/mm/yyyy",
        todayBtn: "linked",
        orientation: "bottom auto",
        toggleActive: true,
    });

    $("#imagePreviewBtn").click(() => showImagePreviewModal());

    function showImagePreviewModal() {
        const imageUrl = $("#imageUrlInput").val();
        showImagePreview(imageUrl);
    }
</script>