<?php
include('header.admin.inc.php');

?>

<!--Content-->
<h3>List of all Users who are Approved</h3>
<hr />
<?php

  $sql = 'SELECT * FROM users WHERE approved=1';
  foreach ($conn->query($sql) as $row)
  {
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    echo $firstname . " " . $lastname;
    echo "<hr />";
  }

?>

<!--EndContent-->

<?php
include('footer.inc.php');
?>
