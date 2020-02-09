<!--
@author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
-->

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h4>Bestellung</h4>
            </div>


        </div>
        <div class="clearfix"></div>

        <div class="row" id="toppage">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Bestellung einlegen <small></small></h2>
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

                        <form id="" data-parsley-validate class="form-horizontal form-label-left">

                            <!-- Bestellung nr -->
                            <div class="item form-group col-md-6 col-sm-12 pl-0 pr-0" >
                                <label class="col-form-label col-md-4 col-sm-4 " for="bestellung_nr">Bestellung Nr.
                                </label>
                                <div class="col-md-8 col-sm-8 ">
                                    <input type="text" id="bestellung_nr"  required="required" class="form-control" readonly>
                                </div>
                            </div>

                            <!-- Datum-->
                            <div class="item form-group col-md-6 col-sm-12 pl-0 pr-0">

                                <label class="col-form-label col-md-4 col-sm-4 " for="datum">Datum <span class="required">*</span>
                                </label>
                                <div class="input-group date col-md-8 col-sm-8" id="bestellungdatepicker">
                                    <input type="text" id="datum" required="required" class="form-control">
                                    <span class="input-group-addon" style="margin-left: 1px">
                                      <i class="fa fa-calendar pt-1"></i>
                                  </span>
                                </div>
                            </div>

                            <!-- BEstellungen List-->
                            <div class="item form-group col-md-6 col-sm-12 pl-0 pr-0">
                                <label class="col-form-label col-md-4 col-sm-4 " for="strasse">Kunde <span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 " >
                                    <select name="" class="form-control" id="selectjs_kunde" data-width="100%">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>


                            <!-- UNVISIBLE -->
                            <div class="item form-group col-md-6 col-sm-12 pl-0 pr-0" style="visibility: hidden">
                                <label class="col-form-label col-md-4 col-sm-4 " for="strasse" >Kunde <span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 ">
                                    <input type="text" id="" required="required" class="form-control">
                                </div>
                            </div>

                            <div class="row" style="padding-top: 40px;">


                                <!-- produkt  -->

                                <div class="item form-group col-md-4 col-sm-12 pl-0 pr-0">
                                    <div class="col-md-12 col-sm-12 ">
                                        <select name="" class="form-control" id="selectjs_produkt" data-width="100%">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>


                                <!-- Artikel Nr
                                <div class="item form-group col-md-3 col-sm-12 pl-0 pr-0 ">
                                    <div class="col-md-12 col-sm-12 ">
                                        <input type="text" id="artikel_nr" required="required" class="form-control" placeholder="artikel Nr">
                                    </div>
                                </div>

                                 -->



                                <!-- Menge  -->
                                <div class="item form-group col-md-4 col-sm-12 pl-0 pr-0">
                                    <div class="col-md-12 col-sm-12 ">
                                        <input type="text" id="menge" required="required" class="form-control" placeholder="Menge">
                                    </div>
                                </div>


                                <!-- button  -->
                                <div class="item form-group col-md-4 col-sm-12 pl-0 pr-0">
                                    <button type="button" class="btn btn-success" id="insertTo" data-width="400px"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>

                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th width="10%">#</th>
                            <th width="35%">Produkt</th>
                            <th width="35%">Menge</th>
                            <th width="20%">-</th>
                        </tr>
                        </thead>
                        <tbody id="table_id">

                        </tbody>
                    </table>



                    </form>

                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <input type="hidden" name="id" id="bestellung_hidden_id" />
                            <button class="btn btn-primary" type="button" id="cancel_btn">Cancel</button>
                            <button class="btn btn-primary" type="reset" id="rest_btn">Reset</button>
                            <button type="button" class="btn btn-success" id="action">SpeichernOOOOO</button>
                        </div>
                    </div>


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

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Bestellungen<small></small></h2>
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
                        <table id="datagrid_table" class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr>
                                <th data-column-id="bestellung_id" data-type="numeric">ID</th>
                                <th data-column-id="bestellung_nr">Bestellung Nummer</th>
                                <th data-column-id="datum">Datum</th>
                                <th data-column-id="name">Kunde</th>

                                <th data-column-id="commands" data-formatter="commands" data-sortable="false">Befehle</th>
                            </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>