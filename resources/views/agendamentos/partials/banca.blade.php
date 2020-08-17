<div class="card">
        <div class="card-header">Banca</div>
        <div class="card-body">
            <a href="/agendamentos/{{ $agendamento->id }}/bancas/create" class="btn btn-success">Inserir Professor</a>
            <br>
            <br>
            <table class="table table-striped" style="text-align: center;">
                <theader>
                    <tr>
                        <th>Nº USP</th>
                        <th>Nome</th>
                        <th>Presidente</th>
                        <th>Tipo</th>
                        <th>Ofícios titulares</th>
                        <th>Ofícios suplentes</th>
                        <th>Declaração de participação</th>
                        <th colspan="2">Ações</th>
                    </tr>
                </theader>
                <tbody>
                @foreach ($agendamento->bancas as $banca)
                    <tr>
                        <td>{{ $banca->codpes }}</td>
                        <td>{{ $pessoa::dump($banca->codpes)['nompes'] }}</td>
                        <td>{{ $banca->presidente }}</td>
                        <td>{{ $banca->tipo }}</td>
                        <td>
                            @if($banca->tipo == 'Titular')
                                <a href="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}/titular" class="btn btn-info"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                            @else
                                #
                            @endif
                        </td>
                        <td>
                            @if($banca->tipo == 'Suplente')
                                <a href="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}/suplente" class="btn btn-info"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                            @else
                                #
                            @endif                    
                        </td>
                        <td>
                            <a href="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}/declaracao" class="btn btn-info"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                        </td>
                        <td>
                            <a href="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}/edit" class="btn btn-warning">Editar</a>
                        </td>
                        <td>
                            <form method="POST" action="/agendamentos/{{ $agendamento->id }}/bancas/{{$banca->id}}">
                                @csrf 
                                @method('delete')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')">Apagar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
 