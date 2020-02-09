<!--
@author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
-->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h4>Lager verwaltung</h4>
            </div>


        </div>
        <div class="clearfix"></div>

        <div class="row" id="toppage">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Regal einlegen <small></small></h2>
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
                                    <input type="text" id="name"  required="required" class="form-control ">
                                </div>
                            </div>

                            <!-- Nummer -->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 " for="name">Nummer<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="nummer"  required="required" class="form-control ">
                                </div>
                            </div>




                            <!-- Barecode-->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 " for="barcode">Barcode
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="barcode" required="required" class="form-control">
                                </div>
                            </div>


                            <!-- fachanzahl  -->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 " for="fachanzahl">Fachanzahl<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="fachanzahl" required="required" class="form-control">
                                </div>
                            </div>

                            <!-- Kapazität jedes Faches  -->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 " for="kapazitaet">Kapazität jedes Faches <span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="kapazitaet" required="required" class="form-control">
                                </div>
                            </div>

                            <!-- Color Picker -->
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3  ">Farbe</label>
                                <div class="col-md-9 col-sm-9  ">
                                    <div class="input-group demo2 colorpicker-element">
                                        <input type="text" value="#e01ab5" id="label_farbe" class="form-control">
                                        <span class="input-group-addon"><i style="background-color: rgb(88, 184, 144);"></i></span>
                                    </div>
                                </div>
                            </div>




                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <input type="hidden" name="id" id="lagerregal_hidden_id" />
                                    <button class="btn btn-primary" type="button">Cancel</button>
                                    <button class="btn btn-primary" type="reset">Reset</button>
                                    <button type="button" class="btn btn-success" id="action">Speichern</button>
                                </div>
                            </div>

                        </form>

                        <!-- Response ajax-->
                        <div id="success_message" class="alert alert-success alert-dismissible" style="display:none;" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            die lager wurde erstellt
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Regalen<small></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="row" id="regalen_id">

                            <!-- -->

                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Barcode <small></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row" id="barcode_id">
                            <div style="margin: auto">Select eine Lager</div>

                        </div>
                        <div class="btn btn-danger " id ="pdf_btn" style="position: relative;right: 0;display: none;margin-top: 18px;margin-left: 8px;cursor: pointer"><i class="fa fa-file-pdf-o"></i> PDF runterladen</div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>