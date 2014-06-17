$(document).ready(function(){
	verificarNivel();
		//Data
	$( "#datepicker" ).datepicker( $.datepicker.regional[ "pt-BR" ] );	
    
		// Autocomplete data da defsa
	$( ".autocomplete" ).autocomplete({
		source: "../buscaDocentes.php",
		minLength: 2,
		select: function( event, ui ) {
     var nome= '#'+ $(this).attr('name');
     $(nome).val(ui.item.id);			
		}
	});
	//Quando ação mudança de nível ocorre para Doutorado mostra titular 4 e 5
	$("#nivel").change(function(){
		if($(this).val() == 'Doutorado') {
			$("#oculto").css('display','block');
      $("input[id='titular4']").addClass("requerido2");
      $("input[id='titular5']").addClass("requerido2");
		}
		else {
			$("#oculto").css('display','none');
      $("input[id='titular4']").removeClass("requerido2");
      $("input[id='titular5']").removeClass("requerido2");
		}
	});

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

 $(".requerido2").each(function(){
   var nome = "'"+$(this).attr("name")+"'";
   $("label + input[name="+nome+"]").css("border","1px solid #455296").next("em").remove();
   $(this).val($.trim($(this).val()));
   if ($(this).val().length < 1)	{
     $("label + input[name="+nome+"]").css("border","1px solid #760000").after('<em  style="color:red;"> docente não cadastrado!</em>');
     erro = erro + 1;
   }
 });

    if(erro == 0) {return true;}
				else return false;
  });
  
	$('.apagar').click(function(){
		$(this).val("");	
	}); 

});

//Esta função será executada quando a página carrega o javascript. 
function verificarNivel(){
	var nivel = $("#nivel").val();
	if( nivel == 'Mestrado') {
		$("#oculto").css('display','none');	
	}
	else {
		$("#oculto").css('display','block');
	}
};
