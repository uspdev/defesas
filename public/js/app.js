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

    $("#programa").click(function() {
        if($("#programa").prop("checked")) {
            $("#busca_programa").show();
        }
        else{
            $("#busca_programa").hide();
        }
    });

    $("#nivel").click(function() {
        if($("#nivel").prop("checked")) {
            $("#busca_nivel").show();
        }
        else{
            $("#busca_nivel").hide();
        }
    });

    $("#nivel").click(function() {
        if($("#nivel").prop("checked")) {
            $("#busca_nivel").show();
        }
        else{
            $("#busca_nivel").hide();
        }
    });
    
    document.getElementById("sala").onchange = function(){
        var value = document.getElementById("sala").value;
        var divSalaVirtual = document.getElementsByClassName('link_sala_virtual');
        if(value == "Sala Virtual"){
            divSalaVirtual[0].style.display = 'block';
        }else{
            divSalaVirtual[0].style.display = 'none';
        }
    };
});

