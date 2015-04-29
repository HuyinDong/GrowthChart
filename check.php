<?php
$database->check();
if($_GET['logout'])
{
   unset($_SESSION['UN']);
   unset($_SESSION['pw']);
  echo "Success. <a href='../index.php'>Log In</a>";
     exit;
}

?>