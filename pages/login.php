<?php
include('header.inc.php');

if($us->loggedin()!="")
{
  $us->redirect('home.php');
}
if($admin->loggedin()!="")
{
  $admin->redirect('admin.php');
}
if(isset($_POST['login']))
{
  $email = @$_POST['email'];
  $pass = @$_POST['password'];

  if($admin->login($email,$pass))
  {
    $admin->redirect('admin.php');
  }

  if($us->login($email,$pass))
  {
    $us->redirect('home.php');
  }
  else
  {
    $error = "Wrong Details!";
  }
}
?>
<style>
body {
padding-bottom: 40px;
background-color: #eee;
}

.form-signin {
max-width: 330px;
padding: 15px;
margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
margin-bottom: 10px;
}
.form-signin .checkbox {
font-weight: normal;
}
.form-signin .form-control {
position: relative;
height: auto;
-webkit-box-sizing: border-box;
    box-sizing: border-box;
padding: 10px;
font-size: 16px;
}
.form-signin .form-control:focus {
z-index: 2;
}
.form-signin input[type="email"] {
margin-bottom: -1px;
border-bottom-right-radius: 0;
border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
margin-bottom: 10px;
border-top-left-radius: 0;
border-top-right-radius: 0;
}
</style>
<div class="form-signin">
        <form method="post">
            <h2>Sign in.</h2><hr />
            <?php
            if(isset($error))
            {
                  ?>
                  <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                  </div>
                  <?php
            }
            ?>
            <div class="form-group">
             <input type="email" class="form-control" name="email" placeholder="E mail" required />
            </div>
            <div class="form-group">
             <input type="password" class="form-control" name="password" placeholder="Your Password" required />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
             <button type="submit" name="login" class="btn btn-block btn-primary">
                 <i class="glyphicon glyphicon-log-in"></i>&nbsp;SIGN IN
                </button>
            </div>
            <br />
            <label>Don't have account yet ! <a href="sign-up.php">Sign Up</a></label>
        </form>
       </div>
<?php
include('footer.inc.php');
?>
