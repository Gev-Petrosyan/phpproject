<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/layout.css">
    <link rel="stylesheet" href="../../css/message.css">
    <title>Messager</title>
</head>
<body>

  <?php

    session_start();

    if ($_SESSION["username"] == null) {
      header("location: ../../index.php");
    }
    else if ($_GET["id"] === $_SESSION["id"]) {
      header("location: ../../home.php");
    }
    else if (empty($_GET["id"])) {
      header("location: ../../index.php");
    }
    else {
      $username = $_SESSION["username"];
      $password = $_SESSION["password"];

      include "../database.php";
      $result = $conn->query("SELECT * FROM users WHERE username='$username'");
      $row = $result->fetch_assoc();
      $id = $row["id"];
      $gender = $row["gender"];
      $level = $row["level"];
      $image = $row["image"];

      if ($image == "" && $gender == "male") {
        $myImage = "userPhotoOne.png";
      }
      else if ($image == "" && $gender == "female") {
        $myImage = "userPhotoTwo.png";
      }
      else if ($image != "") {
        $myImage = $image;
      }

      $id_chat = $_GET["id"];
      $result1 = $conn->query("SELECT * FROM users WHERE id='$id_chat'");
      $row1 = $result1->fetch_assoc();
      $username_chat = $row1["username"];
      $gender_chat = $row1["gender"];
      $level_chat = $row1["level"];
      $image_chatTwo = $row1["image"];

      if ($image_chatTwo == "" && $gender_chat == "male") {
        $image_chat = "userPhotoOne.png";
      }
      else if ($image_chatTwo == "" && $gender_chat == "female") {
        $image_chat = "userPhotoTwo.png";
      }
      else if ($image_chatTwo != "") {
        $image_chat = $image_chatTwo;
      }

    }

  ?>

    <header>
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-light bg-light fixed-top" style="background: transparent !important;">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#"></a>
                      <button class="navbar-toggler navabar-button" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" style="border: none;">
                         <i class="fa-solid fa-bars-staggered" style="color: #518aff; font-size: 35px;"></i>
                      </button>
                      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                          <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><?php echo $username ?></h5>
                          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="../../home.php">Home</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="../users/allUsers.php">All users</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="../list/addList.php">Add new list</a>
                            </li>
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                All lists
                              </a>
                              <ul class="dropdown-menu list-menu" aria-labelledby="offcanvasNavbarDropdown">
                                <div class="input-group mb-3" style="width: 95%; margin-left: 2.5%;">
                                  <input type="search" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2">
                                </div>
                                <?php
                                  include "../database.php";
                                  $result1 = $conn->query("SELECT * FROM lists");
                                  
                                  while ($row1 = $result1->fetch_assoc()) {
                                    $idList = $row1["id"];
                                    $nameList = $row1["name"];
                                    $dateList = $row1["date"];?>
                                    <li class="list-menu-li"><a class="dropdown-item" href="../list/list.php?id=<?php echo $idList ?>"><?php echo $nameList ?>: <?php echo $dateList ?></a>
                                    <a class="dropdown-item" href="../list/deleteList.php?id=<?php echo $idList ?>" style="width: 50px; height: 32px; align-items: center; justify-content: center; display: flex;"><i class="fa-solid fa-trash"></i></a></li>
                                <?php } ?>
                              </ul>
                            </li>
                            <?php
                              if ($level === "admin") {?>
                                <li class="nav-item dropdown">
                                  <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Admin panel
                                  </a>
                                  <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                                    <li><a class="dropdown-item" href="../admin/add-key.php">Add new key code</a></li>
                                    <li><a class="dropdown-item" href="../admin/activeKey.php">Active key codes</a></li>
                                  </ul>
                                </li>
                              <?php } ?>
                            <li class="nav-item">
                              <a class="nav-link" href="../sign-out.php">Sign out</a>
                            </li>
                            <li class="author">
                              All Rights Reserved © 2022 Designed and Coding By <a href="https://gevorg-programmer.github.io/CV-GevorgPetrosyan/" target="_blank">Gevorg Petrosyan</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </nav>
            </div>
        </div>
    </header>
    <section>
    <main>
       <div class="container1">
           <div class="chate">
               <div class="chate-header">
                   <div class="header-content">
                   <div class="sender-avatar">
                      <a href="../users/profileUser.php?id=<?php echo $id_chat ?>"><img style="border-radius: 100%;" src="../../image/<?php echo $image_chat ?>" width="50px" height="50px" alt=""></a>
                   </div>
                   <div class="sender-action">
                       <h3><?php echo $username_chat ?></h3>
                       <span><?php echo $level_chat ?></span>
                   </div>
                   <div class="icons">
                   </div>
                </div>
               </div>
               <div class="chate-body">
                <?php
                  include "../database.php";
                  $message = $conn->query("SELECT * FROM messages WHERE sender_message='$username' AND receiver_message='$username_chat' OR
                                           sender_message='$username_chat' AND receiver_message='$username'");
                  while ($messageRow = $message->fetch_assoc()) {
                     if ($messageRow["sender_message"] == $username) {?>
                      <div class="message-sender">
                          <div class="message-sender-avatar">
                              <img src="../../image/<?php echo $myImage ?>" width="50px" alt="">
                          </div>
                          <div class="message-sender-message">
                              <p style="margin-bottom: 0px;"><?php echo $messageRow["message"] ?></p>
                          </div>
                      </div>
                <?php } else {?>
                      <div class="message-recever">
                        <div class="message-sender-avatar">
                            <img src="../../image/<?php echo $image_chat ?>" width="50px" alt="">
                        </div>
                        <div class="message-sender-message rece">
                            <p style="margin-bottom: 0px;"><?php echo $messageRow["message"] ?></p>
                        </div>
                    </div>
                <?php }} ?>
                </div>
                <div class="message-box">
                    <div class="message-box-aria">
                        <form action="messageAction.php" method="post">
                          <input type="hidden" name="id_chat" value="<?php echo $id_chat ?>">
                          <input type="hidden" name="sender_message" value="<?php echo $username ?>">
                          <input type="hidden" name="receiver_message" value="<?php echo $username_chat ?>">
                          <input type="text" placeholder="Type a message..." autocomplete="off" name="message">
                          <button type="submit" class="btn" name="send"><i class="fa-solid fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
               </div>
           </div>
       </div>
   </main>
    </section>

    
    <script src="https://kit.fontawesome.com/ba53ee2513.js" crossorigin="anonymous"></script>
    <script src="../../js/jquery-3.6.0.min.js"></script>
    <script src="../../js/searchList.js"></script>
</body>
</html>