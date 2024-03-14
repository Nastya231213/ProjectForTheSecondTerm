<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

  <link rel="stylesheet" href="<?= ASSETS ?>/css/style.css?verision=112">
</head>

<body>
  <nav>
    <input type="checkbox" id="check">
    <label for="check" class="check_button"><i class="fas fa-bars"></i></label>
    <a href="#"><label class="logo">QuickCuisne</label></a>
    <ul>
      <li>
        <a href="#">Catalogue </a>
        <ul class="dropdown">
          <li><a href="#">Salads</a>
          <li><a href="#">Side dish</a>

        </ul>
      </li>

      <li><a href="#">Dishes</a></li>
      <li><a href="#">Drinks</a></li>

      <li><a href="#">Delivery and payment</a></li>
      <li><a href="#">Login <i class="fas fa-sign-in-alt"></i></a></li>

      <li><a href="registration">Sign up <i class="fas fa-user-plus"></i></a></li>


      <div class="search">
        <form>
          <input type="text" placeholder="Search..">
          <button type="submit">Go</button>
        </form>

      </div>

    </ul>


  </nav>