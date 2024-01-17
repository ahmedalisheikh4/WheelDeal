<?php
include("../config/connection.php");
session_start();
if(isset($_POST['Login']))
{

    $email=$_POST['email'];
    $password=$_POST['password'];

    $check = $con->query("SELECT * FROM `users` WHERE `email`='$email'");

    $result= mysqli_num_rows($check);

    if($result > 0)
    {

        $fetch = mysqli_fetch_array($check);

        if($password == $fetch['password'])
        {
            // $_SESSION['user_id'] = $user_id; // Use the actual user ID you get after login
            // $_SESSION['username'] = $username;
            // $_SESSION['user_type'] = $user_type;

            $_SESSION['user_id']=$fetch['user_id'];
            $_SESSION['username']=$fetch['username'];
            
            // header("location:../pages/index.php");
            header("location:../pages/index.php?login=success");

        }
        else
        {
            ?>

            <script>
                alert("Password is Wrong"); 
                window.location.href = "../register.php";
            </script>
            
            <?php
    
        }
    }
    else
    {
        ?>

        <script>
            alert("Email Not Registered");
            window.location.href = "../register.php"; 
        </script>

        <?php
        
    }

}
?>