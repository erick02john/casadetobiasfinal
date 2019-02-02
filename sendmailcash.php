<?php
include('include.php');

$sql1 = "SELECT * FROM roomreserve WHERE ID = '".$_GET['mailids']."'";
$query = mysqli_query($connection,$sql1) or die ("Database Connection Failed");
$result1 = mysqli_fetch_assoc($query);

//SELECT (auto_increment) AS ids FROM information_schema.tables WHERE table_name = 'roomreserve' AND table_schema = 'newdbhotel' // query ko

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.googlemail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'casadetobiasmountainresort@gmail.com';                 // SMTP username
    $mail->Password = 'mountainresort';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                     // TCP port to connect to

    //Recipients
    $mail->setFrom('casadetobias@gmail.com', 'Casa De Tobias Mountain Resort');
    $mail->addAddress(''.$result1['Email'].'', 'Testing Email');     // Add a recipient


    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $message = '
    To our Clients, <br /><br />

    Thank you for making a reservation with us, You can check your reservation here ('.base_url().'depositupload?id='.$_GET['mailids'].'). We hope to see you on your scheduled date, have a great day!

    <br /><br /><br />
    If you have any questions, please call us or use the contact page for further help!';
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Casa de Tobias Mountain Resort';
    $mail->Body    = $message;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    redirect(''.base_url().'');
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
