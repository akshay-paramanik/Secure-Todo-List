<?php
require_once "connect.php";
session_start();

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
        $mail->addAddress($email, $receiverNamePass);     //Add a recipient
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $receiverSubjectPass;
        $mail->Body    = $receiverBodyPass;
    
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// OTP
function generateNumericOTP($length = 4) {
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
        $otp .= mt_rand(0, 9);
    }
    return $otp;
}


if(isset($_REQUEST['login'])){
    $email = mysqli_real_escape_string($conn,$_REQUEST['email']);
    $pass = mysqli_real_escape_string($conn,$_REQUEST['password']);
    $sql="select * from `users` where `email`='$email'";

    $res=mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)){
        $user=mysqli_fetch_assoc($res);
        $id = $user['id'];
        if(password_verify($pass,$user['password'])){
            $_SESSION['username']= $id;
            header("location:../index.php");
        }else{
            echo "unauthorize access";
        }
    }else{
        echo "user not exists";
    }
}else if(isset($_REQUEST['req'])=="delete"){
    $id = mysqli_real_escape_string($conn,$_REQUEST['id']);
    $sql = "delete from `tasks` where `id`='$id'";
    $res = mysqli_query($conn,$sql);
    if($res){
        header("location:../index.php");
    }else{
        echo "not deleted";
    }
}else if(isset($_REQUEST['request'])=="completed"){
    $id = mysqli_real_escape_string($conn,$_REQUEST['id']);
    $sql = "update `tasks` set `status` = 1 where `id`=$id";
    $res = mysqli_query($conn,$sql);
    if($res){
        header("location:../index.php");
    }else{
        echo "note update";
    }
}else if(isset($_REQUEST['status'])=="pendding"){
    $id=$_SESSION['username'];
    $sql = "select * from `tasks` where `userid`='$id' and `status`=0";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0){
        while($data=mysqli_fetch_assoc($res)){
            ?>

            <div class="todo">
                <ul class="todo-list">
                <li class="todo-item"><?php echo $data['task']; ?></li>
                <button class="delete-btn" id="delete" onclick="deleteTask(<?php echo $data['id']; ?>,this.id)"><i class="fas fa-trash"></i></button>
                <button class="check-btn" id="completeEvent" onclick="completeEvent(<?php echo $data['id']; ?>,this.id)"><i class="fas fa-check"></i></button>
                  </ul>
            </div>
            <?php
        }
    }
}else  if(isset($_REQUEST['Work'])=="completeWork"){
    $id=$_SESSION['username'];
    $class = $_REQUEST['class'];
    $sql = "select * from `tasks` where `userid`='$id' and `status`=1";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0){
        while($data=mysqli_fetch_assoc($res)){
            ?>

            <div class="todo">
                <ul class="todo-list completed">
                <li class="todo-item"><?php echo $data['task']; ?></li>
                <button class="delete-btn" id="delete" onclick="deleteTask(<?php echo $data['id']; ?>,this.id)"><i class="fas fa-trash"></i></button>
                <button class="check-btn" id="completeEvent" onclick="completeEvent(<?php echo $data['id']; ?>,this.id)"><i class="fas fa-check"></i></button>
                  </ul>
            </div>
            <?php
        }
    }
}else if(isset($_REQUEST['emailVal'])){
    $email = $_REQUEST['emailVal'];
    $sql = "select * from `users` where `email`='$email'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res) == 1){
        $otp = generateNumericOTP();
        sendmail($email,$otp);
        $otpsql = "update `users` set `otp`='$otp' where `email`='$email'";
        $otpres = mysqli_query($conn,$otpsql);
        if($otpres){
            echo "<script>alert('send')</script>";
        }else{
            echo "<script>alert('Not send')</script>";
        }
    }else{
        echo "<script> alert('register first.')</script>";
    }
}else if(isset($_REQUEST['otpVal'])){
    $otpGet = $_REQUEST['otpVal'];
    $email = $_REQUEST['emailValue'];
    $sql = "select * from `users` where `email`='$email'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)==1){
        $data=mysqli_fetch_assoc($res);
        if($otpGet == $data['otp']){
            return true;
        }else{
            return false;
        }
    }else{
        echo "not selected";
    }

}else if(isset($_REQUEST['reset'])){
    $pass = $_REQUEST['password'];
    $email = $_REQUEST['email'];
    $encpass = password_hash($pass,PASSWORD_BCRYPT);
    $sql = "update `users` set `password`='$encpass' where `email`='$email'";
    $res = mysqli_query($conn,$sql);
    if($res){
        echo "<script>alert('Password reset successfully.')</script>";
        header("location:../login/login.php");
    }
}

?>