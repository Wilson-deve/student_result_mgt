<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($con,"select UserName from tblusers where UserName = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['UserName'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:index.php");
      die();
   }
?>