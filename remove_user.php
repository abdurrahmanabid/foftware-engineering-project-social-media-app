<!-- Remove user.php^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->

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
    if(isset($_POST['search_user_btn']))
    {
        $user = $_POST['search'];
        $query = mysqli_query($con, "delete from users where username='$user'") or die("No User Found");
        $post_query = mysqli_query($con, "delete from posts where added_by='$user'")or die("can not Delete posts");
        
        if($query){
            echo "User $user is Deleted with his/her all posts";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove User</title>
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
    <form action="remove_user.php" method="post">
        <?php
        $sql= "SELECT * FROM users WHERE 1";

        $result = $con->query($sql);

       
    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Username</th><th>Email</th><th>Date of Birth</th><th>Gender</th><th>Signup Date</th><th>Profile Pic</th><th>Cover Pic</th><th>Number of Posts</th><th>Number of Likes</th><th>User Closed</th><th>Friend Array</th><th>Address</th><th>City</th><th>Hometown</th><th>Country</th><th>Bio</th><th>Phone</th><th>Work</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["id"]."</td><td>".$row["first_name"]."</td><td>".$row["last_name"]."</td><td>".$row["username"]."</td><td>".$row["email"]."</td><td>".$row["dob"]."</td><td>".$row["gender"]."</td><td>".$row["signup_date"]."</td><td>".$row["profile_pic"]."</td><td>".$row["cover_pic"]."</td><td>".$row["num_posts"]."</td><td>".$row["num_likes"]."</td><td>".$row["user_closed"]."</td><td>".$row["friend_array"]."</td><td>".$row["address"]."</td><td>".$row["city"]."</td><td>".$row["hometown"]."</td><td>".$row["country"]."</td><td>".$row["bio"]."</td><td>".$row["phone"]."</td><td>".$row["work"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }



        ?>
        <input type="text" name="search" placeholder="Enter User Name to remove....">
        <input type="submit" name="search_user_btn" value="Remove">
    </form>
</body>

</html>