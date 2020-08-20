@extends('laravel-usp-theme::master')

@section('content')
    @inject('pessoa','Uspdev\Replicado\Pessoa')

    <div class="card">
        <div class="card-header">Recibo de diária para docentes externos</div>
        <div class="card-body">
            <p> <i> Copiar esse dados e colar em corpo de e-mail para: tesourariafflch@usp.br </p> </i> <br>
        
            <h4> <u> Pagamento de Pró-Labore para banca de {{$agendamento->nivel}} </u> </h4>
            <p>Candidato(a): <b> {{$agendamento->nome}} </b> </p>
            <p><b> {{$agendamento->area_programa}} </b> </p>
            <p> Data da defesa:<b> {{$agendamento->data}} </b> </p>
            <br>
            Item(s):
            <p>Prof. Dr. {{$banca->nome}} </p>
            <p>Número USP: {{$banca->codpes}} </p>
            <p>PIS/PASEP:  </p> 
            <br>

            {!! $configs->mail_docente !!}
            
            <a href="/agendamentos/{{$agendamento->id}}" class="btn btn-primary">Voltar</a>
        </div>
    </div>
@endsection('content')