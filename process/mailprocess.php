<?php
require_once "connect.php";
session_start();
if(isset($_REQUEST['email']) && isset($_REQUEST['v_code'])){
    $email = $_REQUEST['email'];
    $vcode = $_REQUEST['v_code'];
    $query = "SELECT * FROM `users` WHERE `email`='$email' AND `varify_code`='$vcode'";
    $result = mysqli_query($conn,$query);
    if($result){
        if(mysqli_num_rows($result) == 1){
            $data = mysqli_fetch_assoc($result);
            if($data['verify_status']== 0){
                $sql = "UPDATE `users` SET `verify_status` = '1' WHERE `email` = '$data[email]'";
                if(mysqli_query($conn,$sql)){
                    echo "<script>
                alert('Email verified successfully.');
                ;
                </script>";
                $_SESSION['username']= $id;
                header("location:../index.php");
                }else{
                    echo "<script>
                alert('Email not verified!! error: Queryrun');
                window.location.href='../login/signUp.php';
                </script>";
                }
            }else{
                echo "<script>
                alert('Email already verified!! just login with email and password.');
                window.location.href='../login/login.php';
                </script>";
            }
        }
    }else{
        echo "<script>
                alert('Not Verified.');
                window.location.href='../login/signUp.php';
                </script>";
    }
}

?>