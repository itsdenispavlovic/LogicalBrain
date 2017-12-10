<?php
//Header
$css = '
.col-centered{
        margin: auto;
        max-width: 300px;
}
.img-center {
  display: block;
    margin-left: auto;
    margin-right: auto;
}
.row p {
  text-align: center;
  font-size: 15px;
}
';
include('header.inc.php');
?>

<!--Content-->
<div class="col-centered">
  <div class="row">
    <img class="img-center" src="../assets/img/done.png" height="50" width="50" />
    <br />
    <p>
      Thank you for Signing Up! <br />
      Wait from one of Admins to get approved.. <br />
      Have a nice day!
    </p>
  </div>
</div>
<?php
//Footer
include('footer.inc.php');
?>
