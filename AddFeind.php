<?php
include "Function.php";
$UserName = $_GET['UserName'];
$NewFr = $_GET['id'];

$UserFrinds = dbSelectTableData("users","Friends","User_name = '{$UserName}'");
if(mysqli_num_rows($UserFrinds) > 0){
  while ($UserFr = mysqli_fetch_assoc($UserFrinds)){
    if(in_array($NewFr,explode(',',$UserFr['Friends']))){
      goto abc;
    }
    $NewFr .= ",". $UserFr['Friends'];
  }
}
$sql = "UPDATE users SET Friends = '{$NewFr}'  WHERE User_name = '{$UserName}'";
$result = mysqli_query($conn,$sql);
abc:
  header("location: http://localhost/kb_Social_Media/DaseBord.php");

?>
