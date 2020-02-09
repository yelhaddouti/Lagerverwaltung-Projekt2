
<?php
session_start();
include_once("../db_config/dbconfig.php");

$connection = new mysqli(DB_Host, DB_User, DB_Password, DB_Name);
$connection->query("SET GLOBAL FOREIGN_KEY_CHECKS=0;");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$ist_angemeldet = '0';

if(isset($_SESSION['admin0_id'])){
    $mitarbeiter_id = $_SESSION['admin0_id'];
}

if(isset($_SESSION['admin_id'])){
    $mitarbeiter_id = $_SESSION['admin_id'];
}

$prepared2 = $connection->prepare("UPDATE `mitarbeiter` SET `ist_angemeldet` = ? WHERE `mitarbeiter_id` = ?");
if ($prepared2 == false)
    die("Secured1");

$result2 = $prepared2->bind_param("si", $ist_angemeldet, $mitarbeiter_id);
if ($result2 == false)
    die("Secured2");

$result2 = $prepared2->execute();
if ($result2 == false) {
    die("Secured3");
} else {
    echo "You have been successfully updated.";
}

$prepared2->close();
$connection->close();


session_destroy();
header("location:../../index.php");


?>
