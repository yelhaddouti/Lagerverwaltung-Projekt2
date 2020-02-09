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

    if ($_POST['action'] == "INSERT") {

        $lieferung_id = $_POST['lieferung_id'];
        $produkt_id =  $_POST['produkt_id'];
        $fachregal_id = $_POST['fachregal_id'];
        $gelagerte_menge = $_POST['gelagerte_menge'];
        $mitarbeiter_id = $_POST['mitarbeiter_id'];


        $prepared = $connection->prepare("INSERT INTO `position_fach`(`lieferung_id`, `produkt_id`, `fachregal_id`, `gelagerte_menge`, `mitarbeiter_id`) VALUES (?, ?, ?,?,?);");

        if ($prepared == false)
            die("Secured1");

        $result = $prepared->bind_param("iiiii", $lieferung_id, $produkt_id, $fachregal_id, $gelagerte_menge, $mitarbeiter_id);
        if ($result == false)
            die("Secured2");

        $result = $prepared->execute();
        if ($result == false) {
            die("Secured3");
        } else {
            echo "You have been successfully saved...";
        }


        $prepared->close();


        //UPDATE BESTADN FACH
        $prepared2 = $connection->prepare("UPDATE fachregal SET bestand = bestand + ? WHERE fachregal_id = ?");

        if ($prepared2 == false)
            die("Secured11");

        $result2 = $prepared2->bind_param("ii", $gelagerte_menge, $fachregal_id);
        if ($result2 == false)
            die("Secured22");

        $result2 = $prepared2->execute();
        if ($result2 == false) {
            die("Secured33");
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

    if($_POST['action'] == 'REMOVE'){

        $lieferung_id = $_POST['lieferung_id'];
        $produkt_id =  $_POST['produkt_id'];
        $fachregal_id = $_POST['fachregal_id'];
        $gelagerte_menge = $_POST['gelagerte_menge'];


        $prepared = $connection->prepare("DELETE FROM `position_fach` WHERE lieferung_id = ? AND produkt_id = ? AND fachregal_id = ? ");
        if ($prepared == false)
            die("Secured1");

        $result = $prepared->bind_param("iii", $lieferung_id, $produkt_id, $fachregal_id);
        if ($result == false)
            die("Secured2");

        $result = $prepared->execute();
        if ($result == false) {
            die("Secured3");
        } else {
            echo "You have been successfully deleted...";
        }


        $prepared->close();

        //UPDATE BESTADN FACH
        $prepared2 = $connection->prepare("UPDATE fachregal SET bestand = bestand - ? WHERE fachregal_id = ?");

        if ($prepared2 == false)
            die("Secured11");

        $result2 = $prepared2->bind_param("ii", $gelagerte_menge, $fachregal_id);
        if ($result2 == false)
            die("Secured22");

        $result2 = $prepared2->execute();
        if ($result2 == false) {
            die("Secured33");
        }

        $prepared2->close();

        $connection->close();

    }

    if($_POST['action'] == 'FETCHPOSITIONEN'){

        $output = Array();
        $lieferung_id =$_POST['lieferung_id'];
        $produkt_id = $_POST['produkt_id'];


        $stmt = $connection->prepare("SELECT pf.gelagerte_menge as `gelagerte_menge`, f.fachregal_id as `fachregal_id`, f.name as `fachname`, m.mitarbeiter_id as `mitarbeiter_id`, m.nachname as `nachname` FROM fachregal f, mitarbeiter m, position_fach pf WHERE pf.mitarbeiter_id = m.mitarbeiter_id AND pf.fachregal_id = f.fachregal_id AND pf.lieferung_id = ? AND pf.produkt_id = ?");
        $stmt->bind_param("ii",$lieferung_id,$produkt_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $output = array();



        while ($data = $result->fetch_assoc())
        {

            $output[] = $data;

        }



        $stmt->close();
        echo json_encode($output);


    }


}
?>