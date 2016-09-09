/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    
    $(".error").hide();
    $("#tabella_noleggi").hide();
    
    $('#filtra').click(function(e){
        // impedisco il submit
        e.preventDefault(); 
        var _veicolo = $( "#veicolo option:selected" ).attr('value');
        var _cliente = $( "#cliente option:selected" ).attr('value');        
        var _datainizio = $("#datainizio").val();
        var _datafine = $("#datafine").val();

        var par = {
            veicolo : _veicolo,
            cliente : _cliente,
            datainizio :_datainizio,
            datafine : _datafine
        };        
        $.ajax({
            url: 'dipendente/filtra_noleggi',
            data : par,
            dataType: 'json',
            success: function (data, state) {
                if(data['errori'].length === 0){
                    // nessun errore
                    $(".error").hide();
                    if(data['noleggi'].length === 0){
                        
                        // mostro il messaggio per nessun elemento
                        $("#nessuno").show();
                       
                        // nascondo la tabella
                        $("#tabella_noleggi").hide();

                    }else{
                        // nascondo il messaggio per nessun elemento
                        $("#nessuno").hide();
                        $("#tabella_noleggi").show();
                        //cancello tutti gli elementi dalla tabella
                        $("#tabella_noleggi tbody").empty();
                       
                        // aggingo le righe
                        var i = 0;
                        for(var key in data['noleggi']){
                            var esame = data['noleggi'][key];
                            $("#tabella_noleggi tbody").append(
                                "<tr id=\"row_" + i + "\" >\n\
                                       <td>a</td>\n\
                                       <td>a</td>\n\
                                       <td>a</td>\n\
                                       <td>a</td>\n\
                                       <td>a</td>\n\
                                       <td>a</td>\n\\n\
                                        </tr>");
                            if(i%2 == 0){
                                $("#row_" + i).addClass("alt-row");
                            }
                            
                            var colonne = $("#row_"+ i +" td");
                            $(colonne[0]).text(esame['cliente']);
                            $(colonne[1]).text(esame['veicolo']);
                            $(colonne[2]).text(esame['targa']);
                            $(colonne[3]).text(esame['datainizio']);
                            $(colonne[4]).text(esame['datafine']);
                            $(colonne[5]).text(esame['costo'] + " €");

                            i++;
                            
                           
                        }
                    }
                }else{
                    $(".error").show();
                    $(".error ul").empty();
                    for(var k in data['errori']){
                        $(".error ul").append("<li>"+ data['errori'][k] + "<\li>");
                    }
                }
               
            },
            error: function (data, state, error) {
                alert (error);
                
            }
        
        });
        
    })
});
