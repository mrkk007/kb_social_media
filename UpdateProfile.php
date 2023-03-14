<?php
session_start();
if(!isset($_SESSION["User_name"])){
  header("location: http://localhost/kb_Social_Media/index.php");
}

include "Function.php";
$userName = $_SESSION["User_name"];
$result = dbSelectTableData("users","*","User_name = '{$userName}'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<?php
if(mysqli_num_rows($result) > 0){
  while ($row = mysqli_fetch_assoc($result)) {
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
    <a href="UserProfile.php"><i class="fas fa-close"></i></a>
		<h3> Add Your Post </h3>
    <input type="hidden" name="username" value="<?php echo $row['User_name']; ?>">
    <input type="hidden" name="userProfile" value="<?php echo $row['Profile_img']; ?>">
    <input type="file" name="post" accept="image/*" required>
		<button type="submit" name="add_post" class="upload-button"> Upload </button>
</form>

<?php
  }
}
?>



<?php
if(isset($_POST['add_post'])){

    if(isset($_FILES['post'])){
      $errors = array();

      $file_name = $_FILES['post']['name'];
      $file_size = $_FILES['post']['size'];
      $file_tmp = $_FILES['post']['tmp_name'];
      $file_type = $_FILES['post']['type'];
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


    $userN = mysqli_real_escape_string($conn,$_POST['username']);
    $userP = mysqli_real_escape_string($conn,$_POST['userProfile']);
    $date = date("d M, Y");

    $author = $_SESSION['user_id'];

    $sql = "INSERT INTO post (post_img,post_user,user_Profile,post_DateTime) VALUES  ('{$file_name}','{$userN}','{$userP}','{$date}');";

    if(mysqli_multi_query($conn, $sql)){
      header("location: UserProfile.php");
    }else{
      echo "<div class='alert alert-danger'>Query Failed..</div>";
    }

}
?>

</body>
</html>
