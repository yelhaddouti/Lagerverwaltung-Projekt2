<?php
/**
 *
 * @author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
 */
include_once("../db_config/dbconfig.php");

   if(isset($_POST['q'])){
        $connection = new mysqli(DB_Host, DB_User, DB_Password, DB_Name);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $name = $_POST['q'];

        $stmt = $connection->prepare("SELECT * FROM produkt WHERE name LIKE ?");
        $param = "%$name%";

        $stmt->bind_param("s",$param);
        $data = array();
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $produkt_id = $row['produkt_id'];
                $name = $row['name'];
                $data[] = array('id'=>$produkt_id,'text'=>$name);
            }
            $stmt->close();
        }else {
            $data[] = array('id'=>0, 'text'=>'keine Produkt gefunden');
        }

        mysqli_close($connection);

        echo json_encode($data);
   }



?>