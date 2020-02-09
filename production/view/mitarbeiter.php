<!--
@author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
-->
<style>

    .custom-file-label {
position: relative;
        top: -38px;
        height: calc(1.5em + .75rem + 2px);
        padding: 0.375rem .75rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        border: 1px solid #ced4da;

    }

    .custom-file-input:lang(en)~.custom-file-label::after {
        content: "Bild auswählen";
    }

    .custom-file-label::after {
        position: absolute;

        z-index: 3;
        display: block;
        height: calc(1.5em + .75rem);
        padding: 0.375rem .75rem;
        line-height: 1.5;
        color: #495057;
        content: "Browse";
        background-color: #e9ecef;
        border-left: inherit;
        /* border-radius: 0 .25rem .25rem 0; */
        height: 36px;
        border-radius: 0;
    }
</style>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h4>Mitarbeiter</h4>
            </div>


        </div>
        <div class="clearfix"></div>

        <div class="row" id="toppage">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Mitarbeiter einlegen <small></small></h2>
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


                            <!-- Personal Nummer-->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 " for="strasse">Personal Nummer <span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="personal_nr" required="required" class="form-control">
                                </div>
                            </div>


                            <!-- Roll -->
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Rolle<span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select class="form-control" id="rolle">
                                        <option value="1">Administrator</option>
                                        <option value="0">Mitarbeiter</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Passwort-->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 " for="passwort">Passwort<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="passwort" required="required" class="form-control">
                                </div>
                            </div>

                            <!-- benutzer bild -->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 " for="bild">Benuzerbild</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="file" id="bild"  name="bild" class="custom-file-input form-control" required="required" class="form-control">
                                    <label class="custom-file-label form-control" for="bild"></label>
                                    <input type="hidden" id="hidden_image_name">
                                    <span id="uploaded_image"></span>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <input type="hidden" name="id" id="mitarbeiter_hidden_id">
                                    <button class="btn btn-primary" type="button" id="cancel_btn">Cancel</button>
                                    <button class="btn btn-primary" type="reset"id="rest_btn">Reset</button>
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
                                    <th data-column-id="mitarbeiter_id" data-type="numeric">ID</th>
                                    <th data-column-id="benutzerbild" data-formatter="avatar" >Benutzerbild</th>
                                    <th data-column-id="vorname">Vorname</th>
                                    <th data-column-id="nachname">Nachname</th>
                                    <th data-column-id="personal_nr">Personal Nummer</th>
                                    <th data-column-id="passwort">Passwort</th>
                                    <th data-column-id="rolle">Rolle</th>

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