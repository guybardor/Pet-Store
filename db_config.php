<?php
  $db_host = "148.66.138.145";
  $db_user = "dbCourseSt";
  $db_pass = "dbcourseShUsr22#";
  $db_name = "animal_pat_g_new";
  $connection = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
  if(mysqli_connect_errno()) 
  {
    die("DB connection failed: ");
    exit();
   }
 
?>