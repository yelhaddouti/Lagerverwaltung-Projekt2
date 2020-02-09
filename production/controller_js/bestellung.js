/**
 *
 * @author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
 */

$(document).ready(function() {



    /* array literal */
    let aData = [];
    let id = 0;

    update_lists_nr();


    $('#selectjs_produkt').on('change', function() {
        var data = $("#selectjs_produkt option:selected");
    });

    /*  ## insert new Delivery or update (action : param) ## */
    $('#action').on('click',function(e){
        //formdata
        let bestellung_nr = ($("#bestellung_nr").val()).trim();
        let datum = $('#datum').val();
        let kunde_id = $("#selectjs_kunde option:selected").val();

        /*console.log(lieferung_nr);
        console.log(datum);
        console.log(lieferant_id);
        console.log(aData);*/

        //hiddenID , actiontyp
        let id =  $("#bestellung_hidden_id").val();
        let action = $('#action').text();

        if(bestellung_nr != '' && datum != '' && kunde_id !=''){
            $.ajax({
                url: "../module/ajaxActionBestellung.php",
                type: "post",
                data: {
                    bestellung_nr:bestellung_nr,
                    datum: datum,
                    kunde_id:kunde_id,
                    bestellung_position:aData,
                    action:action,
                    id:id
                },
                success: function(strMessage) {
                   cancel_form();

                    $('#success_message').show();
                    $('#success_message').delay(1000).fadeOut();

                    //realod bootgrid
                    $("#datagrid_table").bootgrid('reload');
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
            });
        }else{
            alert("bitte alle daten eintragen");//(required)
        }




    });


    var grid = $("#datagrid_table").bootgrid({
        ajax: true,
        post: function ()
        {
            return {
                id: "b0df282a-0d67-40e5-8558-c9e93b7befed"

            };
        },
        url: "../module/ajaxActionBestellung.php",
        formatters: {
            "commands": function(column, row)
            {
                return '<button type="button" id="commnad-show-btn" class="btn btn-primary btn-sm command-show" data-row-id=' + row.bestellung_id + '><i class="fa fa-eye"></i></button> ' +
                '<button type="button" id="commnad-edit-btn" class="btn btn-warning btn-sm command-edit" data-row-id=' + row.bestellung_id + '><i class="fa fa-pencil"></i></button> ' +
                    '<button type="button" id="commnad-delete-btn" class="btn btn-danger btn-sm command-delete" data-row-id=' + row.bestellung_id + '><i class="fa fa-trash-o"></i></button>';
            }
        }

    }).on("loaded.rs.jquery.bootgrid", function()
    {



        grid.find(".command-edit").on("click", function(e)
        {
            cancel_form();
            let id =  $(this).data("row-id");
            let action = "FETCHONE";
            let kundeSelect = $('#selectjs_kunde');
            $.ajax({
                url : "../module/ajaxActionBestellung.php",
                method : "POST",
                data:{action:action,id:id},
                dataType: "json",
                success:function (data) {

                    $("#action").text("Aenderungen Speichern");

                    $("#bestellung_hidden_id").val(id);

                    $('#bestellung_nr').val(data[0].bestellung_nr);
                    $("#datum").val(data[0].datum);
                    $("#selectjs_kunde").val(""+data[0].kunde_id);
                    $("#selectjs_kunde").trigger('change');


                    //$('#artikel_nr').val('');
                    $('#menge').val('');
                    $("#selectjs_produkt").val('').trigger('change');



                    // $("#selectjs_lieferant option:selected").text(data.name);
                    let option = new Option(data[0].name, data[0].kunde_id, true, true);
                    kundeSelect.append(option).trigger('change');

                    aData = [];
                    let counter = 1;
                    for(let i = 0 ; i< data.length; i++){

                        aData.push(new Data(counter,data[i]['produkt_name'],data[i]['produkt_id'],data[i]['menge']));
                        counter++;
                    }


                    tableDesign();


                    $('html, body').animate({
                        scrollTop: $('#toppage').offset().top
                    }, 500);

                }
            });


        }).end().find(".command-delete").on("click", function(e)
        {

            let id =  $(this).data("row-id");
            let action = "DELETE";
            if(confirm("Are you sure you want to remove this data ? "))
            {

                $.ajax({
                    url: "../module/ajaxActionBestellung.php",
                    type: "post",
                    data: {action:action, id:id},
                    success: function(strMessage) {

                        cancel_form();

                        $("#datagrid_table").bootgrid('reload');
                    },
                    error: function (request, status, error) {
                        console.log(request.responseText);
                    }
                });

            }else{
                return;
            }

        }).end().find(".command-show").on("click", function(e)
        {

            let id =  $(this).data("row-id");
            let action = "FETCHONE";
            let kundeSelect = $('#selectjs_kunde');
            $.ajax({
                url : "../module/ajaxActionBestellung.php",
                method : "POST",
                data:{action:action,id:id},
                dataType: "json",
                success:function (data) {

                    $('#action').hide();

                    $('#bestellung_nr').val(data[0].bestellung_nr);
                    $("#datum").val(data[0].datum);
                    $("#selectjs_kunde").val(""+data[0].kunde_id);
                    $("#selectjs_kunde").trigger('change');


                    //$('#artikel_nr').val('');
                    $('#menge').val('');
                    $("#selectjs_produkt").val('').trigger('change');



                    // $("#selectjs_lieferant option:selected").text(data.name);
                    let option = new Option(data[0].name, data[0].kunde_id, true, true);
                    kundeSelect.append(option).trigger('change');

                    aData = [];
                    let counter = 1;
                    for(let i = 0 ; i< data.length; i++){

                        aData.push(new Data(counter,data[i]['produkt_name'],data[i]['produkt_id'],data[i]['menge']));
                        counter++;
                    }


                    tableDesign();

                    $(".updateFrom").hide();
                    $(".removeFrom").css('visibility','hidden');
                    $("#selectjs_produkt").parent().hide();
                    $("#menge").hide();
                    $("#insertTo").hide();

                    $('html, body').animate({
                        scrollTop: $('#toppage').offset().top
                    }, 500);

                    //after table DESIGN !


                }
            });


        });
    });





    /* object constructur */
    function Data(id, produktname, produkvalue,produktqte) {
        this.id = id;
        this.produktname = produktname;
        this.produkvalue = produkvalue;
        this.produktqte = produktqte;
        /*
                        this.getProduktName = function() {
                            return (this.produktname);
                        };

                        this.getProduktValue = function() {
                            return (this.produkvalue);
                        };

                        this.getProduktQte = function() {
                            return (this.produktqte);
                        };
                        */
    }

    //
    $('#insertTo').on('click',function () {

        let produktname = $("#selectjs_produkt option:selected").text();
        let produkvalue = $("#selectjs_produkt option:selected").val();
        let produktqte =  $("#menge").val();
        if(produktname != '' && produktqte != '' ){
            aData.push(new Data(id,produktname,produkvalue,produktqte));
            id++;

            //$('#artikel_nr').val('');
            $('#menge').val('');
            $("#selectjs_produkt").val('').trigger('change');


            tableDesign();

        }else{
            alert('bitte alle Felder einfüllen');
        }
        /* convert array of object into string json */
        //var jsonString = JSON.stringify(aData);
        //document.write(jsonString);

        /* loop arrray */
        // alert(aData.length);


    });

    function tableDesign() {
        let counter = 1;
        let b = $('#table_id');
        b.html('');

        for(let i = 0; i < aData.length; i++){
            tr = $("<tr></tr>").appendTo(b);
            tr.append( "<td width='10%'>"+counter+"</td><td width='35%'>"+aData[i].produktname+"</td><td width='35%'>"+aData[i].produktqte+"</td><td width='20%'>" +
                "<button class='btn btn-warning updateFrom' style='display: inline;' id="+aData[i].id+"><i class='fa fa-pencil'></i></button><button class='btn btn-danger removeFrom ' style='display: inline;' id="+aData[i].id+"><i class='fa fa-minus'></i></button>" );
            counter++;
        }






    }

    $('#table_id').on('click','.removeFrom', function(e){
        let id = $(this).attr('id');

        for (let i = 0; i < aData.length; i++) {
            let obj = aData[i];

            if (id == obj.id){
                aData.splice(i, 1);
            }
        }

        tableDesign();

    });

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

    })

    $('#bestellungdatepicker').datetimepicker({
        format: 'DD.MM.YYYY'
    });

    function cancel_form(){
        $("#selectjs_produkt").parent().show();
        $("#menge").show();
        $("#insertTo").show();
        $('#action').css('display','inline-block');
        update_lists_nr();
        $("#datum").val('');
        $("#menge").val('');
        $("#selectjs_kunde").val('').trigger('change');
        $("#selectjs_produkt").val('').trigger('change');
        aData = [];
        tableDesign();

    }

    $('#cancel_btn').on('click',function () {
        cancel_form();
        $('#action').text('Speichern');

    })

    $('#rest_btn').on('click',function () {
        cancel_form();


    })



    function update_lists_nr(){
        //change addbutton text after updateaction
        $('#action').text('Speichern');

        //Liwferung_NR
        $.ajax({
            url : "../module/ajaxServiceBestellungNummer.php",
            method : "POST",
            data:{action2:'GET'},
            dataType: "json",
            success:function (data) {
                $("#bestellung_nr").val(data.next_bestellung_nr);
            }
        });

        //Lieferant DropDownList
        $('#selectjs_kunde').select2({
            placeholder: "Kunde..",
            minimumInputLength: 2,
            ajax:{
                url: "../module/ajaxServiceKunde.php",
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

        //Produkt DropDownList
        $('#selectjs_produkt').select2({
            placeholder: "Produkt...",
            minimumInputLength: 1,
            ajax:{
                url: "../module/ajaxServiceProdukt.php",
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

    }




});