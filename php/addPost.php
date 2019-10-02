<?php
    include "connection.php";

    session_start();
    
    if (isset($_POST["title"]) and isset($_POST["posttext"])){
        $title = $_POST["title"];
        $postText = $_POST['posttext'];
        $id = $_SESSION["id"];
        $topic = $_POST["topic"];
        $upvotes = 0;
        $likes = 0;
        date_default_timezone_set('UTC');
        $time = time();

        $sql = "INSERT INTO entries (title, topic, post, timestamp, upvotes, userid, likes) VALUES ('$title', '$topic', '$postText', '$time', '$upvotes', '$id', '$likes')";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: ../index.php");
        } 
        else{  
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();

    }

?>