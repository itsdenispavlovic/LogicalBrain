<?php
include('header.inc.php');
if(!$us->loggedin())
{
  $us->redirect('login.php');
}
$user_id = $_SESSION['user_session'];
$stmt = $conn->prepare('SELECT * FROM users WHERE id=:user_id');
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
$page = "home";
$userid=$_SESSION['user_session'];
$username = 'SELECT * FROM users WHERE id='.$userid.'';
foreach ($conn->query($username) as $is) {
  $firstname = $is['firstname'];
  $lastname = $is['lastname'];
  $age = $is['age'];
  $location = $is['location'];
}
?>

<h2>Welcome, <?php echo $firstname . " " . $lastname; ?></h2>
<h4>On this Website you can Report a new Issue.</h4>


<?php
include('footer.inc.php');
?>
