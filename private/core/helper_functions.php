<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (isset($_GET['functionname'])) {
    if ($_GET['functionname'] == 'decreaseAmount') {
      decreaseAmount();
    } else if ($_GET['functionname'] == 'increaseAmount') {
      increaseAmount();
    } else if ($_GET['functionname'] == 'deleteProduct') {
      deleteProduct();
    }
  }
}

function isAdmin()
{
  if (
    $_SESSION['user']->email == ADMIN_EMAIL  && password_verify(ADMIN_PASSWORD, $_SESSION['user']->password)
  ) {
    return true;
  } else {
    return false;
  }
}
function isLoggedIn()
{
  if (isset($_SESSION['user'])) {
    return true;
  } else {
    return false;
  }
}
function addMessage($data)
{

  if (isset($_SESSION['successMessage'])) {
    $data['successMessage'] = $_SESSION['successMessage'];
    unset($_SESSION['successMessage']);
  } else if (isset($_SESSION['errorMessage'])) {
    $data['errorMessage'] = $_SESSION['errorMessage'];
    unset($_SESSION['errorMessage']);
  }
  return $data;
}

function decreaseAmount()
{
  if (isset($_GET['id'])) {
    $dishId = $_GET['id'];

    if (isset($_SESSION['cart'][$dishId])) {
      if ($_SESSION['cart'][$dishId]['quantity'] != 1) {
        $_SESSION['cart'][$dishId]['quantity']--;
      }
    }
  }
}

function increaseAmount()
{
  if (isset($_GET['id'])) {
    $dishId = $_GET['id'];

    if (isset($_SESSION['cart'][$dishId])) {
      $_SESSION['cart'][$dishId]['quantity']++;
    }
  }
}

function deleteProduct()
{
  if (isset($_GET['id'])) {
    $dishId = $_GET['id'];

    if (isset($_SESSION['cart'][$dishId])) {
      unset($_SESSION['cart'][$dishId]);
    }
  }
}
function getRating($rating)
{
  $fullStars = floor($rating);
  $halfStar = ($rating - $fullStars) >= 0.5 ? 1 : 0;
  $emptyStars = 5 - $fullStars - $halfStar;
  for ($i = 0; $i < $fullStars; $i++) :
    echo '<i class="bi bi-star-fill"></i>';

  endfor;
  if ($halfStar) :

    echo '<i class="bi bi-star-half"></i>';
  endif;
  for ($i = 0; $i < $emptyStars; $i++) :
    echo '<i class="bi bi-star"></i>';
  endfor;
}
