/**
 *
 * @author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
 */

$(document).ready(function() {



    /*  ## insert new Kunde or update (action : param) ## */
    $('#action').on('click',function(e){
        //formdata
        let vorname = ( $("#vorname").val() ).trim();
        let nachname = ( $("#nachname").val() ).trim();
        let personal_nr = ( $('#personal_nr').val() ).trim();
        let passwort = ($("#passwort").val() ).trim();
        let rolle = ( $("#rolle").val()).trim();
        let benutzerbild =  ( $("#hidden_image_name").val()).trim();



        //hiddenID , actiontyp
        let mitarbeiter_id =  $("#mitarbeiter_hidden_id").val();
        let action = $('#action').text();


        //check not empty (Bestand : Readonly input)
        if(vorname != '' && nachname != '' && personal_nr !='' && passwort != ''){
            $.ajax({
                url: "../module/ajaxActionMitarbeiter.php",
                type: "post",
                data: {vorname:vorname,
                    nachname: nachname,
                    personal_nr: personal_nr,
                    passwort: passwort,
                    rolle:rolle,
                    action:action,
                    mitarbeiter_id:mitarbeiter_id,
                    benutzerbild: benutzerbild
                },
                success: function(strMessage) {
                    cancel_form();


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
        url: "../module/ajaxActionMitarbeiter.php",





        formatters: {
            "avatar": function(column, row){

                    benutzerbild = "../images/"+row.benutzerbild;


                return '<div><img style="width: 54px; height:54px; border-radius: 50%; border:2px solid #405367;-webkit-box-shadow: 7px 6px 5px -7px rgba(115,110,115,0.68);\n' +
                    '-moz-box-shadow: 7px 6px 5px -7px rgba(115,110,115,0.68);\n' +
                    'box-shadow: 7px 6px 5px -7px rgba(115,110,115,0.68);" src="'+benutzerbild+'"></div>';
            },
            "commands": function(column, row)
            {
                return '<button type="button" id="commnad-show-btn" class="btn btn-primary btn-sm command-show" data-row-id=' + row.mitarbeiter_id + '><i class="fa fa-eye"></i></button>'+
                    '<button type="button" id="commnad-edit-btn" class="btn btn-warning btn-sm command-edit" data-row-id=' + row.mitarbeiter_id + '><i class="fa fa-pencil"></i></button> ' +
                    '<button type="button" id="commnad-delete-btn" class="btn btn-danger btn-sm command-delete" data-row-id=' + row.mitarbeiter_id + '><i class="fa fa-trash-o"></i></button>';
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
            let mitarbeiter_id =  $(this).data("row-id");
            let action = "FETCHONE";

            let benutzerbild = $('#hidden_image_name').val();

            $.ajax({
                url : "../module/ajaxActionMitarbeiter.php",
                method : "POST",
                data:{action:action,mitarbeiter_id:mitarbeiter_id,benutzerbild:benutzerbild},
                dataType: "json",
                success:function (data) {

                    $("#uploaded_image").html('');
                    $("#action").text("Aenderungen Speichern");
                    $("#mitarbeiter_hidden_id").val(mitarbeiter_id);

                    $("#vorname").val(data.vorname);
                    $("#nachname").val(data.nachname);
                    $("#personal_nr").val(data.personal_nr);
                    $("#passwort").val(data.passwort);
                    $("#rolle").val(data.rolle);

                    if(data.benutzerbild != 'user.png'){
                        $("#hidden_image_name").val(data.benutzerbild);
                        $("#uploaded_image").html('<img src="../images/'+data.benutzerbild+'" height="150" width="225" class="img-thumbnail" style="margin-top:-25px; border-radius:0"><div style="cursor:pointer" id="remove_uploaded_image" class="btn btn-outline-danger btn-sm ml-1"><i class="fa fa-trash" style="font-size:18px"></i> Benutzerbild Löschen</div>');
                    }


                    $('html, body').animate({
                        scrollTop: $('#toppage').offset().top
                    }, 500);

                }
            });


        }).end().find(".command-delete").on("click", function(e)
        {
            cancel_form();
            let mitarbeiter_id =  $(this).data("row-id");
            let action = "DELETE";
            if(confirm("Are you sure you want to remove this data ? "))
            {

                $.ajax({
                    url: "../module/ajaxActionMitarbeiter.php",
                    type: "post",
                    data: {action:action, mitarbeiter_id:mitarbeiter_id},
                    success: function(strMessage) {


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

            let mitarbeiter_id =  $(this).data("row-id");
            let action = "FETCHONE";

            $.ajax({
                url : "../module/ajaxActionMitarbeiter.php",
                method : "POST",
                data:{action:action,mitarbeiter_id:mitarbeiter_id},
                dataType: "json",
                success:function (data) {

                    $('#action').css('display','none');

                    $("#vorname").val(data.vorname);
                    $("#nachname").val(data.nachname);
                    $("#personal_nr").val(data.personal_nr);
                    $("#passwort").val(data.passwort);
                    $("#rolle").val(data.rolle);

                    if(data.benutzerbild != 'user.png'){
                        $("#uploaded_image").html('<img src="../images/'+data.benutzerbild+'" height="150" width="225" class="img-thumbnail" style="margin-top:-25px; border-radius:0">');
                    }

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
        $("#personal_nr").val('');
        $("#passwort").val('');
        $("#rolle").val('');

        $('.custom-file-label').html('');
        $("#uploaded_image").html('');
        $("#bild").val('');
        $("#hidden_image_name").val('');

    }

    $('#cancel_btn').on('click',function () {
        cancel_form();
        $('#action').text('Speichern');

    })

    $('#rest_btn').on('click',function () {
        cancel_form();
    })

    /*benutzerbild upload*/

    $(document).on('change', '#bild', function(){
        var name = document.getElementById("bild").files[0].name;
        var form_data = new FormData();
        var ext = name.split('.').pop().toLowerCase();
        if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
        {
            alert("ungültige bild");
          return;
        }
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("bild").files[0]);
        var f = document.getElementById("bild").files[0];
        var fsize = f.size||f.fileSize;
        if(fsize > 2000000)
        {
            alert("Bildgröße ist zu groß!");
            return;
        } else
        {

            let m = new Date();
            let dateString = m.getUTCFullYear() +""+ (m.getUTCMonth()+1) +""+ m.getUTCDate() + "" + m.getUTCHours() + "" + m.getUTCMinutes() + "" + m.getUTCSeconds();

            let array_string = (document.getElementById('bild').files[0]["name"]).split('.')
            let extension =(array_string)[array_string.length - 1];

            let bildname = dateString+'.'+extension;

            form_data.append("bild", document.getElementById('bild').files[0]);
            form_data.append("bildname", bildname);

            $old_image_name = $('#hidden_image_name').val();
            if($old_image_name != ''){
                form_data.append("old_image", $old_image_name);
            }


            $.ajax({
                url:"../module/ajaxServiceBenutzerbildHochladen.php",
                method:"POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function(){
                    $('#uploaded_image').html("<label class='text-success'>Bild wird hochgeladen...</label>");
                },
                success:function(data)
                {
                    $('#hidden_image_name').val(bildname);
                    $('#uploaded_image').html(data);
                }
            });

        }
    });

    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });


    $(document).on('click','#remove_uploaded_image',function(){
       let image_name = $('#hidden_image_name').val();

        let action = "DELETE_IMAGE";
        let mitarbeiter_id = $('#mitarbeiter_hidden_id').val();



        $.ajax({
            url : "../module/ajaxActionMitarbeiter.php",
            type : "POST",
            data:{action:action,mitarbeiter_id:mitarbeiter_id,image_name:image_name},
            success:function(){

                $('.custom-file-label').html('');
                $("#uploaded_image").html('');
                $("#bild").val('');
                $("#hidden_image_name").val('');

            }
        });
    });



});