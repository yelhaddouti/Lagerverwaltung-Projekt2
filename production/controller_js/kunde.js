/**
 *
 * @author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
 */

$(document).ready(function() {

    $('#kunde_datepicker').datetimepicker({
        format: 'DD.MM.YYYY'
    });




    /*  ## insert new Kunde or update (action : param) ## */
    $('#action').on('click',function(e){
        //formdata
        let vorname = ( $("#vorname").val() ).trim();
        let nachname = ( $("#nachname").val() ).trim();
        let geburtsdatum = ( $('#geburtsdatum').val() ).trim();
        let strasse = ($ ("#strasse").val() ).trim();
        let hausnummer = ( $("#hausnummer").val()).trim();
        let postleitzahl = ($("#postleitzahl").val()).trim();
        let stadt = ($("#stadt").val()).trim();
        let fax= ($("#fax").val()).trim();
        let tel= ($("#tel").val()).trim();

        //hiddenID , actiontyp
        let kunde_id =  $("#kunde_hidden_id").val();
        let action = $('#action').text();

        //check not empty (Bestand : Readonly input)
        if(vorname != '' && nachname != '' && geburtsdatum !=''){
            $.ajax({
                url: "../module/ajaxActionKunde.php",
                type: "post",
                data: {vorname:vorname,
                    nachname: nachname,
                    geburtsdatum: geburtsdatum,
                    strasse: strasse,
                    hausnummer:hausnummer,
                    postleitzahl:postleitzahl,
                    stadt:stadt,
                    fax:fax,
                    tel:tel,
                    action:action,
                    kunde_id:kunde_id
                },
                success: function(strMessage) {
                    //
                    $("#vorname").val('');
                    $("#nachname").val('');
                    $("#geburtsdatum").val('');
                    $("#strasse").val('');
                    $("#hausnummer").val('');
                    $("#postleitzahl").val('');
                    $("#stadt").val('');
                    $("#fax").val('');
                    $("#tel").val('');

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
        url: "../module/ajaxActionKunde.php",
        formatters: {
            "commands": function(column, row)
            {
                return '<button type="button" id="commnad-show-btn" class="btn btn-primary btn-sm command-show" data-row-id=' + row.kunde_id + '><i class="fa fa-eye"></i></button>'+
                    '<button type="button" id="commnad-edit-btn" class="btn btn-warning btn-sm command-edit" data-row-id=' + row.kunde_id + '><i class="fa fa-pencil"></i></button> ' +
                    '<button type="button" id="commnad-delete-btn" class="btn btn-danger btn-sm command-delete" data-row-id=' + row.kunde_id + '><i class="fa fa-trash-o"></i></button>';
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
            let kunde_id =  $(this).data("row-id");
            let action = "FETCHONE";

            $.ajax({
                url : "../module/ajaxActionKunde.php",
                method : "POST",
                data:{action:action,kunde_id:kunde_id},
                dataType: "json",
                success:function (data) {
                    $("#action").text("Aenderungen Speichern");
                    $("#kunde_hidden_id").val(kunde_id);

                    $("#vorname").val(data.vorname);
                    $("#nachname").val(data.nachname);
                    $("#geburtsdatum").val(data.geburtsdatum);
                    $("#strasse").val(data.strasse);
                    $("#hausnummer").val(data.hausnummer);
                    $("#postleitzahl").val(data.postleitzahl);
                    $("#stadt").val(data.stadt);
                    $("#fax").val(data.fax);
                    $("#tel").val(data.tel);


                    $('html, body').animate({
                        scrollTop: $('#toppage').offset().top
                    }, 500);

                }
            });


        }).end().find(".command-delete").on("click", function(e)
        {
            cancel_form();
            let kunde_id =  $(this).data("row-id");
            let action = "DELETE";
            if(confirm("Are you sure you want to remove this data ? "))
            {

                $.ajax({
                    url: "../module/ajaxActionKunde.php",
                    type: "post",
                    data: {action:action, kunde_id:kunde_id},
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

            let kunde_id =  $(this).data("row-id");
            let action = "FETCHONE";

            $.ajax({
                url : "../module/ajaxActionKunde.php",
                method : "POST",
                data:{action:action,kunde_id:kunde_id},
                dataType: "json",
                success:function (data) {

                    $('#action').css('display','none');

                    $("#vorname").val(data.vorname);
                    $("#nachname").val(data.nachname);
                    $("#geburtsdatum").val(data.geburtsdatum);
                    $("#strasse").val(data.strasse);
                    $("#hausnummer").val(data.hausnummer);
                    $("#postleitzahl").val(data.postleitzahl);
                    $("#stadt").val(data.stadt);
                    $("#fax").val(data.fax);
                    $("#tel").val(data.tel);


                    $('html, body').animate({
                        scrollTop: $('#toppage').offset().top
                    }, 500);

                }
            });


        });
    });

    function cancel_form(){
        $('#action').css('display','inline-block');

        $("#vorname").val('');
        $("#nachname").val('');
        $("#geburtsdatum").val('');
        $("#strasse").val('');
        $("#hausnummer").val('');
        $("#postleitzahl").val('');
        $("#stadt").val('');
        $("#fax").val('');
        $("#tel").val('');
        $("#kunde_hidden_id").val('');

    }

    $('#cancel_btn').on('click',function () {
        cancel_form();
        $('#action').text('Speichern');

    })
});