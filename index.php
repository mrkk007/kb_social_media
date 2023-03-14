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

<div class="box">
  <div class="form">
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
      <h2>Login to your account</h2>
      <div class="inputBox">
          <input type="text" name="UserName" required="required">
          <span>Username</span>
          <i></i>
      </div>
      <div class="inputBox">
          <input type="password" name="PassWord" required="required">
          <span>Password</span>
          <i></i>
      </div>
      <div class="links">
          <a href="ForgotPassWord.php">Forgot password?</a>
      </div>
      <a href="#"><input type="submit" name="login" value="Login"></a>
      <p>Don't Have an account? <a href="Sign_Up.php">Sign Up</a></p>
    </form>
  </div>
</div>

<?php

if(isset($_POST['login'])){

  include "Function.php";
  $username = mysqli_real_escape_string($conn,$_POST['UserName']);
  $password = mysqli_real_escape_string($conn,md5($_POST['PassWord']));
  $result = dbSelectTableData("users","User_id,User_name","User_name = '{$username}' AND Password = '{$password}'");

  if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) {
      session_start();
      $_SESSION["User_name"] = $row['User_name'];
      $_SESSION["User_id"] = $row['User_id'];

      header("location: Dasebord.php");
    }
  }else {
    echo "<div class='alert alert-danger'>Username and Password are not matchad..</div>";
  }
}

?>

</body>
</html>
