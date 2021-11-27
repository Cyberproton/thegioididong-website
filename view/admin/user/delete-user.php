<div class="container-fluid">
    <div class="row">
        <div class="col col-md-3 col-lg-2 d-none d-md-block p-3 shadow flex-shrink-0 sidebar">
            <div class="row justify-content-center">
                <span class="text-center fs-5">Menu</span>
            </div>
            <hr />
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="/admin/devices"><i class="fas fa-mobile-alt me-2"></i> Devices</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/admin/users"><i class="fas fa-user me-2"></i> Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/order"><i class="fas fa-shopping-bag me-2"></i> Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/news"><i class="fas fa-newspaper me-2"></i> News</a>
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
            <div class="d-flex">
                <a class="btn btn-primary" href="/admin/users">Go to User Manager</a>
            </div>
        </div>
    </div>
</div>