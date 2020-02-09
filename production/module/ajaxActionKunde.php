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
        $geburtsdatum = date_format(date_create($_POST['geburtsdatum']),"Y-m-d");
        $strasse = $_POST['strasse'];
        $hausnummer = $_POST['hausnummer'];
        $postleitzahl = $_POST['postleitzahl'];
        $stadt = $_POST['stadt'];
        $fax = $_POST['fax'];
        $tel = $_POST['tel'];


        $prepared = $connection->prepare("INSERT INTO kunde (`vorname`,`nachname`,`geburtsdatum`,`strasse`, `hausnummer`,`postleitzahl`,`stadt`,`fax`,`tel`) VALUES (?,?,?,?,?,?,?,?,?);");

        if ($prepared == false)
            die("Secured1");

        $result = $prepared->bind_param("sssssssss", $vorname,$nachname,$geburtsdatum, $strasse, $hausnummer, $postleitzahl, $stadt, $fax, $tel);
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
        $kunde_id = $_POST['kunde_id'];
        $vorname = $_POST['vorname'];
        $nachname = $_POST['nachname'];
        $geburtsdatum = date_format(date_create($_POST['geburtsdatum']),"Y-m-d");
        $strasse = $_POST['strasse'];
        $hausnummer = $_POST['hausnummer'];
        $postleitzahl = $_POST['postleitzahl'];
        $stadt = $_POST['stadt'];
        $fax = $_POST['fax'];
        $tel = $_POST['tel'];


        $prepared = $connection->prepare("UPDATE `kunde` SET `vorname` = ?, `nachname` = ?, `geburtsdatum` = ?,`strasse`= ?, `hausnummer`= ?, `postleitzahl` = ?, `stadt`= ?, `fax`= ?, `tel`= ? WHERE `kunde_id`= ?");

        if ($prepared == false)
            die("Secured1");

        $result = $prepared->bind_param("sssssssssi", $vorname,$nachname,$geburtsdatum, $strasse, $hausnummer, $postleitzahl, $stadt, $fax, $tel,$kunde_id);
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

    if($_POST['action'] == 'DELETE'){

        $kunde_id = $_POST['kunde_id'];

        $prepared = $connection->prepare("DELETE FROM `kunde` WHERE `kunde_id`= ?");

        if ($prepared == false)
            die("Secured1");

        $result = $prepared->bind_param("i", $kunde_id);
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
        $kunde_id = $_POST['kunde_id'];

        $stmt = $connection->prepare("SELECT * FROM kunde WHERE kunde_id = ?");
        $stmt->bind_param("i",$kunde_id);
        $stmt->execute();
        $result = $stmt->get_result();


        while($row = $result->fetch_assoc()) {
            $output['vorname'] = $row['vorname'];
            $output['nachname'] = $row['nachname'];
            $output['geburtsdatum'] = DATE_FORMAT( date_create($row['geburtsdatum']), 'd.m.Y');
            $output['strasse'] = $row['strasse'];
            $output['hausnummer'] = $row['hausnummer'];
            $output['postleitzahl'] = $row['postleitzahl'];
            $output['stadt'] = $row['stadt'];
            $output["fax"] = $row["fax"];
            $output["tel"] = $row["tel"];
        }

        $stmt->close();

        echo json_encode($output);
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
    $query .= "SELECT kunde_id, vorname,nachname, DATE_FORMAT(geburtsdatum, '%d.%m.%Y') as `geburtsdatum`,CONCAT(strasse,' ',hausnummer,', ',postleitzahl,' ',stadt) as adresse, fax, tel
    FROM kunde ";

    if(!empty($_POST["searchPhrase"]))
    {
        $query .= ' WHERE (kunde_id LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR vorname LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR nachname LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR DATE_FORMAT(geburtsdatum, "%d.%m.%Y") LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR CONCAT(strasse," ",hausnummer,", ",postleitzahl," ",stadt) LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR fax LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR tel LIKE "%'.$_POST["searchPhrase"].'%" ) ';
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
        $query .= 'ORDER BY kunde_id DESC ';
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

    $query1 = "SELECT * FROM kunde";
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