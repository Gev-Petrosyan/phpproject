<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/changePhoto.css">
    <title>changing</title>
</head>
<body>

  <?php

    session_start();

    if ($_SESSION["username"] == null) {
      header("location: ./index.php");
    }
    else {
      $username = $_SESSION["username"];
      $password = $_SESSION["password"];

      include "../database.php";
      $result = $conn->query("SELECT * FROM users WHERE username='$username'");
      $row = $result->fetch_assoc();
      $_SESSION["id"] = $row["id"];
      $id = $row["id"];
      $gender = $row["gender"];
      $_SESSION["level"] = $row["level"];
      $level = $row["level"];
      $image = $row["image"];

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
                              <a class="nav-link" href="#">Add new list</a>
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
                          <a href="../../home.php"><i class="fa-solid fa-arrow-left"></i></a>
                      </div>
                      <div class="profile-information-userImage">
                          <?php if ($gender == "male" && $image == "") { ?>
                            <img src="../../image/userPhotoOne.png" alt="">
                          <?php } ?>
                          <?php if ($gender == "female" && $image == "") { ?>
                            <img src="../../image/userPhotoTwo.png" alt="">
                          <?php } ?>
                          <?php if (!$image == "") { ?>
                            <img src="../../image/<?php echo $image ?>" alt="">
                          <?php } ?>
                      </div>
                  </div>
                  <div class="all-profile-information col-md-7">
                       <div class="form col-12">
                            <form action="changePhotoAction.php" method="post" enctype="multipart/form-data">
                                <center>
                                    <h2>Changing photo...</h2>
                                    <div class="input-group group-two mb-3">
                                        <input class="form-control" type="file" id="formFileMultiple" name="file" accept="image/*" multiple>
                                    </div>
                                    <div class="errors">
                                        <?php
                                            if (isset($_GET["error"])) {
                                                $error = $_GET["error"];
                                        ?>
                                            <p class="error-text"><?php echo $error ?></p>
                                        <?php } ?>
                                        <?php
                                            if (isset($_GET["alert"])) {
                                                $alert = $_GET["alert"];
                                        ?>
                                            <p class="error-text" style="color: green;"><?php echo $alert ?></p>
                                        <?php } ?>
                                    </div>
                                    <button type="submit" name="change" class="btn btn-primary">Change</button>
                                </center>
                            </form>
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