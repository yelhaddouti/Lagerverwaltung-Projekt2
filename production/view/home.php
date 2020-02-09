<!--
@author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
-->

<style>
   .actionBar{
        display: none;
    }

</style>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h4>Wilkommen</h4>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Suchen">
                        <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Los!</button>
                    </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row" id="toppage">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-circle" style="color:#ffc107"></i> Produkte (fast leer)<small></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table id="datagrid_table_home_produkt" class="table table-striped jambo_table bulk_action">
                                <thead>
                                <tr>
                                    <th data-column-id="name">Name</th>
                                    <th data-column-id="bestand">Bestand</th>
                                    <th data-column-id="min_bestand">minimale Bestand</th>
                                    <th data-column-id="max_bestand">maximale Bestand</th>
                                </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Mitarbeiter <small></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table id="datagrid_table_mitarbeiter" class="table table-striped jambo_table bulk_action">
                                <thead>
                                <tr>

                                    <th data-column-id="benutzerbild" data-formatter="avatar" >Benutzerbild</th>
                                    <th data-column-id="vorname">Vorname</th>
                                    <th data-column-id="nachname">Nachname</th>
                                    <th data-column-id="personal_nr">Personal Nummer</th>
                                    <th data-column-id="soll_lagern">Soll lagern</th>
                                    <th data-column-id="soll_auslagern">Soll auslagrn</th>
                                    <th data-column-id="status" data-formatter="farben">Status</th>
                                </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
          
        </div>


    </div>
</div>