<?php
session_start();
require_once "connect.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendmail($email,$vcode){
    require('PHPMailer/Exception.php');
    require('PHPMailer/PHPMailer.php');
    require('PHPMailer/SMTP.php');
    require('mailerScript.php');

    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $senderMail;                     //SMTP username
        $mail->Password   = $senderPass;                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom($senderMail, $senderName);
        $mail->addAddress($email, $receiverNameVerify);     //Add a recipient
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $receiverSubjectVerify;
        $mail->Body    = $receiverBodyVerify;
    
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if(isset($_REQUEST['register'])){
    $user = mysqli_real_escape_string($conn,$_REQUEST['username']);
    $email = mysqli_real_escape_string($conn,$_REQUEST['email']);
    $pass = mysqli_real_escape_string($conn,$_REQUEST['password']);
    $encpass=password_hash($pass,PASSWORD_BCRYPT);
    $hexa_num = bin2hex(random_bytes(15));
    $emailSql = "select * from `users` where `email`='$email'";
    $emailRes = mysqli_query($conn,$emailSql);
    if(mysqli_num_rows($emailRes)>0){
        die("Email already exits");
    }else{

        $sql = "insert into `users`(`username`,`email`,`password`,`varify_code`)values('$user','$email','$encpass','$hexa_num')";
        $res = mysqli_query($conn,$sql);
        if($res && sendmail($email,$hexa_num)){
            echo "<script>alert('check your email for verification');</script>";
            sleep(2);
            header("location:../login/login.php");
        }else{
            echo "Email surver is not configed";
        }
    }
}else if(isset($_REQUEST['tasks'])){
    $content = mysqli_real_escape_string($conn,$_REQUEST['taskContent']);
    $id=$_SESSION['username'];
    $sql = "insert into `tasks`(`task`,`userid`)values('$content','$id')";
    $res = mysqli_query($conn,$sql);
    if($res){
        header("location:../index.php");
    }else{
        echo "Not inserted";
    }
}else{
    echo "not find";
}
?>
