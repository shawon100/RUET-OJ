<?php

require_once("config.php");

$user=$_POST['uname'];
$email=$_POST['email'];
$pass=$_POST['password'];
$password=md5($pass);

$query="INSERT into user(name,pass,status,email) VALUES('$user','$password','user','$email')";
$sq=mysqli_query($con,$query);

if($sq)
{
    
    
    
    
  
    require 'mail/PHPMailerAutoload.php';
    require_once('mail/class.phpmailer.php');
  
          
        
           

            $mail = new PHPMailer;

            //$mail->SMTPDebug = 2;                               // Enable verbose debug output

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'ruetoj@gmail.com';                 // SMTP username
            $mail->Password = 'shawonruet';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

           
                // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $mail->isHTML(true);                                  // Set email format to HTML

            //$mail->Subject = 'RUET OJ Contest Alert Test';
            //$mail->Body    = 'This is the Test Message <b>in bold!</b>';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

           

            

               $mail->setFrom('ruetoj@gmail.com', 'Ruet OJ');

              
  
               
               //echo "$em";    
               
               $mail->addAddress($email,'User'); 

               $mail->Subject = 'RUET OJ';
               $mail->Body    = 'Hi '.$user.' , Thank You For Your Registration.<br> Your Username : '.$user.'<br> Password : '.$pass.'<br>';
                $mail->AltBody = 'Hi '.$user.' , Thank You For Your Registration.<br> Your Username : '.$user.'<br> Password : '.$pass.'<br>';


              


            
             if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
               } else {
                echo 'Message has been sent';
               }
               $mail->ClearAddresses();
            

            


      

   
   
    
}

if($sq)
{
	header("Location:login.php");
}
else
{

  header("Location:sign.php?value=fail");
	//echo("Username already exists. Failed<br>");
}






?>
