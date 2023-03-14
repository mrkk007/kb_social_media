<?php
include "Function.php";
$UserName = $_GET['UserName'];
$RemoveFr = $_GET['FrId'];
$UpdateFr = "";

$UserFrinds = dbSelectTableData("users","*","User_name = '{$UserName}'");
if(mysqli_num_rows($UserFrinds) > 0){
  while ($fr = mysqli_fetch_assoc($UserFrinds)){
    $allfr = explode(',',trim($fr['Friends'], ","));
    foreach($allfr as $val){
      if($RemoveFr == $val){ continue; }
      $UpdateFr .= $val .",";
    }
  }
}

$sql = "UPDATE users SET Friends = '{$UpdateFr}'  WHERE User_name = '{$UserName}'";
$result = mysqli_query($conn,$sql);
header("location: http://localhost/kb_Social_Media/UserProfile.php");


?>
