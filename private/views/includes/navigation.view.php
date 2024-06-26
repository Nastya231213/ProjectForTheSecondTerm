<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="<?= ASSETS ?>/css/style.css?version=3">
</head>

<body>
  <nav>
    <input type="checkbox" id="check">
    <label for="check" class="check_button"><i class="fas fa-bars"></i></label>
    <a href="#"><label class="logo">QuickCuisne</label></a>
    <ul>

      <li><a href="<?= ROOT ?>/home/dishes">Dishes <i class="fas fa-utensils"></i></a></li>
      <li><a href="<?= ROOT ?>/home/drinks">Drinks <i class="fas fa-mug-hot"></i></a></li>

      <li><a href="<?=ROOT?>/order/display_your_orders">Delivery and payment <i class="fas fa-truck"></i></a></li>
      <?php if (!isLoggedIn()) : ?>
        <li><a href="<?= ROOT ?>/login">Login <i class="fas fa-sign-in-alt"></i></a></li>

        <li><a href="<?= ROOT ?>/registration">Sign up <i class="fas fa-user-plus"></i></a></li>
      <?php else : ?>
        <li><a href="<?= ROOT ?>/logout">Logout <i class="fas fa-sign-in-alt"></i></a></li>

      <?php endif; ?>
      <li><a href="#" class="shopping" onclick="event.preventDefault();">Cart <i class="fas fa-cart-plus"></i></a></li>

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
      <a href="<?=ROOT?>/order">
        <div class="checkout-button">
          <div> Checkout</div>
        </div>
      </a>
      <h1>Your cart</h1>


      <?php $total = 0; ?>

      <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) : ?>
        <ul>

          <?php foreach ($_SESSION['cart'] as $product) : ?>
            <li>

              <div><img src="<?= UPLOADS . $product['pictureName'] ?>"> </div>
              <div><?= $product['price'] ?> $</div>
              <div id="currentQuantity"><?= $product['quantity'] ?></div>
              <?php $total += $product['quantity'] * $product['price'] ?>
              <div><a data-id="<?= $product['id'] ?>" href="#" class="delete"><i class="fas fa-trash text-white "></i></a></div>

              <div><button class="regulate minus" data-id="<?= $product['id'] ?>">-</button>
                <button class="regulate plus" data-id="<?= $product['id'] ?>">+</button>
              </div>
            </li>

          <?php endforeach; ?>

        </ul>

      <?php else : ?>
        <h2 class="text-white mt-2 text-center ">No products in your cart</h2>
      <?php endif; ?>
      <div class="checkout">
        <div class="total"><?= $total ?> $</div>
        <div class="closeCart">Close</div>
      </div>

      </li>
    </div>
  </div>