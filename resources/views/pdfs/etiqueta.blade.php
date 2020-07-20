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
    @inject('pessoa','Uspdev\Replicado\Pessoa')

    <table style="border='0'" width="19cm" class="etiqueta">
    @foreach($professores as $professor)
        <tr>
            <td width="9.85cm" height="3.33cm">
                Ilmo(a) Sr(a).<br>
                {{$pessoa::dump($professor->codpes)['nompes']}}<br>
                @php
                    $endereco = $pessoa::obterEndereco($professor->codpes);
                @endphp
                {{$endereco['nomtiplgr']}} {{$endereco['epflgr']}} {{$endereco['numlgr']}} <br>
                {{$endereco['cpllgr']}} {{$endereco['nombro']}} <br>
                CEP: {{$endereco['codendptl']}} - {{$endereco['cidloc']}}/{{$endereco['sglest']}}
            </td>     
        </tr>
    @endforeach
    </table>
@endsection('content')