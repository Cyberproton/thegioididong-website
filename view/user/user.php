<div class="container-md mt-3 p-5 shadow">
    <div class="row">
        <div class="col col-12 col-md-4">
            <h4 class="text-center"><?php echo !$user->name || empty($user->name) ? $user->username : $user->name ?></h4>
            <h1 class="text-center text-primary" style="font-size: 100px;"><i class="fas fa-user-circle"></i></h1>
        </div>
        <div class="col col-12 col-md-8">
            <?php if (isset($is_successful)) {
                if ($is_successful === true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle-fill"></i> Your info has been updated<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-circle-fill"></i> ' . $message . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
            } ?>
            <form class="needs-validation" method="post" action="/user" novalidate oninput='confirm_password.setCustomValidity(password.value != confirm_password.value ? "Passwords must match" : "")'>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nameInput" name="name" placeholder="Enter your full name" pattern="[a-zA-Z ]{1,}" aria-describedby="nameHelpBlock" value="<?php echo $user->name ?>">
                    <label for="nameInput">Full Name</label>
                    <div class="invalid-feedback">
                        Invalid name
                    </div>
                    <div id="nameHelpBlock" class="form-text">
                        Your full name. Should contains only characters.
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="phoneInput" name="phone" placeholder="Enter your phone number" pattern="^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$" aria-describedby="phoneHelpBlock" value="<?php echo $user->phone ?>">
                    <label for="phoneInput">Phone Number</label>
                    <div class="invalid-feedback">
                        Invalid phone numbers. Example of valid phone numbers are 123-456-7890, (123) 456-7890, +91 (123) 456-7890, etc.
                    </div>
                    <div id="phoneHelpBlock" class="form-text">
                        Your phone number.
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="addressInput" name="address" placeholder="Enter your address" aria-describedby="addressHelpBlock" value="<?php echo $user->address ?>">
                    <label for="addressInput">Address</label>
                    <div class="invalid-feedback">
                        Address should contains only characters, numbers, "-", "_" and ".".
                    </div>
                    <div id="addressHelpBlock" class="form-text">
                        We will use this to deliver your purchased products.
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="dateInput" name="date_of_birth" placeholder="Enter your date of birth" aria-describedby="dateHelpBlock" onkeydown="return false" onclick="return false" value="<?php $date = strtotime($user->date_of_birth); $date = date("d/m/Y", $date); echo $date ?>">
                    <label for="dateInput">Date Of Birth</label>
                    <div id="dateHelpBlock" class="form-text">
                        Your date of birth.
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
            <hr />
            <form action="/logout" method="post" class="mt-3">
                <div class="d-grid">
                    <button type="submit" class="btn btn-danger">Logout</button>
                </div>

            </form>
        </div>
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
        $("#dateInput").val("<?php $date = strtotime($user->date_of_birth); $date = date("d/m/Y", $date); echo $date ?>");
    }
</script>
