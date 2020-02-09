/**
 *
 * @author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
 */

$(document).ready(function() {
    loadData();//autoload

    function loadData()
    {
        let action = "FETCHALL";
        $.ajax({
            url : "../module/ajaxActionLager.php",//FETCHALL
            method : "POST",
            data : {action:action},
            dataType: "json",
            success:function(data){
                let b = $('#regalen_id');
                b.html();
                for(let i = 0; i < data.length; i++){
                    div = $("<div class='col-md-4 col-sm-12 p-2'></div>").appendTo(b);
                    div.append("<div class='p-2 regal' style='background-color: "+ data[i].label_farbe +"'><span class='regal_title' >"+ data[i].name +" "+ data[i].nummer +" </span>" +
                        "<br><span class='regal_fachnummer'>Anzahl des Faches : "+ data[i].fachanzahl +"</span>" +
                        "<br><span class='regal_fachnummer'>Kapazität jedes Faches : "+ data[i].kapazitaet +"</span>" +
                        "<i class='fa fa-trash remove_regale' style='position:absolute;right: 22px;top: 32px;font-size: 28px;color: #dc3545;cursor: pointer;' id='"+data[i].lagerregal_id+"'></i> " +
                        "<i class='fa fa-barcode barcode_list' style='position:absolute;right: 66px;top: 31px;font-size: 34px;color: #ffffff;cursor: pointer;' id='"+data[i].lagerregal_id+"'></i></button></div>");
                }
            }
        });
    }


    //select barcode list
    $('#regalen_id').on('click','.barcode_list', function(e){
        //formdata
        let id = $(this).attr('id');
        let action = "GETBARCODE";
        $('#barcode_id').html("");
        $.ajax({
            url : "../module/ajaxActionLager.php",//GETBARCODE
            method : "POST",
            dataType: "json",
            data : {action:action,id:id},
            success: function(data) {


                let b = $('#barcode_id');
                b.html();
                for(let i = 0; i < data.length; i++){
                    div = $("<div class='col-md-4 col-sm-12 p-2'></div>").appendTo(b);
                    div.append("<div class='p-2 regal'><span class='regal_title' >"+ data[i].fachbarcode +"</span></div>");
                    div.append("<span style='bordeR:1px solid red;'></span>").barcode(
                        data[i].fachbarcode, // Value barcode (dependent on the type of barcode)
                        "code128" // type (string)
                    );

                }

                //message : request ajax (insert and update)
                $('#pdf_btn').show();

            }
        });




    });

    //DELETE
    $('#regalen_id').on('click','.remove_regale', function(e){
        //formdata
        let lagerregal_id = $(this).attr('id');
        let action = "REMOVE_REGAL";
        if(confirm("Are you sure you want to remove this data ? ")) {
            $('#barcode_id').html("");
            $.ajax({
                url: "../module/ajaxActionLager.php",//GETBARCODE
                type: "POST",
                data: {action: action, lagerregal_id: lagerregal_id},
                success: function (data) {
                    $('#regalen_id').html('');
                    loadData();

                }
            });
        }else{
            return;
        }




    });





    $('#action').text('Speichern');

    /*  ## insert new Delivery or update (action : param) ## */
    $('#action').on('click',function(e){

        //formdata
        let name = ($("#name").val()).trim();
        let barcode = ($("#barcode").val()).trim();
        let fachanzahl = ($("#fachanzahl").val()).trim();
        let kapazitaet = ($("#kapazitaet").val()).trim();
        let nummer = ($("#nummer").val()).trim();
        let label_farbe = ($("#label_farbe").val()).trim();

        let default_farbe  = "#506d89";
        if(label_farbe == '' || label_farbe == '#ffffff' || label_farbe == '#dc3545'){
            label_farbe = default_farbe;
        }


            //action speichern
            let action = $('#action').text();

            //check not empty (Bestand : Readonly input)
            if (name != '' && nummer != '' && fachanzahl != '' && kapazitaet != '') {
                $.ajax({

                    url: "../module/ajaxActionLager.php",//Speichern
                    type: "post",
                    data: {
                        name: name,
                        nummer: nummer,
                        barcode: barcode,
                        fachanzahl: fachanzahl,
                        kapazitaet: kapazitaet,
                        label_farbe: label_farbe,
                        action: action,
                    },
                    success: function (strMessage) {
                        //
                        $("#regalen_id").html('');
                        $("#name").val('');
                        $("#nummer").val('');
                        $("#barcode").val('');
                        $("#fachanzahl").val('');
                        $("#kapazitaet").val('');

                        //message : request ajax (insert and update)
                        $("#success_message").text(strMessage);
                        $('#success_message').show();
                        $('#success_message').delay(1000).fadeOut();

                        loadData();//autoload

                    },
                    error: function (request, status, error) {
                        console.log(request.responseText);
                    }
                });
            } else {
                alert("bitte alle daten eintragen");//(required)
            }



    });


});