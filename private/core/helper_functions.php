<?php

function isAdmin()
{
  if ($_SESSION['admin'] && $_SESSION['user']->email == ADMIN_EMAIL) {
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
