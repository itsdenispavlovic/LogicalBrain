<?php
class USER
{
  private $db;

  function __construct($conn)
  {
    $this->db = $conn;
  }

  //Make a Registration public function to make the code Cleaner

  public function login($umail,$upass)
    {
       try
       {
          $stmt = $this->db->prepare("SELECT * FROM users WHERE email=:umail LIMIT 1");
          $stmt->bindValue(':umail', $umail);
          $stmt->execute();
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
            $upass = $upass;
             if(password_verify($upass, $userRow['password']))
             {



               if($userRow['admin'] == 0) {
                $_SESSION['user_session'] = $userRow['id'];
                return true;
              }
              if($userRow['admin'] == 1) {
                $_SESSION['admin_user_session'] = $userRow['id'];
              }
             }
             else
             {
                return false;
             }
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
     }

  public function post_issues($title, $descritpion, $location) {
    
  }

  public function loggedin() {
    if(isset($_SESSION['user_session']))
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
    unset($_SESSION['user_session']);
    return true;
  }
}
?>
