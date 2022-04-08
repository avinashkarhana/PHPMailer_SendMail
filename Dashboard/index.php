<?php
// This code will fetch the data from the database and display it on the page.
// Connect to the database
include '../conn.php';

// get data from account_for_emails table
$sqlQuery = "SELECT * FROM `account_for_emails`";
$queryResult = mysqli_query($conn, $sqlQuery);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Email Sender</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .email {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        .email h3 {
            cursor: pointer;
        }

        .email h2 {
            cursor: pointer;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <h1>PHPMailer_SendMail Dashboard</h1><br>
    <div class="container">
        <div class="row" style="min-width: max-content;">
            <div class="col-md-12">
                <?php
                do {
                ?>
                    <div class="email" <?php if (!isset($data['UserName'])) { ?> style="background-color: #ccc;"<?php } ?>>
                        <?php
                        if (!isset($data['UserName'])) {
                        ?>
                        <h2 onclick="toogleDivVisibility('<?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>')"><u>Add New Email Configuration</u></h2>
                        <?php
                        }
                        else {
                        ?>
                        <h3 onclick="toogleDivVisibility('<?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>')"><?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?></h3>
                        <?php
                        }
                        ?>
                        <div id="<?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>-div" class="email-details hidden">
                            <table class="table table-borderless">
                                <tbody>
                                    <form action="take_action.php" id="<?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>-form" method="POST">
                                        <tr>
                                            <td><b>UserName <?php if (!isset($data['UserName'])) { ?> / Email Address <?php } ?></b></td>
                                            <td>
                                                <input type="email" class="form-control <?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>-Input" name="UserName"  <?php echo (isset($data['UserName'])) ? 'readonly' : ''; ?> value="<?php echo (isset($data['UserName'])) ? $data['UserName'] : ''; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Password</b></td>
                                            <td>
                                                <input type="password" class="form-control <?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>-Input" name="Password"  <?php echo (isset($data['UserName'])) ? 'readonly' : ''; ?> value="">
                                            </td>
                                        </tr>
                                        <td><b>Default Sender Name</b></td>
                                        <td>
                                            <input type="text" class="form-control <?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>-Input" name="Sender_name"  <?php echo (isset($data['UserName'])) ? 'readonly' : ''; ?> value="<?php echo (isset($data['Sender_name']))? $data['Sender_name'] : ''; ?>">
                                        </td>
                                        </tr>
                                        <tr>
                                            <td><b>SMTP Host</b></td>
                                            <td>
                                                <input type="text" class="form-control <?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>-Input" name="SMTP_Host"  <?php echo (isset($data['UserName'])) ? 'readonly' : ''; ?> value="<?php echo (isset($data['SMTP_Host'])) ? $data['SMTP_Host'] : ''; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>SMTP Port</b></td>
                                            <td>
                                                <input type="number" min='0'  class="form-control <?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>-Input" name="SMTP_Port"  <?php echo (isset($data['UserName'])) ? 'readonly' : ''; ?> value="<?php echo (isset($data['SMTP_Port'])) ? $data['SMTP_Port'] : ''; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>SMTP Security</b></td>
                                            <td>
                                                <input type="text" class="form-control <?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>-Input" name="SMTP_Security"  <?php echo (isset($data['UserName'])) ? 'readonly' : ''; ?> value="<?php echo (isset($data['SMTP_Security'])) ? $data['SMTP_Security'] : ''; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Daily Email Limit</b></td>
                                            <td>
                                                <input type="number" min='0'  class="form-control <?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>-Input" name="Daily_Email_Limit"  <?php echo (isset($data['UserName'])) ? 'readonly' : ''; ?> value="<?php echo (isset($data['Daily_Email_Limit'])) ? $data['Daily_Email_Limit']: '' ; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Email Count</b></td>
                                            <td>
                                                <input type="number" min='0' class="form-control <?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>-Input" name="Consequtive_Email_Count"  <?php echo (isset($data['UserName'])) ? 'readonly' : ''; ?> value="<?php echo (isset($data['Consequtive_Email_Count'])) ? $data['Consequtive_Email_Count'] : ''; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b><?php if (!isset($data['UserName'])) { ?> Yesterday's Date <?php } else { ?>Next Date <?php } ?></b></td>
                                            <td>
                                                <input type="date" class="form-control <?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>-Input" name="Next_Date"  <?php echo (isset($data['UserName'])) ? 'readonly' : ''; ?> value="<?php echo (isset($data['Next_Date'])) ? $data['Next_Date'] : ''; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <input type="hidden" id="<?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>-actionType" name="actionType" value="<?php echo ($data['UserName']) ? 'update' : 'add'; ?>">
                                            <input type="hidden" name="oldUserName" value="<?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>">
                                            <?php
                                            if (isset($data['UserName'])) {
                                            ?>
                                            <td>
                                                <button type="button" id="<?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>-EditButton" class="btn btn-success" onclick="editButtonClicked('<?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>')">Edit</button>
                                            </td>
                                            <td>
                                                <button type="button" id="<?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>-UpdateButton" class="btn btn-success hidden" onclick="updateButtonClicked('<?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>')">Update</button>
                                            </td>

                                            <td>
                                                <button type="button" id="<?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>-CancelButton" class="btn btn-info hidden" onclick="cancelButtonClicked('<?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>')">Cancel</button>
                                            </td>
                                            <td>
                                                <button type="button" id="<?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>-DeleteButton" class="btn btn-danger" onclick="deleteButtonClicked('<?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>')">Delete</button>
                                            </td>
                                            <?php
                                            if($data['Enabled'] == '1'){
                                            ?>
                                            <td>
                                                <button type="button" id="<?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>-DisableButton" class="btn btn-danger" onclick="disableButtonClicked('<?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>')">Disable</button>
                                            </td>
                                            <?php
                                            }else{
                                            ?>
                                            <td>
                                                <button type="button" id="<?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>-EnableButton" class="btn btn-success" onclick="enableButtonClicked('<?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>')">Enable</button>
                                            </td>
                                            <?php
                                            }
                                            }
                                            else {
                                            ?>
                                            <td>
                                                <button type="button" id="<?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>-AddButton" class="btn btn-success" onclick="addButtonClicked('<?php echo (isset($data['UserName'])) ? $data['UserName'] : 'newEmailConfig'; ?>')">Add</button>
                                            </td>
                                            <?php 
                                            }
                                            ?>
                                        </tr>
                                    </form>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php
                    if (!isset($data['UserName'])) {
                        echo '<br><br>';
                    }
                } while ($data = mysqli_fetch_assoc($queryResult))
                ?>

            </div>
        </div>
    </div>
</body>
<script>

    function toogleDivVisibility(id) {
        var allEmailDetailsDivs = document.getElementsByClassName("email-details")
        for(var i = 0; i < allEmailDetailsDivs.length; i++) {
            if(allEmailDetailsDivs[i].id != id + '-div') {
                allEmailDetailsDivs[i].classList.add("hidden");
            }
        }
        var div = document.getElementById(id + '-div');
        if (div.classList.contains("hidden")) {
            div.classList.remove("hidden");
        } else {
            div.classList.add("hidden");
        }
    }

    function editButtonClicked(id) {
        var all_inputs = document.getElementsByClassName(id + '-Input');
        for(var i = 0; i < all_inputs.length; i++) {
            all_inputs[i].readOnly = false;
        }
        var editButton = document.getElementById(id + "-EditButton");
        var cancelButton = document.getElementById(id + "-CancelButton");
        var updateButton = document.getElementById(id + "-UpdateButton");
        editButton.classList.add("hidden");
        cancelButton.classList.remove("hidden");
        updateButton.classList.remove("hidden");

    }

    function cancelButtonClicked(id) {
        var all_inputs = document.getElementsByClassName(id + '-Input');
        for(var i = 0; i < all_inputs.length; i++) {
            all_inputs[i].readOnly = true;
        }
        var editButton = document.getElementById(id + "-EditButton");
        var cancelButton = document.getElementById(id + "-CancelButton");
        var updateButton = document.getElementById(id + "-UpdateButton");
        editButton.classList.remove("hidden");
        cancelButton.classList.add("hidden");
        updateButton.classList.add("hidden");
    }

    function updateButtonClicked(id) {
        var editButton = document.getElementById(id + "-EditButton");
        var cancelButton = document.getElementById(id + "-CancelButton");
        var updateButton = document.getElementById(id + "-UpdateButton");
        editButton.classList.remove("hidden");
        cancelButton.classList.add("hidden");
        updateButton.classList.add("hidden");
        var form = document.getElementById(id + "-form");
        document.getElementById(id+"-actionType").value = "update";
        form.submit();
    }

    function deleteButtonClicked(id) {
        var form = document.getElementById(id + "-form");
        document.getElementById(id+"-actionType").value = "delete";
        form.submit();
    }

    function disableButtonClicked(id) {
        var form = document.getElementById(id + "-form");
        document.getElementById(id+"-actionType").value = "disable";
        form.submit();
    }

    function enableButtonClicked(id) {
        var form = document.getElementById(id + "-form");
        document.getElementById(id+"-actionType").value = "enable";
        form.submit();
    }

    function addButtonClicked(id) {
        var form = document.getElementById(id + "-form");
        document.getElementById(id+"-actionType").value = "add";
        form.submit();
    }
</script>

</html>