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

    //Reservation.php
    if($_POST['action'] == 'SELECTEMPTY'){

        $output = Array();
        $fachregal_id = $_POST['id'];

        $stmt = $connection->prepare("SELECT f.name as `fachregal`,f.fachregal_id as `fachregal_id`,f.max_kapazitaet as `max_kapazitaet`, f.bestand as `bestand` 
FROM lagerregal r, fachregal f
WHERE r.lagerregal_id = f.lagerregal_id AND f.bestand < f.max_kapazitaet AND f.fachregal_id = ?");
        $stmt->bind_param("i",$fachregal_id);
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


    //WareHouse.php
    if ($_POST['action'] == "Speichern") {


        $name = $_POST['name'];
        $nummer = $_POST['nummer'];
        $barcode = $_POST['barcode'];
        $fachanzahl = $_POST['fachanzahl'];


        $prepared = $connection->prepare("INSERT INTO `lagerregal`(`name`,`nummer`,`barcode`, `fachanzahl`) VALUES (?,?, ?, ?);");

        if ($prepared == false)
            die("Secured1");

        $result = $prepared->bind_param("sisi", $name,$nummer, $barcode, $fachanzahl);
        if ($result == false)
            die("Secured2");

        $result = $prepared->execute();
        if ($result == false) {
            die("Secured3");
        } else {
            echo "You have been successfully saved.";
        }
        if($result === true){
            $lagerregal_id = $connection->insert_id;
        }


        $prepared->close();



        for($i = 0; $i < $fachanzahl; $i++) {

            $prepared2 = $connection->prepare("INSERT INTO `fachregal`(`name`, `barcode`, `max_kapazitaet`,`lagerregal_id`) VALUES (?, ?, ?,?);");

            if ($prepared2 == false)
                die("Secured11");

            $fachname = "re-".$nummer."-fa-".($i+1);
            $barcode = "00000-".$nummer."-0000-".($i+1);
            $max_kapazitaet = 50;

            $result2 = $prepared2->bind_param("ssii", $fachname, $barcode, $max_kapazitaet,$lagerregal_id);
            if ($result2 == false)
                die("Secured22");

            $result2 = $prepared2->execute();
            if ($result2 == false) {
                die("Secured33");
            } else {
                echo "You have been successfully saved. fach";
            }

            $prepared2->close();
        }


        $prepared2->close();
        $connection->close();

    }


    // select .php FETCHONE
    if($_POST['action'] == 'FETCHONE'){

        $output = Array();
        $fachregal_id = $_POST['id'];

        $stmt = $connection->prepare("SELECT f.name as `fachregal`,f.fachregal_id as `fachregal_id`,f.max_kapazitaet as `max_kapazitaet`, f.bestand as `bestand` 
FROM lagerregal r, fachregal f
WHERE r.lagerregal_id = f.lagerregal_id AND f.fachregal_id = ?");
        $stmt->bind_param("i",$fachregal_id);
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

    // Warehouse.php FETCHALL
    if($_POST['action'] == 'FETCHALL')
    {


        $output = Array();
        $connection = new mysqli(DB_Host, DB_User, DB_Password, DB_Name);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $stmt = $connection->prepare("SELECT lagerregal_id,name,nummer,barcode, fachanzahl FROM lagerregal");
        //      $stmt->bind_param("i",$lieferung_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $output = array();

        while ($data = $result->fetch_assoc())
        {
            $output[] = $data;
        }

        
      
        $stmt->close();
        $connection->close();
        echo json_encode($output);

    }
    // Warehouse.php GETBARCODE
    if($_POST['action'] == 'GETBARCODE'){

        $lagerregal_id = $_POST['id'];

        $output = Array();
        $connection = new mysqli(DB_Host, DB_User, DB_Password, DB_Name);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $stmt = $connection->prepare("SELECT f.lagerregal_id as `lagerregal_id`, r.name as `regalname`, r.nummer as `regalnummer`, fachanzahl ,f.name as `fachregal`,f.fachregal_id as `fachregal_id`, f.barcode as `fachbarcode` FROM lagerregal r, fachregal f
WHERE r.lagerregal_id = f.lagerregal_id AND r.lagerregal_id = ?");
        $stmt->bind_param("i",$lagerregal_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result == false)
            die("Secured");


        $output = array();

        while ($data = $result->fetch_assoc())
        {
            $output[] = $data;
        }


        $stmt->close();
        $connection->close();


        echo json_encode($output);

    }
}else{
    //LAGER (reservation) //LOAD GRID



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


    $query = 'SELECT CONCAT(l.name," ",l.nummer) as `lagerregal_name`,f.name as `fach_name`,
f.max_kapazitaet as `max_kapazitaet`, (CASE WHEN SUM(pf.gelagerte_menge) IS NULL THEN 0 ELSE SUM(pf.gelagerte_menge) END) as `belegt`,
(f.max_kapazitaet - (CASE WHEN SUM(pf.gelagerte_menge) IS NULL THEN 0 ELSE SUM(pf.gelagerte_menge) END)) as `frei_kapazitaet`,
f.fachregal_id,
(CASE WHEN (SELECT p.name FROM produkt p WHERE p.produkt_id = pf.produkt_id) IS NULL THEN "-" ELSE (SELECT p.name FROM produkt p WHERE p.produkt_id = pf.produkt_id) END) as `produkt_name`
FROM position_fach pf RIGHT JOIN fachregal f ON pf.fachregal_id = f.fachregal_id JOIN lagerregal l ON l.lagerregal_id = f.lagerregal_id
GROUP BY f.fachregal_id, pf.produkt_id ';


    if(!empty($_POST["searchPhrase"]))
    {

        $query .= 'HAVING lagerregal_name LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR fach_name LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR max_kapazitaet LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR belegt LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR frei_kapazitaet  LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR produkt_name LIKE "%'.$_POST["searchPhrase"].'%" ';

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
        $query .= ' ORDER BY l.nummer ASC ';
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


    $query1 = "SELECT * FROM fachregal WHERE bestand < max_kapazitaet";
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