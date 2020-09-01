<div class="card">
        <div class="card-header"><b>Banca</b></div>
        <div class="card-body form-group">
            <a href="/agendamentos/{{ $agendamento->id }}/bancas/create" class="btn btn-outline-success"><b>Inserir Professor</b></a>
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
                @foreach ($bancas as $banca)
                    <tr>
                        <td>{{ $banca->codpes }}</td>
                        <td>{{ $banca->nome }}</td>
                        <td>{{ $banca->presidente }}</td>
                        <td>{{ $banca->tipo }}</td>
                        <td>
                            @if($banca->tipo == 'Titular')
                                <a href="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}/titular" class="btn btn-outline-info"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                            @else
                                #
                            @endif
                        </td>
                        <td>
                            @if($banca->tipo == 'Suplente')
                                <a href="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}/suplente" class="btn btn-outline-info"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                            @else
                                #
                            @endif                    
                        </td>
                        <td>
                            <a href="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}/declaracao" class="btn btn-outline-info"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                        </td>
                        <td>
                            <a href="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}/edit" class="btn btn-outline-warning"><b>Editar</b></a>
                        </td>
                        <td>
                            <form method="POST" class="form-group" action="/agendamentos/{{ $agendamento->id }}/bancas/{{$banca->id}}">
                                @csrf 
                                @method('delete')
                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><b>Apagar</b></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
 