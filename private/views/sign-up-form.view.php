<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="<?= ASSETS ?>/css/style.css?verision=11222">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

    <script defer src="<?= ASSETS ?>/js/validation_registration.js"></script>
</head>

<body id="sign_up_form_body">

    <div class="form_for_refistration">
        <img src="<?= ASSETS ?>/images/icons8-user-100.png">
        <h1>Sign Up Now</h1>
        <form method="POST">
            <div class="form-control">
                <input type="text" id="name" name="name" class="input-registration" placeholder="Your name">

                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i><small>Error message</small>
            </div>
            <div class="form-control">

                <input type="text" name="surname" id="surname" class="input-registration" placeholder="Your surname">
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i><small>Error message</small>
            </div>
            <div class="form-control">
                <input type="email" name="email" id="email" class="input-registration" placeholder="Your email">
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i><small>Error message</small>
            </div>
            <div class="form-control">
                <textarea name="address" rows="3" id="address" class="input-registration" placeholder="Enter your address"></textarea>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i><small>Error message</small>
            </div>
            <div class="form-control">
                <input type="password" name="password" id="password" class="input-registration" placeholder="Your password">
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i><small>Error message</small>
            </div>
            <div class="form-control">
                <input type="password" id="confirmPassword" class="input-registration" placeholder="Confirm password">
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i><small>Error message</small>
            </div>
            <div class="form-control">
                <input type="checkbox" name="terms" id="termsCheckbox"></span>
                I agree with the terms of service
                <small>Error message</small>
            </div>

            <hr>
            <button type="submit" class="signup_button">Sign up</button>

            <p>Do you have an account? <a href="#">Sign in</a></p>
        </form>

    </div>

</body>

</html>