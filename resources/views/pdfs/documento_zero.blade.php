@extends('pdfs.fflch')

@section('styles_head')
<style>
  /**
  @page { margin: 100px 100px 25px 25px; }
  header { position: fixed; top: -60px; left: 0px; right: 0px; height: 100px; }
  footer { position: fixed; bottom: -60px; left: 0px; right: 0px; height: 50px; }
  .page-break {
      page-break-after: always;
      margin-top:160px;
  }
  p:last-child { page-break-after: never; }
  .content {
      margin-top:160px;
  }
  **/
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
  p:last-child {
    page-break-after: never; 
  }
  .content {
    margin-top:0px;
  }
</style>
@endsection('styles_head')

@section('header')
  <table style='width:100%'>
    <tr>
      <td style='width:20%' style='text-align:left;'>
        <img src='https://www.fflch.usp.br/themes/contrib/aegan-subtheme/images/logo.png' width='230px'/>
      </td>
      <td style='width:80%'; style='text-align:center;'>
        <p align='center'><b>FACULDADE DE FILOSOFIA, LETRAS E CIÊNCIAS HUMANAS</b>
        <br>Universidade de São Paulo<br>
        Serviço de Pós-Graduação</p>
      </td>
    </tr>
  </table>
  <hr>
@endsection('header')

@section('content')
  @inject('pessoa','Uspdev\Replicado\Pessoa')

  <b>
    <table width="18cm">
      <tr>
        <td width="9cm" > Nome: {{$pessoa::dump($agendamento->codpes)['nompes']}} </td>
        <td> Data da Defesa: {{$agendamento->data}} </td>
      </tr>
      <tr>
        <td> {{$agendamento->nivel}}: {{$agendamento->area_programa}} </td>
        <td> Hora: {{$agendamento->horario}} </td>
      </tr>
      <tr>
        <td> N° USP: {{$agendamento->codpes}}  </td>
        <td> Sala: {{$agendamento->sala}} </td>
      </tr>
    </table>
  </b> 

  <hr>
    <b>
      <table>
        <tr> 
          <td> 2 PRÉ-RELATÓRIOS </td> 
          <td>  (&nbsp;&nbsp; ) </td> 
        </tr>
        <tr> 
          <td>ENVIO IMPRESSO ___/____   </td> 
          <td>  (&nbsp;&nbsp; )  </td> 
        </tr>
        <tr> 
          <td>  ENVIO PDF ___/____ </td> 
          <td>  (&nbsp;&nbsp; ) </td> 
        </tr>
        <tr> 
          <td>  SITE    </td> 
          <td>  (&nbsp;&nbsp; )  </td> 
        </tr>
        <tr> 
          <td>  PRÓ-LABORE </td> 
          <td>  (&nbsp;&nbsp; ) </td> 
        </tr>
      </table>
      <hr>
      <p> 
        <u> PASSAGENS, HOTEL E DIÁRIAS: <u>
      </p> 
    </b> 
  
  @foreach($professores as $professor)
    <table style="border: 1px solid black; border-spacing: 5px; width: 18cm;">
      <tr> 
        <td>
          Prof: <b> {{$pessoa::dump($professor->codpes)['nompes']}}  </b>
        </td>
      </tr>
      <tr> 
        <td>
          PASSAGEM: __cidade__/__estado__ (_____)/_______ Ida: ___/___ Hora: ____ Volta: ____/____ Hora: _____
        </td>
      </tr>
      <tr>
        <td>
          Cotação:___/___ Compra:___/___
        </td>
      </tr>
      <tr>
        <td>
          HOTEL:___________ Reserva em:___/___ Reserva ok? (  ) CheckIn: _______ CheckOut_______
        </td>
      </tr>
      <tr>
        <td>
          Diárias: 1/2 (  ) 1 (  ) 2 (  ) Pedido ok ( )
        </td>
      </tr>
      <tr>
        <td>
          Cadastro no Usetaxi ok? (   )
        </td>
      </tr>
      <tr>
        <td>
          Skype? Sim(  )  Não (  )
        </td>
      </tr>
      <tr>
        <td>
          Videoconferência? Sim(  )  Não (  )
        </td>
      </tr>
    </table> 
    <br/>
  @endforeach
  <div id="footer">
    {!! $configs->rodape_oficios !!}
  </div>
  <p style="page-break-before: always">&nbsp;</p>
@endsection('content')
