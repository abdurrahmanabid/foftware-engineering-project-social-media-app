<!-- Remove msg.php^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->


<?php

    include 'session-file.php';
    include 'classes/AdminUser.php';
    include 'classes/Post.php'; 

    $userLoggedIn = $_SESSION['username'];
    if(isset($_SESSION['username'])){
        $user_details_query = mysqli_query($con, "SELECT * FROM admin WHERE adminname='$userLoggedIn'")or die(mysqli_error($con));
        $user = mysqli_fetch_array($user_details_query);
    }
    else{
        header("Location: admin.php");
    }

?>

<?php
    if(isset($_POST['search_msg_btn']))
    {
        $msg = $_POST['search'];
        $query = mysqli_query($con, "delete from messages where id='$msg'") or die("No msg Found");
        if($query){
            echo "msg no. $msg is Deleted";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Post</title>
    <style>
    input[type="text"] {
        width: 70%;
        height: 25px;
        padding: 5px;
        border-radius: 5px;
        border: none;
        background: #eeeeee;
        padding-left: 10px;
    }

    input[type="submit"] {
        padding: 5px 10px;
        background: #7a6bff;
        border: none;
        border-radius: 3px;
        color: white;
        height: 32px;
        margin-left: 5px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }
    </style>
</head>

<body>
    <form action="remove_msg.php" method="post">


        <?php
        $sql= "SELECT * FROM messages WHERE 1";

        $result = $con->query($sql);

       
    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>To</th><th>From</th><th>Body</th><th>Date</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["id"]."</td><td>".$row["user_to"]."</td><td>".$row["user_from"]."</td><td>".$row["body"]."</td><td>".$row["date"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }



        ?>




        <input type="text" name="search" placeholder="Enter Message ID to remove....">
        <input type="submit" name="search_msg_btn" value="Remove">
    </form>
</body>

</html>