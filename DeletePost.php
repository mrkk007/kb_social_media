<?php
include "Function.php";
$id = $_GET['id'];
$sql = "DELETE FROM post WHERE p_id = {$id}";
$sql2 = "DELETE FROM postcomment WHERE PostId = {$id}";
$result = mysqli_query($conn,$sql);
$result = mysqli_query($conn,$sql2);
header("location: http://localhost/kb_Social_Media/UserProfile.php");
?>
