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

        $name = $_POST['name'];
        $artikel_nr = $_POST['artikel_nr'];
        $bestand = $_POST['bestand'];
        $min_bestand = $_POST['min_bestand'];
        $max_bestand = $_POST['max_bestand'];

        $prepared = $connection->prepare("INSERT INTO `produkt`(`name`, `artikel_nr`, `bestand`,`min_bestand`,`max_bestand`) VALUES (?, ?, ? ,? ,?);");

        if ($prepared == false)
            die("Secured1");

        $result = $prepared->bind_param("ssiii", $name, $artikel_nr, $bestand, $min_bestand, $max_bestand);
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
        $produkt_id = $_POST['id'];
        $name = $_POST['name'];
        $artikel_nr = $_POST['artikel_nr'];
        $min_bestand = $_POST['min_bestand'];
        $max_bestand = $_POST['max_bestand'];


        $prepared = $connection->prepare("UPDATE `produkt` SET `name` = ?, `artikel_nr`= ?, `min_bestand`= ?,`max_bestand` = ? WHERE `produkt_id`= ?");

        if ($prepared == false)
            die("Secured1");

        $result = $prepared->bind_param("ssiii", $name, $artikel_nr,$min_bestand, $max_bestand,$produkt_id);
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

        $produkt_id = $_POST['id'];

        $prepared = $connection->prepare("DELETE FROM `produkt` WHERE `produkt_id`= ?");

        if ($prepared == false)
            die("Secured1");

        $result = $prepared->bind_param("i", $produkt_id);
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
        $produkt_id = $_POST['id'];

        $stmt = $connection->prepare("SELECT * FROM produkt WHERE produkt_id = ?");
        $stmt->bind_param("i",$produkt_id);
        $stmt->execute();
        $result = $stmt->get_result();


        while($row = $result->fetch_assoc()) {

            $output["artikel_nr"] = $row["artikel_nr"];
            $output["name"] = $row["name"];
            $output["bestand"] = $row["bestand"];
            $output["min_bestand"] = $row["min_bestand"];
            $output["max_bestand"] = $row["max_bestand"];
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
    $query .= "SELECT produkt_id, name, artikel_nr, bestand, min_bestand, max_bestand,
(CASE 
	WHEN bestand = 0 THEN 'nicht verfügbar' 
    WHEN  bestand > 0 AND bestand < min_bestand THEN 'fast leer'
    ELSE 'auf der Lager'
END) as `status`
FROM produkt ";

    if(!empty($_POST["searchPhrase"]))
    {
        $query .= 'WHERE (produkt_id LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR name LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR artikel_nr LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR bestand LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR min_bestand LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR max_bestand LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR (CASE 
	WHEN bestand = 0 THEN \'nicht verfügbar\' 
    WHEN  bestand > 0 AND bestand < min_bestand THEN \'fast leer\'
    ELSE \'auf der Lager\'
END)  LIKE "%'.$_POST["searchPhrase"].'%" ) ';
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
        $query .= 'ORDER BY produkt_id DESC ';
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


    $query1 = "SELECT * FROM produkt";
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