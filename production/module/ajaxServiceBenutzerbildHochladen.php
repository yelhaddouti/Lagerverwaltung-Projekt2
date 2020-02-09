<?php
/**
 *
 * @author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
 */

if(isset($_POST['old_image']) && $_POST['old_image'] != ''){
    $path = '../images/'.$_POST['old_image'];

    if (!unlink($path)) {

    } else {

    }

}
if($_FILES["bild"]["name"] != '') {

    $image_name = $_POST['bildname'];

    //$test = explode(".", $_FILES["bild"]["name"]);
    //$extension = end($test);
   /*
    $ms = 2000;
    $seconds = round($ms / 1000, 2);
    sleep($seconds);
*/
    $location = '../images/' .$image_name;
    move_uploaded_file($_FILES["bild"]["tmp_name"], $location);
    echo '<img src="' . $location . '" height="150" width="225" class="img-thumbnail" style="margin-top:-25px; border-radius:0"/><div style="cursor: pointer" id="remove_uploaded_image" class="btn btn-outline-danger btn-sm ml-1"><i class="fa fa-trash" style="font-size:18px"></i> Benutzerbild Löschen </div>';

}


?>