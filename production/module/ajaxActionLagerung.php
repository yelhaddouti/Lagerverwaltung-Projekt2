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
    /* LIEFIERUNG*/
    if ($_POST['action'] == 'FETCHALL') {




            $output = Array();
            $mitarbeiter_id = $_POST['mitarbeiter_id'];


            $stmt = $connection->prepare("SELECT pf.lieferung_id,pf.produkt_id,pf.fachregal_id,l.lieferung_nr as `lieferung`, DATE_FORMAT(l.datum, '%d.%m.%Y') as `datum`,p.`name` as `produkt_name`,CONCAT(lr.name,'',lr.nummer) as `regal_name` , fr.name as `fach_name`, fr.barcode as `barcode` ,pf.gelagerte_menge FROM position_fach pf JOIN lieferung_position lp USING(lieferung_id,produkt_id) JOIN produkt p USING(produkt_id) JOIN lieferung l USING (lieferung_id) JOIN fachregal fr USING(fachregal_id) JOIN lagerregal lr USING(lagerregal_id) JOIN mitarbeiter m USING(mitarbeiter_id) WHERE pf.ist_gelagert <> 1 AND m.mitarbeiter_id = ?");
            $stmt->bind_param("i",$mitarbeiter_id);
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

    if ($_POST['action'] == 'INSERT') {


        $liefeurng_id = $_POST['liefeurng_id'];
        $produkt_id =  $_POST['produkt_id'];
        $fachregal_id =  $_POST['fachregal_id'];
        $menge =  $_POST['menge'];


        $prepared = $connection->prepare("UPDATE position_fach SET ist_gelagert ='1' WHERE (lieferung_id =  ? ) AND (produkt_id = ?) AND (fachregal_id = ?)");

        if ($prepared == false)
            die("Secured1");

        $result = $prepared->bind_param("iii", $liefeurng_id, $produkt_id, $fachregal_id);
        if ($result == false)
            die("Secured2");

        $result = $prepared->execute();
        if ($result == false) {
            die("Secured3");
        } else {
            echo "You have been successfully lagiert.";
        }

        $prepared->close();

        $prepared2 = $connection->prepare("UPDATE produkt SET bestand = bestand + ? WHERE produkt_id = ?");

        if ($prepared2 == false)
            die("Secured1");

        $result2 = $prepared2->bind_param("ii", $menge,$produkt_id);
        if ($result2 == false)
            die("Secured2");

        $result2 = $prepared2->execute();
        if ($result2 == false) {
            die("Secured3");
        } else {
            echo "You have been successfully updated.";
        }

        $prepared2->close();


        $stmt3 = $connection->prepare("SELECT menge FROM lieferung_position WHERE lieferung_id = ? AND produkt_id = ?");


        $stmt3->bind_param("ii",$liefeurng_id,$produkt_id);
        $stmt3->execute();
        $result3= $stmt3->get_result();

        $output = array();



        while ($data = $result3->fetch_assoc())
        {

            $output[] = $data;

        }


        $menge_produkt = $output[0]['menge'];


        $stmt4 = $connection->prepare("SELECT sum(gelagerte_menge) as `gelagerte_menge_positionen`FROM position_fach  WHERE (lieferung_id =  ? ) AND (produkt_id = ?) AND (ist_gelagert = '1')");

        $stmt4->bind_param("ii",$liefeurng_id,$produkt_id);
        $stmt4->execute();
        $result4= $stmt4->get_result();

        $output = array();



        while ($data = $result4->fetch_assoc())
        {

            $output[] = $data;

        }


        $gelagerte_menge_positionen = $output[0]['gelagerte_menge_positionen'];






        if($menge_produkt == $gelagerte_menge_positionen){

            $prepared3 = $connection->prepare("UPDATE lieferung_position SET gelagert = '1' WHERE lieferung_id = ? AND produkt_id = ?");

            if ($prepared3 == false)
                die("Secured1");

            $result3 = $prepared3->bind_param("ii", $liefeurng_id,$produkt_id);
            if ($result3 == false)
                die("Secured2");

            $result3 = $prepared3->execute();
            if ($result3 == false) {
                die("Secured3");
            }

            $prepared3->close();
        }



        $connection->close();







    }

    /* BESTELLUNG */

    if ($_POST['action'] == 'FETCHALL_BESTELLUNG') {




        $output = Array();
        $mitarbeiter_id = $_POST['mitarbeiter_id'];

        $stmt = $connection->prepare("SELECT pf.bestellung_id, pf.produkt_id,pf.fachregal_id,b.bestellung_nr as `bestellung`, DATE_FORMAT(b.datum, '%d.%m.%Y') as `datum`,p.`name` as `produkt_name`,CONCAT(lr.name,'',lr.nummer) as `regal_name` , fr.name as `fach_name`, fr.barcode as `barcode` ,pf.ausgelagerte_menge 
FROM position_fach_bestellung pf JOIN bestellung_position lp USING(bestellung_id,produkt_id) JOIN produkt p USING(produkt_id) JOIN bestellung b USING (bestellung_id) JOIN fachregal fr USING(fachregal_id) JOIN lagerregal lr USING(lagerregal_id) JOIN mitarbeiter m USING(mitarbeiter_id) WHERE pf.ist_ausgelagert <> 1 AND m.mitarbeiter_id = ?");
        $stmt->bind_param("i",$mitarbeiter_id);
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

    if ($_POST['action'] == 'INSERT_BESTELLUNG') {


        $bestellung_id = $_POST['bestellung_id'];
        $produkt_id =  $_POST['produkt_id'];
        $fachregal_id =  $_POST['fachregal_id'];
        $menge =  $_POST['menge'];


        $prepared = $connection->prepare("UPDATE position_fach_bestellung SET ist_ausgelagert ='1' WHERE (bestellung_id =  ? ) AND (produkt_id = ?) AND (fachregal_id = ?)");

        if ($prepared == false)
            die("Secured1");

        $result = $prepared->bind_param("iii", $bestellung_id, $produkt_id, $fachregal_id);
        if ($result == false)
            die("Secured2");

        $result = $prepared->execute();
        if ($result == false) {
            die("Secured3");
        } else {
            echo "You have been successfully ausglagiert.";
        }

        $prepared->close();

        $prepared2 = $connection->prepare("UPDATE produkt SET bestand = bestand - ? WHERE produkt_id = ?");

        if ($prepared2 == false)
            die("Secured1");

        $result2 = $prepared2->bind_param("ii", $menge,$produkt_id);
        if ($result2 == false)
            die("Secured2");

        $result2 = $prepared2->execute();
        if ($result2 == false) {
            die("Secured3");
        } else {
            echo "You have been successfully updated.";
        }

        $prepared2->close();


        $stmt3 = $connection->prepare("SELECT menge FROM bestellung_position WHERE bestellung_id = ? AND produkt_id = ?");


        $stmt3->bind_param("ii",$bestellung_id,$produkt_id);
        $stmt3->execute();
        $result3= $stmt3->get_result();

        $output = array();



        while ($data = $result3->fetch_assoc())
        {

            $output[] = $data;

        }


        $menge_produkt = $output[0]['menge'];


        $stmt4 = $connection->prepare("SELECT sum(ausgelagerte_menge) as `ausgelagerte_menge_positionen` FROM position_fach_bestellung  WHERE (bestellung_id =  ? ) AND (produkt_id = ?) AND (ist_ausgelagert = '1')");

        $stmt4->bind_param("ii",$bestellung_id,$produkt_id);
        $stmt4->execute();
        $result4= $stmt4->get_result();

        $output = array();



        while ($data = $result4->fetch_assoc())
        {

            $output[] = $data;

        }


        $ausgelagerte_menge_positionen = $output[0]['ausgelagerte_menge_positionen'];



        if($menge_produkt == $gelagerte_menge_positionen){

            $prepared3 = $connection->prepare("UPDATE bestellung_position SET gelagert = '1' WHERE bestellung_id = ? AND produkt_id = ?");

            if ($prepared3 == false)
                die("Secured1");

            $result3 = $prepared3->bind_param("ii", $bestellung_id,$produkt_id);
            if ($result3 == false)
                die("Secured2");

            $result3 = $prepared3->execute();
            if ($result3 == false) {
                die("Secured3");
            }

            $prepared3->close();
        }



        $connection->close();







    }







}

?>