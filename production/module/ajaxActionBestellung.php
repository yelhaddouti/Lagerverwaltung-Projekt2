<?php
/**
 *
 * @author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
 */
include_once("../db_config/dbconfig.php");



if(isset($_POST["action"])) {


    $connection = new mysqli(DB_Host, DB_User, DB_Password, DB_Name);
    $connection->query("SET GLOBAL FOREIGN_KEY_CHECKS=0;");

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    if ($_POST['action'] == "Speichern") {


        $bestellung_nr = $_POST['bestellung_nr'];

        $datum = date_format(date_create($_POST['datum']),"Y-m-d");
        $kunde_id = $_POST['kunde_id'];


        $prepared = $connection->prepare("INSERT INTO `bestellung`(`bestellung_nr`, `datum`, `kunde_id`) VALUES (?, ?, ?);");

        if ($prepared == false)
            die("Secured1");

        $result = $prepared->bind_param("ssi", $bestellung_nr, $datum, $kunde_id);
        if ($result == false)
            die("Secured2");

        $result = $prepared->execute();
        if ($result == false) {
            die("Secured3");
        } else {
            echo "You have been successfully saved.";
        }
        if($result === true){
            $bestellung_id = $connection->insert_id;
        }


        $prepared->close();


        foreach ($_POST["bestellung_position"] as $bestellung_position ){



            $prepared2 = $connection->prepare("INSERT INTO `bestellung_position`(`bestellung_id`, `produkt_id`, `menge`) VALUES (?, ?, ?);");

            if ($prepared2 == false)
                die("Secured11");

            $result2 = $prepared2->bind_param("iii", $bestellung_id, $bestellung_position['produkvalue'], $bestellung_position['produktqte']);
            if ($result2 == false)
                die("Secured22");

            $result2 = $prepared2->execute();
            if ($result2 == false) {
                die("Secured3");
            } else {
                echo "You have been successfully saved. positionen";
            }

            $prepared2->close();

        }



        $prepared2->close();
        $connection->close();

    }

    if($_POST['action'] == 'Aenderungen Speichern'){


        $bestellung_id = $_POST['id'];

        $bestellung_nr = $_POST['bestellung_nr'];
        $datum = date_format(date_create($_POST['datum']),"Y-m-d");
        $kunde_id = $_POST['kunde_id'];


        $prepared = $connection->prepare("UPDATE `bestellung` SET `bestellung_nr` = ?, `datum`= ?, `kunde_id`= ? WHERE `bestellung_id`= ?");

        if ($prepared == false)
            die("Secured1");

        $result = $prepared->bind_param("ssii", $bestellung_nr, $datum, $kunde_id, $bestellung_id);
        if ($result == false)
            die("Secured2");

        $result = $prepared->execute();
        if ($result == false) {
            die("Secured3");
        } else {
            echo "You have been successfully updated.";
        }

        $prepared->close();


        //delete Positionen

        $prepared3 = $connection->prepare("DELETE FROM `bestellung_position` WHERE `bestellung_id`= ?");

        if ($prepared3 == false)
            die("Secured1");

        $result3 = $prepared3->bind_param("i", $bestellung_id);
        if ($result3 == false)
            die("Secured2");

        $result3 = $prepared3->execute();
        if ($result == false) {
            die("Secured3");
        } else {
            echo "You have been successfully Positonen deleted.";
        }

        $prepared3->close();



        foreach ($_POST["bestellung_position"] as $bestellung_position ){


            $prepared2 = $connection->prepare("INSERT INTO `bestellung_position`(`bestellung_id`, `produkt_id`, `menge`) VALUES (?, ?, ?);");

            if ($prepared2 == false)
                die("Secured11");

            $result2 = $prepared2->bind_param("iii", $bestellung_id, $bestellung_position['produkvalue'], $bestellung_position['produktqte']);
            if ($result2 == false)
                die("Secured22");

            $result2 = $prepared2->execute();
            if ($result2 == false) {
                die("Secured3");
            } else {
                echo "You have been successfully saved. positionen";
            }

            $prepared2->close();

        }



        $prepared2->close();
        $connection->close();


    }

    if($_POST['action'] == 'DELETE'){

        $bestellung_id = $_POST['id'];

        $prepared = $connection->prepare("DELETE FROM `bestellung` WHERE `bestellung_id`= ?");

        if ($prepared == false)
            die("Secured1");

        $result = $prepared->bind_param("i", $bestellung_id);
        if ($result == false)
            die("Secured2");

        $result = $prepared->execute();
        if ($result == false) {
            die("Secured3");
        } else {
            echo "You have been successfully Deleted.";
        }

        $prepared->close();

        //delete Positionen

        $prepared3 = $connection->prepare("DELETE FROM `bestellung_position` WHERE `bestellung_id`= ?");

        if ($prepared3 == false)
            die("Secured1");

        $result3 = $prepared3->bind_param("i", $bestellung_id);
        if ($result3 == false)
            die("Secured2");

        $result3 = $prepared3->execute();
        if ($result == false) {
            die("Secured3");
        } else {
         //   echo "You have been successfully Positonen deleted.";
        }

        $prepared3->close();


        $connection->close();
    }

    if($_POST['action'] == 'FETCHONE'){

        $output = Array();
        $bestellung_id = $_POST['id'];

        $stmt = $connection->prepare("SELECT p.produkt_id as `produkt_id`,p.name as `produkt_name`, bp.menge as `menge`, b.bestellung_id as `bestellung_id`, b.bestellung_nr as `bestellung_nr`, DATE_FORMAT(b.datum, '%d.%m.%Y') as `datum`, CONCAT(k.nachname,' ',k.vorname) as `name`, b.kunde_id as `kunde_id` 
FROM bestellung b, kunde k ,bestellung_position bp,produkt p WHERE b.kunde_id = k.kunde_id AND bp.produkt_id = p.produkt_id AND bp.bestellung_id = b.bestellung_id AND b.bestellung_id = ?");
        $stmt->bind_param("i",$bestellung_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $output = array();



        while ($data = $result->fetch_assoc())
            {

                $output[] = $data;

            }










        /*
        while($row = $result->fetch_assoc()) {

            $output["lieferung_nr"] = $row["lieferung_nr"];
            $output["datum"] = $row["datum"];
            $output["lieferant_id"] = $row["lieferant_id"];
            $output["name"] = $row["name"];
            $output["produkt_id"] = $row["produkt_id"];
            $output["produkt_name"] = $row["produkt_name"];
            $output["menge"] = $row["menge"];
        }*/


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
    $query .= "SELECT b.bestellung_id as `bestellung_id`, b.bestellung_nr as `bestellung_nr`, DATE_FORMAT(b.datum, '%d.%m.%Y') as `datum`, CONCAT(k.nachname,' ',k.vorname) as `name` 
            FROM bestellung b, kunde k WHERE b.kunde_id = k.kunde_id ";

    if(!empty($_POST["searchPhrase"]))
    {

        $query .= 'AND (b.bestellung_id LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR b.bestellung_nr LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR DATE_FORMAT(b.datum, "%d.%m.%Y") LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR k.vorname LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR k.nachname LIKE "%'.$_POST["searchPhrase"].'%" ) ';

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
        $query .= 'ORDER BY bestellung_id DESC ';
    }
    if($order_by != '')
    {
        $query .= ' ORDER BY '. substr($order_by, 0, -2);
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

    $query1 = "SELECT * FROM bestellung";
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