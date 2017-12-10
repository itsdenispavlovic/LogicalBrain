<?php
include('header.inc.php');
if($admin->loggedin())
{
  header("Location: admin.php");
}
if(!$us->loggedin())
{
  header("Location: login.php");
}
if(empty($class)) {
  $class ="";
}
$id = $_SESSION['user_session'];
$user_id = $id;
$sql = "SELECT * FROM users WHERE id=$id AND approved=1";
foreach ($conn->query($sql) as $user)
{
  $fn = $user['firstname'];
  $ln = $user['lastname'];
  $author = $fn . " " . $ln;
}
$title = @$_POST['title'];
$description = @$_POST['description'];
$location = @$_POST['location'];
//Locatie trebuie modificata...

if(isset($_POST['send']))
{
  $state = $conn->prepare("INSERT INTO issues (author, user_id, title, short_d, physical_location) VALUES (:author, :user_id, :title, :description, :location)");
  $state->execute(array(
    ':author' => $author,
    ':user_id' => $user_id,
    ':title' => $title,
    ':description' => $description,
    ':location' => $location
  ));
}
$test_issue = "SELECT count(*) FROM issues";
$test_result = $conn->prepare($test_issue);
$test_result->execute();
$test_issue_number = $test_result->fetchColumn();
?>

<style>
      #map {
        height: 400px;
        width: 100%;
       }
</style>
<form class="form-signin" action="issues.php" method="POST">
  <h2 class="center">Report an issue:</h2>
  <div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text" name="title" class="form-control" id="" placeholder="Enter the title of the issue" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Short Description</label>
    <textarea onkeydown="keydown()" type="text" name="description" class="form-control" id="sss" maxlength="250" placeholder="Write a short description" required></textarea>
    <div id="textarea_feedback"></div>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Location</label>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEKmsFXpN8i8nyuB9nNgQ6THsdTUjqxn0&callback=initMap">
    </script>
    <div id="map" style="width:100%;height:500px;"></div>
    <div id="information_coordation">
      <br />
      <input id="coordation" onclick="getCoordation()" type="text" name="location" value="" class="form-control" readonly/>
    </div>
    </div>
  <button type="submit" name="send" onclick="checkLenght()" class="btn btn-primary">Send</button>
</form>
<br />
<?php if($test_issue_number == 0) {
  //Display nothing!
}
else {
echo '<h3>Issues</h3>';
echo '<hr />';
}
?>

<?php

$issue_sql = 'SELECT * FROM issues WHERE new_issue=1';
foreach ($conn->query($issue_sql) as $is) {
  $issue_id = $is['id'];
  $auth = $is['author'];
  $tit = $is['title'];
  $des = $is['short_d'];
  $loc = $is['physical_location'];
  $like_sql_s = "SELECT * FROM likes";
  $comment = @$_POST['textarea'];
  if(isset($_POST['comment'])) {
    $stmt = $conn->prepare("INSERT INTO comments (comment, issue_id, user_id) VALUES (:comment, $issue_id, $user_id)");
    $stmt->bindValue(":comment", $comment);
    $stmt->execute();
  }
  $comment_sql = "SELECT count(*) FROM comments WHERE issue_id=$issue_id";
  $comment_result = $conn->prepare($comment_sql);
  $comment_result->execute();
  $comment_numbers = $comment_result->fetchColumn();
  $like_sql = "SELECT count(*) FROM likes WHERE issue_id=$issue_id";
  $like_result = $conn->prepare($like_sql);
  $like_result->execute();
  $like_number = $like_result->fetchColumn();
  $dislike_sql = "SELECT count(*) FROM dislikes WHERE issue_id=$issue_id";
  $dislike_result = $conn->prepare($dislike_sql);
  $dislike_result->execute();
  $dislike_numbers = $dislike_result->fetchColumn();

  echo '
  <div class="card mb-4">
      <div class="card-body">
      <div id="leff">
        <h4 class="card-title">Author: ' . $auth .'</h4>


        <p>Title: '. $tit .'</p>

        <p>Description: ' . $des .'</p>
        <p>Location: '. $loc .'</p>


        </div>
        <hr />

      </div>
    </div>
  ';
  echo "<br />";
  echo "<hr />";
}

if(isset($_POST['likea'])) {
  if(isset($_POST['likea'])) {
    $stmt = $conn->prepare('INSERT INTO likes(issue_id, user_id) VALUES (:issue_id, :user_id)');
    $stmt->execute(array(
      ':issue_id' => $issue_id,
      ':user_id' => $user_id
    ));
  }
}
if(isset($_POST['dislike'])) {
  $stmt = $conn->prepare('INSERT INTO dislikes(issue_id, user_id) VALUES (:issue_id, :user_id)');
  $stmt->execute(array(
    ':issue_id' => $issue_id,
    ':user_id' => $user_id
  ));
}
?>
<script>
var y = document.getElementById("sss");

function checkLenght() {
  if(y.value.length <= 250 && y.value.length >= 10) {
    alert('Success! You'/'re Issue is now Reported');
  }
  else
  {
    alert('Minimum length is 10 Characters');
  }
}

var area = document.getElementById("sss");
var message = document.getElementById("textarea_feedback");
var maxLength = 250;
var checkLength = function() {
    if(area.value.length < maxLength) {
        message.innerHTML = (maxLength-area.value.length) + " characters remainging";
    }
}
setInterval(checkLength, 300);
</script>

<?php
include('footer.inc.php');
?>
