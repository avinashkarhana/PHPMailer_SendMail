<?php
    include '../conn.php';
    $userName = $_POST['UserName'];
    $password = $_POST['Password'];
    $senderName = $_POST['Sender_name'];
    $smtpHost = $_POST['SMTP_Host'];
    $smtpPort = $_POST['SMTP_Port'];
    $smtpSecurity = $_POST['SMTP_Security'];
    $dailyEmailLimit = $_POST['Daily_Email_Limit'];
    $consequtiveEmailCount = $_POST['Consequtive_Email_Count'];
    $nextDate = $_POST['Next_Date'];
    $action = $_POST['actionType'];
    $oldUserName = $_POST['oldUserName'];

    // print_r([$userName, $password, $senderName, $smtpHost, $smtpPort, $smtpSecurity, $dailyEmailLimit, $consequtiveEmailCount, $nextDate, $action]);

    if($action == 'update') {
        $sql = "UPDATE `account_for_emails` SET `UserName`='$userName',";
        $result = false;
        if(!empty($oldUserName)){
            if(!empty($password)){
                $sql .= " `Password` = '$password',";
            }
            if(!empty($senderName)){
                $sql .= " `Sender_name` = '$senderName',";
            }
            if(!empty($smtpHost)){
                $sql .= " `SMTP_Host` = '$smtpHost',";
            }
            if(!empty($smtpPort)){
                $sql .= " `SMTP_Port` = '$smtpPort',";
            }
            if(!empty($smtpSecurity)){
                $sql .= " `SMTP_Security` = '$smtpSecurity',";
            }
            if(!empty($dailyEmailLimit)){
                $sql .= " `Daily_Email_Limit` = '$dailyEmailLimit',";
            }
            if(!empty($consequtiveEmailCount)){
                $sql .= " `Consequtive_Email_Count` = '$consequtiveEmailCount',";
            }
            if(!empty($nextDate)){
                $sql .= " `Next_Date` = '$nextDate',";
            }
            $sql = rtrim($sql, ',');
            $sql .= " WHERE `UserName` = '$oldUserName'";
            echo "<br>".$sql;
            $result = mysqli_query($conn, $sql);
        } 
        if($result) {
            echo '<div class="alert alert-success" role="alert">
                    <strong>Success!</strong> Email Configuration Updated.
                  </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    <strong>Error!</strong> Email Configuration Not Updated.
                  </div>';
        }
    }
    
    if($action == 'delete') {
        $result = false;
        if(!empty($oldUserName)){
            $sql = "DELETE FROM `account_for_emails` WHERE `UserName` = '$oldUserName'";
            $result = mysqli_query($conn, $sql);
        } 
        if($result) {
            echo '<div class="alert alert-success" role="alert">
                    <strong>Success!</strong> Email Configuration Deleted.
                  </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    <strong>Error!</strong> Email Configuration Deletion Failed.
                  </div>';
        }
    }

    if($action == 'add') {
        $sql = "INSERT INTO `account_for_emails` (`UserName`, `Password`, `Sender_name`, `SMTP_Host`, `SMTP_Port`, `SMTP_Security`, `Daily_Email_Limit`, `Consequtive_Email_Count`, `Next_Date`) VALUES ('$userName', '$password', '$senderName', '$smtpHost', '$smtpPort', '$smtpSecurity', '$dailyEmailLimit', '$consequtiveEmailCount', '$nextDate')";
        $result = mysqli_query($conn, $sql);
        if($result) {
            echo '<div class="alert alert-success" role="alert">
                    <strong>Success!</strong> Email Configuration Added.
                  </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    <strong>Error!</strong> Email Configuration Addition Failed.
                  </div>';
        }
    }

    if($action == 'disable') {
        $result = false;
        if(!empty($oldUserName)){
            $sql = "UPDATE `account_for_emails` SET `Enabled` = '0' WHERE `UserName` = '$oldUserName'";
            $result = mysqli_query($conn, $sql);
        } 
        if($result) {
            echo '<div class="alert alert-success" role="alert">
                    <strong>Success!</strong> Email Configuration Disabled.
                  </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    <strong>Error!</strong> Email Configuration Disabling Failed.
                  </div>';
        }
    }

    if($action == 'enable') {
        $sql = "UPDATE `account_for_emails` SET `Enabled` = '1' WHERE `UserName` = '$userName'";
        $result = mysqli_query($conn, $sql);
        if($result) {
            echo '<div class="alert alert-success" role="alert">
                    <strong>Success!</strong> Email Configuration Enabled.
                  </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    <strong>Error!</strong> Email Configuration Enabling Failed.
                  </div>';
        }
    }
    echo '<br>If you are not redirected to Home in 10 seconds click <a href="index.php">here</a><script>
            setTimeout(function(){
                window.location.href = "index.php";
            }, 10000);
        </script>';
?>
