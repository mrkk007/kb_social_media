<?php
session_start();
if(!isset($_SESSION["User_name"])){
  header("location: http://localhost/kb_Social_Media/index.php");
}

include "Function.php";
// $userId = $_SESSION["User_id"];
$userName = $_SESSION["User_name"];
$OterUserId = $_GET['OtherUserId'];
$LogUser = dbSelectTableData("users","*","User_name = '{$userName}'");

$result = dbSelectTableData("users","*","User_id = '{$OterUserId}'");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>♛𝕶𝖍𝖚𝖘𝖍𝖆𝖑 𝖇𝖆𝖗𝖆𝖎𝖞𝖆♛</title>
    <!-- Bootstrap -->
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font AweSome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  </head>
<body>

<div class="container bootstrap snippets bootdeys">
<div class="row">

<?php

if(mysqli_num_rows($result) > 0){
  while ($row = mysqli_fetch_assoc($result)) {
?>

  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="panel rounded shadow">
      <div class="panel-body">
        <div class="inner-all">
          <a class="back" href="DaseBord.php">Home</a>
          <ul class="list-unstyled">
            <li class="left_icon backbtn">
              <!-- <a class="back" href="DaseBord.php">Back</a> -->
            </li>
            <li><br></li>
            <li class="text-center">
            <?php
              if(!empty($row['Profile_img']) && isset($row['Profile_img']) && $row['Profile_img'] != NULL){
                echo "<img class='img' src='./Images/". $row['Profile_img'] ."' alt='profile'>";
              }
              else{
                echo "<img class='img' src='./Images/NoProfile.jpg' alt='profile'>";
              }
            ?>
            </li>
            <li class="name">
              <h4 class="text-capitalize"><?php echo $row['First_name'] ." ". $row["Last_name"]; ?></h4>
              <p class="text-muted text-capitalize" style="font-size: 20px;"><?php echo $row["User_name"]; ?></p>

<?php
if(mysqli_num_rows($LogUser) > 0){
  while ($logInuser = mysqli_fetch_assoc($LogUser)) {
    $allfr = explode(',',trim($logInuser['Friends'], ","));
      if(in_array($OterUserId,$allfr)){
        echo "<a href='RemoveFriend.php?UserName=". $userName ."&FrId=". $OterUserId ."' class='Follow'>UnFollow</a>";
      }else {
        echo "<a href='AddFeind.php?id=". $OterUserId ."&UserName=". $userName ,"' class='Follow'>Follow</a>";
      }
  }
}
?>
              <!-- <button class="Follow" >Follow</button> -->
            </li>

          </ul>
        </div>
      </div>
    </div>
  </div>

<?php
  }
}
?>

<div class="col-sm-12 px-0">
<div class="widget widget-tabbed">

<ul class="nav nav-tabs nav-justified">
<li class="active"><a href="#my-timeline" data-toggle="tab"><i class="fa fa-pencil"></i> Post</a></li>
<li><a href="#about" data-toggle="tab"><i class="fa fa-user"></i> Frinds</a></li>
</ul>


<div class="tab-content">

  <div class="tab-pane animated active fadeInRight" id="my-timeline">
    <div class="user-profile-content">

      <div class="row">
        <?php
        // $UserPost = dbSelectTableData("post","*","PostUserId = '{$userId}'");
          $OherUserPost = dbSelectTableData("post","*","PostUserId = '{$OterUserId}'");
          if(mysqli_num_rows($OherUserPost) > 0){
            while ($row = mysqli_fetch_assoc($OherUserPost)) {
        ?>
          <div href="#" class="col-sm-6 col-lg-4  col-md-4 post_img">
            <div class="post_hover">
              <a href="#"><i class="fa fa-heart"></i> <?php echo $row['p_like']; ?></a>

            </div>
            <img src="./Images/<?php echo $row['post_img']; ?>" width="100%" height="350px" alt="" class="img-fluid rounded shadow-sm">
          </div>
        <?php
            }
          }
        ?>
      </div>
    </div>
  </div>


  <div class="tab-pane animated fadeInRight" id="about">
    <div class="user-profile-content">

      <?php
        $OtherUserFr = dbSelectTableData("users","*","User_id = '{$OterUserId}'");
        if(mysqli_num_rows($OtherUserFr) > 0){
          while ($fr = mysqli_fetch_assoc($OtherUserFr)){
            $NewFr = $fr['Friends'];
            if(!empty($NewFr) && $NewFr != NULL){
              $NewFr = trim($NewFr, ",");
              $allfr = explode(',',$NewFr);
              foreach($allfr as $UserFrId){
                $UsFr = dbSelectTableData("users","*","User_id = {$UserFrId}");
                if(mysqli_num_rows($UsFr) > 0){
                  while ($AllFr = mysqli_fetch_assoc($UsFr)){
      ?>

      <div class="profile">
  		  <div class="profile__picture">
        <?php
              if(!empty($AllFr['Profile_img']) && isset($AllFr['Profile_img']) && $AllFr['Profile_img'] != NULL){
                echo "<img src='./Images/". $AllFr['Profile_img'] ."' alt='profile'>";
              }
              else{
                echo "<img src='./Images/NoProfile.jpg' alt='profile'>";
              }
            ?>
   </div>
  		  <div class="profile__header">
  			<div class="profile__account">
  			  <h3 class="profile__username"><?php echo $AllFr['First_name'] ." ". $AllFr['Last_name'];?></h3>
  			  <p class="profile__username"><?php echo $AllFr['User_name']; ?></p>

  			</div>
  			<div class="profile__edit">
          <a class="profile__button" href="FrProfile.php?OtherUserId=<?php echo $AllFr['User_id']; ?>">View Profile</a>
        </div>
  		  </div>
  		</div>

      <?php
                  }
                }
              }
            }
          }
        }
      ?>


    </div>
  </div>

</div>
</div>
</div>

</div>
</div>

<style type="text/css">

  body{
    margin-top:20px;
    background:#eee;
  }



ul.list-unstyled {
    display: flex;
    justify-content: center;
    align-items: center;
}
.Follow {
    padding: 10px 50px;
    color: #fff;
    background-color: #337ab7;
    border-color: #2e6da4;
    border: none;
    border-radius: 11px;
}
a.Follow {
    text-decoration: none;
    color: #fff;
}
li.name {
    margin-left: 115px;
}
li.name h4{
  font-size: 35px;
}
.back {
  text-align: center;
  display: inline-block;
  position: relative;
  color: #3e53bb;
  text-transform: capitalize;
  font-size: 18px;
  width: 80px;
  overflow: hidden;
}
.back{
  transition: all 0.2s linear 0s;
}
.back:before {
  content: "\f015";
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

.text-center img{
  height: 200px;
  width: 200px;
  border-radius: 40px;
}
  .post_img{
    margin-top: 30px;
  }
  .post_img .post_hover{
    display: none;
    text-align: center;
    position: absolute;
    width: 90%;
    height: 100%;
    background: radial-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.2) );
    padding: 110px 0px;
  }
  .post_img .post_hover a{
    color: #ffff;
    font-weight: bolder;
    font-size: 25px;
    margin: 10px 10px;
    text-decoration: none;
  }
  .post_img .post_hover a i:hover{
    color: red;
  }
  .post_img:hover > .post_hover{
    display: block;
  }

  .profile {
      -webkit-animation: popUp ease-in-out 350ms;
      animation: popUp ease-in-out 350ms;
      background: #ffffff;
      border-radius: 25px;
      margin-top: 20px;
      padding: 28px 30px 41px 35px;
      position: relative;
      width: 100%;
  }
  .profile__account {
    align-self: center;
    /* display: flex; */
    flex: 1;
    justify-content: flex-start;
    padding-left: 145px;
  }
  .profile__button {
      border-radius: 30px;
      border: 1px solid #000000;
      color: #000000;
      /* display: block; */
      font-family: "Montserrat", sans-serif;
      font-size: 13px;
      margin-right: 15px;
      padding: 14px 30px;
      text-align: center;
      text-decoration: none;
      /* transition: ease-in-out 250ms background, ease-in-out 250ms color; */
  }
  .profile__button:hover {
    background: #000000;
    color: #ffffff;
  }
  .profile__edit {
    flex: none;
    margin-left: 30px;
    display: flex;
  }
  .profile__header {
      display: flex;
      margin-bottom: 20px;
      margin-top: 30px;
  }
  .profile__icon {
    flex: none;
    font-size: 1.5em;
    margin-right: 10px;
    padding-top: 3px;
  }
  .profile__icon--gold {
    color: #eab100;
  }
  .profile__icon--blue {
    color: #8faae8;
  }
  .profile__icon--pink {
    color: #ff86af;
  }
  .profile__key {
    font-family: "Montserrat", sans-serif;
    font-size: 13px;
    font-weight: 400;
    text-align: center;
  }
  .profile__picture {
      background: #ffffff;
      border-radius: 100px;
      border: 10px solid #ffffff;
      height: 125px;
      position: absolute;
      top: 22px;
      width: 125px;
  }
  .profile__picture:before {
    border-radius: 100px;
    box-shadow: 0 0 40px 0px rgba(0, 0, 0, 0.17);
    content: "";
    height: calc(100% + 20px);
    left: -10px;
    position: absolute;
    top: -10px;
    width: calc(100% + 20px);
    z-index: -1;
  }
  .profile__picture img {
    border-radius: 100px;
    height: 100%;
    width: 100%;
  }
  .profile__stat {
    -webkit-animation: slideUp ease-in-out 350ms forwards;
            animation: slideUp ease-in-out 350ms forwards;
    border-right: 1px solid #e9e9e9;
    display: flex;
    flex: 1;
    justify-content: center;
    opacity: 0;
    padding: 10px 4px;
    transform: translateY(5px);
  }
  .profile__stat:last-of-type {
    border-right: none;
  }
  .profile__stat:nth-child(1) {
    -webkit-animation-delay: 400ms;
            animation-delay: 400ms;
  }
  .profile__stat:nth-child(2) {
    -webkit-animation-delay: 500ms;
            animation-delay: 500ms;
  }
  .profile__stat:nth-child(3) {
    -webkit-animation-delay: 600ms;
            animation-delay: 600ms;
  }
  .profile__stats {
    display: flex;
  }
  .profile__username {
    font-family: "Montserrat", sans-serif;
    font-weight: 600;
    margin: 0;

    /* text-align: right; */
  }
  .profile__value {
    font-family: "Montserrat", sans-serif;
    font-size: 28px;
    font-weight: 700;
    text-align: center;
  }
</style>

</body>
</html>
