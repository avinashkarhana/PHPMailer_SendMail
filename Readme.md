# PHPMailer_SendMail

A PHPMailer based mailing function with simplified email capabilities utilizing mysql for multi email host/account capabilities

## Features

1. Ability to use multiple existing mail systems like

   > Gmail

   > Yahoo

   > Rediffmail

   etc.

2. Ability to define host/account switch limits (Switch email sender after one limit of that particular account is reached)
3. Single dashboard for setting/updating mail accounts/hosts.
4. Easy Integartion into existing systems

## SQL Backup/Dump for Dashboard
Refer to `account_for_emails.sql`

## Installation:

1. Download the latest source zip and extract it in your `web root`
2. Import `account_for_emails.sql` in your database
3. Edit `conn.php` to fit your needs.
4. Include `mailer.php` in required locations/files/scripts and use `sendMail()` function.

## Usage
    <?php
      include "mailer.php";
      @$toEmail = $_POST['email'];
      @$toName = $_POST['name'];
      @$message = $_POST['message'];
      @$subject = $_POST['subject'];
      @$replyToEmailAddress = $_POST['replyToEmailAddress'];
      @$replyToName = $_POST['replyToName'];
  
      if(!empty($toEmail)){
        echo "Result: ";
        if(sendMail($replyToEmailAddress, $replyToName, $toEmail, $toName, $subject, $message, $message, "")) {
            echo "Email message sent.";
        } else {
            echo "<br><hr>Failed to send email.";
        }
      }
    ?>

## senMail() parameters
  > $replyToEmailAddress: The email address that the recipient will reply to
  
  > $replyToName: The name that the recipient will see for the reply to address
  
  > $recieverEmailAddress: The email address of the recipient
  
  > $recieverName: The name that the recipient
  
  > $emailSubject: The subject of the email
  
  > $emailBody: The body of the email (HTML)
  
  > $alternateBody: The body of the email in Text format

  > $attachmentsPaths: An key-value pairs of fileNames to the filePaths to be attached in mail


## Sample
Please refer to `sample.php`


## Disclaimer
Before using this function be informed that, I am not sure if it is formally approved by Google to use its SMTP server to send email in this way. I do not see any information prohibiting it either.

## Gmail Configuration 
#### `No longer suppoted since 30th May 2022`
1. Disable two-factor authentication (This step is applicable, only if you have already enabled it.)
2. Allow `Less secure app access` by loging in to your Gmail account and then going to page https://myaccount.google.com/lesssecureapps and Turning this option `On`.

## Yahoo mail Configuration 
1. Disable two-factor authentication (This step is applicable, only if you have already enabled it.)
2. Login to your Yahoo account and then go to page https://login.yahoo.com/account/security 
3. Scroll down to the section `Other ways to sign in > App password` and click `Generate and manage app passwords`
4. Then enter some name in `Enter your App name` field  and then click `Generate Password`. 
5. Then a password will appear on screen, use this password for yahoo account `password` in DB/Dashboard.

## Usual Configurations

1. Gmail
>> Host: `smtp.gmail.com`

>> Port: `587`

>> SMTPSecure: `tls`

>> email_limit: `500`

2. Yahoo mail
>> Host: `smtp.mail.yahoo.com`

>> Port: `587`

>> SMTPSecure: `tls`

>> email_limit: `500`
