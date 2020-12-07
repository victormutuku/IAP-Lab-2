<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>
    <form action="fetch.php" method="POST">
        <h2>Change Password</h2>
        <div>
            <input type="password" name="oldpassword" id="oldpassword" placeholder="Old Password" required>
            <br>
        </div>
        <div>
            <input type="password" name="newpassword" id="newpassword" placeholder="New Password" required>
            <br>
        </div>
        <div>
            <input type="password" name="confirmnewpassword" id="confirmnewpassword" placeholder="Confirm New Password" required>
            <br>
        </div>
        <div>
            <button type="submit" name="changepassword" id="changepassword">Change Password</button>
            <br>
        </div>


    </form>
</body>
</html>