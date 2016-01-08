/* Regras
  A banca é composta por 3 títulares, com as seguintes regras e exceções:
  Se for regimento antigo:
    Mestrado: titular1, titular2 e titular3, sendo o orientador o titular1.
    Doutorado: titular1, titular2, titular3, titular4 e titular5 sendo o orientador o titular1.
  Se for regimento novo, mestrado e doutorado são iguais:
    Orientador votante: titular1, titular2 e titular3, sendo o orientador o titular1.
    Orientador não votante: titular1, titular2 e titular3.

*/

function bancaConfig(){
 
  var regimento = $("#regimento").val();
  var nivel = $("#nivel").val();
 
  
  if (regimento == 'antigo') {
    // Se for regimento antigo o orientador é obrigatoriamente votante.
    $("#div_orientador_votante").css('display','none');
    $("#orientador_votante").val = 'sim';
    $('#titular1').prop('disabled', true);
    $("input[id='titular1_id']").removeClass("requerido_docente");
 
    if( nivel == 'Mestrado' ) {
      $("#titular4").prop('disabled',true);
      $("#titular5").prop('disabled',true);
      $("input[id='titular4_id']").removeClass("requerido_docente");
      $("input[id='titular5_id']").removeClass("requerido_docente");
    }
    else if( nivel == 'Doutorado' ) {
      $("#titular4").prop('disabled',false);
      $("#titular5").prop('disabled',false);
    }  
  }
  else if (regimento == 'novo') {
    // No novo regimento não há titula 4 e 5
    $("#titular4").prop('disabled',true); 
    $("#titular5").prop('disabled',true);
    $("input[id='titular4_id']").removeClass("requerido_docente");
    $("input[id='titular5_id']").removeClass("requerido_docente");

    var orientador_votante = $('#orientador_votante').val();
    if (orientador_votante == 'sim') {
      $('#titular1').prop('disabled', true);
      $("input[id='titular1_id']").removeClass("requerido_docente");
    } 
  }
 
};

function bancaChanges(){
  /* Mudanças possíveis: 
    1) Se for mudança para regimento novo:
      1.1) aparecer orientador_votante e desabilitar titular4 e titular5
      1.2) Se houver mudança do orientador_votante para sim, desabilitar titular1, se for para nao, habilitar titular1

    2) Se for mudança para regimento antigo:
      2.1) desaparecer orientador_votante e titular1;
      2.2) se mudança para Mestrado desabilite titular4 e titular5 e remove classe requerido
      2.3) se mudança para Doutorado habilite titular4 e titular5 e adicione classe requerido
  */

  //Quando ação mudança de nível ocorre para Doutorado mostra titular 4 e 5 no regimento antigo
  $('#regimento').change(
    function(){
   console.log('kdçlw');
      if($(this).val() == 'novo'){
        $("#div_orientador_votante").css('display','block');
        $("#titular4").prop('disabled',true); 
        $("#titular5").prop('disabled',true);
        $("input[id='titular4_id']").removeClass("requerido_docente");
        $("input[id='titular5_id']").removeClass("requerido_docente");
      }
      else if($(this).val() == 'antigo') {
        $("#div_orientador_votante").css('display','none');
        $("#orientador_votante").val = 'sim';
        $('#titular1').prop('disabled', true);
        $("input[id='titular1_id']").removeClass("requerido_docente");
      }
    }
  );
  
  $('#orientador_votante').change(
    function(){
      if( $('#regimento').val() == 'novo') {
        if($(this).val() == 'sim'){
          $('#titular1').prop('disabled', true);
          $("input[id='titular1_id']").removeClass("requerido_docente");
        }
        else if($(this).val() == 'nao'){
          $('#titular1').prop('disabled', false);
          $("input[id='titular1_id']").addClass("requerido_docente");
        }
      }
    }
  );
  $('#nivel').change(
    function(){
      if( $('#regimento').val() == 'antigo') {
        if($(this).val() == 'Mestrado'){
          $("#titular4").prop('disabled',true);
          $("#titular5").prop('disabled',true);
          $("input[id='titular4_id']").removeClass("requerido_docente");
          $("input[id='titular5_id']").removeClass("requerido_docente");
        }
        else if($(this).val() == 'Doutorado'){
          $("#titular4").prop('disabled',false);
          $("#titular5").prop('disabled',false);
          $("input[id='titular4_id']").addClass("requerido_docente");
          $("input[id='titular5_id']").addClass("requerido_docente");
        }
      }
    }
  );
}

$(document).ready(function(){
	
   bancaConfig();
   

  // Calendário da data da defesa
  $( "#datepicker" ).datepicker( $.datepicker.regional[ "pt-BR" ] );
   
  // Autocomple no nome dos docentes
  $( ".autocomplete" ).autocomplete({
    source: "../buscaDocentes.php",
    minLength: 2,
    select: function( event, ui ) {
      var nome= '#' + $(this).attr('name') + '_id';
      $(nome).val(ui.item.id);	
    }
  });
  bancaChanges();
  $("form").submit(function() {
    var erro=0;
    $(".requerido").each(function(){
	    $(this).css("border","1px solid #455296").next("em").remove();
      $(this).val($.trim($(this).val()));
	     if ($(this).val().length < 1)	{
 	      $(this).css("border","1px solid #760000").after('<em  style="color:red;"> requerido!</em>');
         erro = erro + 1;
      }
    });

   $(".requerido_docente").each(
     function(){
       var nome = "'"+$(this).attr("name")+"'";
       $("label + input[name="+nome+"]").css("border","1px solid #455296").next("em").remove();
       $(this).val($.trim($(this).val()));
       if ($(this).val().length < 1)	{
         $("label + input[name="+nome+"]").css("border","1px solid #760000").after('<em  style="color:red;"> docente não cadastrado!</em>');
         erro = erro + 1;
       }
     }
   );
  
  if(erro == 0) {return true;}
  else return false;
  });
  
  $('.apagar').click(
    function(){
      $(this).val("");	
    }
  );
  
});


