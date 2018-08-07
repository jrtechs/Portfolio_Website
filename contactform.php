<?php

/**
 * This file validates input sent from a contact form in {@link index.html}.
 * After verifying that the captcha is correct, it sends the email
 * to my personal address.
 *
 * @author Jeffery Russell 6-17-18
 */

if(isset($_POST['submit']))
{
    if(isset($_POST['g-recaptcha-response']))
    {
        $secret_file_path = '../captchaSecret.txt';
        $secret = file_get_contents($secret_file_path, FILE_USE_INCLUDE_PATH);

        $personal_email_path = '../email.txt';
        $toEmail = file_get_contents($personal_email_path, FILE_USE_INCLUDE_PATH);


        if($secret === false)
        {
            echo "File with the captcha secret is not set:";
            echo $secret_file_path;
        }
        else if($toEmail === false)
        {
            echo "File with personal email address is not set:";
            echo $personal_email_path;
        }
        else
        {
            $response = $_POST["g-recaptcha-response"];
            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $data = array(
                'secret' => $secret,
                'response' => $_POST["g-recaptcha-response"]
            );
            $options = array(
                'http' => array (
                    'method' => 'POST',
                    'content' => http_build_query($data)
                )
            );
            $context  = stream_context_create($options);
            $verify = file_get_contents($url, false, $context);
            $captcha_success=json_decode($verify);

            if ($captcha_success->success==false)
            {
                echo "<p>You are a bot! Go away!</p>";
            }
            else if ($captcha_success->success==true)
            {
                $fromName = stripslashes($_POST["name"]);
                $fromEmail = stripslashes($_POST["email"]);
                $subject = "Jrtechs.me Form Submission - " . $fromEmail;
                $emailMessage = stripslashes($_POST["message"]);
                $message = "Message from contact form on jrtechs.me\nName:
                    $fromName \nEmail:\n$fromEmail \nMessage:\n$emailMessage";
                $headers = "From: $fromEmail";
                $response = $_POST[g-recaptcha-response];


                mail($toEmail, $subject, $message, $headers);
                header('Location:https://jrtechs.me/messageSent.html');
            }
        }

    }
}