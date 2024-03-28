<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="<?= ASSETS ?>/css/style.css?verision=11">
</head>

<body>
  <nav>
    <input type="checkbox" id="check">
    <label for="check" class="check_button"><i class="fas fa-bars"></i></label>
    <a href="#"><label class="logo">QuickCuisne</label></a>
    <ul>

      <li><a href="#">Dishes</a></li>
      <li><a href="#">Drinks</a></li>

      <li><a href="#">Delivery and payment</a></li>
      <li><a href="login">Login <i class="fas fa-sign-in-alt"></i></a></li>

      <li><a href="registration">Sign up <i class="fas fa-user-plus"></i></a></li>
      <li><a href="#" class="shopping">Cart <i class="fas fa-cart-plus"></i></a></li>

      <div class="search">
        <form>
          <input type="text" placeholder="Search..">
          <button type="submit">Go</button>
        </form>

      </div>

    </ul>



  </nav>
  <div class="container_cart">
    <div id="cart">
      <h1>Your cart</h1>
      <div class="">
        <ul>
          <li>

            <?php foreach ($_SESSION['cart'] as $product) : ?>
              <div><img src="<?= UPLOADS . $product->picture ?>"> </div>
              <div><?= $product->price ?> $</div>
              <div><?= $product->quantity ?></div>

              <div><button class="regulate minus" data-id="<?= $product->id ?>">-</button>
                <button class="regulate plus" data-id="<?= $product->id ?>">+</button>
              </div>

            <?php endforeach; ?>
          </li>
        </ul>
        </li>
        <div class="checkout">
          <div class="total">0</div>
          <div class="closeCart">Close</div>
        </div>
      </div>
    </div>