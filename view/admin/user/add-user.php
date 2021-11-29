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
                    <a class="nav-link active" aria-current="page" href="/admin/users"><i class="fas fa-user me-2"></i> Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/order"><i class="fas fa-shopping-bag me-2"></i> Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/news"><i class="fas fa-newspaper me-2"></i> News</a>
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
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle-fill"></i> ' . 'Account Added Successfully' . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-circle-fill"></i> ' . $message . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
            } ?>
            <h4 class="text-center mt-3 mb-5"><i class="fas fa-plus"></i> Add User</h4>
            <form class="needs-validation" method="post" action="/admin/user/add" novalidate oninput='confirm_password.setCustomValidity(password.value != confirm_password.value ? "Passwords must match" : "")'>
                <div class="form-floating mb-3 has-validation">
                    <input type="text" class="form-control" id="usernameInput" name="username" placeholder="name@example.com" pattern="[a-zA-Z0-9-_.]{6,}" required aria-describedby="usernameHelpBlock">
                    <label for="usernameInput">Username <span class="text-danger">(*)</span></label>
                    <div class="invalid-feedback">
                        Invalid username
                    </div>
                    <div id="usernameHelpBlock" class="form-text">
                        Username must be 6-20 characters long, contain letters and numbers, and must not contain spaces or special characters.
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Enter your password" pattern="[a-zA-Z0-9-_.]{6,}" required aria-describedby="passwordHelpBlock">
                    <label for="passwordInput">Password <span class="text-danger">(*)</span></label>
                    <div class="invalid-feedback">
                        Invalid password
                    </div>
                    <div id="passwordHelpBlock" class="form-text">
                        Password must be 6-20 characters long, contain letters and numbers, and must not contain spaces or special characters.
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="confirmPasswordInput" name="confirm_password" placeholder="Confirm your password" pattern="[a-zA-Z0-9-_.]{6,}" required aria-describedby="confirmPasswordHelpBlock">
                    <label for="confirmPasswordInput">Confirm Password <span class="text-danger">(*)</span></label>
                    <div class="invalid-feedback">
                        Passwords must match
                    </div>
                    <div id="confirmPasswordHelpBlock" class="form-text">
                        Please re-enter your password.
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nameInput" name="name" placeholder="Enter your full name" pattern="[a-zA-Z ]{1,}" aria-describedby="nameHelpBlock">
                    <label for="nameInput">Full Name</label>
                    <div class="invalid-feedback">
                        Invalid name
                    </div>
                    <div id="nameHelpBlock" class="form-text">
                        Full name should contains only characters.
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="phoneInput" name="phone" placeholder="Enter your phone number" pattern="^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$" aria-describedby="phoneHelpBlock">
                    <label for="phoneInput">Phone Number</label>
                    <div class="invalid-feedback">
                        Invalid phone numbers. Example of valid phone numbers are 123-456-7890, (123) 456-7890, +91 (123) 456-7890, etc.
                    </div>
                    <div id="phoneHelpBlock" class="form-text">
                        User phone number.
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="addressInput" name="address" placeholder="Enter your address" aria-describedby="addressHelpBlock">
                    <label for="addressInput">Address</label>
                    <div class="invalid-feedback">
                        Address should contains only characters, numbers, "-", "_" and ".".
                    </div>
                    <div id="addressHelpBlock" class="form-text">
                        User address
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="dateInput" name="date_of_birth" placeholder="Enter your date of birth" aria-describedby="dateHelpBlock" onkeydown="return false" onclick="return false">
                    <label for="dateInput">Date Of Birth</label>
                    <div id="dateHelpBlock" class="form-text">
                        User date of birth.
                    </div>
                </div>
                <p class="text-muted fs-6"><span class="text-danger">(*)</span> Required field</p>
                <div class="d-grid mt-5">
                    <button class="btn btn-warning" type="submit">
                        Add User
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
</script>