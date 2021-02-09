@inject('replicado','App\Utils\ReplicadoUtils')

<p>Candidato(a): <b> {{$agendamento->nome}} </b> </p>
<p>Programa: <b>{{$agendamento->nome_area}}</b> / <b>Departamento de {{$replicado->departamentoPrograma($agendamento->orientador)['nomset']}} </b> </p>
@php(setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese'))
<p> Data da defesa:<b> {{strftime("%d de %B de %Y", strtotime($agendamento->data_horario))}} às {{$agendamento->horario}} </b> </p>
<br>
Item(s):
<p>Prof. Dr. {{$docente->nome}} </p>
<p>Número USP: {{$docente->n_usp}} </p>
<p>PIS/PASEP: {{$docente->pis_pasep}} </p> 
<br>