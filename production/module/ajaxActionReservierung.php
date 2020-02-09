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


        $lieferung_nr = $_POST['lieferung_nr'];

        $datum = date_format(date_create($_POST['datum']),"Y-m-d");
        $lieferant_id = $_POST['lieferant_id'];


        $prepared = $connection->prepare("INSERT INTO `lieferung`(`lieferung_nr`, `datum`, `lieferant_id`) VALUES (?, ?, ?);");

        if ($prepared == false)
            die("Secured1");

        $result = $prepared->bind_param("ssi", $lieferung_nr, $datum, $lieferant_id);
        if ($result == false)
            die("Secured2");

        $result = $prepared->execute();
        if ($result == false) {
            die("Secured3");
        } else {
            echo "You have been successfully saved.";
        }
        if($result === true){
            $lieferung_id = $connection->insert_id;
        }


        $prepared->close();


        foreach ($_POST["lieferung_position"] as $lieferung_position ){



            $prepared2 = $connection->prepare("INSERT INTO `lieferung_position`(`lieferung_id`, `produkt_id`, `menge`) VALUES (?, ?, ?);");

            if ($prepared2 == false)
                die("Secured11");

            $result2 = $prepared2->bind_param("iii", $lieferung_id, $lieferung_position['produkvalue'], $lieferung_position['produktqte']);
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


        $lieferung_id = $_POST['id'];

        $lieferung_nr = $_POST['lieferung_nr'];
        $datum = date_format(date_create($_POST['datum']),"Y-m-d");
        $lieferant_id = $_POST['lieferant_id'];


        $prepared = $connection->prepare("UPDATE `lieferung` SET `lieferung_nr` = ?, `datum`= ?, `lieferant_id`= ? WHERE `lieferung_id`= ?");

        if ($prepared == false)
            die("Secured1");

        $result = $prepared->bind_param("ssii", $lieferung_nr, $datum, $lieferant_id, $lieferung_id);
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

        $prepared3 = $connection->prepare("DELETE FROM `lieferung_position` WHERE `lieferung_id`= ?");

        if ($prepared3 == false)
            die("Secured1");

        $result3 = $prepared3->bind_param("i", $lieferung_id);
        if ($result3 == false)
            die("Secured2");

        $result3 = $prepared3->execute();
        if ($result == false) {
            die("Secured3");
        } else {
            echo "You have been successfully Positonen deleted.";
        }

        $prepared3->close();



        foreach ($_POST["lieferung_position"] as $lieferung_position ){


            $prepared2 = $connection->prepare("INSERT INTO `lieferung_position`(`lieferung_id`, `produkt_id`, `menge`) VALUES (?, ?, ?);");

            if ($prepared2 == false)
                die("Secured11");

            $result2 = $prepared2->bind_param("iii", $lieferung_id, $lieferung_position['produkvalue'], $lieferung_position['produktqte']);
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

        $lieferung_id = $_POST['id'];

        $prepared = $connection->prepare("DELETE FROM `lieferung` WHERE `lieferung_id`= ?");

        if ($prepared == false)
            die("Secured1");

        $result = $prepared->bind_param("i", $lieferung_id);
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

        $prepared3 = $connection->prepare("DELETE FROM `lieferung_position` WHERE `lieferung_id`= ?");

        if ($prepared3 == false)
            die("Secured1");

        $result3 = $prepared3->bind_param("i", $lieferung_id);
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
        $lieferung_id = $_POST['lieferung_id'];
        $produkt_id = $_POST['produkt_id'];


        $stmt = $connection->prepare("SELECT l.lieferung_nr as `lieferung_nr`,DATE_FORMAT(l.datum, '%d.%m.%Y') as `datum`, p.name as `produkt_name`, lp.menge as `menge`,lp.lieferung_id as `lieferung_id`, lp.produkt_id as `produkt_id`,lp.gelagert as `gelagert`FROM lieferung_position lp, lieferung l , produkt p WHERE lp.lieferung_id = l.lieferung_id AND lp.produkt_id = p.produkt_id AND lp.lieferung_id = ? AND lp.produkt_id = ?");
        $stmt->bind_param("ii",$lieferung_id, $produkt_id);
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
 //   $query .= "SELECT l.lieferung_nr as `lieferung_nr`,DATE_FORMAT(l.datum, '%d.%m.%Y') as `datum`, p.name as `produkt_name`, lp.menge as `menge`,lp.lieferung_id as `lieferung_id`, lp.produkt_id as `produkt_id`,lp.gelagert as `gelagert`FROM lieferung_position lp, lieferung l , produkt p WHERE lp.lieferung_id = l.lieferung_id AND lp.produkt_id = p.produkt_id AND lp.gelagert = 0 ";
    $query = "SELECT sum(pf.gelagerte_menge) as `sum_gelagerte_menge`,l.lieferung_nr as `lieferung_nr`,
DATE_FORMAT(l.datum, '%d.%m.%Y') as `datum`,
p.name as `produkt_name`, lp.menge as `menge`,
lp.lieferung_id as `lieferung_id`,
lp.produkt_id as `produkt_id`,
(CASE 
	WHEN sum(pf.gelagerte_menge) = lp.menge THEN 'komplett bearbeitet' 
    WHEN sum(pf.gelagerte_menge) < lp.menge THEN 'teilweise bearbeitet'
    ELSE 'noch nicht bearbietet'
END) as `status`
FROM lieferung_position lp JOIN  lieferung l ON lp.lieferung_id = l.lieferung_id 
JOIN produkt p ON lp.produkt_id = p.produkt_id 
LEFT JOIN position_fach pf ON lp.lieferung_id = pf.lieferung_id 
AND lp.produkt_id = pf.produkt_id WHERE lp.gelagert = 0
GROUP BY lp.lieferung_id, lp.produkt_id ";

    if(!empty($_POST["searchPhrase"]))
    {
        $query .= 'HAVING lieferung_nr LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR datum LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR produkt_name LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR menge LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR status LIKE "%'.$_POST["searchPhrase"].'%" ';

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
        $query .= 'ORDER BY lieferung_nr DESC ';
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

    $query1 = "SELECT * FROM lieferung_position WHERE gelagert = 0";
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