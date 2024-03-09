<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="<?= ASSETS ?>/css/style.css?verision=11222">

</head>

<body id="sign_up_form_body">

    <div class="form_for_refistration">
        <img src="<?= ASSETS ?>/images/icons8-user-100.png">
        <h1>Sign Up Now</h1>
        <form method="POST">
            <input type="text" class="input-registration" placeholder="Your name">
            <input type="text" class="input-registration" placeholder="Your surname">

            <input type="email" class="input-registration" placeholder="Your email">
            <input type="number" class="input-registration" placeholder="Your phone number">

            <textarea rows="3" class="input-registration" placeholder="Enter your address"></textarea>
            <input type="password" class="input-registration" placeholder="Yoru password">
            <p><span><input type="checkbox" name="terms" id="termsCheckbox"></span>
                I agree with the terms of service</p>
            <hr>
            <button type="button" class="signup_button">Sign up</button>

            <p>Do you have an account? <a href="#">Sign in</a></p>
        </form>

    </div>

</body>

</html>