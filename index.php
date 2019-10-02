<?php
    include "php/connection.php";
    session_start();
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/posts.css">
        <title>SmartPolitics</title>
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
                    if(isset($_SESSION['id'])){
                ?>
                <form method="post" action="php/logout.php" class="form-inline my-2 my-lg-0 ml-auto">
                    <button class="btn btn-outline-info my-1 mr-1" id="account" type="button">My Account</button>
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

        <div class="jumbotron py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="display-4">Timeline</h1>
                        <p class="lead">Current Topics & Discussions</p>
                        <?php if(isset($_SESSION["id"])){ ?>
                        <div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sort
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="index.php">Recent</a>
                                <a class="dropdown-item" href="timeline.php">Timeline</a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php
                         if(isset($_SESSION['id'])){
                    ?>
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="php/addpost.php" method="post">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Title:</label>
                                        <input type="text" class="form-control" name="title" placeholder="Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Topic:</label>
                                        <input type="text" class="form-control" name="topic" placeholder="Topic">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Start Your Discussion Here:</label>
                                        <textarea class="form-control" name="posttext" placeholder="Discussion" rows="3"></textarea>
                                    </div>
                                    <button class="btn btn-info" id="post" type="submit">Post</button>
                                </form>    
                            </div>
                        </div>
                    <?php } ?>

                    <?php
                        $query = 'SELECT ID, title, topic, post, timestamp, upvotes, userid, likes FROM entries ORDER BY ID DESC';
                        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                        while($row = $result->fetch_assoc()){
                    ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="card-title"><?php echo $row['title']; ?> <br> <small><?php echo $row['topic']; ?></small> </h2>
                            <p class="card-text"><?php echo $row['post']; ?></p>
                            <a href="" class="btn btn-primary"><i class="fas fa-share"></i>  Share</a>  
                            <a href="<?php echo 'comments.php?id='.$row['ID'].'';?>" class="btn btn-primary"><i class="fas fa-comments"></i>  Comments</a>
                            <?php
                                if(isset($_SESSION['id']) && $_SESSION["id"] != $row["userid"]){
                            ?>
                            <button class="btn btn-primary like<?php echo $row['ID'];?>" name="like" type="button"><i class="fas fa-plus"></i>  Like</button>
                            <?php
                                }else{
                                ?>
                                    <button class="btn btn-primary like<?php echo $row['ID'];?>" name="like" type="button" disabled 
                                    <?php if(isset($_SESSION['id'])){?>
                                        title="You cant like your own post"
                                    <?php } else{ ?>
                                        title="You need to be logged in to like"
                                    <?php } ?>
                                    ><i class="fas fa-thumbs-up"></i>  Like</button>
                                <?php
                                }
                            ?>

                        </div>
                        <div class="card-footer text-muted">
                            <div class="footer-text">
                                <?php 
                                date_default_timezone_set('UTC'); ?>
                                Posted on <?php echo date('jS F Y, G:i e', $row['timestamp']); ?> by
                                <?php
                                    $posterid = $row['userid'];
                                    $emailquery = "SELECT email FROM users WHERE ID='$posterid'";
                                    $emailq = mysqli_query($conn, $emailquery) or die(mysqli_error($conn));
                                    $email = mysqli_fetch_assoc($emailq);
                                ?>

                                <?php
                                    if(isset($_SESSION["email"]) && $_SESSION["email"]  == $email['email']){ 
                                ?>
                                        <?php echo $email['email']; ?>
                                <?php
                                    }
                                    else{
                                ?>
                                    <a href="<?php echo 'useraccountsallposts.php?id='.$posterid.'';?>"><?php echo $email['email']; ?></a>
                                <?php        
                                    }
                                ?>
                                <span class="likescounter<?php echo $row['ID'];?>"> likes: <?php echo $row['likes']; ?> </span>

                            </div>
                            <div class="voting">
                                <?php
                                    if(isset($_SESSION['id'])){
                                    ?>
                                    <a href="#" class="fa fa-chevron-circle-up"></a>
                                    <a href="#" class="fa fa-chevron-circle-down"></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <script> 
                            $('.like<?php echo $row['ID'];?>').click(function() {
                                $.ajax({
                                type: "POST",
                                url: "php/like.php",
                                data: { id: "<?php echo $row["ID"] ?>", posterid:"<?php echo $row["userid"] ?>"}
                                })
                                .done(function(msg) {
                                    $(".likescounter<?php echo $row['ID'];?>").html(msg);
                                });
                            });
                    </script>
                    <?php } ?>
                </div>

                <!-- SIDEBAR -->
                <div class="col-md-4">
                    <div class="card mb-4">
                        <h5 class="card-header">#SNIPS</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <ul class="list-unstyled mb-0">
                                        <li>
                                            <a href="#">Web Design</a>
                                        </li>
                                        <li>
                                            <a href="#">HTML</a>
                                        </li>
                                        <li>
                                            <a href="#">Freebies</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <ul class="list-unstyled mb-0">
                                    <li>
                                        <a href="#">JavaScript</a>
                                    </li>
                                    <li>
                                        <a href="#">CSS</a>
                                    </li>
                                    <li>
                                        <a href="#">Tutorials</a>
                                    </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <h5 class="card-header">Topics</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <ul class="list-unstyled mb-0">
                                        <li>
                                            <a href="#">Web Design</a>
                                        </li>
                                        <li>
                                            <a href="#">HTML</a>
                                        </li>
                                        <li>
                                            <a href="#">Freebies</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <ul class="list-unstyled mb-0">
                                    <li>
                                        <a href="#">JavaScript</a>
                                    </li>
                                    <li>
                                        <a href="#">CSS</a>
                                    </li>
                                    <li>
                                        <a href="#">Tutorials</a>
                                    </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src ="js/verify.js"></script>
        <script src="js/redirects.js"></script>
        <script src="https://kit.fontawesome.com/5afa712fd6.js"></script>
    </body>
</html>



