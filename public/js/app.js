jQuery(function ($) {
    $(".horario").mask('00:00');
    $(".data").mask('00/00/0000');  
    
    $("#numero_nome").click(function() {
        if ($("#numero_nome").prop("checked")) {
            $("#busca_data").hide();
            $("#busca").show();
        }
    });
    
    $("#data").click(function() {
        if($("#data").prop("checked")) {
            $("#busca").hide();
            $("#busca_data").show();
        }
    });
});

