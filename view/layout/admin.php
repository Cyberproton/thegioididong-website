<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css" integrity="sha512-rxThY3LYIfYsVCWPCW9dB0k+e3RZB39f23ylUYTEuZMDrN/vRqLdaCBo/FbvVT6uC2r0ObfPzotsfKF9Qc5W5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="/public/css/all.css" rel="stylesheet">
  <link href="/public/css/admin.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/gif/png" href="/public/img/thegioididong-logo-only-16x16.png" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="/public/js/before.js"></script>
  <title><?php if (isset($title)) echo $title;
          else echo "TheGioiDiDong Admin Board"; ?></title>
</head>

<body">
  <nav class="navbar navbar-light bg-light border-bottom border-dark border-2">
    <div class="container">
      <a href="/admin" class="logo d-none d-sm-block">
        <img src=<?php echo "/public/img/thegioididong-logo.png" ?> alt="Logo" style="width: 100%;">
      </a>
      <a href="/admin" class="logo-only d-block d-sm-none">
        <img src=<?php echo "/public/img/thegioididong-logo-only.png" ?> alt="Logo" style="width: 100%;">
      </a>
      <a class="navbar-brand m-0">Admin Board</a>
      <button class="navbar-toggler d-block d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarLinks" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>
  <?php if (isset($_SESSION["admin_id"])) { ?>
    <nav class="navbar navbar-light bg-light d-block d-md-none border-bottom border-dark border-1">
      <div class="container-fluid" style="min-height: 50px;">
        <a class="ms-2" href="/admin/devices">
          <h5 class="m-0">
            <i class="fas fa-mobile-alt"></i>
          </h5>
        </a>
        <a href="/admin/users" style="text-decoration: none;">
          <h5 class="m-0">
            <i class="fas fa-user"></i>
          </h5>
        </a>
        <a href="/admin/order" style="text-decoration: none;">
          <h5 class="m-0">
            <i class="fas fa-shopping-bag"></i>
          </h5>
        </a>
        <a href="/admin/news" style="text-decoration: none;">
          <h5 class="m-0">
            <i class="fas fa-newspaper"></i>
          </h5>
        </a>
        <a href="/admin/user?id=<?php echo $_SESSION["admin_id"] ?>" style="text-decoration: none;">
          <h5 class="m-0">
            <i class="fas fa-id-card"></i>
          </h5>
        </a>
        <a class="me-2" href="/order" style="text-decoration: none;">
          <form action="/admin/logout" method="post">
            <button class="btn nav-link">
              <h5 class="m-0">
                <i class="fas fa-sign-in-alt text-danger"></i>
              </h5>
            </button>
          </form>
        </a>
      </div>
    </nav>
  <?php } ?>
  <div class="modal fade" id="globalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
  {{content}}
  <div class="container-fluid text-center bg-light p-5 border-top border-dark border-2">
    <div class="row justify-content-center">
      <div class="col col-12 col-md-6">
        <div class="row">
          <p>A website based on thegioididong for web programming assignment.</p>
          <p>Copyright Group L09</p>
          <hr />
          <ul style="list-style-type:none;">
            <li>Trần Hoàng Quân - 1813715</li>
            <li>Nguyễn Quang Minh - 1813088</li>
            <li>Lê Nhật Tiến - 1912196</li>
            <li>Trần Trung Quý - 1914896</li>
          </ul>
        </div>
      </div>
      <hr class="d-md-none" />
      <div class="col col-12 col-md-6">
        <div class="row justify-content-center">
          <p>Follow Us</p>
          <div class="col-2 col-md-1">
            <h3 class="m-0"><i class="bi bi-facebook"></i></h3>
          </div>
          <div class="col-2 col-md-1">
            <h3 class="m-0"><i class="bi bi-youtube"></i></h3>
          </div>
          <div class="col-2 col-md-1">
            <h3 class="m-0"><i class="bi bi-instagram"></i></h3>
          </div>
        </div>
      </div>
    </div>
    <script src="/public/js/all.js"></script>
    <script src="/public/js/admin.js"></script>
    </body>

</html>