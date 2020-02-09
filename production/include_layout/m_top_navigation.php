<!--
@author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
-->

<div class="top_nav" style="margin-left: 0px;">
    <div class="nav_menu">


        <nav class="nav navbar-nav">

            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                        <img style="border:1px solid #5A738E" src="../images/<?php echo $_SESSION['admin0_avatar']; ?>" alt=""><?php echo $_SESSION["admin0"]; ?>
                        <input type="hidden" id="session_mitarbeiter_id" value="<?php echo $_SESSION['admin0_id'];?>">
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"  href="javascript:;"> Profile</a>
                        <a class="dropdown-item"  href="../authentication/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                </li>


                <li class="nav-item dropdown " style="padding-right:15px" >
                    <a href="?site=m_lagerung" class="btn btn-outline-success btn-sm <?php if( (!isset($_GET['site'])) || ($_GET['site'] == 'm_lagerung') ) echo active ?>">
                        <i class="fa fa-download"></i>&nbsp;&nbsp;lagerung
                    </a>
                </li>

                <li class="nav-item dropdown" style="padding-right: 15px;">
                    <a href="?site=m_auslagerung" class="btn btn-outline-success btn-sm <?php if( $_GET['site'] == 'm_auslagerung')  echo active ?>">
                        <i class="fa fa-upload"></i>&nbsp;&nbsp;auslagerung
                    </a>
                </li>





            </ul>
        </nav>
    </div>

</div>