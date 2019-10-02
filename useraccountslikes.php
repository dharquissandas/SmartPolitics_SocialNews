<?php
    include "php/connection.php";
    session_start();

    $id = $_GET['id'];
    $emailquery = "SELECT username, email FROM users WHERE ID='$id'";
    $emailq = mysqli_query($conn, $emailquery) or die(mysqli_error($conn));
    $email = mysqli_fetch_assoc($emailq);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/posts.css">
    <title>SmartPolitics | My Account</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="flex-grow-1">
                <a class="navbar-brand" href="index.php">SmartPolitics</a>
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
                    if(isset($_SESSION['id'])){
                ?>
                <form method="post" action="php/logout.php" class="form-inline my-2 my-lg-0 ml-auto">
                    <button class="btn btn-outline-info my-1 mr-1" id="home" type="button">Home</button>
                    <button class="btn btn-info my-1 mr-1" id="login" type="submit">Log out</button>
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
                    <form method="post" action="php/login.php">
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
                    <form method="post" action="php/registration.php">
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

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4"><?php echo $email['username']; ?></h1>
            <hr>
            <p class="lead">Email Account: <?php echo $email['email']; ?> </p>
                <?php
                    if(isset($_SESSION["id"])){
                    $userid = $_SESSION["id"];
                    $query = "SELECT followingid FROM followers WHERE userid = '$userid' AND followingid = '$id'";
                    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                    if($result->num_rows != 1){
                ?>
                <form method="post" action="php/follow.php">
                    <input type="hidden" name="followingid" id="followingid" value="<?php echo $id; ?>" />
                    <button type="submit" id="registerbtn" class="btn btn-info"><i class="fas fa-user-friends"></i>  Follow</button>
                </form>
                <?php }else{ ?>
                <form method="post" action="php/unfollow.php">
                    <input type="hidden" name="followingid" id="followingid" value="<?php echo $id; ?>" />
                    <button type="submit" id="registerbtn" class="btn btn-outline-success"><i class="fas fa-check"></i>  Following</button>
                </form>
            <?php }} ?>
        </div>
    </div>

    <div class="container">
        <button onclick="location.href='useraccountsallposts.php?id=<?php echo $id; ?>'" type="button" class="btn btn-primary mb-2">All Posts</button>
        <button onclick="location.href='useraccountsownposts.php?id=<?php echo $id; ?>'"  type="button" class="btn btn-primary mb-2">My Posts</button>
        <button onclick="location.href='useraccountscomments.php?id=<?php echo $id; ?>'"  type="button" class="btn btn-primary mb-2">Comments</button>
        <button onclick="location.href='useraccountslikes.php?id=<?php echo $id; ?>'"  type="button" class="btn btn-primary mb-2" disabled>Likes</button>
        <h1 class="my-4">Likes</h1>
        <div class="row">
            <div class="col-md-8">
                <?php
                    $query =  "SELECT ID, title, topic, post, timestamp, upvotes, userid FROM entries WHERE userid  ='$id'";
                    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                    while($row = $result->fetch_assoc()){
                        ?>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h2 class="card-title"><?php echo $row['title']; ?> <br> <small><?php echo $row['topic']; ?></small> </h2>
                                <p class="card-text"><?php echo $row['post']; ?></p>
                                <a href="" class="btn btn-primary"><i class="fas fa-share"></i>  Share</a>  
                            <a href="<?php echo 'comments.php?id='.$row['ID'].'';?>" class="btn btn-primary"><i class="fas fa-comments"></i>  Comments</a>
                                
                            </div>
                            <div class="card-footer text-muted">
                                <div class="footer-text">
                                    <?php 
                                    date_default_timezone_set('UTC'); ?>
                                    Posted on <?php echo date('jS F Y, G:i e', $row['timestamp']); ?> by
                                    <a href="<?php echo 'useraccounts.php?id='.$row['ID'].'';?>"><?php echo $email['email']; ?></a>
                                </div>
                                <div class="voting">
                                    <?php
                                        if(isset($_SESSION['email'])){
                                        ?>
                                        <a href="#" class="fa fa-chevron-circle-up"></a>
                                        <a href="#" class="fa fa-chevron-circle-down"></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                <?php } ?>
            </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <h5 class="card-header">Achievements</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <p>Following:</p>
                                </li>
                                <li>
                                    <p>Followers:</p>
                                </li>
                                <li>
                                    <p>Total Upvotes:</p>
                                </li>
                                <li>
                                    <p>Total Posts:</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src ="js/verify.js"></script>
        <script src="js/redirects.js"></script>
        <script src="https://kit.fontawesome.com/5afa712fd6.js"></script>
</body>
</html>