<!--
@author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
-->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h4>Produkt</h4>
            </div>


        </div>
        <div class="clearfix"></div>

        <!-- Produkt einlegen -->
        <div class="row" id="toppage">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Produkt einlegen <small></small></h2>
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

                        <form id="produkt_from" data-parsley-validate class="form-horizontal form-label-left">

                            <!-- Name -->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 " for="name">Name<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="name" name="name" required="required" class="form-control ">
                                </div>
                            </div>

                            <!-- Artikel Nummer-->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 " for="artikel_nr">Artikel Nummer <span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="artikel_nr" name="artikel_nr" required="required" class="form-control">
                                </div>
                            </div>


                            <!-- Bestand ReadOnly-->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 " for="bestand">Bestand
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="bestand" name="bestand" readonly="readonly" class="form-control" value="0">
                                </div>
                            </div>

                            <!-- min Bestand-->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 " for="min_bestand">Minimale Bestand<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="min_bestand" name="min_bestand" required="required" class="form-control">
                                </div>
                            </div>

                            <!-- max Bestand-->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 " for="max_bestand">Maximale Bestand<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="max_bestand" name="max_bestand" required="required" class="form-control">
                                </div>
                            </div>



                                <div class="ln_solid">asd</div>
                                <div class="item form-group" id="">
                                    <div class="col-md-6 col-sm-6 offset-md-3">
                                        <input type="hidden" name="id" id="produkt_hidden_id" />
                                        <button class="btn btn-primary" type="button" id="cancel_btn">Cancel</button>
                                        <button class="btn btn-primary" type="reset">Reset</button>
                                        <button type="button" class="btn btn-success" id="action">Speichern</button>
                                    </div>
                                </div>



                        </form>

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

        <!-- Produkte List-->
        <div class="row" >
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Produkte <small></small></h2>
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
                                    <th data-column-id="produkt_id" data-type="numeric">ID</th>
                                    <th data-column-id="name">Name</th>
                                    <th data-column-id="artikel_nr">Artikel Nr.</th>
                                    <th data-column-id="bestand">Bestand</th>
                                    <th data-column-id="min_bestand">minimale Bestand</th>
                                    <th data-column-id="max_bestand">maximale Bestand</th>
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


    </div>
</div>