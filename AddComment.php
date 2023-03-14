<?php
  include "Function.php";
  $value = array(
    'CommUserId' => mysqli_real_escape_string($conn,$_POST['commUserId']),
    'Comment' => mysqli_real_escape_string($conn,$_POST['ComValue']),
    'PostId' => mysqli_real_escape_string($conn,$_POST['PostId']),
  );
  dbInsertTableData("postcomment",$value);
  header("location: http://localhost/kb_Social_Media/DaseBord.php");
?>
