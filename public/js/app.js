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

    $("#codpes").click(function() {
        console.log('codpes');
        if ($("#codpes").prop("checked")) {
            $("#busca_data").hide();
            $("#busca_codpes").show();
        }
    });

    $("#data").click(function() {
        console.log('data');
        if($("#data").prop("checked")) {
            $("#busca_codpes").hide();
            $("#busca_data").show();
        }
    });

});

