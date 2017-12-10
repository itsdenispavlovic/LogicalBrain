<?php
session_start();
try {
    $user = 'root';
    $pass = '';
    $conn = new PDO('mysql:host=localhost;dbname=srp', $user, $pass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

include_once ('../classes/user.php');
include_once ('../classes/admin.php');
$us = new USER($conn);
$admin = new ADMIN($conn);
?>
