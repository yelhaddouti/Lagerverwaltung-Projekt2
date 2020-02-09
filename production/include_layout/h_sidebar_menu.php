<!--
@author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
-->

<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Menu</h3>
        <ul class="nav side-menu">
            <li <?php if ($_GET['site'] == 'home') echo "class='active' style='color:#ffc107'";?> >
                <a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a <?php if ($_GET['site'] == 'home') echo "style='color:#ffc107'";?> href="?site=home">Main</a></li>
                </ul>
            </li>

            <li <?php if ($_GET['site'] == 'lieferant' || $_GET['site'] == 'lieferung' || $_GET['site'] == 'reservation') echo "class='active'";?>>
                <a><i class="fa fa-download"></i> Lieferung <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a <?php if ($_GET['site'] == 'lieferant') echo "style='color:#ffc107'";?> href="?site=lieferant">Lieferant</a></li>
                    <li><a <?php if ($_GET['site'] == 'lieferung') echo "style='color:#ffc107'";?> href="?site=lieferung">Lieferung</a></li>
                    <li><a <?php if ($_GET['site'] == 'reservation') echo "style='color:#ffc107'";?> href="?site=reservation">Reserveriung</a></li>
                </ul>
            </li>

            <li <?php if ($_GET['site'] == 'kunde' || $_GET['site'] == 'bestellung' || $_GET['site'] == 'auslagern') echo "class='active'";?>>
                <a><i class="fa fa-upload"></i> Bestellung <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a <?php if ($_GET['site'] == 'kunde') echo "style='color:#ffc107'";?> href="?site=kunde">Kunde</a></li>
                    <li><a <?php if ($_GET['site'] == 'bestellung') echo "style='color:#ffc107'";?> href="?site=bestellung">Bestellung</a></li>
                    <li><a <?php if ($_GET['site'] == 'auslagern') echo "style='color:#ffc107'";?> href="?site=auslagern">Auslagerung</a></li>
                </ul>
            </li>


            <li <?php if ($_GET['site'] == 'produkt') echo "class='active'";?> >
                <a><i class="fa fa-cubes "></i> Bestand <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a <?php if ($_GET['site'] == 'produkt') echo "style='color:#ffc107'";?> href="?site=produkt">Produkt</a></li>
                </ul>
            </li>

            <li <?php if ($_GET['site'] == 'mitarbeiter') echo "class='active' style='color:#ffc107'";?> ><a href="?site=mitarbeiter">
                    <i class="fa fa-group"></i> Mitarbeiter
                </a>
            </li>

            <li <?php if ($_GET['site'] == 'lager') echo "class='active'";?> >
                <a><i class="fa fa-th"></i> Lager <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a <?php if ($_GET['site'] == 'lager') echo "style='color:#ffc107'";?> href="?site=lager">Lager</a></li>
                </ul>
            </li>
        </ul>
    </div>


</div>