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
            <div class="row justify-content-between">
                <div class="col-8">
                    <h4><i class="fas fa-newspaper me-2"></i> News Manager</h4>
                </div>
                <div class="col-4">
                    <div class="d-flex justify-content-end">
                        <a href="/admin/news/add" class="btn btn-warning btn-sm"><i class="fas fa-plus"></i> Add</a>
                    </div>
                </div>
            </div>
            <ol id="newsList" class="list-group list-group-numbered my-3">

            </ol>
        </div>
    </div>
</div>
<script>
    const news = <?php echo json_encode($news) ?>;

    updateNews();

    function updateNews() {
        const list = $("#newsList");
        const elems = news.map(u => (`
            <li class="list-group-item d-flex align-items-center justify-content-between align-items-start dark-on-hover">
                <div class="ms-2 text-wrap">
                    <div class="fw-bold" data-bs-toggle="tooltip" data-bs-placement="top">${u.title.length > 80 ? u.title.substr(0, 80) + "..." : u.title}</div>
                    <p class="mb-0">Classification: ${u.classification ? u.classification : "?"}</p>
                    <p class="mb-0">Post at: ${u.date}</p>
                </div>
                <div class='ms-auto'>
                    <div class='btn-group' role='group'>
                        <a href='/admin/news/edit?id=${u.id}' class='btn btn-outline-secondary btn-sm'>Chi tiết</a>
                        <a href='/admin/news/edit?id=${u.id}#deleteButton' class='btn btn-danger btn-sm' type='submit'>Xóa</a>
                    </div> 
                </div>
            </li>
        `));
        list.empty().append(elems);
    }
</script>