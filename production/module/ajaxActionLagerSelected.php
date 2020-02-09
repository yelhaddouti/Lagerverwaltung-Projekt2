<?php
/**
 *
 * @author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
 */
include_once("../db_config/dbconfig.php");


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


$query = 'SELECT CONCAT(l.name," ",l.nummer) as `lagerregal_name`,
f.name as `fach_name`,
f.max_kapazitaet as `max_kapazitaet`,
f.bestand as `belegt`,
( CAST(f.max_kapazitaet as signed) - CAST(f.bestand as signed) ) as `frei_kapazitaet`, 
f.fachregal_id,
(CASE WHEN (SELECT p.name FROM produkt p WHERE p.produkt_id = pf.produkt_id) IS NULL THEN "-" ELSE (SELECT p.name FROM produkt p WHERE p.produkt_id = pf.produkt_id) END) as `produkt_name`
FROM position_fach pf RIGHT JOIN fachregal f ON pf.fachregal_id = f.fachregal_id JOIN lagerregal l ON l.lagerregal_id = f.lagerregal_id
GROUP BY f.fachregal_id, pf.produkt_id HAVING (f.bestand = 0  OR ( f.bestand < f.max_kapazitaet) AND pf.produkt_id ='.$_POST["produkt_id"].') ';



$result = mysqli_query($connection, $query);
$total_records = mysqli_num_rows($result);


    if(!empty($_POST["searchPhrase"]))
    {

        $query .= 'AND (lagerregal_name LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR fach_name LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR max_kapazitaet LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR belegt LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR frei_kapazitaet  LIKE "%'.$_POST["searchPhrase"].'%" ';
        $query .= 'OR produkt_name LIKE "%'.$_POST["searchPhrase"].'%") ';

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
        $query .= ' ORDER BY f.fachregal_id ASC ';
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


    $output = array(
        'current'  => intval($_POST["current"]),
        'rowCount'  => 10,
        'total'   => intval($total_records),
        'rows'   => $data
    );

    echo json_encode($output);



?>