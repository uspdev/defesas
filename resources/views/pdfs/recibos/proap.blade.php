@extends('pdfs.fflch')

@section('styles_head')
<style>
    #headerFFLCH { font-size: 15px; width: 17cm; text-align:center;}
    .data_hoje{ margin-left: 10cm; margin-bottom:0.8cm; }
    .conteudo { margin: 1cm }
    p.recuo {text-indent: 0.5cm;}
    .moremargin {margin-bottom: 0.15cm;}
    .importante {border:2px solid; background-color:#cbcbcb; margin-top:0.3cm; margin-bottom:0.3cm;}
    .negrito {font-weight: bolder;}
    .justificar{text-align: justify;}
    table { background #fff; border-collapse: collapse; }
    tr, td { border: 1px #000 solid; padding: 3 }
    #proap { font-family:Courier; font-size:13px; }
</style>
@endsection('styles_head')

@section('header')
	<div id="headerFFLCH">
		<table border="0" width="16cm">
			<tr>
   				<td width="2cm"> <img src="images/fflch.gif" width="95%"/> </td> 
				<td width="16cm"> <span style="font-size:20px; font-style:normal; "> <b> UNIVERSIDADE DE SÃO PAULO </b> </span> <br>   
					<span style="font-size:15px;">Faculdade de Filosofia, Letras e Ciências Humanas</span> <br>
					<span style="font-size:12x; font-style:normal; "> <b>CNPJ. 63.025.530/0016-90</b> </span> <br> 
					<span style="font-size:10px; font-style:normal; ">Rua do Lago, 717 - Sl. 131 - Cid. Universitária - CEP: 05508-900 - Fone/Fax: 3091-4878 </span> 
				</td>
			</tr>
 	 	</table>
	</div>
@endsection('header')

@section('content')
@inject('pessoa','Uspdev\Replicado\Pessoa')
@inject('replicado','App\Utils\ReplicadoUtils')

	<br>
    <div id="proap">	
        <center> <span style="font-size:16px;"> <b> RECIBO DE DIÁRIAS - BANCA EXAMINADORA </b> </span> </center>	
        <center> <span style="font-size:14px;"> <b> PROAP {{$dados->ano}} </b> </span> </center>
        <hr>
        <table width="16.5cm" style="border:0px;">
			<tr>
				<td style="border:0px;" colspan="2">Nome do Convidado: {{$banca->nome}} </td>
			</tr>
			<tr>
				<td style="border:0px;"> CPF: {{$pessoa::dump($banca->codpes)['numcpf']}}</td>
				<td style="border:0px;">  RG: {{$pessoa::dump($banca->codpes)['numdocidf']}}  </td>
			</tr>
		</table>				
	    <hr>
	    <table width="16.5cm" style="border:0px;">
			<tr>
				<td style="border:0px;">Unidade: </td>
				@if($pessoa::cracha($banca->codpes)['nomorg'] == null) 
					<td style="border:0px;"> {{$replicado::nomeOrganizacao($banca->codpes)['sglorg']}} </td>
                @else
					<td style="border:0px;"> {{$pessoa::cracha($banca->codpes)['nomorg']}} </td>
                @endif 
				<td style="border:0px;">Cargo: </td>
				<td style="border:0px;"> <b> Professor(a) Doutor(a) </b> </td>
			</tr>
			<tr>
				<td style="border:0px;">Pós Graduação em: </td>
				<td style="border:0px;"> {{$agendamento->nome_area}} </td>
				<td style="border:0px;"> Mês: </td>
				@php(setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese'))
				<td style="border:0px;"> <b> {{strftime("%B de %Y", strtotime($agendamento->data_horario))}}</b> </td>
			</tr>
		</table>			
	    <center>
	    <br> <div style="font-size:16px;">  <b>DISCRIMINAÇÃO</b> </span> </div><br>		
	    <table width="18.5cm" style="border:1px;">
			<tr>
				<td style="border:1px solid;" colspan="2"> <b> CHEGADA NA SEDE</b> </td>
				<td style="border:1px solid;" rowspan="2"> <b> ORIGEM  <b> </td>
				<td style="border:1px solid;" colspan="2"> <b> SAÍDA DA SEDE </td>
				<td style="border:1px solid;" rowspan="2"> <b> N° DIÁRIAS </b> </td>
				<td style="border:1px solid;" rowspan="2"> <b> TOTAL </b> </td>
			</tr>
			<tr>
				<td style="border:1px solid;"> DIA</td>
				<td style="border:1px solid;"> HORA </td>
				<td style="border:1px solid;"> DIA</td>
				<td style="border:1px solid;"> HORA </td>
			</tr>
			<tr>
				<td style="border:1px solid;"> {{$dados->chegada}} </td>
				<td style="border:1px solid;">  </td>
				<td style="border:1px solid;"> {{$dados->origem}}  </td>
				<td style="border:1px solid;"> {{$dados->saida}}  </td>
				<td style="border:1px solid;">  </td>
				<td style="border:1px solid;"> {{$dados->diaria_proap}} </td>
				<td style="border:1px solid;"> {{$dados->valor_proap}}  </td>
			</tr>
			<tr>
				<td style="border:0;" colspan="4">  Valor da Diária com pernoite </td>
				<td style="border:0;"> {{$configs->diaria_com_pernoite}}   </td>
				<td style="border:1px solid;"> <b> TOTAL </b> </td>
				<td style="border:1px solid;"> <b> {{$dados->valor_proap}}  </b> </td>
			</tr>
		</table>
	    </center>
	    <br><br><br><br><br>Recebi o valor de {{$dados->valor_proap}} ({{$dados->extenso}}) <br><br><br>
	    Referente às diárias a que fiz jus conforme demonstração supra. <br><br><br>
	    São Paulo, {{strftime("%d de %B de %Y", strtotime($agendamento->data_horario))}} <br><br><br><br>
	    <table width="18cm"> 
			<tr>
				<td style="border:0;"> <hr style="width:10cm;"> 
					{{$banca->nome}} <br> 
					<b>{{$pessoa::obterEndereco($banca->codpes)['nomtiplgr']}} {{$pessoa::obterEndereco($banca->codpes)['epflgr']}} {{$pessoa::obterEndereco($banca->codpes) ['numlgr']}} {{$pessoa::obterEndereco($banca->codpes)['cpllgr']}} {{$pessoa::obterEndereco($banca->codpes)['nombro']}}
                {{$pessoa::obterEndereco($banca->codpes)['cidloc']}}/{{$pessoa::obterEndereco($banca->codpes)['sglest']}} - {{$pessoa::obterEndereco($banca->codpes)['codendptl']}}</b>
				</td>
			</tr> 
		</table>

	    <center> <b> {{$pessoa::email($banca->codpes)}} </b> </center>
	    <br> <center> <b>RELATÓRIO </center></b> <br> <div class="justificar">  {!! $configs->capes_proap !!} </div> 
	    Banca de: {{$agendamento->nome}} <br><br><br><br><br><br><br>
        <table width="18cm"> 
			<tr>
				<td style="border:0;"> <hr style="width:10cm;"> 
					<center>Assinatura do(a) Coordenador(a)</center>
				</td>
			</tr> 
		</table>

	</div>
@endsection('content')
