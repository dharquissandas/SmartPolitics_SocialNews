<?php   
    include "connection.php";
    session_start();
    $postid = $_POST["id"];
    $posterid = $_POST["posterid"];
    $userid = $_SESSION["id"];
    
    $entrylikestablequery = "INSERT INTO entrylikes (idofpostinguser, idofpost, idoflikinguser) VALUES ('$posterid','$postid','$userid')";
    if ($conn->query($entrylikestablequery) === TRUE) {} 
    else{  
        echo "Error: " . $entrylikestablequery . "<br>" . $conn->error;
    }
    
    if(!$conn->connect_error)
    {$conn->query("UPDATE entries SET likes = likes + 1 WHERE ID = '$postid'");}
    $query = "SELECT likes FROM entries WHERE ID= '$postid;'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $row = $result->fetch_assoc();
    $n = $row["likes"];
    echo "likes: $n";
?>