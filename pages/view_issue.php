<?php
include('header.inc.php');
if(empty($_GET['id']))
{
  header("Location: home.php");
}

$id = $_GET['id'];
$view_issue_sql = "SELECT * FROM issues WHERE new_issue=1 AND id=$id";
foreach ($conn->query($view_issue_sql) as $view) {
  $author = $view['author'];
  $title = $view['title'];
  $description = $view['short_d'];
  $location = $view['physical_location'];
}

?>

<h2>Author: <?php echo $author; ?></h2>
<h3>Title: <?php echo $title; ?></h3>
<p>Description: <?php echo $description; ?></p>
<p>Location: <?php echo $location; ?></p>
<a href="!#" class="btn btn-success">Resolved</a>
<hr />
<h3>COMMENTS!</h3>

<?php
include('footer.inc.php');
?>
