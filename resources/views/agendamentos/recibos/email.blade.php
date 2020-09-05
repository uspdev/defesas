@extends('laravel-usp-theme::master')

@section('content')
    @inject('pessoa','Uspdev\Replicado\Pessoa')
    @inject('replicado','App\Utils\ReplicadoUtils')

    <div class="card">
        <div class="card-header">Recibo de diária para docentes externos</div>
        <div class="card-body">
            <p> <i> Copiar esse dados e colar em corpo de e-mail para: tesourariafflch@usp.br </p> </i> <br>
        
            <h4> <u> Pagamento de Pró-Labore para banca de {{$agendamento->nivel}} </u> </h4>
            <p>Candidato(a): <b> {{$agendamento->nome}} </b> </p>
            <p>Programa: <b>{{$agendamento->nome_area}}</b> </p>
            @php(setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese'))
            <p> Data da defesa:<b> {{strftime("%d de %B de %Y", strtotime($agendamento->data_horario))}} às {{$agendamento->horario}} </b> </p>
            <br>
            Item(s):
            <p>Prof. Dr. {{$docente->nome}} </p>
            <p>Número USP: {{$docente->n_usp}} </p>
            <p>PIS/PASEP: {{$docente->pis_pasep}} </p> 
            <br>

            {!! $configs->mail_docente !!}
            
            <a href="/agendamentos/{{$agendamento->id}}" class="btn btn-primary">Voltar</a>
        </div>
    </div>
@endsection('content')