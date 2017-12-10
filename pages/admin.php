<?php
//Header
include('header.admin.inc.php');


?>
<style>
#leff {
  text-align: left;
}
</style>
<!--Content-->
<div class="row center">
  <div class="col-sm-4">
    Solved Issues<br />(<?php $solved_sql = "SELECT count(*) FROM issues WHERE solved=1";
    $solved_result = $conn->prepare($solved_sql);
    $solved_result->execute();
    echo $solved_numbers = $solved_result->fetchColumn(); ?>)
    <br />
    <br />
    <a href="view_all_solved.php" class="btn btn-primary">View all the solved issues</a>
  </div>
  <div class="col-sm-4">
    Total Users<br />(<?php $sql = "SELECT count(*) FROM users WHERE approved = 1";
$result = $conn->prepare($sql);
$result->execute();
echo $number_of_rows = $result->fetchColumn();  ?>)
<br />
<br />
<a href="view_all.php" class="btn btn-primary">View all the users</a>
  </div>
  <div class="col-sm-4">
    Archived Issues<br />(<?php $archived_sql = "SELECT count(*) FROM issues WHERE archived_issue=1";
    $archived_result = $conn->prepare($archived_sql);
    $archived_result->execute();
    echo $archived_numbers = $archived_result->fetchColumn(); ?>)
    <br />
    <br />
    <a href="view_all_archived.php" class="btn btn-primary">View all the archived issues</a>
  </div>
</div>
<div class="row pp center">
  <div class="tt col-sm-4">
    <h3>Pending Users</h3>
    <hr />
    <div class="p_users">
      <?php
      $users = 'SELECT * FROM users WHERE admin=0 AND approved=0';
      foreach ($conn->query($users) as $us) {
        $is = $us['id'];
        $fn = $us['firstname'];
        $ln = $us['lastname'];
        echo '
        <div class="card mb-4">
            <div class="card-body">
              <h4 class="card-title">' . $fn . " " . $ln .'</h4>
              <a href="view.php?id='. $is .'" class="btn btn-primary">View</a>
            </div>
          </div>
        ';
        echo "<br />";
        echo "<hr />";
      }
      ?>
    </div>
  </div>
  <div class="tt col-sm-4">
    <h3>Comments</h3>
    <hr />
    <div class="p_comments">
      <p>Lorem ipsmun nasodnasodinasodasndoasdnasdaasdasdasdasddnda</p>
      <a href="!#">Like</a>(x)<a href="!#">Dislike</a>(y) <a href="!#" class="btn btn-primary">View</a>
      <br />
      <br />
      <p>Lorem ipsmun nasodnasodinasodasndoasdnasdaasdasdasdasddnda</p>
      <a href="!#">Like</a>(x)<a href="!#">Dislike</a>(y) <a href="!#" class="btn btn-primary">View</a>
      <br />
      <br />
      <p>Lorem ipsmun nasodnasodinasodasndoasdnasdaasdasdasdasddnda</p>
      <a href="!#">Like</a>(x)<a href="!#">Dislike</a>(y) <a href="!#" class="btn btn-primary">View</a>
    </div>
  </div>
  <div class="tt col-sm-4">
    <h3>New Issues</h3>
    <hr />
    <?php
    $issue_sql = 'SELECT * FROM issues WHERE new_issue=1';
    foreach ($conn->query($issue_sql) as $is) {
      $issue_id = $is['id'];
      $auth = $is['author'];
      $tit = $is['title'];
      $des = $is['short_d'];
      $loc = $is['physical_location'];
      echo '
      <div class="card mb-4">
          <div class="card-body">
          <div id="leff">
            <h4 class="card-title">Author: ' . $auth .'</h4>


            <p>Title: '. $tit .'</p>

            <p>Description: ' . $des .'</p>
            <p>Location: '. $loc .'</p>

            <a href="view_issue.php?id='. $issue_id .'" class="btn btn-primary">View</a>
            </div>
          </div>
        </div>
      ';
      echo "<br />";
      echo "<hr />";
    }
    ?>
  </div>
</div>
<?php
//Footer
include('footer.admin.inc.php');
?>
