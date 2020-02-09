/**
 *
 * @author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
 */

$(document).ready(function() {

    /* array literal */
    let aData = [];
    let id = 0;

    /* verwendetet Fächer */
    let Data_fach = [];




    var grid1 = $("#datagrid_table_reservierung").bootgrid({
        ajax: true,
        post: function ()
        {
            return {
                id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
            };
        },
        url: "../module/ajaxActionReservierung.php",
        formatters: {

            "farben": function(column, row){

                let color;
                if(row.status == 'komplett bearbeitet'){
                    color = "#26B99A";//succes
                }
                if(row.status == 'teilweise bearbeitet'){
                    color = "#007bff";//primary
                }
                if(row.status == 'noch nicht bearbietet'){
                    color = "#dc3545";//danger
                }
                return '<div style="display:inline-block;vertical-align: middle;width:15px;height:15px;margin-right: 5px; border-radius:50%; background-color:'+color+'"></div> '+ row.status;
            },
            "commands": function(column, row)
            {

                return '<button type="button" id="commnad-edit-btn-reservierung" class="btn btn-warning btn-sm command-edit-reservierung" style="width: 110px;" data-row-id=' + row.lieferung_id+'-'+row.produkt_id + '><i class="fa fa-cube"></i> reservieren</button> ';

            }
        }

    }).on("loaded.rs.jquery.bootgrid", function()
    {

        //change addbutton text after updateaction
        $('#action').text('Speichern');


        //Lieferant DropDownList
        $('#selectjs_mitarbeiter').select2({
            placeholder: "Mitarbeiter..",
            minimumInputLength: 1,
            ajax:{
                url: "../module/ajaxServiceMitarbeiter.php",
                dataType: "json",
                type: "POST",
                data:function(params){
                    return{
                        q:params.term,
                    };

                },
                processResults: function(data){
                    return{
                        results: data
                    };
                },
                cache:true

            }
        });

        grid1.find(".command-edit-reservierung").on("click", function(e)
        {

            let row_id =  ($(this).data("row-id")).split("-");
            let lieferung_id = row_id[0];
            let produkt_id = row_id[1];
            let action = "FETCHONE";



            $.ajax({
                url : "../module/ajaxActionReservierung.php",
                method : "POST",
                data:{action:action,lieferung_id:lieferung_id,produkt_id:produkt_id},
                dataType: "json",
                success:function (data) {

                    $("#action").text("Aenderungen Speichern");
                    $("#lieferung_position_hidden_id").val(lieferung_id+'-'+produkt_id);

                    $('#lieferung_nr').val(data[0].lieferung_nr);
                    $('#datum').val(data[0].datum);
                    $('#produkt').val(data[0].produkt_name);
                    $('#menge').val(data[0].menge);
                    $('#rest_menge').val(data[0].menge);

                    $('#hidden_lieferung_id').val(lieferung_id);
                    $('#hidden_produkt_id').val(produkt_id);

                    //reste vor laden
                    $('#js_fach').val('');
                    $('#js_fach').css('background-color','#E1E1E1');

                    $('#js_gelagerte_menge').val('');
                    $("#selectjs_mitarbeiter").val('').trigger('change');



                    $('html, body').animate({
                        scrollTop: $('#toppage').offset().top
                    }, 500);

                    loadReservationForm(lieferung_id,produkt_id);
                    //loadLagerBootGrid(produkt_id);
                }
            });


        }).end().find(".command-delete").on("click", function(e)
        {



        });

    });


    var grid2 = $("#datagrid_table_lager").bootgrid({
        ajax: true,
        post: function ()
        {
            return {
                id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
            };
        },
        url: "../module/ajaxActionLager.php", //all
        formatters: {

            "progress-bar": function(column, row)
            {

                let prozentValue = (row.belegt * 100) / row.max_kapazitaet;

                return '<div class="project_progress"><div class="progress progress_sm" style="background-color: #c4c4c4"><div class="progress-bar bg-green role="progressbar" data-transitiongoal="'+prozentValue+'" aria-valuenow="76" style="width: '+prozentValue+'%;"></div></div><small>'+prozentValue+'% beleget</small></div>';
            },
            "commands": function(column, row)
            {
                return '<button type="button" id="commnad-edit-btn-lager" class="btn btn-warning btn-sm command-edit-lager" style="width: 110px;" data-row-id=' + row.fachregal_id + '><i class="fa fa-check-square-o"></i> wählen</button> ';

            }
        }

    }).on("loaded.rs.jquery.bootgrid", function()
    {

        grid2.find(".command-edit-lager").on("click", function(e)
        {
            let id =  $(this).data("row-id");

            let action = "FETCHONE";

            //let lieferantSelect = $('#selectjs_lieferant');

            if($("#produkt").val()!= ''){
                $.ajax({
                    url : "../module/ajaxActionLager.php",//FETCHONE edit Grid lager
                    method : "POST",
                    data:{action:action,id:id},
                    dataType: "json",
                    success:function (data){

                        $('#js_fach').css('background-color','#26B99A');
                        $('#js_fach').css('color','#FFFFFF');


                        $('#js_fach').val(data[0].fachregal);
                        $('#fachregal_hidden').val(data[0].fachregal_id);

                        let frei_kapazitaet = (data[0].max_kapazitaet - data[0].bestand);
                        $('#frei_kapazitaet_hidden').val(frei_kapazitaet);

                        $('html, body').animate({
                            scrollTop: $('#toppage').offset().top
                        }, 500);

                    }
                });
            }




        }).end().find(".command-delete-lager").on("click", function(e)
        {

        });
    });

    $('#js_fach').on('click',function () {
        let rest_menge = parseInt( $("#rest_menge").val() );


        let produkt_id = $('#hidden_produkt_id').val();

        // action = "SELECTEMPTY";
        if(rest_menge != 0){
            if(produkt_id != ''){
                $("#gridconent").html('');



                $("#gridconent").append('  <div class="table-responsive">\n' +
                    '                                <table id="datagrid_table_lager" class="table table-striped jambo_table bulk_action">\n' +
                    '                                    <thead>\n' +
                    '                                    <tr>\n' +
                    '                                        <th data-column-id="lagerregal_name" data-width="10%">Regal</th>\n' +
                    '                                        <th data-column-id="fach_name" data-width="12%">Fach</th>\n' +
                    '                                        <th data-column-id="max_kapazitaet" data-width="15%">Max. Kapazitaet</th>\n' +
                    '                                        <th data-column-id="belegt" data-width="10%">Belegt</th>\n' +
                    '                                        <th data-column-id="frei_kapazitaet"data-width="10%" data-formatter="bolder">Frei</th>\n' +
                    '                                        <th data-column-id="frei_kapazitaet" data-formatter="progress-bar" data-width="18%">%</th>\n' +
                    '                                        <th data-column-id="produkt_name" data-width="15%">enthält</th>\n' +
                    '                                        <th data-column-id="commands" data-formatter="commands" data-width="10%" data-sortable="false">Befehle</th>\n' +
                    '                                    </tr>\n' +
                    '                                    </thead>\n' +
                    '                                </table>\n' +
                    '                            </div>');


                var gridSelect = $("#datagrid_table_lager").bootgrid({
                    ajax: true,
                    post: function ()
                    {
                        return {
                            id: "b0df282a-0d67-40e5-8558-c9e93b7befed",
                            produkt_id : produkt_id
                        };
                    },
                    url: "../module/ajaxActionLagerSelected.php", //all
                    formatters: {
                        "bolder": function(colum, row)
                        {
                            return '<span class="badge badge-pill" style="background-color:#1ABB9C;color:#FFFFFF;font-size: small">'+row.frei_kapazitaet+ '</span>';

                        },
                        "progress-bar": function(column, row)
                        {
                            let prozentValue = (row.belegt * 100) / row.max_kapazitaet;
                            return '<div class="project_progress"><div class="progress progress_sm" style="background-color: #c4c4c4"><div class="progress-bar bg-green role="progressbar" data-transitiongoal="'+prozentValue+'" aria-valuenow="76" style="width: '+prozentValue+'%;"></div></div><small>'+prozentValue+'% beleget</small></div>';
                        },
                        "commands": function(column, row)
                        {
                            return '<button type="button" id="commnad-edit-btn-lager" class="btn btn-warning btn-sm command-edit-lager" style="width: 110px;" data-row-id=' + row.fachregal_id + '><i class="fa fa-check-square-o"></i> wählen</button> ';

                        }
                    }

                }).on("loaded.rs.jquery.bootgrid", function()
                {

                    gridSelect.find(".command-edit-lager").on("click", function(e)
                    {
                        let id =  $(this).data("row-id");

                        let action = "FETCHONE";

                        //let lieferantSelect = $('#selectjs_lieferant');

                        if($("#produkt").val()!= ''){
                            $.ajax({
                                url : "../module/ajaxActionLager.php",//FETCHONE edit Grid lager
                                method : "POST",
                                data:{action:action,id:id},
                                dataType: "json",
                                success:function (data){


                                    let frei_kapazitaet = (data[0].max_kapazitaet - data[0].bestand);
                                    $('#frei_kapazitaet_hidden').val(frei_kapazitaet);


                                    $('#js_fach').val(data[0].fachregal +" [frei Kapazität : "+ frei_kapazitaet +"]");
                                    $('#fachregal_hidden').val(data[0].fachregal_id);



                                    $('#js_fach').css('background-color','#26B99A');
                                    $('#js_fach').css('color','#FFFFFF');
                                    $('#js_fach').css('font-weight','400');


                                    $('html, body').animate({
                                        scrollTop: $('#toppage').offset().top
                                    }, 500);

                                }
                            });
                        }




                    }).end().find(".command-delete-lager").on("click", function(e)
                    {

                    });
                });





                $('html, body').animate({
                    scrollTop: $('#regalpage').offset().top
                }, 500);
            }else{
                alert('bitte wählen Sie zuerst eine Position ');
            }
        }

    });


    /* object constructur */
    function Data(id, fachname,fachvalue,gelagerte_menge, mitarbeitername, mitarbeitervalue) {
        this.id = id;
        this.fachname = fachname;
        this.fachvalue = fachvalue;
        this.gelagerte_menge = gelagerte_menge;
        this.mitarbeitername = mitarbeitername;
        this.mitarbeitervalue = mitarbeitervalue;
    }


    $('#insertTo').on('click',function () {
        let lieferung_id = $("#hidden_lieferung_id").val();
        let produkt_id = $("#hidden_produkt_id").val();

        let rest_menge_str = ($('#rest_menge').val()).trim();
        let rest_menge  = parseInt(rest_menge_str);//CAST to NUMBER

        let fachregal_id =  $('#fachregal_hidden').val();
        let mitarbeiter_id = $("#selectjs_mitarbeiter option:selected").val();
        let gelagerte_menge_str = ($("#js_gelagerte_menge").val()).trim();
        let gelagerte_menge = parseInt(gelagerte_menge_str);//CAST to NUMBER

        let action = "INSERT";
        let frei_kapazitaet = parseInt(($('#frei_kapazitaet_hidden').val()).trim());




        if(gelagerte_menge != '' && mitarbeiter_id != '' && fachregal_id != ''){
            if(gelagerte_menge > frei_kapazitaet || gelagerte_menge > rest_menge || Data_fach.includes(parseInt(fachregal_id)) ){
                if(gelagerte_menge > frei_kapazitaet){
                    alert('ungültige Kapazität : die gelagerte Menge ist große als die freie Kapazität');
                }else if(gelagerte_menge > rest_menge){
                    alert('ungültige Kapazität : die gelagerte Menge ist große als rest Menge');
                }else if(Data_fach.includes(parseInt(fachregal_id))){
                    alert('Fach schon gewählt !');
                }

            }else{
                // Speichern daten item in Datenbank wegen aktualiwerung andere tabellen
                $.ajax({
                    url: "../module/ajaxActionPositionFach.php",
                    type: "POST",
                    data: {action:action, lieferung_id:lieferung_id, produkt_id:produkt_id,fachregal_id:fachregal_id, gelagerte_menge:gelagerte_menge, mitarbeiter_id:mitarbeiter_id},
                    success: function(strMessage) {
                        /*
                        $('#name').val('');
                        $("#artikel_nr").val('');
                        $("#bestand").val(0);
                        $("#min_bestand").val('');
                        $("#max_bestand").val('');*/

                        //message : request ajax (insert and update)
                        $("#success_message").text(strMessage);
                        $('#success_message').show();
                        $('#success_message').delay(1000).fadeOut();

                        $('#js_fach').val('');
                        $('#js_fach').css('background-color','#E1E1E1');
                        $('#js_gelagerte_menge').val('');
                        $("#selectjs_mitarbeiter").val('').trigger('change');




                        //realod bootgrid
                        loadReservationForm(lieferung_id,produkt_id);
                        $("#datagrid_table_reservierung").bootgrid('reload');
                        $("#datagrid_table_lager").bootgrid('reload');
                    },
                    error: function (request, status, error) {
                        console.log(request.responseText);
                    }
                });

            }

        }else{
            alert('bitte alle Felder einfüllen');
        }



    });

    $('#table_id').on('click','.removeFrom', function(e){

        let ids = ($(this).attr('id')).split('-');
        let fachregal_id = ids[0];
        let gelagerte_menge = parseInt(ids[1]);


        let lieferung_id = $("#hidden_lieferung_id").val();
        let produkt_id = $("#hidden_produkt_id").val();


        let action = "REMOVE";

        // Speichern daten item in Datenbank wegen aktualiwerung andere tabellen
        $.ajax({
            url: "../module/ajaxActionPositionFach.php",
            type: "POST",
            data: {action:action, lieferung_id:lieferung_id, produkt_id:produkt_id,fachregal_id:fachregal_id,gelagerte_menge:gelagerte_menge},
            success: function(strMessage) {


                //message : request ajax (insert and update)
                $("#success_message").text(strMessage);
                $('#success_message').show();
                $('#success_message').delay(1000).fadeOut();

                //REST gewählte Lager
                $("#fachregal_hidden").val('');
                $("#frei_kapazitaet_hidden").val('');
                //REST
                $('#js_fach').val('');
                $('#js_fach').css('background-color','#E1E1E1');
                $('#js_ausgelagerte_menge').val('');
                $("#selectjs_mitarbeiter").val('').trigger('change');


                //realod bootgrid
                loadReservationForm(lieferung_id,produkt_id);
                $("#datagrid_table_reservierung").bootgrid('reload');
                $("#datagrid_table_lager").bootgrid('reload');

            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }
        });
    });


    function tableDesign() {
        let counter = 1;
        let b = $('#table_id');
        let gelagerte_menge_total = 0;
        let menge = ($('#menge').val()).trim();
        b.html('');

        //initialisieren
        Data_fach = [];
        for(let i = 0; i < aData.length; i++){


            tr = $("<tr></tr>").appendTo(b);
            tr.append( "<td width='10%'>"+counter+"</td>" +
                "<td width='23.33%'>"+aData[i].fachname+"</td>" +
                "<td width='23.33%'>"+aData[i].gelagerte_menge+"</td>" +
                "<td width='23.33%'>"+aData[i].mitarbeitername+"</td>" +
                "<td width='20%'>" +
                "<button class='btn btn-warning updateFrom' style='display: inline;' id="+aData[i].fachvalue+"-"+aData[i].gelagerte_menge+">" +
                "<i class='fa fa-pencil'></i></button>" +
                "<button class='btn btn-danger removeFrom ' style='display: inline;' id="+aData[i].fachvalue+"-"+aData[i].gelagerte_menge+">" +
                "<i class='fa fa-minus'></i></button>" );
            counter++;
            gelagerte_menge_total = aData[i].gelagerte_menge+ gelagerte_menge_total;

            /*DATEN SPEICHERN*/

            Data_fach.push(aData[i].fachvalue);

        }
        console.log(Data_fach);
        $("#rest_menge").val(menge - gelagerte_menge_total);

    }




    $('#table_id').on('click','.updateFrom',function(e){
        let id = $(this).attr('id');
        let produktSelect = $('#selectjs_produkt');

        for (let i = 0; i < aData.length; i++) {
            let obj = aData[i];

            if (id == obj.id){
                let option = new Option(obj.produktname, obj.produkvalue, true, true);
                produktSelect.append(option).trigger('change');
                $('#menge').val(obj.produktqte);
                aData.splice(i, 1);
            }

            tableDesign();
        }

        // $("#selectjs_lieferant option:selected").text(data.name);

    });


    function loadReservationForm(lief_id,pro_id){
        let lieferung_id = lief_id;
        let produkt_id = pro_id;
        let action = "FETCHPOSITIONEN"

        //let lieferantSelect = $('#selectjs_lieferant');

        $.ajax({
            url : "../module/ajaxActionPositionFach.php",
            method : "POST",
            data:{action:action,lieferung_id:lieferung_id,produkt_id:produkt_id},
            dataType: "json",
            success:function (data){

                aData = [];
                let counter = 1;
                for(let i = 0 ; i< data.length; i++){
                    aData.push(new Data(counter,data[i].fachname,data[i].fachregal_id,data[i].gelagerte_menge,data[i].nachname, data[i].mitarbeiter_id));
                    counter++;
                }

                tableDesign();

            }
        });



    }




});//ENDf
