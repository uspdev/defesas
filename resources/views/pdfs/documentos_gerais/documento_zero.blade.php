@inject('pessoa','Uspdev\Replicado\Pessoa')

@extends('laravel-fflch-pdf::main')
@section('other_styles')
<style type="text/css">
    body{
        margin-top: 0.2em; font-family: DejaVu Sans, sans-serif; font-size: 12px;
    }
    #footer{
        text-align:center;
    }
</style>
@endsection('other_styles')

@section('content')
  <b>
    <table width="18cm">
      <tr>
        <td width="9cm" > Nome: {{$agendamento->nome}} </td>
        <td> Data da Defesa: {{$agendamento->data}} </td>
      </tr>
      <tr>
        <td> {{$agendamento->nivel}}: {{$agendamento->nome_area}} </td>
        <td> Hora: {{$agendamento->horario}} </td>
      </tr>
      <tr>
        <td> N° USP: {{$agendamento->codpes}}  </td>
        <td> Sala: {{$agendamento->sala}} </td>
      </tr>
    </table>
  </b> 

  <hr style="width: 18.6cm;">
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
      <hr style="width: 18.6cm;">
      <p> 
        <u> PASSAGENS, HOTEL E DIÁRIAS: <u>
      </p> 
    </b> 
  
  @foreach($professores as $professor)
    <table style="border: 1px solid black; border-spacing: 5px; width: 18.6cm;">
      <tr> 
        <td>
          Prof: <b> {{$agendamento->dadosProfessor($professor->codpes)->nome ?? 'Professor não cadastrado'}}  </b>
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
  <p class="page-break"></p> 
@endsection('content')

@section('footer')
    {!! $configs->rodape_oficios !!}
@endsection('footer')