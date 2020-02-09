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
    $query .= "SELECT m.mitarbeiter_id, m.vorname, m.nachname, m.personal_nr,
(CASE WHEN m.benutzerbild IS NULL OR m.benutzerbild = '' THEN 'user.png' ELSE m.benutzerbild END) as `benutzerbild`,
(CASE WHEN m.ist_angemeldet = '0' THEN 'Offline' WHEN m.ist_angemeldet = '1' THEN 'Online' END) as `status`,
(CASE WHEN (SELECT COUNT(pf.mitarbeiter_id) FROM mitarbeiter m1 left join position_fach pf using(mitarbeiter_id) 
WHERE m1.mitarbeiter_id = m.mitarbeiter_id AND pf.ist_gelagert ='0' 
GROUP BY (pf.mitarbeiter_id)) IS NULL THEN 0 ELSE (SELECT COUNT(pf.mitarbeiter_id) FROM mitarbeiter m1 left join position_fach pf using(mitarbeiter_id) 
WHERE m1.mitarbeiter_id = m.mitarbeiter_id AND pf.ist_gelagert ='0' 
GROUP BY (pf.mitarbeiter_id)) END)as 'soll_lagern',
(CASE WHEN (SELECT COUNT(pfb.mitarbeiter_id) FROM mitarbeiter m2 left join position_fach_bestellung pfb using(mitarbeiter_id)
WHERE m2.mitarbeiter_id = m.mitarbeiter_id AND pfb.ist_ausgelagert ='0' 
GROUP BY (pfb.mitarbeiter_id)) IS NULL THEN 0 ELSE (SELECT COUNT(pfb.mitarbeiter_id) FROM mitarbeiter m2 left join position_fach_bestellung pfb using(mitarbeiter_id)
WHERE m2.mitarbeiter_id = m.mitarbeiter_id AND pfb.ist_ausgelagert ='0' 
GROUP BY (pfb.mitarbeiter_id)) END) as 'soll_auslagern' 
FROM mitarbeiter m WHERE m.rolle = '0' ";



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
        $query .= 'ORDER BY status DESC ';
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

    $query1 = "SELECT * FROM mitarbeiter WHERE rolle = '0'";
    $result1 = mysqli_query($connection, $query1);
    $total_records = mysqli_num_rows($result1);

    $output = array(
        'current'  => intval($_POST["current"]),
        'rowCount'  => 10,
        'total'   => intval($total_records),
        'rows'   => $data
    );



    echo json_encode($output);


?>