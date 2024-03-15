<?php

function isAdmin()
{
  if ($_SESSION['admin'] && $_SESSION['user']->email == ADMIN_EMAIL) {
    return true;
  } else {
    return false;
  }
}
