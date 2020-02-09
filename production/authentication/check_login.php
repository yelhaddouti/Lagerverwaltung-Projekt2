
<?php
session_start();
include_once("../db_config/dbconfig.php");
/*
if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $connection = new mysqli(DB_Host, DB_User, DB_Password, DB_Name);
    $connection->query("SET GLOBAL FOREIGN_KEY_CHECKS=0;");

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }


    $sql = "SELECT * FROM mitarbeiter WHERE nachname = '".$username."' AND passwort = '".$password."'";

   // die($sql);
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            die("OK ");
        }
    } else {
        echo "0 results";
    }
    $connection->close();


}
*/

if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $connection = new mysqli(DB_Host, DB_User, DB_Password, DB_Name);
    $connection->query("SET GLOBAL FOREIGN_KEY_CHECKS=0;");

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $stmt = $connection->prepare("SELECT mitarbeiter_id, vorname,nachname, personal_nr, passwort, rolle,
(CASE WHEN benutzerbild IS NULL OR benutzerbild = '' THEN 'user.png' ELSE benutzerbild END) as `benutzerbild`
    FROM mitarbeiter WHERE (nachname = ? OR personal_nr = ?) AND passwort = ? ");
    $stmt->bind_param("sss", $username, $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    $output = array();


    while ($data = $result->fetch_assoc()) {

        $output[] = $data;

    }


    if(count($output) > 0){
        //online
        $ist_angemeldet  = '1';
        $mitarbeiter_id = $output[0]['mitarbeiter_id'];

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

        if($output[0]['rolle'] == 1){
            $_SESSION['admin'] = $username;
            $_SESSION['admin_id'] = $output[0]['mitarbeiter_id'];
            $_SESSION['admin_avatar'] = $output[0]['benutzerbild'];
            header("location:../view/index.php?site=home");
        }else if($output[0]['rolle'] == 0){
            $_SESSION['admin0'] = $username;
            $_SESSION['admin0_id'] = $output[0]['mitarbeiter_id'];
            $_SESSION['admin0_avatar'] = $output[0]['benutzerbild'];
            header("location:../view/index_mobile.php?site=m_lagerung");
        }

    }else{
        header("location:../../index.php");
    }



}

?>



