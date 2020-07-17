@extends('pdfs.fflch')

@section('styles_head')
	<style type="text/css">
		body {background-image: url(/images/placa.jpg); 
				background-repeat:no-repeat; 
				background-position:center;
				font-family: DejaVu Sans, sans-serif;
				}
		.cabecalho {font-weight: bolder; text-align: center; font-size: large; margin-top: 2cm; }
		.candidato {font-weight: bolder; text-align: left; font-size: x-large; padding: 0.3cm; width: 24cm; margin-left:2cm;}
	</style>
@endsection('styles_head')

@section('content')
@inject('pessoa','Uspdev\Replicado\Pessoa')
<br>
<div class="cabecalho">
    Universidade de São Paulo<br>
	Faculdade de Filosofia, Letras e Ciências Humanas <br> 
	Serviço de Pós-Graduação 
</div>
<br><br><br>
<div class="candidato">Candidato(a): {{$pessoa::dump($agendamento->codpes)['nompes']}}</div> 
<div class="candidato">Data: {{$agendamento->data}}.</div>  
<div class="candidato">Defesa de {{$agendamento->nivel}} em {{$agendamento->area_programa}}</div> 
<div class="candidato">Título: <i>"{{$agendamento->titulo}}"</i></div>
@endsection('content')
