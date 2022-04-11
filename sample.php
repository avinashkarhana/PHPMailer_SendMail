<!DOCTYPE html>
<html>
<head>
    <title>Send Email</title>
</head>
<body>
    <form method="POST" action="">
        <label>Recipient Email Address</label><br>
        <input type="text" name="email" placeholder="Email"><br>
        <label>Recipient Name</label><br>
        <input type="text" name="name" placeholder="Name"><br>
        <label>Email Subject</label><br>
        <input type="text" name="subject" placeholder="Name"><br>
        <label>Body</label><br>
        <textarea name="message" placeholder="Message"></textarea><br>
        <input type="submit" value="Send Email">
    </form>
</body>
</html>
<?php  
    include "mailer.php";
    @$toEmail = $_POST['email'];
    @$toName = $_POST['name'];
    @$message = $_POST['message'];
    @$subject = $_POST['subject'];
    $attachmentsPaths = ['images/landscape.jpg', 'images/compass.jpg'];

    if(!empty($toEmail)){
        echo "Result: ";
        if(sendMail("", "", $toEmail, $toName, $subject, $message, $message, $attachmentsPaths)) {
            echo "Email message sent.";
        } else {
            echo "<br><hr>Failed to send email.";
        }
    }
?>