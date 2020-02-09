<!--
@author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
-->
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h4>Lieferung</h4>
            </div>


        </div>
        <div class="clearfix"></div>

        <div class="row" id="toppage">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Lieferung einlegen <small></small></h2>
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

                            <!-- Lieferung nr -->
                            <div class="item form-group col-md-6 col-sm-12 pl-0 pr-0" >
                                <label class="col-form-label col-md-4 col-sm-4 " for="lieferung_nr">Lieferung Nr.<span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 ">
                                    <input type="text" id="lieferung_nr"  required="required" class="form-control" readonly>
                                </div>
                            </div>

                            <!-- Datum-->
                            <div class="item form-group col-md-6 col-sm-12 pl-0 pr-0">

                                <label class="col-form-label col-md-4 col-sm-4 " for="datum">Datum <span class="required">*</span>
                                </label>
                                <div class="input-group date col-md-8 col-sm-8" id="lieferungdatepicker">
                                    <input type="text" id="datum" required="required" class="form-control">
                                    <span class="input-group-addon" style="margin-left: 1px">
                                      <i class="fa fa-calendar pt-1"></i>
                                  </span>
                                </div>
                            </div>

                            <!-- Lieferant List-->
                            <div class="item form-group col-md-6 col-sm-12 pl-0 pr-0">
                                <label class="col-form-label col-md-4 col-sm-4 " for="strasse">Lieferant <span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 " >
                                    <select name="" class="form-control" id="selectjs_lieferant" data-width="100%">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>


                            <!-- UNVISIBLE -->
                            <div class="item form-group col-md-6 col-sm-12 pl-0 pr-0" style="visibility: hidden">
                                <label class="col-form-label col-md-4 col-sm-4 " for="strasse" >Lieferant <span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 ">
                                    <input type="text" id="" required="required" class="form-control">
                                </div>
                            </div>
                            <!--
                             <div class="daterangepicker dropdown-menu ltr single opensright show-calendar picker_4 xdisplay"><div class="calendar left single" style="display: block;"><div class="daterangepicker_input"><input class="input-mini form-control active" type="text" name="daterangepicker_start" value="" style="display: none;"><i class="fa fa-calendar glyphicon glyphicon-calendar" style="display: none;"></i><div class="calendar-time" style="display: none;"><div></div><i class="fa fa-clock-o glyphicon glyphicon-time"></i></div></div><div class="calendar-table"><table class="table-condensed"><thead><tr><th class="prev available"><i class="fa fa-chevron-left glyphicon glyphicon-chevron-left"></i></th><th colspan="5" class="month">Oct 2016</th><th class="next available"><i class="fa fa-chevron-right glyphicon glyphicon-chevron-right"></i></th></tr><tr><th>Su</th><th>Mo</th><th>Tu</th><th>We</th><th>Th</th><th>Fr</th><th>Sa</th></tr></thead><tbody><tr><td class="weekend off available" data-title="r0c0">25</td><td class="off available" data-title="r0c1">26</td><td class="off available" data-title="r0c2">27</td><td class="off available" data-title="r0c3">28</td><td class="off available" data-title="r0c4">29</td><td class="off available" data-title="r0c5">30</td><td class="weekend available" data-title="r0c6">1</td></tr><tr><td class="weekend available" data-title="r1c0">2</td><td class="available" data-title="r1c1">3</td><td class="available" data-title="r1c2">4</td><td class="available" data-title="r1c3">5</td><td class="available" data-title="r1c4">6</td><td class="available" data-title="r1c5">7</td><td class="weekend available" data-title="r1c6">8</td></tr><tr><td class="weekend available" data-title="r2c0">9</td><td class="available" data-title="r2c1">10</td><td class="available" data-title="r2c2">11</td><td class="available" data-title="r2c3">12</td><td class="available" data-title="r2c4">13</td><td class="available" data-title="r2c5">14</td><td class="weekend available" data-title="r2c6">15</td></tr><tr><td class="weekend available" data-title="r3c0">16</td><td class="available" data-title="r3c1">17</td><td class="today active start-date active end-date available" data-title="r3c2">18</td><td class="available" data-title="r3c3">19</td><td class="available" data-title="r3c4">20</td><td class="available" data-title="r3c5">21</td><td class="weekend available" data-title="r3c6">22</td></tr><tr><td class="weekend available" data-title="r4c0">23</td><td class="available" data-title="r4c1">24</td><td class="available" data-title="r4c2">25</td><td class="available" data-title="r4c3">26</td><td class="available" data-title="r4c4">27</td><td class="available" data-title="r4c5">28</td><td class="weekend available" data-title="r4c6">29</td></tr><tr><td class="weekend available" data-title="r5c0">30</td><td class="available" data-title="r5c1">31</td><td class="off available" data-title="r5c2">1</td><td class="off available" data-title="r5c3">2</td><td class="off available" data-title="r5c4">3</td><td class="off available" data-title="r5c5">4</td><td class="weekend off available" data-title="r5c6">5</td></tr></tbody></table></div></div><div class="calendar right" style="display: none;"><div class="daterangepicker_input"><input class="input-mini form-control" type="text" name="daterangepicker_end" value="" style="display: none;"><i class="fa fa-calendar glyphicon glyphicon-calendar" style="display: none;"></i><div class="calendar-time" style="display: none;"><div></div><i class="fa fa-clock-o glyphicon glyphicon-time"></i></div></div><div class="calendar-table"><table class="table-condensed"><thead><tr><th></th><th colspan="5" class="month">Nov 2016</th><th class="next available"><i class="fa fa-chevron-right glyphicon glyphicon-chevron-right"></i></th></tr><tr><th>Su</th><th>Mo</th><th>Tu</th><th>We</th><th>Th</th><th>Fr</th><th>Sa</th></tr></thead><tbody><tr><td class="weekend off available" data-title="r0c0">30</td><td class="off available" data-title="r0c1">31</td><td class="available" data-title="r0c2">1</td><td class="available" data-title="r0c3">2</td><td class="available" data-title="r0c4">3</td><td class="available" data-title="r0c5">4</td><td class="weekend available" data-title="r0c6">5</td></tr><tr><td class="weekend available" data-title="r1c0">6</td><td class="available" data-title="r1c1">7</td><td class="available" data-title="r1c2">8</td><td class="available" data-title="r1c3">9</td><td class="available" data-title="r1c4">10</td><td class="available" data-title="r1c5">11</td><td class="weekend available" data-title="r1c6">12</td></tr><tr><td class="weekend available" data-title="r2c0">13</td><td class="available" data-title="r2c1">14</td><td class="available" data-title="r2c2">15</td><td class="available" data-title="r2c3">16</td><td class="available" data-title="r2c4">17</td><td class="available" data-title="r2c5">18</td><td class="weekend available" data-title="r2c6">19</td></tr><tr><td class="weekend available" data-title="r3c0">20</td><td class="available" data-title="r3c1">21</td><td class="available" data-title="r3c2">22</td><td class="available" data-title="r3c3">23</td><td class="available" data-title="r3c4">24</td><td class="available" data-title="r3c5">25</td><td class="weekend available" data-title="r3c6">26</td></tr><tr><td class="weekend available" data-title="r4c0">27</td><td class="available" data-title="r4c1">28</td><td class="available" data-title="r4c2">29</td><td class="available" data-title="r4c3">30</td><td class="off available" data-title="r4c4">1</td><td class="off available" data-title="r4c5">2</td><td class="weekend off available" data-title="r4c6">3</td></tr><tr><td class="weekend off available" data-title="r5c0">4</td><td class="off available" data-title="r5c1">5</td><td class="off available" data-title="r5c2">6</td><td class="off available" data-title="r5c3">7</td><td class="off available" data-title="r5c4">8</td><td class="off available" data-title="r5c5">9</td><td class="weekend off available" data-title="r5c6">10</td></tr></tbody></table></div></div><div class="ranges" style="display: none;"><div class="range_inputs"><button class="applyBtn btn btn-sm btn-success" type="button">Apply</button> <button class="cancelBtn btn btn-sm btn-default" type="button">Cancel</button></div></div></div>


                        <fieldset>
                            <div class="control-group">
                                <div class="controls">
                                    <div class="col-md-11 xdisplay_inputx form-group row has-feedback">
                                        <input type="text" class="form-control has-feedback-left" id="single_cal4" placeholder="Datum" aria-describedby="inputSuccess2Status4">
                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                        <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        -->
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
                            <input type="hidden" name="id" id="lieferung_hidden_id" />
                            <button class="btn btn-primary" type="button" id="cancel_btn">Cancel</button>
                            <button class="btn btn-primary" type="reset" id="rest_btn">Reset</button>
                            <button type="button" class="btn btn-success" id="action">Speichern</button>
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
                    <h2>Lieferungen<small></small></h2>
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
                                <th data-column-id="lieferung_id" data-type="numeric">ID</th>
                                <th data-column-id="lieferung_nr">Liefrung Nummer</th>
                                <th data-column-id="datum">Datum</th>
                                <th data-column-id="name">Lieferant</th>

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