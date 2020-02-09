/**
 *
 * @author Yassin El Haddouti <yassin.el.haddouti@mnd.thm.de>
 */
$(document).ready(function(){

    loadPage();

    function loadPage(){
        let mitarbeiter_id = parseInt($("#session_mitarbeiter_id").val());
        let action = "FETCHALL";
        $.ajax({
            url : "../module/ajaxActionLagerung.php",
            method : "POST",
            dataType: "json",
            data : {mitarbeiter_id: mitarbeiter_id, action:action},
            success: function(data) {
                $('#accordion1').html('');
                for(let i = 0; i < data.length; i++){
                    let ids = data[i].lieferung_id+'-'+data[i].produkt_id+'-'+data[i].fachregal_id;
                    $('#accordion1').append('   <div class="panel" style="background-color: #f2f5f7">\n' +
                        '<h4 style="padding:15px 0 0 15px;">'+data[i].lieferung +' | '+data[i].datum+'</h4>'+
                        '<h4 style="padding-left:15px;">'+data[i].regal_name +' | '+data[i].fach_name+'</h4>'+
                        '<h4 style="padding-left:15px;">'+data[i].produkt_name +' | '+data[i].gelagerte_menge+'</h4>'+

                        '                                          <a class="panel-heading collapsed" role="tab" id="heading'+i+'" data-toggle="collapse" data-parent="#accordion1" href="#collapse'+i+'" aria-expanded="false" aria-controls="collapse'+i+'">\n' +
                        '                                              <button class="btn btn-primary">Anzeigen</button>\n' +
                        '                                          </a>\n' +
                        '                                          <div id="collapse'+i+'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'+i+'" style="">\n' +
                        '                                              <div class="panel-body" >\n' +
                        '\n' +
                        '                                                      <br>\n' +
                        '\n' +
                        '                                                          <!-- Liefrung Nr.-->\n' +
                        '                                                          <div class="item form-group">\n' +
                        '                                                              <label class="col-form-label col-sm-3" for="liefrung_nr">Lieferung Nr.\n' +
                        '                                                              </label>\n' +
                        '                                                              <div class=" col-sm-9 ">\n' +
                        '                                                                  <input type="text" id="lieferung_nr" name="" class="form-control " readonly style="background-color: white;" value="'+data[i].lieferung+'">\n' +
                        '                                                              </div>\n' +
                        '                                                          </div>\n' +
                        '\n' +
                        '                                                          <!-- Datum-->\n' +
                        '                                                          <div class="item form-group">\n' +
                        '                                                              <label class="col-form-label col-sm-3" for="datum">Datum\n' +
                        '                                                              </label>\n' +
                        '                                                              <div class=" col-sm-9 ">\n' +
                        '                                                                  <input type="text" id="datum" name="" class="form-control " readonly style="background-color: white;" value="'+data[i].datum+'">\n' +
                        '                                                              </div>\n' +
                        '                                                          </div>\n' +
                        '\n' +
                        '                                                          <!-- Produkt-->\n' +
                        '                                                          <div class="item form-group">\n' +
                        '                                                              <label class="col-form-label col-sm-3" for="produkt">Produkt\n' +
                        '                                                              </label>\n' +
                        '                                                              <div class=" col-sm-9 ">\n' +
                        '                                                                  <input type="text" id="produkt" name="" class="form-control " readonly style="background-color: white;" value="'+data[i].produkt_name+'">\n' +
                        '                                                              </div>\n' +
                        '                                                          </div>\n' +
                        '\n' +
                        '                                                          <!-- Menge-->\n' +
                        '                                                          <div class="item form-group">\n' +
                        '                                                              <label class="col-form-label col-sm-3" for="menge">Menge\n' +
                        '                                                              </label>\n' +
                        '                                                              <div class=" col-sm-9 ">\n' +
                        '                                                                  <input type="text" id="menge_'+ids+'" name="" class="form-control " readonly style="background-color: white;" value="'+data[i].gelagerte_menge+'">\n' +
                        '                                                              </div>\n' +
                        '                                                          </div>\n' +
                        '\n' +
                        '\n' +
                        '                                                          <!-- Regal-->\n' +
                        '                                                          <div class="item form-group">\n' +
                        '                                                              <label class="col-form-label col-sm-3" for="regal">Regal\n' +
                        '                                                              </label>\n' +
                        '                                                              <div class=" col-sm-9 ">\n' +
                        '                                                                  <input type="text" id="regal" name="" class="form-control " readonly style="background-color: white;" value="'+data[i].regal_name+'">\n' +
                        '                                                              </div>\n' +
                        '                                                          </div>\n' +
                        '\n' +
                        '                                                          <!-- Fach-->\n' +
                        '                                                          <div class="item form-group">\n' +
                        '                                                              <label class="col-form-label col-sm-3" for="fach">Fach\n' +
                        '                                                              </label>\n' +
                        '                                                              <div class=" col-sm-9 ">\n' +
                        '                                                                  <input type="text" id="fach" name="" class="form-control " readonly style="background-color: white;" value="'+data[i].fach_name+'">\n' +
                        '                                                              </div>\n' +
                        '                                                          </div>\n' +
                        '\n' +
                        '\n' +
                        '                                                          <!-- barcode-->\n' +
                        '                                                          <div class="item form-group">\n' +
                        '                                                              <div class=" col-sm-12 ">\n' +
                        '                                                                  <input type="text" id="barcode_'+ids+'"  placeholder="barcode eingeben..." name="" class="form-control ">\n' +
                        '                                                              </div>\n' +
                        '                                                          </div>\n' +
                        '\n' +
                        '\n' +
                        '\n' +
                        '                                                          <div class="ln_solid"></div>\n' +
                        '                                                          <div class="item form-group">\n' +
                        '                                                              <div class="col-md-6 col-sm-6 offset-md-3">\n' +
                        '                                                                  <button type="button" class="btn btn-success insertTo" id="'+ids+'">lagern</button>\n' +
                        '                                                              </div>\n' +
                        '                                                          </div>\n' +
                        '\n' +
                        '                                                          <!-- Response ajax-->\n' +
                        '                                                          <div id="success_message-'+ids+'" class="alert alert-success alert-dismissible" role="alert" style="display: none">\n' +
                        '                                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>\n' +
                        '                                                              </button>\n' +
                        '                                                             die daten wurden gespeichert\n' +
                        '                                                          </div>\n' +
                        '<input type="hidden" id="barcode_hidden_'+ids+'" value="'+data[i].barcode+'" >'+
                        '\n' +
                        '\n' +
                        '                                              </div>\n' +
                        '                                          </div>\n' +
                        '                                      </div>');

                }


            }
        });
    }

    $(document).on('click', '.insertTo', function () {
        let id = $(this).attr('id');
        let ids = ((id).trim()).split('-');
        let liefeurng_id = ids[0];
        let produkt_id = ids[1];
        let fachregal_id = ids[2];
        let barcode = ($('#barcode_'+id+'').val()).trim();
        let barcode_hidden = ($('#barcode_hidden_'+id+'').val()).trim();
        let menge = ($('#menge_'+id+'').val()).trim();

        let action = "INSERT";
        if(barcode != '' && barcode == barcode_hidden){

            $.ajax({
                url : "../module/ajaxActionLagerung.php",
                type : "POST",
                data : {liefeurng_id: liefeurng_id, produkt_id:produkt_id, fachregal_id:fachregal_id, menge:menge, action:action},
                success: function(data) {
                    $('#success_message'+ids+'').show();
                    $('#success_message'+ids+'').delay(1000).fadeOut();

                    loadPage();
                }
            });
        }else{
            alert("ungültige barcode");
        }


    });



});