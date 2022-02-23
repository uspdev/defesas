    <div class="card" style="margin-bottom: 0.5em;">
        <div class="card-header"><b>Arquivos</b></div>
        <div class="card-body">
            @include('agendamentos.files.partials.form')
            <br>
            <br>
            <table class="table table-striped" style="text-align: center;">
                <theader>
                    <tr>
                        <th>Nome do Arquivo</th>
                        <th>Data de Envio</th>
                        <th>Tipo</th>
                        <th>Usuário Responsável</th>
                        <th>Status</th>
                        <th>Data da Publicação</th>
                        <th>URL</th>
                        <th>Responsável Biblioteca</th>
                        <th colspan='2'>Ações</th>
                    </tr>
                </theader>
                <tbody>
                @foreach ($agendamento->files as $file)
                    <tr>
                        <td><a href="/files/{{$file->id}}">{{ $file->original_name }}</a></td>
                        <td>
                            {{ Carbon\Carbon::parse($file->created_at)->format('d/m/Y') }}
                        </td>
                        <td>{{$file->tipo}}</td>
                        <td>{{$file->nomeUsuario($file->user_id_admin)}}</td>
                        <td>{{ $file->status ? 'Publicado' : 'Não Publicado' }}</td>
                        
                        @if($file->status == 1)
                            <td>
                                {{ Carbon\Carbon::parse($file->updated_at)->format('d/m/Y') }}
                            </td>
                            <td>
                                <a href="{{$file->url}}">Link</a>
                            </td>
                            <td>{{$file->nomeUsuario($file->user_id_biblioteca)}}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                        <td>
                            @if($file->status == 0  && $file->user_id_biblioteca == null)
                                <form method="POST" class="form-group" action="/files/{{$file->id}}">
                                    @csrf 
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            @endif
                        </td>
                        <td>
                        @can('biblioteca')
                            <a href="/files/{{$file->id}}/edit" class="btn btn-primary"><i class="fas fa-file-export"></i></a>
                        @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
 
 