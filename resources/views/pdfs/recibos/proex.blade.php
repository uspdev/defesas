@extends('pdfs.fflch')

@section('styles_head')
<style type="text/css">
  body {padding:0px; margin-left:10px; font-size: 12px; font-family: Impact, Charcoal, sans-serif;}
  .negrito {font-weight: bolder;}
  .justificar{text-align: justify;}
  table { background #fff;  border: none; margin:4px; }
  tr, td { border: none; padding: 4 }
  .nome {text-align:center; font-size:7px; padding:0px; }
  .assinatura{border-bottom:1px solid;}
</style>
@endsection('styles_head')

@section('header')
  <table width="18cm" class="negrito" cellspacing="0" cellpadding="0">
    <tr>
      <td width="1.5cm" height="1.5cm"> <img width="80px" height="60px" src="images/capes.jpg" style="float:left;"> </td>
      <td width="9.5cm">
        <span style="font-size: 10px;">
          <center>CAPES - COORDENAÇÃO DE APERFEIÇOAMENTO DE PESSOAL DE NÍVEL SUPERIOR </center>
        </span>
      </td>
      <td> <span style="font-size: 7px;">PROJETO N° <br><br><br><br> </span> </td>
    </tr>
  </table>
@endsection('header')

@section('content')
  <br>
  <table width="18cm" cellspacing="0" cellpadding="0">
    <tr>
      <td height="0.4cm" style="background-color:gray; padding:0px;">
        <center> RECIBO </center>
      </td>
    </tr>
    <tr>
      <td>
      @php(setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese'))
      <div class="justificar">	Recebi da Fundação CAPES / <b>{{ $coordenador }}</b> a importância de <b>{{ $dados->importancia }}</b>, em caráter eventual e sem vínculo empregatício, a título de DIÁRIAS(S), no período de <b>{{$dados->periodo}}</b> pela participação na banca examinadora de <b>{{$agendamento->nivpgm}}</b> de <b>{{$agendamento->aluno}}</b>, no dia <b>{{strftime("%d de %B de %Y", strtotime($agendamento->data_horario))}}.</b></div>
        <table width="15cm" cellspacing="0" cellpadding="0">
          <tr >
            <td ><b>Deduções(*)  </td>
            <td > VALOR DA REMUNERAÇÃO <br> {{ $dados->outro_tipo }} <br> Líquido recebido</td>
            <td > {{ $dados->valor }} <br> {{ $dados->outro_valor }} <br> {{ $dados->liquido }} </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <p style="font-size: 9px;">(*) Não se aplica a diárias e sim a serviços prestados por pessoa física quando essa não possui talonários de Nota Fiscal de Serviços. Só aplicar deduções (INSS,ISS etc.), quando for o caso. </p>
      </td>
    </tr>
  </table>
  <table width="18cm" cellspacing="0" cellpadding="0">
    <tr>
      <td height="0.4cm" style="background-color:gray; padding:0px;" colspan="2">
        <center> IDENTIFICAÇÃO DO PRESTADOR DE SERVIÇO </center>
      </td>
    </tr>
    <tr>
      <td> Nome: {{ $docente['nompesttd'] ?? 'Professor não cadastrado'}}	</td>
      <td> CPF: {{ $docente['documentos']['numcpf'] }} </td>
    </tr>
    <tr>
      <td> Profissão: <br> PROFESSOR DOUTOR	</td>
      <td> RG/Passaporte(se estrangeiro):<br> {{ $docente['documentos']['numdocidf'] }} </td>
    </tr>
    <tr>
      <td colspan="2"> Endereço Completo: <br>
        @if ( $docente['tipvin'] == 'SERVIDOR' )
          Depto. de {{ $docente['setor']['nomset'] }}<br />
        @else
          {{ $docente['nomtiplgr'] . ' ' . $docente['epflgr'] . ' ' .  $docente['numlgr'] . ' ' . $docente['cpllgr'] }}, {{ $docente['nombro'] }} <br>
        CEP: {{ $docente['codendptl'] }} - {{ $docente['cidloc'] }}/{{ $docente['sglest'] }}
        @endif
      </td>
    </tr>
  </table>
  <br>
  <table width="18cm" cellspacing="0" cellpadding="0">
    <tr>
      <td height="0.4cm" style="background-color:gray; padding:0px;" colspan="2">
        <center> TESTEMUNHAS (na falta dos dados de identificação do prestador de serviço) </center>
      </td>
    </tr>
    <tr>
      <td width="12cm"> (1)Nome:	</td>
      <td> CPF: </td>
    </tr>
    <tr>
      <td> Profissão: 	</td>
      <td> RG: </td>
    </tr>
    <tr>
      <td width="10cm"> Endereço Completo: </td>
      <td> Assinatura: </td>
    </tr>
    <tr>
      <td width="12cm"> (2)Nome:	</td>
      <td> CPF: </td>
    </tr>
    <tr>
      <td> Profissão: 	</td>
      <td> RG: </td>
    </tr>
    <tr>
      <td width="10cm"> Endereço Completo: </td>
      <td> Assinatura: </td>
    </tr>
  </table>
  <br>

  <table width="18cm" cellspacing="0" cellpadding="0">
    <tr>
      <td height="0.4cm" style="background-color:gray; padding:0px;" colspan="2">
        <center> ASSINATURA BENEFICIÁRIO/PRESTADOR DO SERVIÇO </center>
      </td>
    </tr>
    <tr style="font-size:10px;">
      <td width="8.5cm"> Atesto que os serviços constantes do presente recibo foram prestados. <br><br> Em ___/___/___.</td>
      <td> Por ser verdade, firmo o presente recibo. <br> <br> <p style="text-align:right;"> São Paulo, {{strftime("%d de %B de %Y", strtotime($agendamento->data_horario))}} </p> <br><br></td>
    </tr>
    <tr>
      <td>  <b> <center>{{ $coordenador }}</b> </center>	</td>
      <td> <b> <center>{{ $docente['nompesttd'] ?? 'Professor não cadastrado'}}</b> </center> </td>
    </tr>
  </table>
    <p style="font-size: 9px;"> <b>ATENÇÃO:</b> Utilizar esse modelo quando ocorrer pagamento de diárias ou remuneração de serviço a pessoas físicas que não possuam talonários de Notas Fiscais de Serviços (<b> Outros Serviços de Terceiros - Pessoas Físicas </b>) </p>
@endsection('content')
