<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="/public/css/admin.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <title><?php echo $title ?></title>
</head>

<body>
  <nav class="navbar navbar-light bg-light border-bottom border-dark border-3">
    <div class="container">
      <img src=<?php echo "/public/img/thegioididong-logo.png" ?> alt="Logo" class="logo d-none d-sm-block">
      <img src=<?php echo "/public/img/thegioididong-logo-only.png" ?> alt="Logo" class="logo-only d-block d-sm-none">
      <a class="navbar-brand m-0">Admin Board</a>
      <button class="navbar-toggler d-block d-sm-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarLinks" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarLinks">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active fw-bold" href="/admin/devices">Devices</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">News</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  {{content}}
  <div class="container-fluid text-center bg-dark text-light p-5 mt-5">
    <div class="row justify-content-center">
      <p>A website based on thegioididong for web programming assignment.</p>
      <p>Copyright L01</p>
      <hr/>
      <p>Follow Us</p>
      <div class="col-1">
        <h3><i class="bi bi-facebook"></i></h3>
      </div>
      <div class="col-1">
        <h3>
          <h3><i class="bi bi-youtube"></i></h3>
        </h3>
      </div>
    </div>
  </div>
  <script src="/public/js/all.js"></script>
  <script src="/public/js/admin.js"></script>
</body>

</html>