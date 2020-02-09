<!--
@author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
-->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h4>Kunde</h4>
            </div>


        </div>
        <div class="clearfix"></div>

        <div class="row" id="toppage">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Lieferant einlegen <small></small></h2>
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

                            <!-- Vorname -->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 " for="vorname">Vorname<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="vorname"  required="required" class="form-control ">
                                </div>
                            </div>

                            <!-- Nachname -->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 " for="nachname">Nachname<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="nachname"  required="required" class="form-control ">
                                </div>
                            </div>

                            <!-- Geburtsdatum-->
                            <div class="item form-group">

                                <label class="col-form-label col-md-3 col-sm-3 " for="datum">Geburtsdatum <span class="required">*</span>
                                </label>
                                <div class="input-group date col-md-9 col-sm-9" id="kunde_datepicker">
                                    <input type="text" id="geburtsdatum" required="required" class="form-control">
                                    <span class="input-group-addon" style="margin-left: 1px">
                                      <i class="fa fa-calendar pt-1"></i>
                                  </span>
                                </div>
                            </div>

                            <!-- Straße-->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 " for="strasse">Straße
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="strasse" required="required" class="form-control">
                                </div>
                            </div>


                            <!-- hausnummer -->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 " for="hausnummer">Hausnummer
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="hausnummer" required="required" class="form-control">
                                </div>
                            </div>

                            <!-- Postleitzahl-->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 " for="postleitzahl">Postleitzahl
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="postleitzahl" required="required" class="form-control">
                                </div>
                            </div>

                            <!--stadt -->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 " for="stadt">Stadt
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="stadt"  required="required" class="form-control">
                                </div>
                            </div>

                            <!--fax -->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 " for="fax">Fax.
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="fax" class="form-control">
                                </div>
                            </div>


                            <!--tel -->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 " for="tel">Tel.
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="tel" class="form-control">
                                </div>
                            </div>


                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <input type="hidden" name="id" id="kunde_hidden_id" />
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

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Lieferanten<small></small></h2>
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
                                    <th data-column-id="kunde_id" data-type="numeric">ID</th>
                                    <th data-column-id="vorname">Vorname</th>
                                    <th data-column-id="nachname">Nachname</th>
                                    <th data-column-id="geburtsdatum">Geburtsdatum</th>
                                    <th data-column-id="adresse">Adresse</th>
                                    <th data-column-id="fax">Fax</th>
                                    <th data-column-id="tel">Tel</th>

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