<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css" integrity="sha512-rxThY3LYIfYsVCWPCW9dB0k+e3RZB39f23ylUYTEuZMDrN/vRqLdaCBo/FbvVT6uC2r0ObfPzotsfKF9Qc5W5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="/public/css/all.css" rel="stylesheet">
  <link href="/public/css/main.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/gif/png" href="/public/img/thegioididong-logo-only-16x16.png" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="/public/js/before.js"></script>
  <title><?php if (isset($title)) echo $title;
          else echo "The Gioi Di Dong"; ?></title>
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
      <a href="/" class="logo d-none d-sm-block me-2">
        <img src=<?php echo "/public/img/thegioididong-logo-dark.png" ?> alt="Logo" style="width: 100%;">
      </a>
      <a href="/" class="logo-only d-block d-sm-none">
        <img src=<?php echo "/public/img/thegioididong-logo-only.png" ?> alt="Logo" style="width: 100%;">
      </a>
      <form class="d-flex d-md-none" method="get" action="/product" style="width: 60%">
        <input name="key" class="form-control" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
      </form>
      <button class="navbar-toggler my-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 me-5 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/product">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/news">News</a>
          </li>
        </ul>
        <form class="d-flex me-auto" method="get" action="/product">
          <input name="key" class="form-control me-2 d-none d-md-block" type="search" placeholder="Search a product" aria-label="Search">
          <button class="btn btn-outline-light d-none d-md-block" type="submit"><i class="fas fa-search"></i></button>
        </form>
      </div>
      <a class="d-none d-md-block btn btn-warning mx-2" href="/cart">
        <h5 class="m-0">
          <i class="fas fa-shopping-cart text-dark"></i>
        </h5>
      </a>
      <a class="d-none d-md-block mx-2" href="/order" style="text-decoration: none;">
        <h5 class="m-0 text-white">
          <i class="fas fa-shipping-fast"></i>
        </h5>
      </a>
      <a class="d-flex d-none d-md-block ms-3 me-3" href="/user" style="text-decoration: none;">
        <h5 class="m-0 text-white">
          <i class="fas fa-user text-white ms-2"></i>
        </h5>
      </a>
    </div>
  </nav>
  <nav class="navbar navbar-dark bg-dark d-block d-md-none">
    <div class="container-fluid" style="min-height: 50px;">
      <a class="mx-2" href="/cart">
        <h5 class="m-0 text-white">
          <i class="fas fa-shopping-cart"></i>
        </h5>
      </a>
      <a class="mx-2" href="/order" style="text-decoration: none;">
        <h5 class="m-0 text-white">
          <i class="fas fa-shipping-fast"></i>
        </h5>
      </a>
      <a class="d-flex ms-3 me-3" href="/user" style="text-decoration: none;">
        <h5 class="m-0 text-white">
          <i class="fas fa-user text-white ms-2"></i>
        </h5>
      </a>
    </div>
  </nav>
  <div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3">
    <div id="globalToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <strong class="me-auto" name="header">Alert</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body bg-light">
        <p id="globalToastMessage" name="message">Some message</p>
      </div>
    </div>
    <div id="globalSuccessToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header bg-success text-light">
        <strong id="globalSuccessToastHeader" class="me-auto" name="header">Alert</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body bg-light">
        <p id="globalSuccessToastMessage" name="message">Some message</p>
      </div>
    </div>
    <div id="globalDangerToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header bg-danger text-light">
        <strong id="globalDangerToastHeader" class="me-auto" name="header">Alert</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body bg-light">
        <p id="globalDangerToastMessage" name="message">Some message</p>
      </div>
    </div>
  </div>
  <div class="modal fade" id="globalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  </div>
  {{content}}
  <div class="container-fluid text-center bg-dark text-light p-5 mt-5">
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
  </div>
  <script src="/public/js/all.js"></script>
  <script src="/public/js/main.js"></script>
  <script src="/public/js/after.js"></script>
</body>

</html>