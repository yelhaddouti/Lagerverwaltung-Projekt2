<!--
@author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
-->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h4>Reservierung</h4>
            </div>


        </div>
        <div class="clearfix"></div>

        <!-- Positinen-->
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Positionen Übersicht<small></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a class="dropdown-item" href="#">Settings 1</a>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="table-responsive">
                            <table id="datagrid_table_reservierung" class="table table-striped jambo_table bulk_action">
                                <thead>
                                <tr>
                                    <th data-column-id="lieferung_nr">Lieferung Nummer</th>
                                    <th data-column-id="datum">Datum</th>
                                    <th data-column-id="produkt_name">Produkt</th>
                                    <th data-column-id="menge">Menge</th>
                                    <th data-column-id="status" data-formatter="farben">Status</th>
                                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Befehle</th>
                                </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="row" id="toppage">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Fächer reservieren <small></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />



                        <!-- Lieferung_nr -->
                        <div class="item form-group col-md-6 col-sm-12 pl-0 pr-0">
                            <label class="col-form-label col-md-4 col-sm-4 " for="lieferung_nr" >Lieferant Nr.</label>
                            <div class="col-md-8 col-sm-8 ">
                                <input type="text" id="lieferung_nr" class="form-control" readonly style="background-color: white">
                            </div>
                        </div>
                        <!-- Hidden Lieferung_id-->
                        <input type="hidden" id="hidden_lieferung_id">

                        <!-- Dazum -->
                        <div class="item form-group col-md-6 col-sm-12 pl-0 pr-0">
                            <label class="col-form-label col-md-4 col-sm-4 " for="datum" >Datum</label>
                            <div class="col-md-8 col-sm-8 ">
                                <input type="text" id="datum" class="form-control" readonly style="background-color: white">
                            </div>
                        </div>

                        <!-- Produkt name -->
                        <div class="item form-group col-md-6 col-sm-12 pl-0 pr-0">
                            <label class="col-form-label col-md-4 col-sm-4 " for="produkt" >Produkt</label>
                            <div class="col-md-8 col-sm-8 ">
                                <input type="text" id="produkt" class="form-control" readonly style="background-color: white">
                            </div>
                        </div>
                        <!-- Hidden Produkt_id-->
                        <input type="hidden" id="hidden_produkt_id">


                        <!-- Megne -->
                        <div class="item form-group col-md-6 col-sm-12 pl-0 pr-0">
                            <label class="col-form-label col-md-4 col-sm-4 " for="Menge" >Menge</label>
                            <div class="col-md-8 col-sm-8 ">
                                <input type="text" id="menge" class="form-control" value="0" readonly style="background-color: white;font-weight: bolder">
                            </div>
                        </div>


                        <!-- Megne -->
                        <div class="item form-group col-md-6 col-sm-12 pl-0 pr-0" style="visibility: hidden">
                            <label class="col-form-label col-md-4 col-sm-4 " ></label>
                            <div class="col-md-8 col-sm-8 ">
                                <input type="text" id="">
                            </div>
                        </div>


                        <!-- REST_Menge -->
                        <div class="item form-group col-md-6 col-sm-12 pl-0 pr-0">
                            <label class="col-form-label col-md-4 col-sm-4 " for="rest_menge" >Rest</label>
                            <div class="col-md-8 col-sm-8 ">
                                <input type="text" id="rest_menge" class="form-control" value="0" readonly style="border:2px solid #26B99A; background-color: white;font-weight: bolder">
                            </div>
                        </div>



                        <div class="row" style="padding-top: 40px;">


                            <!-- Fach wählen  -->
                            <div class="item form-group col-md-3 col-sm-12 pl-0 pr-0">
                                <div class="col-md-12 col-sm-12 ">
                                    <input type="text" id="js_fach" required="required" readonly class="form-control" placeholder="Fach wählen.." style="cursor:pointer;background-color: #e1e1e1;" onchange="this.css('background-color:#78e1cb')">
                                </div>
                            </div>

                            <!-- hidden data for Fach -->

                            <input type="hidden" id="fachregal_hidden">
                            <input type="hidden" id="frei_kapazitaet_hidden">


                            <!-- Menge  -->
                            <div class="item form-group col-md-3 col-sm-12 pl-0 pr-0">
                                <div class="col-md-12 col-sm-12 ">
                                    <input type="text" id="js_gelagerte_menge" required="required" class="form-control" placeholder="Menge">
                                </div>
                            </div>

                            <!-- Mitarbeiter List-->
                            <div class="item form-group col-md-3 col-sm-12 pl-0 pr-0">
                                <div class="col-md-12 col-sm-12 ">
                                    <select name="" class="form-control" id="selectjs_mitarbeiter" data-width="100%">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>

                            <!-- button  -->
                            <div class="item form-group col-md-3 col-sm-12 pl-0 pr-0">
                                <button type="button" class="btn btn-success" id="insertTo" data-width="400px"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>


                        <table class="table">
                            <thead>
                            <tr>
                                <th width="10%">#</th>
                                <th width="23.33%">Fach</th>
                                <th width="23.33%">gelagerte Menge</th>
                                <th width="23.33%">Mitarbeiter</th>
                                <th width="20%">-</th>
                            </tr>
                            </thead>
                            <tbody id="table_id">

                            </tbody>
                        </table>


                        <!-- gespeicherte_lager_id-->
                        <input type="hidden" id="ids_gewaelte_lagers">


                        <!-- Response ajax-->
                        <div id="success_message" class="alert alert-success alert-dismissible" style="display:none;" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            die daten wurden erfolgreich gespeichert
                        </div>
                    </div>








                </div>
            </div>
        </div>

        <!-- lagerfach wählen -->
        <div class="row" id="regalpage">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Übersicht der Fächer <small> </small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" id="gridconent">

                        <div class="table-responsive">
                            <table id="datagrid_table_lager" class="table table-striped jambo_table bulk_action">
                                <thead>
                                <tr>
                                    <th data-column-id="lagerregal_name" data-width="10%" >Regal</th>
                                    <th data-column-id="fach_name" data-width="12%">Fach</th>
                                    <th data-column-id="max_kapazitaet" data-width="15%">Max. Kapazitaet</th>
                                    <th data-column-id="belegt" data-width="10%">Belegt</th>
                                    <th data-column-id="frei_kapazitaet"data-width="10%">Frei</th>
                                    <th data-column-id="frei_kapazitaet" data-formatter="progress-bar" data-width="18%">%</th>
                                    <th data-column-id="produkt_name" data-width="15%">enthält</th>
                                    <th data-column-id="commands" data-formatter="commands" data-width="10%" data-sortable="false">Befehle</th>
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