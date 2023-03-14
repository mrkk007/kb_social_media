<?php
session_start();
if(!isset($_SESSION["User_name"])){
  header("location: http://localhost/kb_Social_Media/index.php");
}

include "Function.php";
$userName = $_SESSION["User_name"];
// $result = dbSelectTableData("users","*","User_name = '{$userName}'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>♛_𝕶𝖍𝖚𝖘𝖍𝖆𝖑 𝖇𝖆𝖗𝖆𝖎𝖞𝖆_♛</title>
    <!-- Bootstrap -->
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font AweSome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet">
</head>
<body>

<div class="container bootstrap snippets bootdeys">
<div class="row">

<div class="panel rounded shadow">
  <div class="panel-body">
    <div class="backbtn">
      <a class="back" href="EditProfile.php">Back</a>
    </div>
    <div class="img-form">
      <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
      		<h3> Change Your Profile </h3>
          <input type="file" name="ProfileImage" accept="image/*" required>
      		<button type="submit" name="ChangeImage" class="upload-button"> Change Img </button>
      </form>
    </div>
  </div>
</div>

</div>
</div>


<?php

if(isset($_POST['ChangeImage'])){

    if(isset($_FILES['ProfileImage'])){
      $errors = array();

      $file_name = $_FILES['ProfileImage']['name'];
      $file_size = $_FILES['ProfileImage']['size'];
      $file_tmp = $_FILES['ProfileImage']['tmp_name'];
      $file_type = $_FILES['ProfileImage']['type'];
      $ary = explode('.',$file_name);
      $file_ext = strtolower($ary['1']);
      $extensions = array("jpeg","jpg","png");

      if(in_array($file_ext,$extensions) === false){
        $errors[] = "This extension file not allowed, Please choose a JPG or PNG file..";
      }

      if($file_size > 10485760){
        $errors[] = "File size must be 2mb or lower..";
      }

      if(empty($errors) == true){
        move_uploaded_file($file_tmp,"Images/".$file_name);
      }else{
        print_r($errors);
        die();
      }
    }
    $UpdateData = "UPDATE users SET Profile_img = '{$file_name}' WHERE User_name = '{$userName}'";

    if(mysqli_multi_query($conn, $UpdateData)){
      header("location: http://localhost/kb_Social_Media/EditProfile.php");
    }else{
      echo "<div class='alert alert-danger'>Query Failed..</div>";
    }

}
?>


<style type="text/css">
  body{
    margin-top:20px;
    background:#eee;
  }
  .img-form{
    justify-content: center;
    margin: 10px 10px;
    text-align: center;
  }
  .img-form form input{
    margin: 20px auto;
    padding-left: 70px;
  }


  .backbtn a{
    text-decoration: none;
  }
  .back {
    text-align: center;
    display: inline-block;
    position: relative;
    color: #3e53bb;
    text-transform: capitalize;
    font-size: 18px;
    width: 70px;
    overflow: hidden;
  }
  .back{
    transition: all 0.2s linear 0s;
  }
  .back:before {
    content: "\f30a";
    font-family: FontAwesome;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: 0;
    left: 0px;
    height: 100%;
    width: 20px;
    border-radius: 0 60% 60% 0;
    transform: scale(0, 1);
    transform-origin: left center;
    transition: all 0.2s linear 0s;
  }
  .back:hover {
    text-indent: 30px;
  }
  .back:hover:before {
    transform: scale(1, 1);
    text-indent: 0;
  }

</style>
</body>
</html>
