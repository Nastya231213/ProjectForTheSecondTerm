<?php $this->view("includes/navigation", ["title" => "Login"]) ?>

<div class="form_for_login">
    <img src="<?= ASSETS ?>/images/icons8-sign-in-100.png">
    <h1>Sign In</h1>
    <form method="POST">

        <div class="form-control">
            <input type="email" name="email" id="email" class="input-registration" required placeholder="Your email">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i><small>Error message</small>
        </div>

        <div class="form-control">
            <input type="password" name="password" required id="password" class="input-registration" placeholder="Your password">
            <i class="fas fa-check-circle"></i>
            <i class="fas fa-exclamation-circle"></i><small>Error message</small>
        </div>

        <hr>
        <button type="submit" class="signup_button">Sign In</button>

        <p>Don't have an account? <a href="registration">Sign Up</a></p>
    </form>

</div>
<?php if (isset($errorMessage)) : ?>
    <div class="alert show">
        <span class="fas fa-exclamation-circle"></span>
        <span class="msg"><?= $errorMessage ?></span>
        <span class="close">
            <span class="fas fa-times"></span>
        </span>
    </div>
<?php endif; ?>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const closeButton = document.querySelector('.alert .close');
        closeButton.addEventListener('click', function() {
            const alert = this.parentElement;
            alert.style.display = 'none';

        });
    });
</script>
<?php $this->view("includes/footer") ?>