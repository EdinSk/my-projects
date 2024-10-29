<?php
require_once '../../../2nd_Project/php/classes/user.php';

header('Content-Type: application/json');

$userObj = new User();
$allUsers = $userObj->getAllUsers();

echo json_encode($allUsers);