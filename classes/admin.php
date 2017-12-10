<?php
class ADMIN
{
  private $db;

  function __construct($conn)
  {
    $this->db = $conn;
  }

  public function login($a_mail, $a_pass)
  {
    try {
      $stmt = $this->db->prepare("SELECT * FROM users WHERE email=:a_mail AND admin=1 LIMIT 1");
      $stmt->bindValue(':a_mail', $a_mail);
      $stmt->execute();
      $adminUserRow=$stmt->fetch(PDO::FETCH_ASSOC);
      if($stmt->rowCount() > 0)
      {
        if(password_verify($a_pass, $adminUserRow['password']))
        {
          $_SESSION['admin_user_session'] = $adminUserRow['id'];
          return true;
        }
        else
        {
          return false;
        }
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

  }

  public function makeAdmin()
  {
    //Create another User a admin
  }

  public function permission()
  {
    //To add a new User into database
  }


  public function loggedin()
  {
    if(isset($_SESSION['admin_user_session']))
    {
      return true;
    }
  }

  public function redirect($url)
  {
    header("Location: $url");
  }

  public function logout()
  {
    session_destroy();
    unset($_SESSION['admin_user_session']);
    return true;
  }
}
?>
