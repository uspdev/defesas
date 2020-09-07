@extends('pdfs.fflch')

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
                {{$professor->nome}}<br>
                {{$professor::getDadosProfessor($professor->codpes)['endereco']}}, {{$professor::getDadosProfessor($professor->codpes)['bairro']}} <br>
                CEP:{{$professor::getDadosProfessor($professor->codpes)['cep']}} - {{$professor::getDadosProfessor($professor->codpes)['cidade']}}/{{$professor::getDadosProfessor($professor->codpes)['estado']}}
            </td>     
        </tr>
    @endforeach
    </table>
@endsection('content')