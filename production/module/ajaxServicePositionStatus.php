<?php
/**
 *
 * @author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
 */
include_once("../db_config/dbconfig.php");

   if(isset($_POST['lieferung_id']) && isset($_POST['produkt_id'])){
        $connection = new mysqli(DB_Host, DB_User, DB_Password, DB_Name);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }


       $output = Array();
       $lieferung_id = $_POST['lieferung_id'];
       $produkt_id =  $_POST['produkt_id'];

       $stmt = $connection->prepare("SELECT  lieferung_id,produkt_id,SUM(gelagerte_menge) FROM position_fach
GROUP BY lieferung_id,produkt_id HAVING lieferung_id = ? AND produkt_id = ?");

       $stmt->bind_param("ii",$lieferung_id,$produkt_id);
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



?>