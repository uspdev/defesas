@extends('pdfs.fflch')

@section('styles_head')
<style>
    body{
        margin-top: 0px; margin-left:3em; font-family: DejaVu Sans, sans-serif; font-size: 12px;
    }
    #headerFFLCH { font-size: 15px; width: 17cm; text-align:center;}
    .data_hoje{ margin-left: 10cm; margin-bottom:0.8cm; }
    .conteudo { margin: 1cm }
    p.recuo {text-indent: 0.5cm;}
    .moremargin {margin-bottom: 0.15cm;}
    .importante {border:2px solid; background-color:#cbcbcb; margin-top:0.3cm; margin-bottom:0.3cm;}
    .negrito {font-weight: bolder;}
    .justificar{text-align: justify; margin-right:2em;}
    #proap { font-family:Courier; font-size:13px; }
</style>
@endsection('styles_head')

@section('header')
  <table id="headerFFLCH" style='width:100%'>
    <tr>
      <td style='width:20%' style='text-align:left;'>
        <img src='images/logo-fflch.png' width='100px'/>
      </td>
      <td style='width:80%'; style='text-align:center;'>
        <p align='center'><b>FACULDADE DE FILOSOFIA, LETRAS E CIÊNCIAS HUMANAS</b>
        <br>Universidade de São Paulo<br>
        Serviço de Compras</p>
      </td>
    </tr>
  </table>
  </br><br>
@endsection('header')

@section('content')
@inject('pessoa','Uspdev\Replicado\Pessoa')
    <left> {!! $configs->header_auxilio !!} </left> 
    <left> <u><b>{{$dados->processo}}</b></u> </left> <br> 

    <p> Banca de defesa de <b> {{$agendamento->nome}} </p> 
    <p> Passageiro(a) {{$agendamento->dadosProfessor($banca->codpes)->nome ?? 'Professor não cadastrado'}} </p> 
    <p> Itinerário: {{$dados->itinerario}} </p> 
    <p> Partida: {{$dados->partida}}</p> 
    <p> Retorno: {{$dados->retorno}} </p> 
    <p> Telefone: {{$agendamento->dadosProfessor($banca->codpes)->telefone ?? ' '}} </p> 
    <p> E-mail: {{$agendamento->dadosProfessor($banca->codpes)->email ?? ' '}}
    </p> 
    <div class="justificar"> {!! $configs->obs_passagem !!} </div>
            
    <p> 
      @php(setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese'))
      São Paulo, {{ strftime('%d de %B de %Y', strtotime('today')) }}
    </p>
    <center> 
      <br>
      <p style="margin-top:3cm;">
      <b> 
        {{Auth::user()->name}} <br>
        {{Auth::user()->codpes}}
        <br> SPG-{{$pessoa::cracha(Auth::user()->codpes)['nomorg']}}-USP 
      </b> 
      </p>
    </center>
@endsection('content')
