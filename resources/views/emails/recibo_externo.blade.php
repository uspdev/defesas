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