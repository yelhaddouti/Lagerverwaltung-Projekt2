/**
 *
 * @author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
 */

var grid = $("#datagrid_table_home_produkt").bootgrid({
    ajax: true,
    post: function ()
    {
        return {
            id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
        };
    },
    url: "../module/ajaxActionProduktHome.php",


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
            url : "../module/ajaxActionProduktHome.php",
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
                url: "../module/ajaxActionProduktHome.php",
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
            url : "../module/ajaxActionProduktHome.php",
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

/*  ## bootgrid load (fetch all data ) using default action ## */
var grid2 = $("#datagrid_table_mitarbeiter").bootgrid({
    ajax: true,
    post: function ()
    {
        return {
            id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
        };
    },
    url: "../module/ajaxActionHomeMitarbeiter.php",



    formatters: {
        "avatar": function(column, row){

            let benutzerbild = "../images/"+row.benutzerbild;


            return '<div><img style="width: 54px; height: 54px; border-radius: 50%; border:2px solid #405367;"src="'+benutzerbild+'"></div>';
        },
        "farben": function(column, row){

            let online;
            if(row.status == 'Online'){
                online = "background: rgb(166,255,180);\n" +
                    "background: radial-gradient(circle, rgba(166,255,180,1) 0%, rgba(0,138,93,1) 100%);";//succes
            }

            if(row.status == 'Offline'){
                online = "background: rgb(255,255,255);\n" +
                    "background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgba(142,142,142,1) 100%);";//gray
            }
            return '<div style="display:inline-block;vertical-align: middle;width:15px;height:15px;margin-right: 5px; border-radius:50%; '+online+'"></div> '+ row.status;
        }
    }
}).on("loaded.rs.jquery.bootgrid", function()
{
    /* Executes after data is loaded and rendered */
    //change addbutton text after updateaction
    $('#action').text('Speichern');

    grid.find(".command-edit").on("click", function(e)
    {


    }).end().find(".command-delete").on("click", function(e)
    {


    }).end().find(".command-show").on("click", function(e)
    {


    });
});

/* reload datatable 3000ms */
setInterval(function(){

    $("#datagrid_table_mitarbeiter").bootgrid('reload');
    $("#datagrid_table_home_produkt").bootgrid('reload');

},3000);


