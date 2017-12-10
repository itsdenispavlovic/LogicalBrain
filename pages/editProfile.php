<?php
include('header.inc.php');
$userid=$_SESSION['user_session'];
$username = 'SELECT * FROM users WHERE id='.$userid.'';
foreach ($conn->query($username) as $is) {
  $firstname = $is['firstname'];
  $lastname = $is['lastname'];
  $age = $is['age'];
  $location = $is['location'];
}
?>
<input name="firstname" type="text" value="<?php echo $firstname; ?>"/>
<input name="lastname" type="text" value="<?php echo $lastname; ?>"/>
<h5>*Note you can't change you're Username/Email</h5>
<button class="btn btn-success" type="submit" name="edit">Edit</button>
