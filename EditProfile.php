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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>♛_𝕶𝖍𝖚𝖘𝖍𝖆𝖑 𝖇𝖆𝖗𝖆𝖎𝖞𝖆_♛</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font AweSome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  </head>
<body>



<div class="container bootstrap snippets bootdeys">
<div class="row">

<?php
if(mysqli_num_rows($result) > 0){
  while ($row = mysqli_fetch_assoc($result)) {
?>


<div class="col-lg-3 col-md-3 col-sm-4">
  <div class="panel rounded shadow">
    <div class="panel-body">
      <div class="inner-all">
        <ul class="list-unstyled">
            <li class="left_icon backbtn">
              <a class="back" href="UserProfile.php">Back</a>
            </li>
            <li><br></li>
            <li class="text-center">
              <a href="ChangeImg.php">
              <?php
                if(!empty($row['Profile_img']) && isset($row['Profile_img']) && $row['Profile_img'] != NULL){
                  echo "<img class='img-circle img-responsive img-bordered-primary' src='./Images/". $row['Profile_img'] ."' alt='profile'>";
                }
                else{
                  echo "<img class='img-circle img-responsive img-bordered-primary' src='./Images/NoProfile.jpg' alt='profile'>";
                }
              ?>
              </a>
            </li>
            <li><a href="ChangeImg.php" class="btn btn-default list-group-item">Change Image Profile</a></li>
            <li class="text-center">
              <h4 class="text-capitalize"><?php echo $row['First_name'] ." ". $row["Last_name"]; ?></h4>
              <p class="text-muted text-capitalize"><?php echo $row["User_name"]; ?></p>
            </li>
            <li class="list-group-item"><i class="fa fa-globe mr-5"></i> <?php echo $row["Email"]; ?></li>
            <li class="list-group-item"><i class="fa fa-phone mr-5"></i> <?php echo $row["Number"]; ?></li>
            <div class="btn-group-vertical btn-block">
              <a href="LogOut.php" class="btn btn-default"><i class="fa fa-sign-out pull-right"></i>Logout</a>
            </div>
        </ul>
      </div>
    </div>
  </div>
</div>


<div class="col-sm-9 px-0 panel rounded shadow">
  <div class="widget widget-tabbed panel-body">
    <div class="row justify-content-center text-center">
      <h3>Form</h3>
    </div>

    <div class="row px-lg-5">
      <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
          <label>First Name:</label>
          <input type="hidden" class="form-control" name="userName" value="<?php echo $row['User_name']; ?>">
          <input type="text" class="form-control" name="FirstName" value="<?php echo $row['First_name']; ?>">
        </div>
        <div class="form-group">
          <label>Last Name:</label>
          <input type="text" class="form-control" name="LastName" value="<?php echo $row['Last_name']; ?>">
        </div>
        <div class="form-group">
          <label>Email:</label>
          <input type="email" class="form-control" name="Email" value="<?php echo $row['Email']; ?>">
        </div>
        <div class="form-group">
          <label>Number:</label>
          <input type="text" class="form-control" name="Number" value="<?php echo $row['Number']; ?>">
        </div>
        <button name="update_profile" type="submit" class="btn bg-primary">Submit</button>
      </form>
    </div>
  </div>
</div>

<?php
  }
}


if(isset($_POST['update_profile'])){

  $value = array(
    'First_name' => mysqli_real_escape_string($conn,$_POST['FirstName']),
    'Last_name' => mysqli_real_escape_string($conn,$_POST['LastName']),
    'Email' => mysqli_real_escape_string($conn,$_POST['Email']),
    'Number' => mysqli_real_escape_string($conn,$_POST['Number'])
  );

  $UpdateData = dbUpdateTableData("users",$value,"User_name = '{$userName}'");
  header("location: http://localhost/kb_Social_Media/UserProfile.php");

}

?>


</div>
</div>



<style type="text/css">

  body{
    margin-top:20px;
    background:#eee;
  }

    .row .flex {
      margin-top: 20px;
      display: flex;
      justify-content: center;
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


  i.fa{
    margin-right:10px;
  }
  h4.text-capitalize {
      margin-top: 14px;
  }
  li.list-group-item {
      margin-bottom: 10px;
  }
  a.btn.btn-default {
      margin-bottom: 10px;
  }
  .text-center {
      text-align: center;
      width: 200px;
     margin:0 auto;

  }
  .text-center img{
    height: 200px;
    width: 200px;
  }
</style>

</body>
</html>
