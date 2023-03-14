<?php
include "Function.php";
$id = $_GET['id'];
$sql = "UPDATE post SET p_like = p_like + 1  WHERE p_id = {$id}";
$result = mysqli_query($conn,$sql);
header("location: http://localhost/kb_Social_Media/DaseBord.php");
?>
