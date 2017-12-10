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
<h3><?php echo $firstname . " " . $lastname; ?></h3>
<h5>Age: <?php echo $age; ?></h5>
<h5>Location: <?php echo $location; ?></h5>
<button class="btn btn-success" type="submit" name="edit">Edit</button>

<?php
include('footer.inc.php');
?>
