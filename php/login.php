<?php
    include "connection.php";
    if (isset($_POST["email"]) and isset($_POST["password"])){
        $email = $_POST["email"];
        $password = $_POST['password'];
        
        $query = "SELECT * FROM `users` WHERE email='$email'";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

        if ($count == 1 & password_verify($password, $row["password"])){
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $row["username"];
            $_SESSION['id'] = $row["ID"];
            header('Location: ../index.php');
        }
        else{
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login Error</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/5afa712fd6.js"></script>
        <link rel="stylesheet" href="../css/errorpages.css">
        <link rel="stylesheet" href="../css/navbar.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="flex-grow-1">
                    <a class="navbar-brand" href="#">SmartPolitics</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- <ul class="navbar-nav mr-auto"></ul> -->
                    <div class="flex-grow-2">
                        <form class="form-inline">
                            <div class="mx-lg-0 searchbar">
                                <input class="form-control my-1" id="search" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-info ml-1 my-1" id="button" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <?php 
                        if(isset($_SESSION['email'])){
                    ?>
                    <form method="post" action="logout.php" class="form-inline my-2 my-lg-0 ml-auto">
                        <button class="btn btn-outline-info my-1 mr-1" id="login" type="submit">Log out</button>
                    </form>
                    <?php
                        }else{
                    ?>
                    <form class="form-inline my-2 login my-lg-0 ml-auto">
                        <button class="btn btn-outline-info my-1 mr-1" id="login" type="button" data-toggle="modal" data-target="#loginmodal">Log in</button>
                        <button class="btn btn-info my-1 my-sm-0 ml-1" id="register" type="button" data-toggle="modal" data-target="#registermodal">Register</button>
                    </form>
                    <?php
                        }
                    ?>
                </div>
            </nav>

            <div class="modal fade" role="dialog" id="loginmodal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Login</h3>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="login.php">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-info" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info">Sign In</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" role="dialog" id="registermodal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Register</h3>
                        </div>
                        <div id="registerbody" class="modal-body">
                            <form method="post" action="registration.php">
                                <div class="form-group">
                                    <input id="email" type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input id="username" type="text" name="username" class="form-control" placeholder="Name" required>
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="closebtn" class="btn btn-outline-info" data-dismiss="modal">Close</button>
                            <button type="submit" id="registerbtn" class="btn btn-info">Register</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="errorjumbo" class="jumbotron">
                    <div class="container">
                    <h1 class="display-4">Login Unsuccessfull</h1>
                    <p class="lead">Incorrect Credentials</p>
                    <hr class="my-4">
                    <p>The email or password was incorrect, If you dont have an account please register and you will be granted access</p>
                </div>        
            </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src ="../js/verify.js"></script>
    </body>
</html>
<?php }} ?>