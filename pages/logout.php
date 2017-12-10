<?php
  include('header.inc.php');

  if($us->loggedin()!="")
  {
    $us->redirect('home.php');
  }
  if(isset($_GET['logout']) && $_GET['logout']=='true')
  {
    $us->logout();
    $us->redirect('registration.php');
  }
?>
