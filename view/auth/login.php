<div class="container-md p-3">
    <div class="row">
        <div class="col col-1 col-md-3"></div>
        <div class="col col-10 col-md-6 p-3 shadow">
            <?php if (isset($is_login_successful)) {
                if ($is_login_successful === true) {
                    echo '<div class="alert alert-success" role="alert"><i class="bi bi-check-circle-fill"></i> Logged in Successfully</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert"><i class="bi bi-exclamation-circle-fill"></i> ' . $message . '</div>';
                }
            } ?>
            <h4 class="text-center mt-3 mb-5">Login</h4>
            <form class="needs-validation" method="post" action="/login" novalidate>
                <div class="form-floating mb-3 has-validation">
                    <input type="text" class="form-control" id="usernameInput" name="username" placeholder="name@example.com" pattern="[a-zA-Z0-9-_.]{6,}" required>
                    <label for="usernameInput">Username</label>
                    <div class="invalid-feedback">
                        Please enter username
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Enter your password" pattern="[a-zA-Z0-9-_.]{6,}" required>
                    <label for="passwordInput">Password</label>
                    <div class="invalid-feedback">
                        Please enter password
                    </div>
                </div>
                <div class="d-grid mt-5">
                    <button class="btn btn-warning" type="submit">
                        Login
                    </button>
                </div>
                <div class="divider my-3 text-secondary">Or</div>
                <div class="d-grid">
                    <a class="btn btn-outline-secondary" href="/register">
                        Register
                    </a>
                </div>
            </form>
        </div>
        <div class="col col-1 col-md-3"></div>
    </div>
</div> 