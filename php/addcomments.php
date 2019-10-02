<?php
    include "connection.php";
    $connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    

    $error = "";
    $comment_content = "";
    $entry_id = "";


    if(empty($_POST["comment_content"])){
        $error .= "<p class='text-danger'>Content is required</p>";
    }
    else{
        $comment_content = $_POST["comment_content"];    
    }

    if($error == ''){
        $query = "INSERT INTO comments 
        (parent_comment_id, comment, userid, entries_id) VALUES (:parent_comment_id, :comment, :comment_sender_name, :entries_id)";      
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':parent_comment_id' => $_POST["comment_id"],
                ':comment' => $comment_content,
                ':comment_sender_name' => $_POST["user_id"],
                ':entries_id' => $_POST["entries_id"]
            )
        );
        $error = "<label class='text-success'>Comment Added</label>";
    }

    $data = array(
        'error' => $error
    );

    echo json_encode($data);
?>