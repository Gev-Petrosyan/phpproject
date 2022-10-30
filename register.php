<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Sign up</title>
</head>
<body>
    
    <header>
        <div class="container">
            <div class="row">
                <form action="php/sign-up.php" method="post">
                    <center>
                        <h2>Sign up</h2>
                        <div class="input-group group-one mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                            <input type="text" class="form-control" autocomplete='off' placeholder="Username" name="username">
                        </div>
                        <div class="input-group group-two mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <div class="input-group group-two mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" class="form-control" placeholder="Confirm Password"  name="confirm-password">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i style="font-size: 19px;" class="fa-solid fa-mars-and-venus"></i></span>
                            <select class="form-select" id="inputGroupSelect03" aria-label="Example select with button addon" name="gender">
                              <option selected>Gender</option>
                              <option value="male">Male</option>
                              <option value="female">Female</option>
                            </select>
                          </div>
                          <div class="input-group group-two mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-key"></i></span>
                            <input type="text" class="form-control" autocomplete='off' placeholder="Key code"  name="key-code">
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
                        <button type="submit" class="btn btn-primary" name="submit">Sign up</button>
                        <div class="regsiter-a">
                            <p>If you have already registered, Sign in <a href="index.php">here</a></p>
                        </div>
                    </center>
                </form>
            </div>
        </div>
    </header>
    
    <script src="https://kit.fontawesome.com/ba53ee2513.js" crossorigin="anonymous"></script>
</body>
</html>