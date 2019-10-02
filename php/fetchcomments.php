<?php
    include "connection.php";
    $connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $entid = $_POST["entries_id"];

    $query = " SELECT * FROM comments WHERE parent_comment_id = '0' AND entries_id= '$entid' ORDER BY comment_id DESC";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    $getemailfromid = "";

    foreach($result as $row)
    {
        $getemailfromid = $row["userid"];
        $emailquery = "SELECT email FROM users WHERE ID = '$getemailfromid'";
        $emailresult = mysqli_query($conn, $emailquery) or die(mysqli_error($conn));
        while($email = $emailresult->fetch_assoc()){
            $output .= '
            <div class="card mb-2">
            <div class="card-header">
              By <b>'.$email["email"].'</b> on <i>'.$row["date"].'</i>
            </div>
            <div class="card-body">
              <p class="card-text">'.$row["comment"].'</p>
            </div>
              <div class="card-footer" align="right">
              <button type="button" class="btn btn-outline-info my-1 mr-1 reply" id="'.$row["comment_id"].'"><i class="fas fa-reply-all"></i>  Reply</button>
            </div>
          </div>
            ';
        }
        $output .= get_reply_comment($connect, $conn, $row["comment_id"]);
    }

    echo $output;

    function get_reply_comment($connect, $conn, $parent_id = 0, $marginleft = 0){
        $query = "SELECT * FROM comments WHERE parent_comment_id = '".$parent_id."'";
        $output = '';
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $count = $statement->rowCount();
        if($parent_id == 0){
            $marginleft = 0;
        }
        else{
            $marginleft = $marginleft + 48;
        }
        
        if($count > 0){
            foreach($result as $row){
                $getemailfromid = $row["userid"];
                $emailqueryreply = "SELECT email FROM users WHERE ID = '$getemailfromid'";
                $emailresultreply = mysqli_query($conn, $emailqueryreply) or die(mysqli_error($conn));
                while($emailreply = $emailresultreply->fetch_assoc()){
                    $output .= '
                    <div class="card mb-2" style="margin-left:'.$marginleft.'px">
                    <div class="card-header">
                      By <b>'.$emailreply["email"].'</b> on <i>'.$row["date"].'</i>
                    </div>
                    <div class="card-body">
                      <p class="card-text">'.$row["comment"].'</p>
                    </div>
                      <div class="card-footer" align="right">
                      <button type="button" class="btn btn-outline-info my-1 mr-1 reply" id="'.$row["comment_id"].'"><i class="fas fa-reply"></i>  Reply</button>
                    </div>
                  </div>
                    ';
                }
                $output .= get_reply_comment($connect, $conn, $row["comment_id"], $marginleft);
            }
        }
        return $output;
    }
?>