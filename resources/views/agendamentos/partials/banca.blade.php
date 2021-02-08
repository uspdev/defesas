    <div class="card">
        <div class="card-header"><b>Banca</b></div>
        <div class="card-body">
            @can('admin')
                @include('agendamentos.bancas.partials.form')
            @endcan
            <br><br>
            <table class="table table-striped" style="text-align: center;">
                <theader>
                    <tr>
                        <th>Nº USP</th>
                        <th>Nome</th>
                        <th>Presidente</th>
                        <th>Tipo</th>
                        @can('admin')
                            <th>Ofícios titulares</th>
                            <th>Ofícios suplentes</th>
                            <th>Declaração de participação</th>
                            <th colspan="2">Ações</th>
                        @endcan
                    </tr>
                </theader>
                <tbody>
                @foreach ($agendamento->bancas as $banca)
                    <tr>
                        <td>{{ $banca->codpes }}</td>
                        <td>{{ $agendamento->dadosProfessor($banca->codpes)->nome  ?? 'Professor não cadastrado'}}</td>
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
 