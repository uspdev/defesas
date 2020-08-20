
<div class="card">
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
            @foreach($agendamento->bancas as $professor)
                @if($pessoa::cracha($professor->codpes) == false)
                    <tr>
                        <form action="/emails/{{$agendamento->id}}/reciboexterno/{{$professor->id}}" method="POST">
                            @csrf
                            <td>{{$professor->nome}}</td>
                            <td> <input type="text" class="datepicker" autocomplete="off" size="8" name="ida"> </td>
                            <td> <input type="text" class="datepicker" autocomplete="off" size="8" name="volta"> </td>
                            <td> <input type="text" size="8" name="origem"> </td>
                            <td> 	
                                <select name="diaria"> 
                                    <option value="diaria_simples" selected="selected"> Simples </option>
                                    <option value="diaria_completa"> Completa </option>
                                    <option value="duas_diarias"> 2 diárias </option>
                                </select>
                            </td>
                            <td> <input type="submit" class="btn btn-outline-success" value="Gerar Recibo"></td>
                        </form>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
<br>
<div class="card">
    <div class="card-header"><b>PROEX</b></div>
    <form action="./pdfs/proex.php?id_candidato=996" method="POST">
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
                <tr> 
                    <td> Marta Denise da Rosa Jardim </td>
                    <td> <input type="text" size="6" name="importancia" /> </td>
                    <td> <input type="text" size="6" name="periodo" /> </td>
                    <td> <input type="text" size="6" name="valor" /> </td>
                    <td><input type="text" size="4" name="outro_tipo" placeholder="Tipo"></td>
                    <td><input type="text" size="4" name="outro_valor" placeholder="Valor"></td>
                    <td> <input type="text" size="6" name="liquido" /> </td>
                    <td> <input type="submit" size="4" class="btn btn-outline-success" value="Gerar Documento" > </td>
                </tr>
            </tbody>
            <input type="hidden" name="nome_docente" value="Marta Denise da Rosa Jardim" />
            <input type="hidden" name="telefone_docente" value="(11) 3384-8320" />
            <input type="hidden" name="email_docente" value="martabane@gmail.com / m.jardim@unifesp.br" />	
            <input type="hidden" name="cpf_docente" value="449.797.030-20" />	
            <input type="hidden" name="documento" value="1028041299" />	
            <input type="hidden" name="endereco" value=" R. Dr. Edmur de Castro Cotti, 218 Jardim Rizzo São Paulo SP 05587-130" />	
        </table>
    </form>
</div>
<br>
<div class="card">
    <div class="card-header"><b>Recibo de diárias - PROAP</b></div>
    <form action="" method="POST">
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
                <tr> 
                    <td> Marta Denise da Rosa Jardim </td>
                    <td> <input type="text" size="2" name="ano" /> </td>
                    <td> <input type="text" size="1" name="diaria_proap" />  </td>
                    <td> <input type="text" size="6" name="origem" /> </td>
                    <td> <input type="text" size="6" name="chegada" /> </td>
                    <td> <input type="text" size="6" name="saida" /> </td>
                    <td> <input type="text" size="1" name="valor_proap" /> </td>
                    <td> <input type="text" size="6" name="extenso" /> </td>
                    <td> <input type="submit" size="4" class="btn btn-outline-success"  value="Gerar Documento" > </td>
                </tr>
            </tbody>

            <input type="hidden" name="nome_docente" value="Marta Denise da Rosa Jardim" />
            <input type="hidden" name="telefone_docente" value="(11) 3384-8320" />
            <input type="hidden" name="email_docente" value="martabane@gmail.com / m.jardim@unifesp.br" />	
            <input type="hidden" name="cpf_docente" value="449.797.030-20" />	
            <input type="hidden" name="documento" value="1028041299" />	
            <input type="hidden" name="lotado" value="UNIFESP" />	
            <input type="hidden" name="endereco" value=" R. Dr. Edmur de Castro Cotti, 218 - Jardim Rizzo - São Paulo - SP - 05587-130" />	
        </table>
    </form>
</div>
<br>
<div class="card">
    <div class="card-header"><b>Requisição de passagem aérea</b></div>
    <form action="" method="POST">
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
                <tr> 
                    <td> Marta Denise da Rosa Jardim </td>
                    <td> <input  type="text" size="6" name="ida" /> </td>
                    <td> <input type="text" size="6" name="volta" /> </td>
                    <td> <input  type="text" size="6" name="trajeto" /> </td>
                    <td> <input type="text" size="6" name="requisicao" />	 </td>
                    <td> <input type="submit" size="4" class="btn btn-outline-success" value="Gerar documento" > </td>
                </tr>
            </tbody>
            <input type="hidden" name="nome_docente" value="Marta Denise da Rosa Jardim" />
            <input type="hidden" name="telefone_docente" value="(11) 3384-8320" />
            <input type="hidden" name="email_docente" value="martabane@gmail.com / m.jardim@unifesp.br" />	
        </table>
    </form>
</div>
<br>
<div class="card">
<div class="card-header"><b>Passagem aérea - Compra via auxílio</b></div>
    <form action="" method="POST">
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
                <tr> 
                    <td> Marta Denise da Rosa Jardim </td>
                    <td> <input  type="text" size="6" name="partida" /> </td>
                    <td> <input  type="text" size="6" name="retorno" /> </td>
                    <td> <input  type="text" size="6" name="itinerario" /> </td>
                    <td> <input type="text" size="6" name="processo" />	 </td>
                    <td> <input type="submit" size="4" class="btn btn-outline-success" value="Gerar Documento" > </td>
                </tr>
            </tbody>
            <input type="hidden" name="nome_docente" value="Marta Denise da Rosa Jardim" />
            <input type="hidden" name="telefone_docente" value="(11) 3384-8320" />
            <input type="hidden" name="email_docente" value="martabane@gmail.com / m.jardim@unifesp.br" />	
        </table>
    </form>
</div>
<br>
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
            @foreach($agendamento->bancas as $professor)
                @if($pessoa::cracha($professor->codpes) == false)
                    <tr>
                        <form action="/emails/{{$agendamento->id}}/emaildocente/{{$professor->id}}" method="POST">
                            @csrf 
                            <td>{{$professor->nome}}</td>
                            <td><input type="submit" size="4" class="btn btn-outline-success" value="Enviar E-mail" > </td>
                        </form> 
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>	
</div>