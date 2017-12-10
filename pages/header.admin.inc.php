<?php
include('../db.php');
if(!$admin->loggedin())
{
  $admin->redirect('login.php');
}

    $sql = 'SELECT firstname, lastname FROM users WHERE admin=1 LIMIT 1';
    foreach ($conn->query($sql) as $row) {
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
    }

?>
<!--Header.php-->
<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="static/css/myCss.css" rel="stylesheet">
<style>
<?php echo $css; ?>
</style>
<meta charset="UTF-8">
<style>
.act a{
  color: white !important;
}
.navbar-header{
  padding-top: 10px;
}
.nav{
  padding-top: 10px !important;
}
.dropdown {
  margin-top: -5px;
}
.center {
  text-align: center;
}
.pp {
  padding-top: 120px;
}
.p_users {
  text-align: left;
}
.p_comments {
  text-align: left;
}
.tt {
  border: 1px solid black;
}
</style>
<title>Admin panel</title>
<link href="static/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="static/css/customIndex.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">



  <body>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="home.php">Social Responsibility Portal</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav nam">
            <li class="act"><a href="#">Home</a></li>
            <li><a href="#">Issues</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $firstname . " " . $lastname; ?><br />Administrator <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Notification</a></li>
                <li><a href="#">Settings</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <div class="container">
<!--End Header -->
