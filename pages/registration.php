<?php
//Include the header
$title = 'Register';
include('header.inc.php');
if($us->loggedin()!="")
{
  $us->redirect('home.php');
}
//Get the all data
$fn = @$_POST['firstname'];
$ln = @$_POST['lastname'];
$em = @$_POST['email'];
$age = @$_POST['age'];
$location = @$_POST['location'];
$pwd = @$_POST['password'];
$pwd2 = @$_POST['password2'];
// Because the single quotes are "escaped" (i.e. appended with a backslash), the
// hackers attempt would fail.


//When the Submit button is Submitted
if(isset($_POST['submit']))
{


  //RULES
  //For Emptys
  if(empty($fn)) {
    echo "<script>alert('Your Firstname is empty!');</script>";
  }
  else if(empty($ln)) {
    echo "<script>alert('Your Lastname is empty!');</script>";
  }
  else if(empty($em)) {
    echo "<script>alert('Your Email is empty!');</script>";
  }
  else if(empty($pwd)) {
    echo "<script>alert('Your Password is empty!');</script>";
  }

  //For length and Validity
  $numbers = '/[0-9]/';
  if(preg_match($numbers,$fn)) {
    echo "<script>alert('Numbers are not allowed!');</script>";
  }
  else if(preg_match($numbers,$ln)) {
    echo "<script>alert('Numbers are not allowed!');</script>";
  }

  //If the passwords is corrects 1==2
  if($pwd == $pwd2) {
    //Check if the user is Already Signed Up
    $check_email_sql = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $check_email_sql->bindValue(':email', $em );
    $check_email_sql->execute();
    if($check_email_sql->rowCount() > 0) {
      echo '<script>alert("You are already signed up!");</script>';
    }
    else {
    //Lets add into database!
    $pwd = password_hash($pwd, PASSWORD_DEFAULT);
    $statement = $conn->prepare('INSERT INTO users (firstname, lastname, email, age, location, password, admin, approved) VALUES (:firstname, :lastname, :email, :age, :location, :password, 0, 0)');
    $statement->execute(array(
      ':firstname' => $fn,
      ':lastname' => $ln,
      ':email' => $em,
      ':age' => $age,
      ':location' => $location,
      ':password' => $pwd
    ));
    header('Location: validation.php');
  }
  }
  else {
    echo "<script>alert('Password didn/'t match!');</script>";
  }

}
?>
<style>
body {
padding-bottom: 40px;
background-color: #eee;
}

.form-signin {
max-width: 400px;
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

<!--Content-->
<form class="form-signin" action="registration.php" method="POST">
  <h2 class="center">Register:</h2>
  <div class="form-group">
    <label for="exampleInputEmail1">Firstname</label>
    <input type="text" name="firstname" class="form-control" id="" placeholder="Enter firstname" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Lastname</label>
    <input type="text" name="lastname" class="form-control" id="" placeholder="Enter lastname" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="" aria-describedby="emailHelp" placeholder="Enter email" required>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Age</label>
    <input type="number" name="age" class="form-control" id="" placeholder="Enter your age" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Location</label>
    <input type="text" name="location" class="form-control" id="location" onload="getLocation()" value="" readonly>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Repeat Password</label>
    <input type="password" name="password2" class="form-control" id="exampleInputPassword1" placeholder="Repeat Password" required>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
<!--EndContent-->
<script type="text/javascript">
var x = document.getElementById("location");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.value = "Geolocation is not supported by this browser.";
    }
}
window.onload = getLocation;

function showPosition(position) {
    x.value = "lat: " + position.coords.latitude + ", lng: " + position.coords.longitude;
}
</script>
<?php
//Include the Footer
include('footer.inc.php');
?>
