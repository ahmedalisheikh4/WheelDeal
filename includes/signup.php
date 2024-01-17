<?php
    // include("../config/connection.php");
    // if(isset($_POST['submit']))
    // {
    //     $id = $_POST['id'];
    //     $fname = $_POST['first_name'];
    //     $lname = $_POST['last_name'];
    //     $add = $_POST['address'];
    //     $email = $_POST['email'];
    //     $uname = $_POST['username'];
    //     $pass = $_POST['password'];
        
    //     $insert = $con->prepare("INSERT INTO `user`(`id`,`FirstName`,`LastName`,`address`,`email`,`username`,`password`) VALUES ('$id','$fname','$lname','$add','$email','$uname','$pass')");
    //     $insert->bind_param("ssssss", $id, $fname, $lname, $add, $email, $uname, $pass);
    //     $insert->execute();
    //     // $insert = $con->query()("INSERT INTO `user`(`id`,`FirstName`,`LastName`,`address`,`email`,`username`,`password`) VALUES ('$id','$fname','$lname','$add','$email','$uname','$pass');");
    //     // mysqli_query($con, $insert);
    //     if($insert)
    //     {
    //         header("location:../index.php?signup=success");
    //     }
    //     else
    //     {
    //         echo"ERROR";
    //     }
    // }

    include("../config/connection.php");

    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $fname = $_POST['first_name'];
        $lname = $_POST['last_name'];
        $add = $_POST['address'];
        $email = $_POST['email'];
        $uname = $_POST['username'];
        $pass = $_POST['password'];
        $usertype = $_POST['user_type'];
        
        $insert = $con->prepare("INSERT INTO `users`(`user_id`,`firstname`,`lastName`,`address`,`email`,`username`,`password`,`user_type`) VALUES (?,?,?,?,?,?,?,?);");
        $insert->bind_param('ssssssss', $id, $fname, $lname, $add, $email, $uname, $pass, $usertype);
        $insert->execute();

        if($insert)
        {
            header("location:../register.php?signup=success");
        }
        else
        {
            echo "ERROR: " . $con->error;
        }

        $insert->close();
    }

?>