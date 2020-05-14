<?php

// configure
$okMessage = 'Contact form successfully submitted. Thank you, I will get back to you soon!';
$errorMessage = 'There was an error while submitting the form. Please try again later';

// let's do the sending

if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])):
    //your site secret key
    $secret = '6LdE4u4UAAAAAIFT0UUdsKwFbcmfugTLGiBVNJim';
    //get verify response data

    $c = curl_init('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    $verifyResponse = curl_exec($c);

    $responseData = json_decode($verifyResponse);
    if($responseData->success):

        try
        {
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

            $responseArray = array('type' => 'success', 'message' => $okMessage);
        }
        catch (\Exception $e)
        {
            $responseArray = array('type' => 'danger', 'message' => $errorMessage);
        }

        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $encoded = json_encode($responseArray);

            header('Content-Type: application/json');

            echo $encoded;
        }
        else {
            echo $responseArray['message'];
        }

    else:
        $errorMessage = 'Robot verification failed, please try again.';
        $responseArray = array('type' => 'danger', 'message' => $errorMessage);
        $encoded = json_encode($responseArray);

            header('Content-Type: application/json');

            echo $encoded;
    endif;
else:
    $errorMessage = 'Please click on the reCAPTCHA box.';
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
    $encoded = json_encode($responseArray);

            header('Content-Type: application/json');

            echo $encoded;
endif;
