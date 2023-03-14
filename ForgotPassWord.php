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
      <form action="ResetPassWord.php" method="post">
        <h2>Forgot password</h2>
        <div class="inputBox">
            <input type="text" name="UserName" required="required">
            <span>Username</span>
            <i></i>
        </div>
        <input type="submit" name="check_user" value="Reset">
        <p><a href="index.php">Back To Log In</a></p>
      </form>
    </div>
</div>


</body>
</html>
