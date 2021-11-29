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
        <div class="col col-12 col-md-9 col-lg-10 my-4">
            <?php if (isset($successful)) {
                if ($successful === true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle-fill"></i> ' . $message . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-circle-fill"></i> ' . $message . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
            } ?>
            <?php if (!isset($model)) { ?>
                <div class="container my-5 text-center" style="min-height: 500px;">
                    <h1><i class="fas fa-exclamation-triangle"></i></h1>
                    <h1 class="mb-5">This news does not exist</h1>
                    <p>Something wrong has happened.</p>
                    <p>Please contact your admin for more information.</p>
                </div>
        </div>
    <?php
                return;
            } ?>
    <div class="row">
        <div class="col col-12 col-md-8 mx-auto">
            <h4 class="text-center mt-3">Edit News</h4>
            <form class="needs-validation" method="post" action="/admin/news/edit?id=<?php echo $model->id ?>" novalidate>
                <div class="form-floating mb-3 has-validation">
                    <input type="text" class="form-control" id="titleInput" name="title" placeholder="name@example.com" pattern="*{6,}" required aria-describedby="titleHelpBlock" value="<?php echo $model->title ?>">
                    <label for="titleInput">Title <span class="text-danger">(*)</span></label>
                    <div class="invalid-feedback">
                        Invalid title
                    </div>
                    <div id="titleHelpBlock" class="form-text">
                        Title must be min 6 characters long, contain letters and numbers, and must not contain special characters.
                    </div>
                </div>
                <div class="form-floating mb-3 has-validation">
                    <input type="text" class="form-control" id="classificationInput" name="classification" placeholder="name@example.com" pattern="[a-zA-Z0-9-_. ]{3,}" required aria-describedby="classificationHelpBlock" value="<?php echo $model->classification ?>">
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
                            <input type="text" class="form-control" id="imageUrlInput" name="image_url" placeholder="News image" aria-describedby="imageHelpBlock" value="<?php echo $model->image_url ?>">
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
                    <textarea name="content" class="form-control" placeholder="The news content" id="contentInput" aria-describedby="contentHelpBlock" style="height: 500px;" required><?php echo $model->content ?></textarea>
                    <label for="contentInput">Content <span class="text-danger">(*)</span></label>
                    <div class="invalid-feedback">
                        Invalid content
                    </div>
                    <div id="contentHelpBlock" class="form-text">
                        The news content.
                    </div>
                </div>
                <input type="hidden" class="form-control" id="idInput" name="id" required value="<?php echo $model->id ?>">
                <p class="text-muted fs-6"><span class="text-danger">(*)</span> Required field</p>
                <div class="row mt-5">
                    <div class="col col-12 col-md-8 d-grid my-2">
                        <button class="btn btn-warning" type="submit">
                            Update News
                        </button>
                    </div>
                    <div class="col col-12 col-md-4 d-grid my-2">
                        <button class="btn btn-outline-secondary" type="button" onclick="resetInputs()">
                            Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col col-12 col-md-3 mx-auto">
            <h4 class="mt-3" id="deleteButton">Delete News</h4>
            <div class="d-grid mt-3">
                <button class="btn btn-danger" type="button" onclick="showDeleteModal()">
                    Delete News
                </button>
            </div>
        </div>
    </div>
    </div>
</div>
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
</div>
</div>
<script>
    const model = <?php echo json_encode($model) ?>;

    function resetInputs() {
        $("#titleInput").val(model.title);
        $("#classificationInput").val(model.classification);
        $("#contentInput").val(model.content);
        $("#imageUrlInput").val(model.image_url);
    }

    $("#imagePreviewBtn").click(() => showImagePreviewModal());

    function showImagePreviewModal() {
        const imageUrl = $("#imageUrlInput").val();
        showImagePreview(imageUrl);
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

    function showDeleteModal() {
        const dialog = `
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h6>ID: ${model.id}</h6>
                            <p>Title: ${model.title.length > 100 ? model.title.substring(0, 100) + "..." : model.title}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <form action="/admin/news/delete" method="post">
                                <input type="hidden" class="form-control" name="id" value="<?php echo $model->id ?>">
                                <button type="submit" class="btn btn-danger">Delete User</button>
                            </form>
                        </div>
                    </div>
                </div>
            `;
        showModal("modal", dialog);
    }
</script>