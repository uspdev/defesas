<div class="card" style="margin-bottom: 0.5em;">
  <div class="card-header"><b>Arquivos</b></div>
    <div class="card-body">
      @can('admin') @include('agendamentos.files.partials.form') @endcan
      <br><br>
      <table class="table table-striped" style="text-align: center;">
        <theader>
          <tr>
            <th>Nome do Arquivo</th>
            <th>Data de Envio</th>
            <th>Tipo</th>
            <th>Usuário Responsável</th>
            @can('admin')<th>Ações</th>@endcan
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
            @can('admin')
              <td>
                @if($file->status == 0  && $file->user_id_biblioteca == null)
                  <form method="POST" class="form-group" action="/files/{{$file->id}}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                  </form>
                @endif
              </td>
            @endcan
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
