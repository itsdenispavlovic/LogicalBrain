<?php
include('header.admin.inc.php');

$id = $_GET['id'];
$users = "SELECT * FROM users WHERE approved=0 or approved=1 AND id=$id";
foreach ($conn->query($users) as $us) {
  $fn = $us['firstname'];
  $ln = $us['lastname'];
  $age = $us['age'];
  $location = $us['location'];
  $approved = $us['approved'];
  $email = $us['email'];
  $add = $us['admin'];
}
if($approved == 0) {
  $app = 'No';
}
else {
  $app = 'Yes';
}
if($add == 0) {
  $ad = 'No';
}
else {
  $ad = 'Yes';
}

if(isset($_POST['approve']))
{
  echo("<script>confirm('Are you sure you want to approve this User?')</script>");
  $update_approve = "UPDATE users SET approved=1 WHERE id=$id";
  $res = $conn->prepare($update_approve);
  $res->execute();
  echo "<script>alert('Now is this user Approved!');</script>";
  //header("Location: view.php?id=$id");
  header('Location: '.$_SERVER['REQUEST_URI']);

}

if(isset($_POST['disapprove']))
{
  echo("<script>confirm('Are you sure you want to disapprove this User?')</script>");
  $update_approve = "UPDATE users SET approved=0 WHERE id=$id";
  $res = $conn->prepare($update_approve);
  $res->execute();
  echo "<script>alert('Now is this user Dispproved!');</script>";
  header("Location: view.php?id=$id");

}

if(isset($_POST['add_admin']))
{
  echo("<script>confirm('Are you sure you want to make this User an Admin?')</script>");
  $update_approve = "UPDATE users SET admin=1 WHERE id=$id";
  $res = $conn->prepare($update_approve);
  $res->execute();
  echo "<script>alert('Now is this user is a Admin!');</script>";
  header("Location: view.php?id=$id");

}

if(isset($_POST['ch_admin']))
{
  echo("<script>confirm('Are you sure you want to make this Admin into User?')</script>");
  $update_approve = "UPDATE users SET admin=0 WHERE id=$id";
  $res = $conn->prepare($update_approve);
  $res->execute();
  echo "<script>alert('Now is this user is a User!');</script>";
  header("Location: view.php?id=$id");

}
?>
<h2><?php echo $fn . " " . $ln; ?></h2>
<h4>Age: <?php echo $age; ?></h4>
<h4>E-mail: <?php echo $email; ?></h4>
<h4>Location: <?php echo $location; ?></h4>
<h4>Approved: <?php echo $app; ?></h4>
<h4>Admin: <?php echo $ad; ?></h4>
<form action="view.php?id=<?php echo $id;?>" method="POST">
<?php if($approved==0){ echo '<input type="submit" class="btn btn-success" name="approve" value="Approve">'; } else { echo '<input type="submit" class="btn btn-success" name="disapprove" value="Disapprove">'; }?> <?php if($add == 0) { echo '<input type="submit" class="btn btn-primary" name="add_admin" value="Make a admin">'; } else { echo '<input type="submit" class="btn btn-danger" name="ch_admin" value="Make a user">';} ?> <input type="submit" class="btn btn-danger" value="Delete">
</form>
<?php
include('footer.inc.php');
?>
