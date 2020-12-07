<?php 
include_once 'database.php';
include_once 'user.php';

$connection = new databaseConnector();
$pdo = $connection->connectToDatabase();

$userid =$_GET['id'];
$statement = $pdo->prepare("SELECT * FROM user_details WHERE iduser = ?");
$statement->execute([$userid]);
$value = $statement->fetch();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
</head>
<body>
    <h3>User ID: <?php echo $value['iduser']; ?></h3>
    <h3>First Name: <?php echo $value['FirstName']; ?></h3>
    <h3>Middle Name: <?php echo $value['MiddleName']; ?></h3>       
    <h3>Last Name: <?php echo $value['LastName']; ?></h3>
    <h3>Email: <?php echo $value['Email_Address']; ?></h3>
    <h3>City of Residence: <?php echo $value['City_Of_Residence']; ?></h3>
    <img src="<?php echo $value['Profile_Picture']; ?>">
    <p>Would you like to: </p>
    <a href="passwordchange.php?id=<?php echo $value['iduser']; ?>"><p>Change your password</p></a>
    <a href="logout.php"><p>Logout</p></a>
</body>

</html>