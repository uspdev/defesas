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
    .obs{
        height: 120px;
    }
</style>
@endsection('other_styles')

@section('content')
  <b>
    <table width="18cm">
      <tr>
        <td width="9cm" > Nome: {{$agendamento->nome}} </td>
        <td> Data da Defesa: {{date('d/m/Y', strtotime($agendamento->data_horario))}} </td>
      </tr>
      <tr>
        <td> {{$agendamento->nivel}}: {{$agendamento->nome_area}} </td>
        <td> Hora: {{date('H:i', strtotime($agendamento->data_horario))}} </td>
      </tr>
      <tr>
        <td> N° USP: {{$agendamento->codpes}}  </td>
        <td> Sala: {{$agendamento->sala}} </td>
      </tr>
    </table>
  </b>

  <hr style="width: 18.6cm;">
  <div class="obs"></div>
      <hr style="width: 18.6cm;">
    </b>

  @foreach($professores as $professor)
      @if($agendamento->dadosProfessor($professor->codpes)->docente_usp == 'nao')
          <table style="border: 1px solid black; border-spacing: 5px; width: 18.6cm;">
            <tr>
              <td>
                Prof: <b> {{$agendamento->dadosProfessor($professor->codpes)->nome ?? 'Professor não cadastrado'}}  </b>
              </td>
            </tr>
            <tr>
              <td>
                PASSAGEM: {{$agendamento->dadosProfessor($professor->codpes)->cidade ?? ''}}/
                {{$agendamento->dadosProfessor($professor->codpes)->estado ?? ''}}
              </td>
            </tr>
            <tr>
              <td>
                Ida: __________/______________ Hora: ______________ Volta: __________/______________ Hora: ______________
              </td>
            </tr>
            <tr>
              <td>
                Cotação: __________/______________ Compra: __________/______________
              </td>
            </tr>
            </tr>
            <tr>
              <td>
                Diárias: 1/2 (  ) 1 (  ) 2 (  ) Pedido ok (  )
              </td>
            </tr>
            <tr>
              <td>
                Cadastro no taxi ok? (  )
              </td>
            </tr>
          </table>
          <br/>
      @endif
  @endforeach
  <p class="page-break"></p>
@endsection('content')

@section('footer')
    {!! $configs->rodape_oficios !!}
@endsection('footer')
