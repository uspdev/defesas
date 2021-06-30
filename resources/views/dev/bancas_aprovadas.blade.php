@extends('laravel-usp-theme::master')

@section('content')


<div class="container-fluid">

<div class="panel panel-primary">
<div class="panel-body">



<table class="table table-bordered table-striped table-hover datatable">
<thead>
    <tr>
        <th>NÚMERO USP</th>

        <th>NOME</th>
        
        <th>AGENDAMENTO</th>

        <th></th>
    
    </tr>
    @foreach($bancas_aprovadas as $aluno)
        
        {{ csrf_field() }}

            <tr>
            <form action="{{ '/dev/codpes/'.$aluno['codpes'] }}" method="POST" class="form-horizontal">
                <td>{{ $aluno['codpes'] }}</td>

                <td>{{ $aluno['nompes'] }}</td>
                
                @if(\App\Models\Agendamento::where('codpes', $aluno['codpes'])->first() )
                    <td>{{ (new Datetime(\App\Models\Agendamento::where('codpes', $aluno['codpes'])->first()->data_horario))->format('d/m/Y') }}</td>
                @else
                    <td></td>
                @endif

                <td><button class="btn btn-outline-dark">Importar do Janus</button></td>
            </form>
            </tr>
    @endforeach
</thead>
<tbody><tr></tr></tbody>
</table>

</div>


@endsection('content')

@section('flash')
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
            <a href="#" class="close" data-dismiss="alert" aria-label="fechar">&times;</a>
        </p>
        @endif
    @endforeach
    </div>
@endsection



