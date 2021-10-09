@inject('pessoa','Uspdev\Replicado\Pessoa')

@extends('laravel-fflch-pdf::main')
@section('other_styles')
<style type="text/css">
    .data_hoje{
        margin-left: 10cm; margin-bottom:0.8cm; 
    }
    .conteudo{ 
        margin: 1cm 
    }
    .boxSuplente {
        border: 1px solid; padding: 4px;
    }
    .boxPassagem {
        border: 1px solid; padding: 4px; text-align: justify;
    }
    .oficioSuplente{
        text-align: justify; 
    }
    .rodapeFFLCH{
        padding-top:3cm; text-align: center;
    }
    p.recuo {
        text-indent: 0.5em;
        direction: rtl;
    }
    .moremargin {
        margin-bottom: 0.15cm;
    }
    .importante {
        border:1px solid; margin-top:0.3cm; margin-bottom:0.3cm; width: 15cm; font-size:12px; margin-left:4em;
    }
    .negrito {
        font-weight: bolder;
    }
    .justificar{
        text-align: justify;
    }
    table{
        border-collapse: collapse;
        border: 0px solid #000;
    }
    table th, table td {
        border: 0px solid #000;
    }
    tr, td {
        border: 1px #000 solid; padding: 1
    }
    body{
        margin-top: 0.2em; margin-left: 1.8em; font-family: DejaVu Sans, sans-serif; font-size: 12px;
    }
    #footer{
        text-align:center;
    }
</style>
@endsection('other_styles')

@section('content')

    <div align="right">
        @php(setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese'))
        São Paulo, {{ strftime('%d de %B de %Y', strtotime('today')) }}
    </div><br><br>

    <div class="moremargin">Assunto: Banca Examinadora de <b>{{$agendamento->nivel}}</b></div> 
    <div class="moremargin">Candidato(a): <b>{{$agendamento->nome}}</b> </div>
    <div class="moremargin">Área: <b>{{$agendamento->nome_area}}</b> </div>
    <div class="moremargin">Orientador(a) Prof(a). Dr(a). {{$pessoa::dump($agendamento->orientador)['nompes']}}</div>
    <div class="moremargin">Título do Trabalho: <i>{{$agendamento->titulo}} </i></div><br>
    <div class="importante">
        {!! $configs->importante_oficio !!}
    </div><br>
    <p>
        <i>Data e hora da defesa:  </i> <b> {{$agendamento->data}}, às {{$agendamento->horario}} </b> <br> 
        <i>Local:</i> <b> {{$agendamento->sala}} </b> - Administração da FFLCH 
    </p>  
    <i>Composição da banca examinadora:</i> 


    <table width="16cm" style="border='0'; margin-left:4cm; align-items: center; justify-content: center;">
        @foreach($professores as $componente)    
        <tr style="border='0'">
            <td> {{$agendamento->dadosProfessor($componente->codpes)->nome ?? 'Professor não cadastrado'}} </td> 
            <td><b>{{$agendamento->dadosProfessor($componente->codpes)->lotado ?? ' '}}</b></td>
        </tr>
        @endforeach
    </table>

	<br>
	<div class="importante" align="center"> 
        {!! $configs->regimento !!}
    </div>
    <p align="center">
        Atenciosamente, 
		<br>
        <b> 
            {{Auth::user()->name}} @if($pessoa::cracha(Auth::user()->codpes)) - Defesas de Mestrado e Doutorado da {{$pessoa::cracha(Auth::user()->codpes)['nomorg']}}/USP @endif 
		</b>
    </p>
    <br><br> 
    Ilmo(a). Sr(a). {{$agendamento->dadosProfessor($professor->codpes)['nome'] ?? 'Professor não cadastrado'}}<br>
    {{$agendamento->dadosProfessor($professor->codpes)->endereco ?? ' '}}, {{$agendamento->dadosProfessor($professor->codpes)->bairro ?? ' '}} <br>
    CEP:{{$agendamento->dadosProfessor($professor->codpes)->cep ?? ' '}} - {{$agendamento->dadosProfessor($professor->codpes)->cidade ?? ' '}}/{{$agendamento->dadosProfessor($professor->codpes)->estado ?? ' '}}
    <br> telefone: {{$agendamento->dadosProfessor($professor->codpes)->telefone ?? ' '}}
    <br>e-mail: {{$agendamento->dadosProfessor($professor->codpes)->email ?? ' '}}
@endsection('content')

@section('footer')
    {!! $configs->rodape_oficios !!}
@endsection('footer')