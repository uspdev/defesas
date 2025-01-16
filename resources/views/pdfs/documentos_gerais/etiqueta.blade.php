@extends('pdfs.fflch')
@inject('pessoa','Uspdev\Replicado\Pessoa')

@section('styles_head')
<style type="text/css">
    body {
        margin: 1cm -1.2cm 0cm -1.2cm;
        padding:0; 
    }
    .negrito {
        font-weight: bolder;
    }
    .justificar{
        text-align: justify;
    }
    .etiqueta{
        font-size: 12px; border-spacing:0.5cm 0cm;
    }
    tr{
        margin-left:0.5cm;
    }
    td{
        margin-left:0.5cm;
    }
</style>
@endsection('styles_head')

@section('content')
    <table style="border='0'" width="19cm" class="etiqueta">
    @foreach($professores as $professor)
        <tr>
            <td width="9.85cm" height="3.33cm">
                Ilmo(a) Sr(a).<br>
                {{$agendamento->dadosProfessor($professor->codpes)['nompes']}}<br>
                {{$agendamento->endereco($professor->codpes)['epflgr']}}, {{$agendamento->endereco($professor->codpes)['nombro']}} <br>
                CEP:{{$agendamento->endereco($professor->codpes)['codendptl']}} - {{$agendamento->endereco($professor->codpes)['cidloc']}}/{{$agendamento->endereco($professor->codpes)['sglest']}}
            </td>     
        </tr>
    @endforeach
    </table>
@endsection('content')