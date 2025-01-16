    <div class="card" style="margin-bottom: 0.5em;">
        <div class="card-header"><b>Banca</b></div>
        <div class="card-body">
            @include('flash')
            @can('admin')
                @include('agendamentos.bancas.partials.form')
            @endcan
            <br><br>
            <table class="table table-striped" style="text-align: center;">
                <theader>
                    <tr>
                        @can('logado')<th>Nº USP</th>@endcan
                        <th>Nome</th>
                        <th>Presidente</th>
                        <th>Tipo</th>
                        @can('admin')
                            <th>Ofícios titulares</th>
                            <th>Invite</th>
                            <th>Ofícios suplentes</th>
                            <th>Declaração de participação</th>
                            <th>Statement of Participation</th>
                            <th colspan="2">Ações</th>
                        @endcan
                    </tr>
                </theader>
                <tbody>
                @foreach ($agendamento->bancas as $banca)
                    <tr>
                        @can('logado')<td>{{ $banca->codpes }}</td>@endcan
                        <td>{{ $agendamento->dadosProfessor($banca->codpes)['nompes'] }}</td>
                        <td>{{ $banca->presidente }}</td>
                        <td>{{ $banca->tipo }}</td>
                        @can('admin')
                            <td>
                                @if($banca->tipo == 'Titular')
                                    <a href="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}/titular" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                                @else
                                    #
                                @endif
                            </td>
                            <td>
                                @if($banca->tipo == 'Titular')
                                    <a href="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}/invite" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                                @else
                                    #
                                @endif
                            </td>
                            <td>
                                @if($banca->tipo == 'Suplente')
                                    <a href="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}/suplente" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                                @else
                                    #
                                @endif                    
                            </td>
                            <td>
                                <a href="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}/declaracao" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                            </td>
                            <td>
                                <a href="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}/statement" class="btn btn-info"><i class="fas fa-file-pdf"></i></a>
                            </td>
                            <td>
                                <form method="POST" class="form-group" action="/bancas/{{$banca->id}}">
                                    @csrf 
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        @endcan
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
 