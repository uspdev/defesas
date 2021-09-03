jQuery(function ($) {
    $('#codpes').change(function(){
        var data = { codpes: $( "#codpes" ).val() };

        function success(response) {
            if(!$( "#nome" ).val()){
                $( "#nome" ).val(response['nome']);
            }
            if(response['sexo'] == 'M'){
                $( "#sexo" ).val('Masculino');
            }
            else{
                $( "#sexo" ).val('Feminino');
            }
        }
        $.get('info', data, success);
        
    });
    
    $(".horario").mask('00:00');
    $(".data").mask('00/00/0000'); 
     
    $('.datepicker, .datePicker').datepicker({
        dateFormat: 'dd/mm/yy'
        , dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado']
        , dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D']
        , dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom']
        , monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']
        , monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
        , nextText: 'Próximo'
        , prevText: 'Anterior'
    });

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

