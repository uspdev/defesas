@extends('laravel-usp-theme::master')

@section('content')
    @inject('replicado','App\Utils\ReplicadoUtils')

    <div class="card">
        <div class="card-header">Recibo de diária para docentes externos</div>
        <div class="card-body">
            <p> <i> Copiar esse dados e colar em corpo de e-mail para: tesourariafflch@usp.br </p> </i> <br>

            <h4> <u> Pagamento de Pró-Labore para banca de {{ $agendamento->nivel }} </u> </h4>
            <p>Candidato(a): <b> {{$agendamento->nome}} </b> </p>
            <p>Programa: <b>{{ $agendamento->area['nomare'] }}</b> / <b>Departamento de {{ $agendamento->orientador['nomset'] }} </b> </p>
            @php(setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese'))
            <p> Data da defesa:<b> {{strftime("%d de %B de %Y", strtotime($agendamento->data_horario))}} às {{date('H:i',strtotime($agendamento->data_horario))}} </b> </p>
            <br>
            Item(s):
            <p>Prof. Dr. {{ $docente['nompesttd'] }} - Número USP: {{ $docente['codpesdct'] }} - PIS/PASEP: {{ $docente['documentos']['numpispsp'] }} - CPF: {{ $docente['documentos']['numcpf'] }}</p>
            <p>Banco: {{ $docente['banco'] ?? '' }} - Agência: {{ $docente['agencia'] ?? '' }} - Conta: {{ $docente['c_corrente'] ?? '' }} </p>
            <br>
            <hr />
<!-- a pedido do usuario. serve somente para copiar  -->
            <h4>Dados pessoais:</h4>
            <p><i>Campo somente para copiar</i></p>
            <p><b>Nome completo:</b>_______________________________________________________</p>
            <p><b>Data de nascimento:</b>_______/_______/__________</p>
            <p><b>CPF:</b>_______________________________________</p>
            <p><b>Telefone celular:</b>__________________________</p>
            <div class="col-auto float-right">
                <form method="POST" action="/agendamentos/pro_labore/{{ $agendamento->id }}/{{ $docente['codpesdct'] }}">
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
