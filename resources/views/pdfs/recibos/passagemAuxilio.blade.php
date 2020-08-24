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
    .justificar{text-align: justify;}
    table { background #fff; border-collapse: collapse; }
    tr, td { border: 1px #000 solid; padding: 3 }
    #proap { font-family:Courier; font-size:13px; }
</style>
@endsection('styles_head')

@section('content')
@inject('pessoa','Uspdev\Replicado\Pessoa')

    <h3><center> UNIVERSIDADE DE SÃO PAULO <br>
						FACULDADE DE FILOSOFIA, LETRAS E CIÊNCIAS HUMANAS <br>
						SERVIÇO DE COMPRAS</center> </h3>

    <left> {!! $configs->header_auxilio !!} </left> 
    <left> <u><b>{{$dados->processo}}</b></u> </left> <br> 

    <p> Banca de defesa de <b> {{$agendamento->nome}} </p> 
    <p> Passageiro(a) {{$banca->nome}} </p> 
    <p> Itinerário: {{$dados->itinerario}} </p> 
    <p> Partida: {{$dados->partida}}</p> 
    <p> Retorno: {{$dados->retorno}} </p> 
    <p> Telefone: {$telefone} </p> 
    <p> E-mail:  {{$pessoa::email($banca->codpes)}} </p> 
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
        <br> SPG-FFLCH-USP 
      </b> 
      </p>
    </center>
@endsection('content')
