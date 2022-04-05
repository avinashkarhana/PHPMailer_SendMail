<?php
    include "conn.php";
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require_once __DIR__ . '/conn.php';
    
    require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
    require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
    require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';
    
    
    // Before using this function configure Google to send email via Gmail SMTP
    // I am not sure if it is formally approved by Google to use its SMTP
    // server to send email in this way. I do not see any information
    // prohibiting it either.
    // 
    // Steps to configure Gmail/Yahoo SMTP:
    // 1. Disable two-factor authentication (This step is applicable, only if
    // you have already enabled it.)
    // 2. Allow “Less secure app access”: 
    //        >> For Gmail 
    //              Login to your Gmail account and
    //              then go to page https://myaccount.google.com/lesssecureapps and Turn
    //              it On.
    //        >> For Yahoo
    //              Login to your Yahoo account and
    //              then go to page https://login.yahoo.com/account/security and scroll down
    //              to the section `Other ways to sign in > App password` and click `Generate and manage app passwords`
    //              and then click `Enter your App name` and then click `Generate Password`. Then a password will appear and
    //              insert this password for MySql table `account_for_emails` as for your yahoo acount `password`.
    //      
    //
    // Note: On fist usage of the smtp email, Google ‘may’ send a warning
    // message to you as below, Someone just used your password to try
    // to sign in to your account from a non-Google app. Google blocked
    // them, but you should check what happened. Review your account
    // activity to make sure that no one else has access....Login to your Gmail account and give confirmation that it is you.
    
    function sendMail($replyToEmailAddress, $replyToName, $recieverEmailAddress, $recieverName, $emailSubject, $emailBody, $alternateBody, $attachmentsPaths) {
        /*
        A function to send email using SMTP
        Takes in the following parameters:
            $replyToEmailAddress: The email address that the recipient will reply to
            $replyToName: The name that the recipient will see for the reply to address
            $recieverEmailAddress: The email address of the recipient
            $recieverName: The name that the recipient
            $emailSubject: The subject of the email
            $emailBody: The body of the email (HTML)
            $alternateBody: The body of the email in Text format
            $attachmentsPaths: An key-value pairs of fileNames to the filePaths to be attached in mail
        */
        global $conn;
        $sqlQuery = "SELECT * FROM `account_for_emails` WHERE next_Date < NOW()";
        $queryResult = mysqli_query($conn, $sqlQuery);
        $row = "";
        $row_count = 0;
        while( $data = mysqli_fetch_assoc($queryResult)){
            if($data['limit']>$data['count']){
                $row = $data;
                $row_count = $row_count + 1;
                break;
            }
        }
        if ($row_count == 0) {
            return false;
        }
        $UserName = $row['UserName'];
        $Password = $row['Password'];
        $senderName = $row['Sender_name'];
        $SMTP_Host = $row['SMTP_Host'];
        $SMTP_Port = $row['SMTP_Port'];
        $SMTPSecure = $row['SMTPSecure'];
    
        // passing true in constructor enables exceptions in PHPMailer
        $mail = new PHPMailer(true);
    
        try {
            // Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Uncomment this line for detailed debug output
            $mail->isSMTP();
            $mail->Host = $SMTP_Host;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = $SMTPSecure;
            $mail->Port = $SMTP_Port;
        
            $mail->Username = $UserName; // YOUR gmail email
            $mail->Password = $Password; // YOUR gmail password
        
            // Sender and recipient settings
            $mail->setFrom($UserName, $senderName);
            $mail->addAddress($recieverEmailAddress, $recieverName);
            $mail->addReplyTo(($replyToEmailAddress != "") ? $recieverEmailAddress : $UserName, ($replyToName != "") ? $replyToName : $senderName);
        
            // Add attachments
            if($attachmentsPaths != "") {
                foreach($attachmentsPaths as $attachmentPath) {
                    $mail->addAttachment($attachmentPath);
                }
            }

            // Setting the email content
            $mail->IsHTML(true);
            $mail->Subject = $emailSubject;
            $mail->Body = $emailBody;
            $mail->AltBody = $alternateBody;
            
            print_r([$senderName, $UserName, $Password, $SMTP_Host, $SMTP_Port, $SMTPSecure]);

            $mail->send();
            mysqli_query($conn, "UPDATE `account_for_emails` SET `email_count` = `email_count` + 1 WHERE `UserName` = '$UserName'");
            if ($row['email_count'] > 498){
                mysqli_query($conn, "UPDATE `account_for_emails` SET `next_Date` = (CURDATE()+INTERVAL 1 DAY) WHERE `UserName` = '$UserName'");
            }
            return true;
        } catch (Exception $e) {
            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }
    
?>