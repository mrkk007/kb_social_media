<?php
session_start();
if(!isset($_SESSION["User_name"])){
  header("location: http://localhost/kb_Social_Media/index.php");
}

include "Function.php";
$userName = $_SESSION["User_name"];
$userId = $_SESSION["User_id"];
$result = dbSelectTableData("users","*","User_name = '{$userName}'");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>♛_𝕶𝖍𝖚𝖘𝖍𝖆𝖑 𝖇𝖆𝖗𝖆𝖎𝖞𝖆_♛</title>
      <!-- BootStrap -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
      <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
      <!-- Font Awesome -->
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  </head>
<body>

<div class="container">
<div class="profile-page tx-13">

<?php
if(mysqli_num_rows($result) > 0){
  while ($row = mysqli_fetch_assoc($result)) {
?>

<!-- Header Start -->
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="profile-header">
        <div class="cover">
          <div class="gray-shade"></div>
            <figure>
              <img src="https://bootdey.com/img/Content/bg1.jpg" class="img-fluid" alt="profile cover">
            </figure>
            <div class="cover-body d-flex justify-content-between align-items-center">
            <div class="UserInfo">
              <?php
                if(!empty($row['Profile_img']) && isset($row['Profile_img']) && $row['Profile_img'] != NULL){
                  echo "<img class='profile-pic' src='./Images/". $row['Profile_img'] ."' alt='profile'>";
                }
                else{
                  echo "<img class='profile-pic' src='./Images/NoProfile.jpg' alt='profile'>";
                }
              ?>
              <div class="UserInfoName">
                <b><?php echo $row["First_name"]; ?> <?php echo $row["Last_name"]; ?></b>
                <p class="user_name"><?php echo $row["User_name"]; ?></p>
              </div>
            </div>
            <div class="d-none d-md-block">
              <a href="UserProfile.php" class="btn btn-primary btn-icon-text btn-edit-profile">
                View profile
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- Header End -->

<!-- Body Start -->
<div class="row profile-body">


    <div class="col-lg-3 col-md-3 col-sm-4">
      <div class="panel rounded shadow">
        <div class="panel-body">
          <div class="inner-all">
            <ul class="list-unstyled">
              <li><br></li>
              <li class="text-center">
              <?php
                if(!empty($row['Profile_img']) && isset($row['Profile_img']) && $row['Profile_img'] != NULL){
                  echo "<img class='img-circle img-responsive img-bordered-primary' src='./Images/". $row['Profile_img'] ."' alt='profile'>";
                }
                else{
                  echo "<img class='img-circle img-responsive img-bordered-primary' src='./Images/NoProfile.jpg' alt='profile'>";
                }
              ?>
              </li>
              <li class="text-center">
                <h4 class="text-capitalize"><?php echo $row['First_name'] ." ". $row["Last_name"]; ?></h4>
                <p class="text-muted text-capitalize"><?php echo $row["User_name"]; ?></p>
              </li>

              <li>
                <li class="list-group-item"><i class="fa fa-globe mr-5"></i> <?php echo $row["Email"]; ?></li>
                <li class="list-group-item"><i class="fa fa-phone mr-5"></i> <?php echo $row["Number"]; ?></li>
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


<div class="col-md-8 col-xl-6 middle-wrapper">
  <div class="row">

    <?php
$UserFrinds = dbSelectTableData("users","*","User_name = '{$userName}'");
if(mysqli_num_rows($UserFrinds) > 0){
  while ($fr = mysqli_fetch_assoc($UserFrinds)){
    $NewFr = $fr['Friends'];
    if(!empty($NewFr) && $NewFr != NULL){
      $allfr = explode(',',trim($NewFr, ","));
      foreach($allfr as $UserFrId){
        $post_result = mysqli_query($conn,"SELECT * FROM post WHERE PostUserId = '{$UserFrId}' ORDER BY post.p_id DESC");
        if(mysqli_num_rows($post_result) > 0){
          while ($AllFrPost = mysqli_fetch_assoc($post_result)){
          $PostUser = $AllFrPost['PostUserId'];
          $PostUserResult = dbSelectTableData("users","*","User_id = '{$PostUser}'");
  ?>
    <div class="col-md-12 grid-margin">
      <div class="card rounded">
        <div class="card-header">
          <?php
            if(mysqli_num_rows($PostUserResult) > 0){
              while ($PostUserInfo = mysqli_fetch_assoc($PostUserResult)) {
          ?>
          <div class="d-flex align-items-center justify-content-between">
            <a href="FrProfile.php?OtherUserId=<?php echo $PostUserInfo['User_id']; ?>" class="d-flex align-items-center">
              <?php
                if(!empty($PostUserInfo['Profile_img']) && $PostUserInfo['Profile_img'] != NULL){
                  echo "<img class='img-xs rounded-circle' src='./Images/". $PostUserInfo['Profile_img'] ."' alt='profile'>";
                }
                else{
                  echo "<img class='img-xs rounded-circle' src='./Images/NoProfile.jpg' alt='profile'>";
                }
              ?>
              <div class="ml-2">
                <p class="PostUser"><?php echo $PostUserInfo['User_name']; ?></p>
                <p class="tx-11 text-muted"><?php echo $AllFrPost['post_DateTime']; ?></p>
              </div>
            </a>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-lg pb-3px">
                  <circle cx="12" cy="12" r="1"></circle>
                  <circle cx="19" cy="12" r="1"></circle>
                  <circle cx="5" cy="12" r="1"></circle>
                </svg>
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                <a class="dropdown-item d-flex align-items-center" href="#"><span class="">View Profile</span></a>
              </div>
            </div>
          </div>
          <?php
              }
            }
          ?>
        </div>
        <div class="card-body">
          <img class="img-fluid" src="./Images/<?php echo $AllFrPost['post_img']; ?>" alt="" width="100%">
        </div>
        <div class="card-footer">
          <div class="d-flex post-actions justify-content-between">
            <a href="Like.php?id=<?php echo $AllFrPost['p_id']; ?>" class="d-flex align-items-center text-muted mx-3">
              <p class="d-none d-md-block"><i class="fa fa-heart"></i> <?php echo $AllFrPost['p_like']; ?> Like</p>
            </a>
          </div>

          <div class="comment">
            <a href="#" class="d-flex align-items-center text-muted mx-3"><p class="d-none d-md-block">Comment</p></a>

            <?php
              $CommResult = mysqli_query($conn,"SELECT * FROM postcomment WHERE PostId = {$AllFrPost['p_id']} ORDER BY postcomment.cId DESC");
              if(mysqli_num_rows($CommResult) > 0){
                while ($comm = mysqli_fetch_assoc($CommResult)) {
                $commUserId = $comm['CommUserId'];
                $CommUserResult = dbSelectTableData("users","*","User_id = '{$commUserId}'");
                  if(mysqli_num_rows($CommUserResult) > 0){
                    while ($commUserInfo = mysqli_fetch_assoc($CommUserResult)) {
            ?>
            <div class="commbody">
              <div class="arrow">
                <div class="outer"></div>
                <div class="inner"></div>
              </div>
              <div class="message-body">
                <a href="FrProfile.php?OtherUserId=<?php echo $commUserInfo['User_id']; ?>">
                  <?php
                    if(!empty($commUserInfo['Profile_img']) && $commUserInfo['Profile_img'] != NULL){
                      echo "<img class='img-xs rounded-circle' src='./Images/". $commUserInfo['Profile_img'] ."' alt='profile'>";
                    }
                    else{
                      echo "<img class='img-xs rounded-circle' src='./Images/NoProfile.jpg' alt='profile'>";
                    }
                  ?>
                  <div class="CommMessage">
                    <b><?php echo $commUserInfo['User_name']; ?></b>
                </a>
                    <p><?php  echo $comm['Comment']; ?></p>
                  </div>
              </div>
            </div>
            <?php
                    }
                  }
                }
              }
            ?>

            <div class="AddComm">
              <form action="AddComment.php" method="post">
                <input type="hidden" name="commUserId" value="<?php echo $userId; ?>">
                <input type="hidden" name="PostId" value="<?php echo $AllFrPost['p_id']; ?>">
                <input type="text" placeholder="Add Your Comment" name="ComValue">
                <button type="submit" class="add_btn" name="AddComm" value="">Add</button>
              </form>
            </div>

          </div>






        </div>
      </div>
    </div>
  <?php
              }
            }
          }
        }
        else {
        echo "<h2> Not Availbale Friend </h2>";
        }
      }
    }
  ?>
  </div>
</div>




<div class="d-none d-xl-block col-xl-3 right-wrapper">

  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card rounded">
        <div class="search_form card">
          <div class="card-body">
            <h4 class="serchHead">SEARCH</h4>
            <form class="" action="Search.php" method="post">
              <input type="text" name="SerchName" placeholder="Search from here..." required>
              <button type="submit" name="sercSubmit" class="anccor"><i class="fa fa-search"></i></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card rounded">
        <div class="card-body">
          <h4 class="serchHead">FRIENDS</h4>
          <?php

                    $UserFrinds = dbSelectTableData("users","*","User_name = '{$userName}'");
                    if(mysqli_num_rows($UserFrinds) > 0){
                      while ($OldFr = mysqli_fetch_assoc($UserFrinds)){
                        $FriendS = $OldFr['Friends'];
                        $FriendS = trim($FriendS, ",");
                        $allfr = explode(',',$FriendS);

                          $AllUser = dbSelectTableData("users","*","NOT User_name = '{$userName}'");
                        if(mysqli_num_rows($AllUser) > 0){
                          while ($FrRow = mysqli_fetch_assoc($AllUser)) {

                            if(in_array($FrRow['User_id'],$allfr)){
                              continue;
                            }else {

          ?>

            <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
              <a href="FrProfile.php?OtherUserId=<?php echo $FrRow["User_id"]; ?>" class="d-flex align-items-center hover-pointer">
                <?php
                  if(!empty($FrRow['Profile_img']) && $FrRow['Profile_img'] != NULL){
                    echo "<img class='img-xs rounded-circle' src='./Images/". $FrRow['Profile_img'] ."' alt='profile'>";
                  }
                  else{
                    echo "<img class='img-xs rounded-circle' src='./Images/NoProfile.jpg' alt='profile'>";
                  }
                ?>
                <div class="ml-2">
                  <p class="PostUser"><?php echo $FrRow["First_name"]; ?> <?php echo $FrRow["Last_name"]; ?></p>
                  <p class="tx-11 text-muted"><?php echo $FrRow["User_name"]; ?></p>
                </div>
              </a>
              <button class="btn btn-icon">
                <a href="AddFeind.php?id=<?php echo $FrRow["User_id"]; ?>&UserName=<?php echo $userName; ?>">
                  <i class="fa fa-user-plus"></i>
                </a>
              </button>
            </div>

          <?php
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
<!-- Body End -->

</div>
</div>

<style type="text/css">


body{
    background-color: #f9fafb;
    margin-top:20px;
  }

.serchHead{
  border-left:3px solid blue;
  padding: 4px;
  padding-left: 8px;
  margin-top: 10px;
  margin-bottom: 18px;
}


  /* Message box starts here */
  .commbody {
    clear: both;
    position: relative;
  }

  .commbody .arrow {
    width: 12px;
    height: 20px;
    overflow: hidden;
    position: relative;
    float: left;
    top: 6px;
    right: -1px;
  }

  .commbody .arrow .outer {
    width: 0;
    height: 0;
    border-right: 20px solid #000000;
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    position: absolute;
    top: 0;
    left: 0;
  }

  .commbody .arrow .inner {
    width: 0;
    height: 0;
    border-right: 20px solid #ffffff;
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    position: absolute;
    top: 0;
    left: 2px;
  }

  .commbody .message-body {
    float: left;
    width: 90%;
    height: auto;
    border: 1px solid #CCC;
    background-color: #ffffff;
    border: 1px solid #000000;
    padding: 6px 8px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    -o-border-radius: 5px;
    border-radius: 5px;
    margin-bottom: 15px;
  }
  .commbody .message-body .CommMessage{
    margin: -35px 1px -13px 51px;
}

.AddComm form{
  margin-left: 10px;
  width: 90%;
  display: flex;
  justify-content: space-around;
}
.AddComm form input[type="text"]{
  width: 85%;
}
.AddComm form .add_btn{
  padding: 0px 20px;
}



.UserInfo {
    display: flex;
    align-items: center;
}
.UserInfo b{
    font-weight: 700;
    font-size: 30px;
}
.UserInfo p{
  font-size: 18px;
}
a:focus, a:hover {
    color: black;
    text-decoration: none;
}

p.PostUser {
      color: black;
    margin-bottom: 0px;
    font-size: 18px;
}
.UserInfoName{
  margin-left:30px;
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

.profile-page .profile-header {
    box-shadow: 0 0 10px 0 rgba(183, 192, 206, 0.2);
}

.profile-page .profile-header .cover {
    position: relative;
    border-radius: .25rem .25rem 0 0;
}


.profile-page .profile-header .cover figure {
    margin-bottom: 0;
}

.profile-page .profile-header .cover figure img {
    border-radius: .25rem .25rem 0 0;
    width: 100%;
    height: 200px;
}


.profile-page .profile-header .cover .gray-shade {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    background: linear-gradient(#d9dfff, #fff ,#d9dfff);
}

.profile-page .profile-header .cover .cover-body {
    position: absolute;
    bottom: 20px;
    left: 0;
    z-index: 2;
    width: 100%;
    padding: 0 20px;
}

.profile-page .profile-header .cover .cover-body .profile-pic {
    border-radius: 50%;
    width: 100px;
    height: 100px;
}

.profile-page .profile-header .cover .cover-body .profile-name {
    font-size: 20px;
    font-weight: 600;
    margin-left: 17px;
}

.profile-page .profile-header .header-links {
    padding: 15px;
    display: -webkit-flex;
    display: flex;
    -webkit-justify-content: center;
    justify-content: center;
    background: #fff;
    border-radius: 0 0 .25rem .25rem;
}

.profile-page .profile-header .header-links ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

.profile-page .profile-header .header-links ul li a {
    color: #000;
    -webkit-transition: all .2s ease;
    transition: all .2s ease;
}

.profile-page .profile-header .header-links ul li:hover,
.profile-page .profile-header .header-links ul li.active {
    color: #727cf5;
}

.profile-page .profile-header .header-links ul li:hover a,
.profile-page .profile-header .header-links ul li.active a {
    color: #727cf5;
}

.profile-page .profile-body .left-wrapper .social-links a {
    width: 30px;
    height: 30px;
}

.profile-page .profile-body .right-wrapper .latest-photos > .row {
    margin-right: 0;
    margin-left: 0;
}

.profile-page .profile-body .right-wrapper .latest-photos > .row > div {
    padding-left: 3px;
    padding-right: 3px;
}

.profile-page .profile-body .right-wrapper .latest-photos > .row > div figure {
    -webkit-transition: all .3s ease-in-out;
    transition: all .3s ease-in-out;
    margin-bottom: 6px;
}

.profile-page .profile-body .right-wrapper .latest-photos > .row > div figure:hover {
    -webkit-transform: scale(1.06);
    transform: scale(1.06);
}

.profile-page .profile-body .right-wrapper .latest-photos > .row > div figure img {
    border-radius: .25rem;
}

.rtl .profile-page .profile-header .cover .cover-body .profile-name {
    margin-left: 0;
    margin-right: 17px;
}
.img-xs {
    width: 37px;
    height: 37px;
}
.rounded-circle {
    border-radius: 50% !important;
}
img {
    vertical-align: middle;
    border-style: none;
}

.card-header:first-child {
    border-radius: 0 0 0 0;
}
.card-header {
    padding: 0.875rem 1.5rem;
    margin-bottom: 0;
    background-color: rgba(0, 0, 0, 0);
    border-bottom: 1px solid #f2f4f9;
}

.card-footer:last-child {
    border-radius: 0 0 0 0;
}
.card-footer {
    padding: 0.875rem 1.5rem;
    background-color: rgba(0, 0, 0, 0);
    border-top: 1px solid #f2f4f9;
}

.grid-margin {
    margin-bottom: 1rem;
}

.card {
    box-shadow: 0 0 10px 0 rgba(183, 192, 206, 0.2);
    -webkit-box-shadow: 0 0 10px 0 rgba(183, 192, 206, 0.2);
    -moz-box-shadow: 0 0 10px 0 rgba(183, 192, 206, 0.2);
    -ms-box-shadow: 0 0 10px 0 rgba(183, 192, 206, 0.2);
}
.rounded {
    border-radius: 0.25rem !important;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid #f2f4f9;
    border-radius: 0.25rem;
}

</style>

</body>
</html>
