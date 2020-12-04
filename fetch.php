<?php
session_start();
include_once 'database.php';
include_once 'user.php';

$connection = new databaseConnector();
$pdo = $connection->connectToDatabase();

if(isset($_POST['signup'])){
    $FirstName = $_POST["FirstName"];
    $MiddleName = $_POST["MiddleName"];
    $LastName = $_POST["LastName"];
    $Email = $_POST["Email"];
    $City = $_POST["City"];
    $Profilepic = $_FILES["ProfilePic"];
    $Passkey = password_hash($_POST["Passkey"], PASSWORD_DEFAULT);
    $dateCreated = date("Y:m:d");

    $original_file_name = $_FILES['ProfilePic']['name'];
    $file_tmp_location = $_FILES['ProfilePic']['tmp_name'];

    $file_type = substr($original_file_name, strpos($original_file_name,'.'),strlen($original_file_name));

    $file_path = "ProfilePics/";
    $new_file_name = $file_path.$original_file_name;

    $user = new User();
    $user->setFirstName($FirstName);
    $user->setMiddleName($MiddleName);
    $user->setLastName($LastName);
    $user->setEmailAddress($Email);
    $user->setCityOfResidence($City);
    $user->setPassKey($Passkey);
    $user->setDateCreated($dateCreated);

    if(move_uploaded_file($file_tmp_location,$new_file_name)){

        $user->setProfilePicture($new_file_name);   
    }
    $signup = $user->register($pdo);
    echo $signup;
}
if(isset($_POST['login'])){
    $Email = $_POST["Email"];
    $Passkey = password_hash($_POST["Passkey"], PASSWORD_DEFAULT);

    $user = new User();
    $user->setEmailAddress($Email);
    $user->setPassKey($Passkey);
    $login = $user->login($pdo);
    echo $login;
}
?>