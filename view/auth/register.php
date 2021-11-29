<div class="container-md p-3">
    <div class="row">
        <div class="col col-1 col-md-3"></div>
        <div class="col col-10 col-md-6 p-3 shadow">
            <?php if (isset($is_register_successful)) {
                if ($is_register_successful === true) {
                    echo '<div class="alert alert-success" role="alert"><i class="bi bi-check-circle-fill"></i> Account Register Successfully</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert"><i class="bi bi-exclamation-circle-fill"></i> ' . $message . '</div>';
                }
            } ?>
            <h4 class="text-center mt-3 mb-5">Register</h4>
            <form class="needs-validation" method="post" action="/register" novalidate oninput='confirm_password.setCustomValidity(password.value != confirm_password.value ? "Passwords must match" : "")'>
                <div class="form-floating mb-3 has-validation">
                    <input type="text" class="form-control" id="usernameInput" name="username" placeholder="name@example.com" pattern="[a-zA-Z0-9-_.]{6,}" required aria-describedby="usernameHelpBlock">
                    <label for="usernameInput">Username <span class="text-danger">(*)</span></label>
                    <div class="invalid-feedback">
                        Invalid username
                    </div>
                    <div id="usernameHelpBlock" class="form-text">
                        Your username must be 6-20 characters long, contain letters and numbers, and must not contain spaces or special characters.
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Enter your password" pattern="[a-zA-Z0-9-_.]{6,}" required aria-describedby="passwordHelpBlock">
                    <label for="passwordInput">Password <span class="text-danger">(*)</span></label>
                    <div class="invalid-feedback">
                        Invalid password
                    </div>
                    <div id="passwordHelpBlock" class="form-text">
                        Your username must be 6-20 characters long, contain letters and numbers, and must not contain spaces or special characters.
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
                        Your full name. Should contains only characters.
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="phoneInput" name="phone" placeholder="Enter your phone number" pattern="^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$" aria-describedby="phoneHelpBlock">
                    <label for="phoneInput">Phone Number</label>
                    <div class="invalid-feedback">
                        Invalid phone numbers. Example of valid phone numbers are 123-456-7890, (123) 456-7890, +91 (123) 456-7890, etc.
                    </div>
                    <div id="phoneHelpBlock" class="form-text">
                        Your phone number.
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="addressInput" name="address" placeholder="Enter your address" aria-describedby="addressHelpBlock">
                    <label for="addressInput">Address</label>
                    <div class="invalid-feedback">
                        Address should contains only characters, numbers, "-", "_" and ".".
                    </div>
                    <div id="addressHelpBlock" class="form-text">
                        We will use this to deliver your purchased products.
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="dateInput" name="date_of_birth" placeholder="Enter your date of birth" aria-describedby="dateHelpBlock" onkeydown="return false" onclick="return false">
                    <label for="dateInput">Date Of Birth</label>
                    <div id="dateHelpBlock" class="form-text">
                        Your date of birth.
                    </div>
                </div>
                <p class="text-muted fs-6"><span class="text-danger">(*)</span> Required field</p>
                <div class="d-grid mt-5">
                    <button class="btn btn-warning" type="submit">
                        Register
                    </button>
                </div>
                <div class="divider my-3 text-secondary">Or</div>
                <div class="d-grid">
                    <a class="btn btn-outline-secondary" href="/login">
                        Login
                    </a>
                </div>
            </form>
        </div>
        <div class="col col-1 col-md-3"></div>
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