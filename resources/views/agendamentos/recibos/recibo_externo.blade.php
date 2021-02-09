@extends('laravel-usp-theme::master')

@section('content')
    @inject('pessoa','Uspdev\Replicado\Pessoa')

    <div class="card">
        <div class="card-header">Recibo de diária para docentes externos</div>
        <div class="card-body">
            <p><i>Copiar esse dados e colar em corpo de e-mail para: tesourariafflch@usp.br</p></i><br>
            <p><b>Nome:</b> {{$docente->nome}} </p> 
            <p><b>N° USP:</b> {{$docente->n_usp}} </p> 
            <p><b>Origem:</b> {{$dados->origem}} </p> 
            <p><b>Ida:</b> {{$dados->ida}} </p> 
            <p><b>Volta:</b> {{$dados->volta}} </p> 
            <p><b>E-mail:</b> {{$docente->email}}
            </p><br>
            <p>Banca de <b> {{$agendamento->nome_area}} / {{$agendamento->nivel}} </b> </p>
            <p>Do(a) aluno(a) <b> {{$agendamento->nome}} </b> </p>
            @php(setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese'))
            <p><b>Data da defesa:</b> {{strftime("%d de %B de %Y", strtotime($agendamento->data_horario))}} às {{$agendamento->horario}} </p></br></br>
            @if($dados->diaria == "diaria_simples")
            <p><b>Diária Simples:</b> {{$configs->diaria_simples}}</p>  
            @elseif($dados->diaria == "diaria_completa")
            <p><b>Diária Completa:</b> {{$configs->diaria_completa}}</p>
            @elseif($dados->diaria == "duas_diarias")
            <p><b>2 Diárias:</b> {{$configs->duas_diarias}}</p>
            @endif            
            <a href="/agendamentos/{{$agendamento->id}}" class="btn btn-primary">Voltar</a>
            <div class="col-auto float-right">
                <form method="POST" action="/agendamentos/recibo_externo/{{ $agendamento->id }}/{{ $configs->id }}/{{ $docente->id }}">
                    @csrf 
                    <button type="submit" class="btn btn-success" onclick="return confirm('Tem certeza que deseja enviar E-mail?')"> Enviar E-mail </button>
                    <input type="hidden" name="origem" value="{{$dados->origem}}">
                    <input type="hidden" name="ida" value="{{$dados->ida}}">
                    <input type="hidden" name="volta" value="{{$dados->volta}}">
                    <input type="hidden" name="diaria" value="{{$dados->diaria}}">
                </form>
            </div>
        </div>
    </div>
@endsection('content')