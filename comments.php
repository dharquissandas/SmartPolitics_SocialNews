<?php
    include "php/connection.php";
    session_start();
    $id = $_GET['id'];
    $query = 'SELECT ID, title, topic, post, timestamp, upvotes, userid FROM entries WHERE ID ='. $id .'';
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/posts.css">
    
    <title>SmartPolitics | Comments</title>
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

    <div class="container">
        <h1 class="my-4">More Information & Comments</h1>
        <div class="row">
            <div class="col-md-8">
                <h3 class="my-3"><?php echo $row['title'];?> <br> <small><?php echo $row['topic'];?></small></h3>
                <p><?php echo $row['post']; ?></p>
                <h3 class="my-3">Comments</h3>
                <?php
                    if(isset($_SESSION["id"])){
                ?>
                <form method="POST" id="comment_form">
                    <div class="form-group">
                        <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Commment..." rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION["id"]; ?>" />
                        <input type="hidden" name="comment_id" id="comment_id" value="0" />
                        <input type="hidden" name="entries_id" id="entries_id" <?php $entriesid = $row['ID'];?> value="<?php echo $entriesid ?>"/>
                        <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit">
                    </div>
                </form>
                <?php }else{ ?>
                <p>You need to be logged in to comment, Log in or make an account now</p>
                <?php } ?>
                <span id="comment_message"></span>
                <br/>
                <div id="display_comment"></div>

            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <h5 class="card-header">Information</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <?php
                                            $posterid = $row['userid'];
                                            $emailquery = "SELECT email FROM users WHERE ID='$posterid'";
                                            $emailq = mysqli_query($conn, $emailquery) or die(mysqli_error($conn));
                                            $email = mysqli_fetch_assoc($emailq);
                                        ?>
                                        <p>Poster:
                                            <?php
                                                if(isset($_SESSION["email"]) && $_SESSION["email"]  == $email['email']){ 
                                            ?>
                                            <?php echo $email['email']; ?>
                                            <?php
                                            }else{
                                            ?>
                                            <a href="<?php echo 'useraccounts.php?id='.$posterid.'';?>"><?php echo $email['email']; ?></a>
                                            <?php        
                                            }
                                            ?>
                                        </p>
                                    </li>
                                    <li>
                                    <?php date_default_timezone_set('UTC'); ?>
                                        <p>Posted on: <?php echo date('jS F Y, G:i e', $row['timestamp']); ?></p>
                                    </li>
                                    <li>
                                        <p>Upvotes: <?php echo $row['upvotes']; ?></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src ="js/verify.js"></script>
    <script src="js/redirects.js"></script>
    <script src="https://kit.fontawesome.com/5afa712fd6.js"></script>
 
</body>
</html>

    
<script>
$(document).ready(function(){
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"php/addcomments.php",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
   {
    if(data.error != '')
    {
     $('#comment_form')[0].reset();
     $('#comment_message').html(data.error);
     $('#comment_id').val('0');
     load_comment();
    }
   }
  })
 });

 load_comment();

 function load_comment()
 {
  $.ajax({
   url:"php/fetchcomments.php",
   method:"POST",
   datatype:"JSON",
   data:({entries_id: <?php echo $id; ?>}),
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
 }

 $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_content').focus();
 });
});
</script>


