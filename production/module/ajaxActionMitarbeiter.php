<?php
/**
 *
 * @author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
 */
include_once("../db_config/dbconfig.php");


if(isset($_POST["action"])) {

    $connection = new mysqli(DB_Host, DB_User, DB_Password, DB_Name);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    if ($_POST['action'] == "Speichern") {

        $vorname = $_POST['vorname'];
        $nachname = $_POST['nachname'];
        $personal_nr = $_POST['personal_nr'];
        $passwort = $_POST['passwort'];
        $rolle = $_POST['rolle'];
        if(isset($_POST['benutzerbild'])){
            $benutzerbild = $_POST['benutzerbild'];
        }





        $prepared = $connection->prepare("INSERT INTO mitarbeiter(`vorname`,`nachname`,`personal_nr`,`passwort`,`rolle`,`benutzerbild`) VALUES (?,?,?,?,?,?)");

        if ($prepared == false)
            die("Secured1");

        $result = $prepared->bind_param("ssssss", $vorname,$nachname,$personal_nr, $passwort, $rolle,$benutzerbild);
        if ($result == false)
            die("Secured2");

        $result = $prepared->execute();
        if ($result == false) {
            die("Secured3");
        } else {
            echo "You have been successfully saved.";
        }

        $prepared->close();
        $connection->close();

    }

    if($_POST['action'] == 'Aenderungen Speichern'){
        $mitarbeiter_id = intval($_POST['mitarbeiter_id']);
        $vorname = $_POST['vorname'];
        $nachname = $_POST['nachname'];
        $personal_nr = $_POST['personal_nr'];
        $passwort = $_POST['passwort'];
        $rolle = $_POST['rolle'];
        $benutzerbild = $_POST['benutzerbild'];

        if($benutzerbild != ''){

            $prepared = $connection->prepare("UPDATE `mitarbeiter` SET `vorname` = ?, `nachname` = ?, personal_nr = ?, passwort = ?, rolle = ?,benutzerbild = ? WHERE `mitarbeiter_id`= ?");
            if ($prepared == false)
                die("Secured11");

            $result = $prepared->bind_param("ssssssi", $vorname,$nachname,$personal_nr,$passwort,$rolle,$benutzerbild,$mitarbeiter_id);
            if ($result == false)
                die("Secured22");

                echo "update mit Bild";
        }else{
            $prepared = $connection->prepare("UPDATE `mitarbeiter` SET `vorname` = ?, `nachname` = ?, personal_nr = ?, passwort = ?, rolle = ? WHERE `mitarbeiter_id`= ?");
            if ($prepared == false)
                die("Secured1");

            $result = $prepared->bind_param("sssssi", $vorname,$nachname,$personal_nr,$passwort,$rolle,$mitarbeiter_id);
            if ($result == false)
                die("Secured2");
            echo "update ohne Bild";
        }


        $result = $prepared->execute();
        if ($result == false) {
            die("Secured3");
        } else {
            echo "You have been successfully updated.";
        }

        $prepared->close();
        $connection->close();
    }

    if($_POST['action'] == 'DELETE'){


        $mitarbeiter_id = $_POST['mitarbeiter_id'];



        $stmt = $connection->prepare("SELECT (CASE WHEN benutzerbild IS NULL OR benutzerbild = '' THEN 'user.png' ELSE benutzerbild END) as `benutzerbild` FROM mitarbeiter WHERE `mitarbeiter_id`= ?");
        $stmt->bind_param("i",$mitarbeiter_id);
        $stmt->execute();
        $stmt->execute();
        $result = $stmt->get_result();

        $output = array();



        while ($data = $result->fetch_assoc())
        {

            $output[] = $data;

        }



        $benutzerbild = $output[0]['benutzerbild'];
        $stmt->close();
        if($benutzerbild != 'user.png'){
            $path = '../images/'.$benutzerbild;

            if (!unlink($path)) {

            } else {

            }
        }



        $prepared = $connection->prepare("DELETE FROM `mitarbeiter` WHERE `mitarbeiter_id`= ?");

        if ($prepared == false)
            die("Secured1");

        $result = $prepared->bind_param("i", $mitarbeiter_id);
        if ($result == false)
            die("Secured2");

        $result = $prepared->execute();
        if ($result == false) {
            die("Secured3");
        } else {
            echo "You have been successfully Deleted.";
        }

        $prepared->close();
        $connection->close();
    }

    if($_POST['action'] == 'FETCHONE'){

        $output = Array();
        $mitarbeiter_id = $_POST['mitarbeiter_id'];

        $stmt = $connection->prepare("SELECT mitarbeiter_id, vorname,nachname, personal_nr, passwort,rolle, 
(CASE WHEN benutzerbild IS NULL OR benutzerbild = '' THEN 'user.png' ELSE benutzerbild END) as `benutzerbild` FROM mitarbeiter WHERE mitarbeiter_id = ?");
        $stmt->bind_param("i",$mitarbeiter_id);
        $stmt->execute();
        $result = $stmt->get_result();


        while($row = $result->fetch_assoc()) {
            $output['vorname'] = $row['vorname'];
            $output['nachname'] = $row['nachname'];
            $output['personal_nr'] = $row['personal_nr'];
            $output['passwort'] = $row['passwort'];
            $output['rolle'] = $row['rolle'];
            $output['benutzerbild'] = $row['benutzerbild'];
        }

        $stmt->close();


        echo json_encode($output);
    }


    if($_POST['action'] == 'DELETE_IMAGE'){
        $mitarbeiter_id = $_POST['mitarbeiter_id'];
        $image_name = $_POST['image_name'];
        $benutzerbild = '';

        if(isset($_POST['mitarbeiter_id']) && $mitarbeiter_id != ''){
            $prepared = $connection->prepare("UPDATE `mitarbeiter` SET `benutzerbild` = ? WHERE `mitarbeiter_id`= ?");

            if ($prepared == false)
                die("Secured1");

            $result = $prepared->bind_param("si", $benutzerbild,$mitarbeiter_id);
            if ($result == false)
                die("Secured2");

            $result = $prepared->execute();
            if ($result == false) {
                die("Secured3");
            } else {
                echo "You have been successfully updated.";
            }

            $prepared->close();
            $connection->close();
        }

        //remove image form Folder images
        if(isset($image_name) && $image_name != ''){
            $path = '../images/'.$image_name;

            if (!unlink($path)) {
                echo ("Error deleting");
            } else {
                echo ("Deleted");
            }

        }





    }


}else{
    $output = Array();
    $connection = new mysqli(DB_Host, DB_User, DB_Password, DB_Name);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $query = '';
    $data = array();
    $records_per_page = 10;
    $start_from = 0;
    $current_page_number = 0;

    if(isset($_POST["rowCount"]))
    {
        $records_per_page = $_POST["rowCount"];
    }
    else
    {
        $records_per_page = 10;
    }

    if(isset($_POST["current"]))
    {
        $current_page_number = $_POST["current"];
    }
    else
    {
        $current_page_number = 1;
    }

    $start_from = ($current_page_number - 1) * $records_per_page;
    $query .= "SELECT mitarbeiter_id, vorname,nachname, personal_nr, passwort, (CASE 
	WHEN rolle = 0 THEN 'Mitarbeiter' 
    WHEN  rolle = 1 THEN 'Administrator'
END) as `rolle`, 
(CASE WHEN benutzerbild IS NULL OR benutzerbild = '' THEN 'user.png' ELSE benutzerbild END) as `benutzerbild`
    FROM mitarbeiter  ";

    if(!empty($_POST["searchPhrase"]))
    {
        $query .= ' WHERE (mitarbeiter_id LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR vorname LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR nachname LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR personal_nr LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR passwort LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR (CASE WHEN rolle = 0 THEN \'Mitarbeiter\' WHEN  rolle = 1 THEN \'Administrator\' END) LIKE "%'.$_POST["searchPhrase"].'%") ';
    }

    $order_by = '';
    if(isset($_POST["sort"]) && is_array($_POST["sort"]))
    {
        foreach($_POST["sort"] as $key => $value)
        {
            $order_by .= " $key $value, ";
        }
    }
    else
    {
        $query .= 'ORDER BY mitarbeiter_id DESC ';
    }
    if($order_by != '')
    {
        $query .= ' ORDER BY ' . substr($order_by, 0, -2);
    }

    if($records_per_page != -1)
    {
        $query .= " LIMIT " . $start_from . ", " . $records_per_page;
    }

    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result))
    {
        $data[] = $row;
    }

    $query1 = "SELECT * FROM mitarbeiter";
    $result1 = mysqli_query($connection, $query1);
    $total_records = mysqli_num_rows($result1);

    $output = array(
        'current'  => intval($_POST["current"]),
        'rowCount'  => 10,
        'total'   => intval($total_records),
        'rows'   => $data
    );



    echo json_encode($output);

}
?>