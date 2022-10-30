<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/profileUser.css">
    <title>Profile</title>
</head>
<body>

  <?php

    session_start();

    if ($_SESSION["username"] == null || empty($_GET["id"])) {
        header("location: ../../home.php");
    }
    else if ($_GET["id"] === $_SESSION["id"]) {
        header("location: ../../home.php");
    }
    else {
        $username = $_SESSION["username"];
        $level = $_SESSION["level"];

        $profileId = $_GET["id"];
        include "../database.php";
        $result = $conn->query("SELECT * FROM users WHERE id='$profileId'");
        $row = $result->fetch_assoc();
        $profileUsername = $row["username"];
        $profileLevel = $row["level"];
        $profileGender = $row["gender"];
        $profileImage = $row["image"];
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
                              <a class="nav-link" href="allUsers.php">All users</a>
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
    <main>
        <section class="section-one">
              <div class="profile-image col-12"></div>
                <div class="profile-information fixed-top col-9">
                  <div class="col-md-5 profile-information-div">
                      <div class="profile-information-out">
                          <a href="../users/allUsers.php"><i class="fa-solid fa-arrow-left"></i></a>
                      </div>
                      <div class="profile-information-userImage">
                          <?php if ($profileGender == "male" && $profileImage == "") { ?>
                            <img src="../../image/userPhotoOne.png" alt="">
                          <?php } ?>
                          <?php if ($profileGender == "female" && $profileImage == "") { ?>
                            <img src="../../image/userPhotoTwo.png" alt="">
                          <?php } ?>
                          <?php if (!$profileImage == "") { ?>
                            <img src="../../image/<?php echo $profileImage ?>" alt="">
                          <?php } ?>
                      </div>
                  </div>
                  <div class="all-profile-information col-md-7">
                    <div class="profile-information-user col-12">
                        <h2><?php echo $profileUsername ?></h2>
                        <p><?php echo $profileLevel ?></p>
                    </div>
                      <div class="profile-information-button col-12">
                          <a class="btn col-3" href="../messages/message.php?id=<?php echo $profileId ?>">Message to <?php echo $profileUsername ?></a>
                      </div>
                      <div class="profile-information-user">
                        <h3>Information</h3>
                          <div class="ul col-md-12">
                              <div class="col-5">
                                  <p>Id user:</p>
                              </div>
                              <div class="col-7">
                                  <p><?php echo $profileId ?></p>
                              </div>
                          </div>
                          <div class="ul col-md-12">
                              <div class="col-5">
                                  <p>Username:</p>
                              </div>
                              <div class="col-7">
                                  <p><?php echo $profileUsername ?></p>
                              </div>
                          </div>
                          <div class="ul col-md-12">
                              <div class="col-5">
                                  <p>Level:</p>
                              </div>
                              <div class="col-7">
                                  <p><?php echo $profileLevel ?></p>
                              </div>
                          </div>
                          <div class="ul col-md-12">
                              <div class="col-5">
                                  <p>Gender:</p>
                              </div>
                              <div class="col-7">
                                  <p><?php echo $profileGender ?></p>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
        </section>
    </main>

    <script src="https://kit.fontawesome.com/ba53ee2513.js" crossorigin="anonymous"></script>
    <script src="../../js/jquery-3.6.0.min.js"></script>
    <script src="../../js/searchList.js"></script>
</body>
</html>