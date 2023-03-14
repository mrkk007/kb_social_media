<?php
session_start();
if(isset($_SESSION["User_name"])){
  header("location: http://localhost/kb_Social_Media/Dasebord.php");
}
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>♛_𝕶𝖍𝖚𝖘𝖍𝖆𝖑 𝖇𝖆𝖗𝖆𝖎𝖞𝖆_♛</title>

    <!-- Css File -->
    <link rel="stylesheet" href="style/Style.css">

    <!-- Bootstrap Link -->
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  </head>

<body>

<?php
  include "Function.php";
  $username = mysqli_real_escape_string($conn,$_POST['UserName']);
  $result = dbSelectTableData("users","User_id,User_name,Password","User_name = '{$username}'");
  if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) {
?>

<div class="box">
    <div class="form">
      <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <h2>Reset password</h2>
        <div class="inputBox">
            <input type="hidden" name="UserId" value="<?php echo $row['User_id']; ?>">
            <input type="password" name="PassWord" required="required">
            <span>Password</span>
            <i></i>
        </div>
        <div class="inputBox">
            <input type="password" name="ConfirmPassWord" required="required">
            <span>Confirm Password</span>
            <i></i>
        </div>
        <input type="submit" name="reset" value="Reset">
        <p><a href="index.php">Back To Log In</a></p>
      </form>
    </div>
</div>

<?php
  }
}else {
  header("location: ForgotPassWord.php");
}

if(isset($_POST['reset'])){
  $userId = mysqli_real_escape_string($conn,$_POST['UserId']);
  $passWord = mysqli_real_escape_string($conn,md5($_POST['PassWord']));
  $ConfimPass = mysqli_real_escape_string($conn,md5($_POST['ConfirmPassWord']));

  if($passWord == $ConfimPass){
    $sql = "UPDATE users SET Password = '{$passWord}' WHERE User_id = {$userId}";
    $result2 = mysqli_query($conn,$sql);
    header("location: index.php");
  }else{
    echo "<h3>Password are not matchad.</h3>";
  }
}
?>


</body>
</html>
