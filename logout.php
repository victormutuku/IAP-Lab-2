<?php
include_once 'database.php';
include_once 'user.php';

$user = new User();
$endSession = $user->logout($pdo);
header("Location: index.php");
?>