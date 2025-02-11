
<div class="card" style="margin-bottom: 0.5em;">
    <div class="card-header"><b>Recibo de diária para docentes externos</b></div>
    <table class="table table-striped" style="text-align:center;">
        <thead class="thead-light">
            <tr>
                <th scope="col">Docente</th>
                <th scope="col">Ida</th>
                <th scope="col">Volta</th>		
                <th scope="col">Origem</th>
                <th scope="col">Diária</th>
                <th scope="col"></th> 
            </tr>
        </thead>
        <tbody>
            @foreach($agendamento->bancas as $banca)
                <tr>
                    <form action="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}/recibos/exibir_recibo_externo" class="form-group" method="POST">
                        @csrf
                        <td>{{$agendamento->dadosProfessor($banca->codpes)->nome ?? 'Professor não cadastrado'}}</td>
                        <td> <input type="text" class="datepicker form-control" size="7" autocomplete="off" name="ida"> </td>
                        <td> <input type="text" class="datepicker form-control" size="7" autocomplete="off" name="volta"> </td>
                        <td> <input type="text" class="form-control" size="7" name="origem"> </td>
                        <td> 	
                            <select name="diaria" class="form-control"> 
                                <option value="diaria_simples" selected="selected"> Simples </option>
                                <option value="diaria_completa"> Completa </option>
                                <option value="duas_diarias"> 2 diárias </option>
                            </select>
                        </td>
                        <td> <button type="submit" class="btn btn-primary" @if($agendamento->dadosProfessor($banca->codpes) == null) disabled @endif><b>Visualizar E-mail</b></button></td>
                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="card" style="margin-bottom: 0.5em;">
    <div class="card-header"><b>PROEX</b></div>
        <table class="table table-striped" style="text-align:center;">
            <thead class="thead-light">
                <tr>
                    <th>Docente</th>
                    <th>Importância recebida</th>
                    <th>Período</th>	
                    <th>Valor remuneração</th>	
                    <th colspan="2">Outros</th>	
                    <th>Líquido</th>
                    <th></th> 
                </tr>
            </thead>
            <tbody>
                @foreach($agendamento->bancas as $banca)
                    <tr>
                        <form class="form-group" action="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}/proex" method="POST">
                            @csrf
                            <td> {{$agendamento->dadosProfessor($banca->codpes)->nome ?? 'Professor não cadastrado'}} </td>
                            <td><input type="text" class="form-control" size="4" name="importancia"></td>
                            <td><input type="text" class="form-control" size="4" name="periodo"></td>
                            <td><input type="text" class="form-control" size="4" name="valor"></td>
                            <td><input type="text" class="form-control" size="4" name="outro_tipo" placeholder="Tipo"></td>
                            <td><input type="text" class="form-control" size="4" name="outro_valor" placeholder="Valor"></td>
                            <td><input type="text" class="form-control" size="4" name="liquido"></td>
                            <td><button type="submit" class="btn btn-primary" @if($agendamento->dadosProfessor($banca->codpes) == null) disabled @endif><b>Gerar Documento</b></button></td>
                        </form>
                    </tr>
                @endforeach
            </tbody>	
        </table>
    </form>
</div>
<div class="card" style="margin-bottom: 0.5em;">
    <div class="card-header"><b>Recibo de diárias - PROAP</b></div>
        <table class="table table-striped" style="text-align:center;">
            <thead class="thead-light">
                <tr>
                    <th>Docente</th>
                    <th>Ano PROAP</th>
                    <th>N. Diárias</th>	
                    <th>Origem </th>
                    <th>Chegada</th>	
                    <th>Saída</th>
                    <th>Valor</th>
                    <th>Valor por extenso </th>	
                    <th></th> 
                </tr>
            </thead>
            <tbody>
                @foreach($agendamento->bancas as $banca)
                    <tr>
                        <form action="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}/proap" class="form-group" method="POST">
                            @csrf
                            <td>{{$agendamento->dadosProfessor($banca->codpes)->nome ?? 'Professor não cadastrado'}}</td>
                            <td><input type="text" class="form-control" size="1" name="ano"></td>
                            <td><input type="text" class="form-control" size="1" name="diaria_proap"></td>
                            <td><input type="text" class="form-control" size="6" name="origem"></td>
                            <td><input type="text" class="form-control datepicker" size="6" name="chegada"></td>
                            <td><input type="text" class="form-control datepicker" size="6" name="saida"></td>
                            <td><input type="text" class="form-control" size="2" name="valor_proap"></td>
                            <td><input type="text" class="form-control" size="5" name="extenso"></td>
                            <td><button type="submit" size="4" class="btn btn-primary" @if($agendamento->dadosProfessor($banca->codpes) == null) disabled @endif><b>Gerar Documento</b></button></td>
                        </form>
                    </tr>
                @endforeach
            </tbody>	
        </table>
    </form>
</div>
<div class="card" style="margin-bottom: 0.5em;">
    <div class="card-header"><b>Requisição de passagem aérea</b></div>
        <table class="table table-striped" style="text-align:center;">
            <thead class="thead-light">
                <tr>
                    <th>Docente</th>
                    <th>Ida (dia - horário) </th>
                    <th>Volta (dia - horário)</th>		
                    <th>Trajeto</th>
                    <th>Nº. da Requisição</th>
                    <th></th> 
                </tr>
            </thead>
            <tbody>
                @foreach($agendamento->bancas as $banca)
                    <tr>
                        <form action="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}/passagem" class="form-group" method="POST">
                            @csrf
                            <td>{{$agendamento->dadosProfessor($banca->codpes)->nome ?? 'Professor não cadastrado'}}</td>
                            <td><input  type="text" class="form-control" size="6" name="ida"></td>
                            <td><input type="text" class="form-control" size="6" name="volta"></td>
                            <td><input  type="text" class="form-control" size="6" name="trajeto"></td>
                            <td><input type="text" class="form-control" size="6" name="requisicao"></td>
                            <td><button type="submit" size="4" class="btn btn-primary" @if($agendamento->dadosProfessor($banca->codpes) == null) disabled @endif><b>Gerar documento</b></button></td>
                        </form>
                    </tr>
                @endforeach
            </tbody>	
        </table>
    </form>
</div>
<div class="card" style="margin-bottom: 0.5em;">
<div class="card-header"><b>Passagem aérea - Compra via auxílio</b></div>
        <table class="table table-striped" style="text-align:center;">
            <thead class="thead-light">
                <tr>
                    <th>Docente</th>
                    <th>Partida</th>
                    <th>Retorno</th>		
                    <th>Itinerário</th>
                    <th>Processo/Pregão</th>
                    <th></th> 
                </tr>
            </thead>
            <tbody>
                @foreach($agendamento->bancas as $banca)
                    <tr>
                        <form action="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}/auxilio_passagem" class="form-group" method="POST">
                            @csrf
                            <td>{{$agendamento->dadosProfessor($banca->codpes)->nome ?? 'Professor não cadastrado'}}</td>
                            <td><input  type="text" size="6" class="form-control datepicker" name="partida"></td>
                            <td><input  type="text" size="6" class="form-control datepicker" name="retorno"></td>
                            <td><input  type="text" size="6" class="form-control" name="itinerario"></td>
                            <td><input type="text" size="6" class="form-control"name="processo"></td>
                            <td><button type="submit" size="4" class="btn btn-primary" @if($agendamento->dadosProfessor($banca->codpes) == null) disabled @endif><b>Gerar Documento</b></button></td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>
<div class="card">
<div class="card-header"><b>E-mails para docente</b></div>
    <table class="table table-striped" style="text-align:center;">
        <thead class="thead-light">
            <tr>
                <th>Docente</th>
                <th></th> 
            </tr>
        </thead>
        <tbody>
            @foreach($agendamento->bancas as $banca)
                <tr>
                    <form action="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}/recibos/exibir_email_docente" class="form-group" method="POST">
                        @csrf 
                        <td>{{ $agendamento->dadosProfessor($banca->codpes)->nome ?? 'Professor não cadastrado'}}</td>
                        <td><button type="submit" size="4" class="btn btn-primary" @if($agendamento->dadosProfessor($banca->codpes) == null) disabled @endif><b>Visualizar E-mail</b></button></td>
                    </form> 
                </tr>
            @endforeach
        </tbody>
    </table>	
</div>