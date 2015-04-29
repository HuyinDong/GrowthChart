<?php
 SESSION_START();
  include('test.class.php');
  
  
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
  
$database = new test('localhost','root','chang','conn','dong','utf8');


?>
