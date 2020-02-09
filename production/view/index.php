<!--
@author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
-->
<?php session_start();?>
<?php include_once("../authentication/check_session.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  
    <title>LAGERVERWALTUNG v 1.0</title>

    <!-- Bootstrap -->
    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">


      <!-- JQeury Bootgrid-->
      <link rel="stylesheet" href="../css/jquery.bootgrid.css">
     <!-- <link rel="stylesheet" href="css/select2.css"> -->

    <!-- NProgress -->
    <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="../../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../../vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
      <!-- bootstrap-datetimepicker -->
      <link href="../../vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

      <!-- Bootstrap Colorpicker -->
      <link href="../../vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">

    <!-- new Style-->
      <link rel="stylesheet" href="../css/style/style.css">

      <!-- Teamplte Style Änderungen -->
      <link rel="stylesheet" href="../css/style/template.css">

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;background-color: #364157">
              <a href="index.php?site=home" class="site_title"><i class="fa fa-windows" style="font-size: 28px;color: #ffffff;border-radius:0;border:none; ;"></i> <span style="font-size: 16px;">Administration <small>V 1.0</small></span></a>
            </div>

            <div class="clearfix">

            </div>

            <!-- menu profile quick info -->
         <!--   <?php /* include("../include_layout/h_menu_profile_quick.php"); */ ?> -->
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <?php include("../include_layout/h_sidebar_menu.php"); ?>
            <!-- /sidebar menu -->


          <!-- menu profile quick info -->
          <?php include("../include_layout/h_menu_profile_quick.php"); ?>
          <!-- /menu profile quick info -->

            <!-- /menu footer buttons -->
           <?php include("../include_layout/h_menu_footer_buttons.php"); ?>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
         <?php include("../include_layout/h_top_navigation.php"); ?>
        <!-- /top navigation -->

        <!-- page content -->
          <?php
          // Array of all available sites.
          $availableSites = ["lieferant", "lieferung", "reservation", "produkt","kunde","auslagern","bestellung","lager","mitarbeiter","home"];
          if( isset($_GET['site']) && in_array($_GET['site'], $availableSites)) {
              global $currentSite;
              $currentSite = $_GET['site'];

          }else{
              $currentSite ="home";
          }

          ?>

          <?php include($currentSite.".php"); ?>
        </div>
        <!-- /page content -->

        <!-- footer content -->

        <?php include("../include_layout/h_footer_content.php"); ?>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
   <script src="../../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../../vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../../vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../../vendors/moment/min/moment.min.js"></script>
    <script src="../../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-datetimepicker + -->
    <script src="../../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>


    <!-- bootstrap-wysiwyg -->
    <script src="../../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="../../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>


    <!--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.js" integrity="sha256-ASBoVF7YsFeFNsTSQXGollow0nMkiNhagGJF4/h58sQ=" crossorigin="anonymous"></script>
    -->
    <script src="../js/jqeury.bootgrid.js"></script>
    <script src="../js/jquery.bselect.js"></script>

    <!-- Switchery -->
    <script src="../../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../../vendors/select2/dist/js/select2.full.min.js"></script>

    <!-- -( BARCODE)-->

    <script src="../js/jquery-barcode.min.js"></script>

    <!-- Parsley -->
    <script src="../../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>

    <!-- Bootstrap Colorpicker -->
    <script src="../../vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>

    <!-- starrr -->
    <script src="../../vendors/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../../build/js/custom.min.js"></script>

    <!-- mein JS -->

    <?php

     echo "<script src='../controller_js/$currentSite.js' ></script>";
    ?>





  </body>
</html>

