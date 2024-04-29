<!-- Remove Post.php^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->


<?php

    include 'session-file.php';
    include 'classes/AdminUser.php';
    include 'classes/MyPost.php'; 

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
    if(isset($_POST['search_Post_btn']))
    {
        $Post = $_POST['search'];
        $query = mysqli_query($con, "delete from posts where id='$Post'") or die("No Post Found");
        if($query){
            echo "post no. $Post is Deleted";
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

    <form action="remove_post.php" method="post">

        <?php
        $sql= "SELECT * FROM posts WHERE 1";

        $result = $con->query($sql);

       
    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Post</th><th>Added By</th><th>Added Date</th><th>Likes</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["id"]."</td><td>".$row["body"]."</td><td>".$row["added_by"]."</td><td>".$row["date_added"]."</td><td>".$row["likes"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }



        ?>







        <input type="text" name="search" placeholder="Enter post ID to remove....">
        <input type="submit" name="search_Post_btn" value="Remove">
    </form>
</body>

</html>