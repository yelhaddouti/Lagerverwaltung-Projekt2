<?php
/**
 *
 * @author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
 */

include_once("../db_config/dbconfig.php");

if($_POST['action2'] == 'GET') {


    $connection = new mysqli(DB_Host, DB_User, DB_Password, DB_Name);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }


    $qeury = "SELECT MAX(bestellung_id) as `next_id` FROM bestellung LIMIT 1";
    $result = mysqli_query($connection, $qeury);


    $next_id = 1;


    $data = $result->fetch_all(MYSQLI_ASSOC);

    if ($data[0]['next_id'] != NULL) {
        $next_id = $data[0]['next_id'] + 1;
    }

    $output['next_bestellung_nr'] = $next_bestellung_nr = date("mdy") . '' . $next_id;

    echo json_encode($output);

}

?>