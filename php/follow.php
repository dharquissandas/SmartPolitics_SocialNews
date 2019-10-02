<?php
    include "connection.php";
    session_start();
    $userid = $_SESSION["id"];
    $followingid = $_POST["followingid"];

    $sql = "INSERT INTO followers (userid, followingid) VALUES ('$userid', '$followingid')";

    if ($conn->query($sql) === TRUE) {
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    } 
    else{  
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
?>