@inject('pessoa','Uspdev\Replicado\Pessoa')

@extends('laravel-fflch-pdf::main')
@section('other_styles')
<style type="text/css">
    body{
        margin-top: 0px; margin-left:3em; font-family: DejaVu Sans, sans-serif; font-size: 12px;
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
    .data_hoje{
        margin-left: 11cm; margin-bottom:0.8cm; 
    }
    .justificar{
        text-align: justify; width: 15cm; margin-left:0.5cm;
    }
    .importante {
        border:1px solid; margin-top:0.3cm; margin-bottom:0.3cm; width: 15cm; font-size:12px; margin-left:0.5cm;
    }
    #footer{
      text-align:center;
    }
</style>
@endsection('other_styles')

@section('content')
  <div class="data_hoje">
    @php(setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese'))
    São Paulo, {{ strftime('%d de %B de %Y', strtotime('today')) }}
  </div>
	<left> {!! $configs->agencia_viagem !!} </left> 
	<br> 
    <ul> 
		<li>Requisição passagem aérea nº <b>{{$dados->requisicao}} </b> </li>  
		<li>Programa: <b>{{$agendamento->nome_area}} </b> </li>  
    <li><b>{{$agendamento->nivel}} </b> </li>  
		<li>Defesa do Sr.(a): <b> {{$agendamento->nome}} </b> </li>  
		<li>Orientador(a): Prof(a) Dr(a)<b> {{$agendamento->nome_orientador ?? $pessoa::dump($agendamento->orientador)['nompes']}} @if($agendamento->co_orientador) e {{$agendamento->nome_co_orientador ?? $agendamento->dadosProfessor($agendamento->co_orientador)['nompes']}} @endif </b> </li>
    </ul>
	<div class="justificar" style="text-indent:1cm;" >{!! $configs->agencia_texto !!} </div>
	<div class="importante">  
		Interessado(a): Prof(a). Dr(a). <b> {{$agendamento->dadosProfessor($banca->codpes)['nompes']}}</b> <br>
		E-mail: <b>{{$agendamento->dadosProfessor($banca->codpes)['codema']}}</b> <br>
		Telefone:<b> {{$agendamento->dadosProfessor($banca->codpes)['numtelfmt']}} </b> <br>
		Data da defesa:<b> {{date('d/m/Y', strtotime($agendamento->data_horario))}}</b> <br>
		Trajeto da passagem aérea <b> {{$dados->trajeto}}</b> <br>
	</div> <br>
	<table style="width:15.5cm; text-align:center;"> 
		<tr> 
			<td style="width:7.25cm;"> <p style="text-align:center;"> <b>IDA </b></p></td>
			<td> <p style="text-align:center;"><b>VOLTA </b> </p> </td>
		</tr>
		<tr>
			<td> {{$dados->ida}} </td>
			<td> {{$dados->volta}} </td>
		</tr>
	</table> <br>

	<p class="justificar"><b> Solicitamos a gentileza no sentido de comunicar aos professores interessados, com antecedência, n° do PTA e nome da companhia aérea.  </b></p> <br> <br> 
	<p style="text-align:center;"><b> Favor faturar para: {!! $configs->faturar_para !!} </b></p> <br>
  <div style="margin-top:0.5em; text-align:center;"> 
      Atenciosamente, 
  </div>
 	<p style="text-align:center;"> 
    <b> 
		  {{Auth::user()->name}}
      <br> 
      Serviço de Pós-Graduação - @if($pessoa::cracha(Auth::user()->codpes)) {{$pessoa::cracha(Auth::user()->codpes)['nomorg']}}/USP @endif 
		</b>
  </p>
@endsection('content')

@section('footer')
    {!! $configs->rodape_oficios !!}
@endsection('footer')