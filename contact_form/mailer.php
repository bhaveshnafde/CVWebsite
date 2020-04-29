<?php
  $result=""
  require 'PHPMailerAutoload.php';
  $mail = new PHPMailer;
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 587;
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'tls';
  $mail->Username = 'admin@bhaveshnaphade.in';
  $mail->Password = 'bhavesh1999B';

  $mail->setFrom($_POST['email'],$_POST['name']);
  $mail->addAddress('naphadebhavesh99@gmail.com');
  $mail->addReplyTo($_POST['email'],$_POST['name']);

  $mail->isHTML(true);
  $mail->Subject = 'Form Submission : '.$_POST['subject'];
  $mail->Body='<h1 align = center>Name:'.$_POST['name'].'<br>Email:'.$_POST['email'].'<br>Message:'.$_POST['message'].'</h1>';

  if(!$mail->send()){
    $result = "Something went wrong";
  }else{
    $result = "Thank You ".$_POST['name']."For contatcing us.";
  }


 ?>
