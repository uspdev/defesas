@extends('pdfs.fflch')
@inject('pessoa','Uspdev\Replicado\Pessoa')

@section('styles_head')
<style type="text/css">
    #headerFFLCH {
        font-size: 14px; width: 17cm; text-align:center; font-weight:bold; font-style:italic;
    }
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
        text-indent: 0.5cm;
    }
    .moremargin {
        margin-bottom: 0.15cm;
    }
    .importante {
        border:1px solid; margin-top:0.3cm; margin-bottom:0.3cm; width: 15cm; font-size:12px; margin-left:0.5cm;
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
        margin-top: -2.1cm; margin-bottom: -2.1cm; font-family: DejaVu Sans, sans-serif; font-size: 12px;
    }
    #footer {
        position: fixed;
        bottom: -1cm;
        left: 0px;
        right: 0px;
        text-align: center;
        border-top: 1px solid gray;
        width: 18.5cm;
        height: 100px;
    }
    .page-break {
        page-break-after: always;
        margin-top:160px;
    }
</style>
@endsection('styles_head')

@section('content')
    <br><br><br>
    @foreach($professores as $professor)
        <div id="headerFFLCH" style="text-align:center;">
            <table>
                <tr>
                    <br>
                    <td width="2cm"> <img src="images/fflch.gif" width="95%"/> </td> 
                    <td width="14cm"> 
                        <p align="center" style="font-style:normal; font-size:17px"> 
                            Universidade de São Paulo<br> 
                            Faculdade de Filosofia, Letras e Ciências Humanas<br>
                        </p>
                    </td>
                </tr>
            </table>
        </div>

        <div align="right">
            São Paulo, {{Carbon\Carbon::now()->formatLocalized('%d de %B de %Y')}}
        </div><br><br>

        <div class="moremargin">Assunto: Banca Examinadora de <b>{{$agendamento->nivel}}</b></div> 
        <div class="moremargin">Candidato(a): <b>{{$pessoa::dump($agendamento->codpes)['nompes']}}</b> </div>
        <div class="moremargin">Área: <b>{{$agendamento->area_programa}}</b> </div>
        <div class="moremargin">Orientador(a) Prof(a). Dr(a). {{$pessoa::dump($agendamento->orientador)['nompes']}}</div>
        <div class="moremargin">Título do Trabalho: <i>{{$agendamento->titulo}} </i></div>
        <div class="importante" align="center">
            {!! $configs->importante_oficio !!}
        </div>
        <p> 
            <i>Data e hora da defesa:  </i> <b> {{$agendamento->data}} {{$agendamento->hora}} </b> <br> 
            <i>Local:</i> <b> {{$agendamento->sala}} </b> - Administração da FFLCH 
        </p>  
        <i>Composição da banca examinadora:</i> 


        <table width="16cm" style="border='0'; margin-left:4cm; align-items: center; justify-content: center;">
            @foreach($bancas as $banca)    
            <tr style="border='0'">
                <td> {{$pessoa::dump($banca->codpes)['nompes']}} </td> 
                <td> {{$pessoa::cracha($banca->codpes)['nomorg']}}	</td>
            </tr>
            @endforeach
        </table>

        <br>
        <div class="importante" align="center">
            {!! $configs->regimento !!}
        </div>
        <p align="center">
            Atenciosamente, 
			<br> <b> 
			{{Auth::user()->name}} - Defesas de Mestrado e Doutorado da FFLCH /USP 
			</b>
        </p><br><br> 
        Ilmo(a). Sr(a). {{$pessoa::dump($professor->codpes)['nompes']}}<br>
        {{$pessoa::obterEndereco($professor->codpes)['nomtiplgr']}} {{$pessoa::obterEndereco($professor->codpes)['epflgr']}} {{$pessoa::obterEndereco($professor->codpes)['numlgr']}} {{$pessoa::obterEndereco($professor->codpes)['cpllgr']}} {{$pessoa::obterEndereco($professor->codpes)['nombro']}} 
        CEP: {{$pessoa::obterEndereco($professor->codpes)['codendptl']}}
        <br>  {{$pessoa::obterEndereco($professor->codpes)['cidloc']}}
        - {{$pessoa::obterEndereco($professor->codpes)['sglest']}}
        <br> telefone: 
        <br>e-mail: {{$pessoa::emailusp($professor->codpes)}}

        <div id="footer">
            {!! $configs->rodape_oficios !!}
        </div>
        <p style="page-break-before: always">&nbsp;</p>
    @endforeach
@endsection('content')
