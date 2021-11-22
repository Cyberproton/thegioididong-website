<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="/public/css/all.css" rel="stylesheet">
  <link href="/public/css/main.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" defer></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous" defer></script>

  <title><?php if ($title) echo $title;
          else echo "thegioididong" ?></title>
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
      <img src=<?php echo "/public/img/thegioididong-logo-dark.png" ?> alt="Logo" class="logo d-none d-sm-block me-2">
      <a href="/" class="logo-only d-block d-sm-none">
        <img src=<?php echo "/public/img/thegioididong-logo-only.png" ?> alt="Logo" style="width: 100%;">
      </a>
      <form class="d-flex d-md-none" method="get" action="/product" style="width: 40%">
        <input name="key" class="form-control" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
      </form>
      <a class="d-block d-md-none btn btn-warning mx-1" href="/cart">
        <h5 class="m-0">
          <i class="fas fa-shopping-cart text-dark"></i>
        </h5>
      </a>
      <a href="/user" class="d-block d-md-none">
        <h5 class="d-block d-md-none m-0"><i class="fas fa-user text-white"></i></h5>
      </a>
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
      <a class="d-flex d-none d-md-block ms-3" href="/user" style="text-decoration: none;">
        <h5 class="m-0 text-white">
          <span>Me</span>
          <i class="fas fa-user text-white ms-2"></i>
        </h5>
      </a>
    </div>
  </nav>
  {{content}}
  <div class="container-fluid text-center bg-dark text-light p-5 mt-5">
    <div class="row justify-content-center">
      <p>A website based on thegioididong for web programming assignment.</p>
      <p>Copyright L01</p>
      <hr />
      <p>Follow Us</p>
      <div class="col-1">
        <h3 class="m-0"><i class="bi bi-facebook"></i></h3>
      </div>
      <div class="col-1">
        <h3 class="m-0"><i class="bi bi-youtube"></i></h3>
      </div>
    </div>
  </div>
  <script src="/public/js/all.js"></script>
  <script src="/public/js/main.js"></script>
</body>

</html>