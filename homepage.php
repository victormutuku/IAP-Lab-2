<?php 
session_start();
include_once 'database.php';
include_once 'user.php';

$connection = new databaseConnector();
$pdo = $connection->connectToDatabase();

$user = new User();
$user_details = $user->login($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
</head>
<body>
    <h3>User ID: <?php echo $user->getUserID(); ?></h3>
    <h3>First Name: <?php echo $user->getFirstName(); ?></h3>
    <h3>Middle Name: <?php echo $user->getMiddleName(); ?></h3>       
    <h3>Last Name: <?php echo $user->getLastName(); ?></h3>
    <h3>Email: <?php echo $user->getEmailAddress(); ?></h3>
    <h3>City of Residence: <?php echo $user->getCityOfResidence(); ?></h3>
    <img src="<?php echo $user->getProfilePicture(); ?>">
    <p>Would you like to: </p>
    <a href="change_password.php"><p>Change your password</p></a>
    <a href="login form.php"><p>Logout</p></a>
</body>

</html>