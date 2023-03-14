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

<div class="sbox">
    <div class="form">
      <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <h2>Create to your account</h2>
        <div class="inputBox">
          <input type="text" name="FirstName" required />
          <span>FirstName</span>
          <i></i>
        </div>
        <div class="inputBox">
          <input type="text" name="LastName" required />
          <span>LastName</span>
          <i></i>
        </div>
        <div class="inputBox">
          <input type="text" name="UserName" required />
          <span>UserName</span>
          <i></i>
        </div>
        <div class="inputBox">
          <input type="password" name="PassWord" required />
          <span>Password</span>
          <i></i>
        </div>
        <div class="inputBox">
          <input type="email" name="Email" required />
          <span>Email</span>
          <i></i>
        </div>
        <div class="inputBox">
          <input type="text" name="Number" required />
          <span>Phone Number</span>
          <i></i>
        </div>
        <input type="submit" name="signup" value="Sign Up">
        <p>Have an account? <a href="index.php">Log In</a></p>
      </form>
    </div>
</div>

<?php

  if(isset($_POST['signup'])){

    include "Function.php";
    $username = mysqli_real_escape_string($conn,$_POST['UserName']);
    $result = dbSelectTableData("users","User_name","User_name = '{$username}'");

    $value = array(
      'First_name' => mysqli_real_escape_string($conn,$_POST['FirstName']),
      'Last_name' => mysqli_real_escape_string($conn,$_POST['LastName']),
      'User_name' => mysqli_real_escape_string($conn,$_POST['UserName']),
      'Password' => mysqli_real_escape_string($conn,md5($_POST['PassWord'])),
      'Email' => mysqli_real_escape_string($conn,$_POST['Email']),
      'Number' => mysqli_real_escape_string($conn,$_POST['Number'])
    );

    if(mysqli_num_rows($result) > 0){
      echo "<p style='color:red;text-align:center;'>Username Already Exists..</p>";
    }else{
      dbInsertTableData("users",$value);
      header("location: index.php");
    }
  }

?>

</body>
</html>
