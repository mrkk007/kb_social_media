<?php

session_start();

session_unset();

session_destroy();

header("location: http://localhost/kb_Social_Media/index.php");

?>
