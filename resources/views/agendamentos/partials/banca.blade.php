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
                        <td>{{ $banca['vinptpbantrb'] }}</td>
                        <td>{{ $banca['staptp'] }}</td>
                        @can('admin')
                            <td>
                                @if($banca['vinptpbantrb'] == 'Titular')
                                    <a href="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}/titular" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                                @else
                                    #
                                @endif
                            </td>
                            <td>
                                @if($banca['vinptpbantrb'] == 'TIT')
                                    <a href="/agendamentos/{{$agendamento->id}}/bancas/invite" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                                @else
                                    #
                                @endif
                            </td>
                            <td>
                                @if($banca['vinptpbantrb'] == 'SUP')
                                    <a href="/agendamentos/{{$agendamento->id}}/bancas/suplente" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                                @else
                                    #
                                @endif
                            </td>
                            <td>
                                <a href="/agendamentos/{{$agendamento->id}}/bancas/declaracao" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                            </td>
                            <td>
                                <a href="/agendamentos/{{$agendamento->id}}/bancas/statement" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                            </td>
                        @endcan
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

