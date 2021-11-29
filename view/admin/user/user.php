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
        <div class="col col-12 col-md-9 col-lg-10 my-4">
            <?php if (!isset($user) || $user->is_deleted) { ?>
                <div class="container my-5 text-center" style="min-height: 500px;">
                    <h1><i class="fas fa-exclamation-triangle"></i></h1>
                    <h1 class="mb-5">This user does not exist</h1>
                    <p>Something wrong has happened.</p>
                    <p>Please contact your admin for more information.</p>
                </div>
        </div>
            <?php
                return;
            } ?>
            <?php if (isset($successful)) {
                if ($successful === true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle-fill"></i> ' . $message . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-circle-fill"></i> ' . $message . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
            } ?>
            <div class="row">
                <div class="col col-12 col-md-4">
                    <h4 class="text-center"><?php echo !$user->name || empty($user->name) ? $user->username : $user->name ?></h4>
                    <h1 class="text-center text-primary" style="font-size: 100px;"><i class="fas fa-user-circle"></i></h1>
                </div>
                <div class="col col-12 col-md-8">
                    <h5>Profile</h5>
                    <form class="needs-validation" method="post" action="/admin/user?id=<?php echo $user->id ?>" novalidate oninput='confirm_password.setCustomValidity(password.value != confirm_password.value ? "Passwords must match" : "")'>
                        <input type="hidden" class="form-control" id="idInput" name="user_id" aria-describedby="nameHelpBlock" value="<?php echo $user->id ?>">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nameInput" name="name" placeholder="Enter your full name" pattern="[a-zA-Z ]{1,}" aria-describedby="nameHelpBlock" value="<?php echo $user->name ?>">
                            <label for="nameInput">Full Name</label>
                            <div class="invalid-feedback">
                                Invalid name
                            </div>
                            <div id="nameHelpBlock" class="form-text">
                                User full name. Should contains only characters.
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="phoneInput" name="phone" placeholder="Enter your phone number" pattern="^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$" aria-describedby="phoneHelpBlock" value="<?php echo $user->phone ?>">
                            <label for="phoneInput">Phone Number</label>
                            <div class="invalid-feedback">
                                Invalid phone numbers. Example of valid phone numbers are 123-456-7890, (123) 456-7890, +91 (123) 456-7890, etc.
                            </div>
                            <div id="phoneHelpBlock" class="form-text">
                                User phone number.
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="addressInput" name="address" placeholder="Enter your address" aria-describedby="addressHelpBlock" value="<?php echo $user->address ?>">
                            <label for="addressInput">Address</label>
                            <div class="invalid-feedback">
                                Address should contains only characters, numbers, "-", "_" and ".".
                            </div>
                            <div id="addressHelpBlock" class="form-text">
                                User address
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="dateInput" name="date_of_birth" placeholder="Enter your date of birth" aria-describedby="dateHelpBlock" onkeydown="return false" onclick="return false" value="<?php $date = strtotime($user->date_of_birth);
                                                                                                                                                                                                                                        $date = date("d/m/Y", $date);
                                                                                                                                                                                                                                        echo $date ?>">
                            <label for="dateInput">Date Of Birth</label>
                            <div id="dateHelpBlock" class="form-text">
                                User date of birth.
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="d-grid col-8">
                                <button class="btn btn-warning" type="submit">
                                    Update
                                </button>
                            </div>
                            <div class="d-grid col-4">
                                <button class="btn btn-outline-secondary" type="button" onclick="resetInputs()">
                                    Reset
                                </button>
                            </div>
                        </div>
                    </form>
                    <hr class="mt-5" />
                    <h5>Change Password</h5>
                    <form class="needs-validation" method="post" action="/admin/user/change-password" novalidate oninput='confirm_password.setCustomValidity(password.value != confirm_password.value ? "Passwords must match" : "")'>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Enter your password" pattern="[a-zA-Z0-9-_.]{6,}" required aria-describedby="passwordHelpBlock">
                            <label for="passwordInput">Password</label>
                            <div class="invalid-feedback">
                                Invalid password
                            </div>
                            <div id="passwordHelpBlock" class="form-text">
                                Password must be 6-20 characters long, contain letters and numbers, and must not contain spaces or special characters.
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="confirmPasswordInput" name="confirm_password" placeholder="Confirm your password" pattern="[a-zA-Z0-9-_.]{6,}" required aria-describedby="confirmPasswordHelpBlock">
                            <label for="confirmPasswordInput">Confirm Password</label>
                            <div class="invalid-feedback">
                                Passwords must match
                            </div>
                            <div id="confirmPasswordHelpBlock" class="form-text">
                                Confirm the password.
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="user_id" value="<?php echo $user->id ?>">
                        <div class="d-grid mt-5">
                            <button class="btn btn-warning" type="submit">
                                Update Password
                            </button>
                        </div>
                    </form>

                    <hr class="mt-5" />
                    <h5>Change Role</h5>
                    <form class="needs-validation" method="post" action="/admin/user/change-role" novalidate>
                        <input type="hidden" class="form-control" name="user_id" value="<?php echo $user->id ?>">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="validationCustom04" name="role" required>
                                <option <?php if ($user->role === "CUSTOMER") echo "selected" ?> value="CUSTOMER">Customer</option>
                                <option <?php if ($user->role === "ADMIN") echo "selected" ?> value="ADMIN">Admin</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid role.
                            </div>
                            <label for="dateInput">Role</label>
                            <div id="dateHelpBlock" class="form-text">
                                User role. Downgrade admin to customer role will revoke permissions to access this site!
                            </div>
                        </div>
                        <div class="d-grid mt-5">
                            <button class="btn btn-warning" type="submit">
                                Update Role
                            </button>
                        </div>
                    </form>

                    <hr class="mt-5" />
                    <h5>Delete User</h5>
                    <form action="/admin/user/delete" method="post" class="mt-3">
                        <input type="hidden" class="form-control" name="user_id" value="<?php echo $user->id ?>">

                    </form>
                    <div class="d-grid mt-3" id="deleteUserButton">
                        <button type="submit" class="btn btn-danger" onclick="showDeleteModal()">Delete User</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    </div>
</div>
<script>
    const user = <?php echo json_encode($user) ?>;
    $('#dateInput').datepicker({
        format: "dd/mm/yyyy",
        todayBtn: "linked",
        orientation: "bottom auto",
        toggleActive: true,
    });

    function resetInputs() {
        $("#nameInput").val(user.name);
        $("#phoneInput").val(user.phone);
        $("#addressInput").val(user.address);
        $("#dateInput").val(`<?php $date = strtotime($user->date_of_birth);
                                $date = date("d/m/Y", $date);
                                echo $date; ?>`);
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
                            <h6>Username: ${user.username}</h6>
                            <p>Full Name: ${user.name ? user.name : "Empty"}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <form action="/admin/user/delete" method="post">
                                <input type="hidden" class="form-control" name="user_id" value="<?php echo $user->id ?>">
                                <button type="submit" class="btn btn-danger">Delete User</button>
                            </form>
                        </div>
                    </div>
                </div>
            `;
        showModal("modal", dialog);
    }
</script>