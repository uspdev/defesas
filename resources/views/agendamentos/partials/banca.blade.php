<div class="card" style="margin-bottom: 0.5em;">
  <div class="card-header"><b>Banca</b></div>
    <div class="card-body">
      @include('flash')
      <br>
      <table class="table table-striped" style="text-align: center;">
        <theader>
          <tr>
            @can('logado')<th>Nº USP</th>@endcan
            <th>Nome</th>
            <th>Tipo</th>
            <th>Participação</th>
            @can('admin')
                <th>Ofícios titulares</th>
                <th>Invite</th>
                <th>Ofícios suplentes</th>
                <th>Declaração de participação</th>
                <th>Statement of Participation</th>
            @endcan
          </tr>
        </theader>
        <tbody>
        @foreach ($agendamento->banca as $banca)
          <tr>
            @can('logado')<td>{{ $banca['codpesdct'] }}</td>@endcan
            <td>{{ $banca['nompesttd']  ?? 'Professor não cadastrado'}}</td>
            <td>{{ $banca['vinptpbantrb'] === 'SUP' ? 'Suplente' : 'Titular' }}{{ $banca['vinptpbantrb'] === 'PRE' ? ' ( Presidente )' : null }}</td>
            <td>{{ $banca['staptp'] }}</td>
            @can('admin')
              <td>
                  @if(in_array($banca['vinptpbantrb'], ['TIT', 'PRE']))
                  <a href="/agendamentos/{{$agendamento->id}}/{{$banca['codpesdct']}}/titular" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                  @endif
              </td>
              <td>
                  @if(in_array($banca['vinptpbantrb'], ['TIT', 'PRE']))
                  <a href="/agendamentos/{{$agendamento->id}}/{{$banca['codpesdct']}}/invite" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                  @endif
              </td>
              <td>
                  @if($banca['vinptpbantrb'] == 'SUP')
                  <a href="/agendamentos/{{$agendamento->id}}/{{$banca['codpesdct']}}/suplente" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                  @endif
              </td>
              <td>
                  @if($banca['staptp'] == 'S')
                <a href="/agendamentos/{{$agendamento->id}}/{{$banca['codpesdct']}}/declaracao" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                  @endif
              </td>
              <td>
                  @if($banca['staptp'] == 'S')
                <a href="/agendamentos/{{$agendamento->id}}/{{$banca['codpesdct']}}/statement" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                  @endif
              </td>
            @endcan
          </tr>
        @endforeach
        </tbody>
      </table>
    <div>
      <a href="/emails/banca/{{ $agendamento->id }}" id="buscar">Show E-mails</a><br />
      <div id="busca" class="d-none">
        <p>Aguarde...</p>
      </div>
      <div id="email" class="d-none">
        <div class="bg-light mx-4 p-2">
          <span class="font-weight-bold col-sm-2">Titulares:</span>
          <span id="titulares" class="mx-4"></span>
          <button type="button" class="btn btn-outline-secondary btn-sm" name="titulares" data-toogle="tooltip" data-placement="top" title="Copiar p/ área de transferência">Copiar</button>
        </div>
        <div class="bg-light mx-4 p-2">
          <span class="font-weight-bold col-sm-2">Suplentes:</span>
          <span id="suplentes" class="mx-3"></span>
          <button type="button" class="btn btn-outline-secondary btn-sm" name="suplentes" data-toogle="tooltip" data-placement="top" title="Copiar p/ área de transferência">Copiar</button>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>
