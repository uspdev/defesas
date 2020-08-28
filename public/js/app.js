jQuery(function ($) {
    $(".horario").mask('00:00');
    $(".busca").mask('000000000000');
    $(".data").mask('00/00/0000');  
    
    $("#numero_usp").click(function() {
        if ($("#numero_usp").prop("checked")) {
            $("#busca_data").hide();
            $("#busca_nusp").show();
        }
    });
    
    $("#data").click(function() {
        if($("#data").prop("checked")) {
          $("#busca_data").show();
          $("#busca_nusp").hide();
        }
    });
});

