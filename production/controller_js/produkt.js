/**
 *
 * @author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
 */

$(document).ready(function() {
    /*  ## insert new Product or update (action : param) ## */
    $('#action').on('click',function(e){

        //formdata
        let name = ($("#name").val()).trim();
        let artikel_nr = ($("#artikel_nr").val()).trim();
        let bestand = ($("#bestand").val()).trim();
        let min_bestand = ($("#min_bestand").val()).trim();
        let max_bestand = ($("#max_bestand").val()).trim();

        //hiddenID , actiontyp
        let id =  $("#produkt_hidden_id").val();
        let action = $('#action').text();

        //check not empty (Bestand : Readonly input)
        if(name != '' && artikel_nr != '' && min_bestand !='' && max_bestand != ''){
            $.ajax({
                url: "../module/ajaxActionProdukt.php",
                type: "post",
                data: {name:name, artikel_nr: artikel_nr,bestand:bestand,min_bestand:min_bestand, max_bestand:max_bestand, action:action, id:id},
                success: function(strMessage) {
                    //
                    $('#name').val('');
                    $("#artikel_nr").val('');
                    $("#bestand").val(0);
                    $("#min_bestand").val('');
                    $("#max_bestand").val('');

                    //message : request ajax (insert and update)
                    $("#success_message").text(strMessage);
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

    /*  ## bootgrid load (fetch all data ) using default action ## */
    var grid = $("#datagrid_table").bootgrid({
        ajax: true,
        post: function ()
        {
            return {
                id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
            };
        },
        url: "../module/ajaxActionProdukt.php",
        formatters: {
            "farben": function(column, row){

                let color;
                if(row.status == 'auf der Lager'){
                    color = "#26B99A";//succes
                }
                if(row.status == 'fast leer'){
                    color = "#ffc107";//warning
                }
                if(row.status == 'nicht verfügbar'){
                    color = "#dc3545";//danger
                }
                return '<div style="display:inline-block;vertical-align: middle;width:15px;height:15px;margin-right: 5px; border-radius:50%; background-color:'+color+'"></div> '+ row.status;
            },
            "commands": function(column, row)
            {
                return  '<button type="button" id="commnad-show-btn" class="btn btn-primary btn-sm command-show" data-row-id=' + row.produkt_id + '><i class="fa fa-eye"></i></button>' +
                    '<button type="button" id="commnad-edit-btn" class="btn btn-warning btn-sm command-edit" data-row-id=' + row.produkt_id + '><i class="fa fa-pencil"></i></button> ' +
                    '<button type="button" id="commnad-delete-btn" class="btn btn-danger btn-sm command-delete" data-row-id=' + row.produkt_id + '><i class="fa fa-trash-o"></i></button>';

            }
        }
    }).on("loaded.rs.jquery.bootgrid", function()
    {
        /* Executes after data is loaded and rendered */
        //change addbutton text after updateaction
        $('#action').text('Speichern');

        grid.find(".command-edit").on("click", function(e)
        {
            cancel_form();
            let id =  $(this).data("row-id");
            let action = "FETCHONE";

            $.ajax({
                url : "../module/ajaxActionProdukt.php",
                method : "POST",
                data:{action:action,id:id},
                dataType: "json",
                success:function (data) {
                    $("#action").text("Aenderungen Speichern");
                    $("#produkt_hidden_id").val(id);

                    $('#name').val(data.name);
                    $("#artikel_nr").val(data.artikel_nr);
                    $("#bestand").val(data.bestand);
                    $("#min_bestand").val(data.min_bestand);
                    $("#max_bestand").val(data.max_bestand);

                    $('html, body').animate({
                        scrollTop: $('#toppage').offset().top
                    }, 500);

                }
            });


        }).end().find(".command-delete").on("click", function(e)
        {

           cancel_form();
            let id =  $(this).data("row-id");
            let action = "DELETE";
            if(confirm("Are you sure you want to remove this data ? "))
            {

                $.ajax({
                    url: "../module/ajaxActionProdukt.php",
                    type: "post",
                    data: {action:action, id:id},
                    success: function(strMessage) {

                        alert(strMessage);

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

            $.ajax({
                url : "../module/ajaxActionProdukt.php",
                method : "POST",
                data:{action:action,id:id},
                dataType: "json",
                success:function (data) {

                    $('#action').css('display','none');

                    $('#name').val(data.name);
                    $("#artikel_nr").val(data.artikel_nr);
                    $("#bestand").val(data.bestand);
                    $("#min_bestand").val(data.min_bestand);
                    $("#max_bestand").val(data.max_bestand);

                    $('html, body').animate({
                        scrollTop: $('#toppage').offset().top
                    }, 500);

                }
            });

        });
    });



    function cancel_form(){

        $('#action').css('display','inline-block');
        $('#name').val('');
        $("#artikel_nr").val('');
        $("#bestand").val(0);
        $("#min_bestand").val('');
        $("#max_bestand").val('');
        $("#hidden_produkt_id").val('');
    }

    $('#cancel_btn').on('click',function () {
        cancel_form();
        $('#action').text('Speichern');
    })
});