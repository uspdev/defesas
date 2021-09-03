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
            <p>Programa: <b>{{$agendamento->nome_area}}</b> / <b>Departamento de {{$replicado->departamentoPrograma($agendamento->orientador)['nomset']}} </b> </p>
            @php(setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese'))
            <p> Data da defesa:<b> {{strftime("%d de %B de %Y", strtotime($agendamento->data_horario))}} às {{$agendamento->horario}} </b> </p>
            <br>
            Item(s):
            <p>Prof. Dr. {{$docente->nome}} - Número USP: {{$docente->n_usp}} - PIS/PASEP: {{$docente->pis_pasep}} - CPF: {{$docente->cpf}}</p>
            <p>Banco: {{$docente->banco}} - Agência: {{$docente->agencia}} - Conta: {{$docente->conta}} </p>
            <br>
            <div class="col-auto float-right">
                <form method="POST" action="/agendamentos/pro_labore/{{ $agendamento->id }}/{{ $docente->id }}">
                    @csrf 
                    <button type="submit" class="btn btn-success" onclick="return confirm('Tem certeza que deseja enviar para E-mail?')"> Enviar E-mail </button>
                </form>
            </div>
            <br><br>
            {!! $configs->mail_docente !!}
            
            <a href="/agendamentos/{{$agendamento->id}}" class="btn btn-primary">Voltar</a>
            
        </div>
    </div>
@endsection('content')