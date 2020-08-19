    <div class="card">
        <div class="card-header"><b>Documentos Gerais</b></div>
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td>
                        Documento Zero
                    </td>
                    <td>
                        <a href="/agendamentos/{{$agendamento->id}}/documento_zero" class="btn btn-outline-info"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        Placa
                    </td>
                    <td>
                        <a href="/agendamentos/{{$agendamento->id}}/placa" class="btn btn-outline-info"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        Etiquetas
                    </td>
                    <td>
                        <a href="/agendamentos/{{$agendamento->id}}/etiqueta" class="btn btn-outline-info"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        Ofício titulares
                    </td>
                    <td>
                        <a href="/agendamentos/{{$agendamento->id}}/titulares" class="btn btn-outline-info"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        Ofício suplentes
                    </td>
                    <td>
                        <a href="/agendamentos/{{$agendamento->id}}/suplentes" class="btn btn-outline-info"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        Declaração de Participação
                    </td>
                    <td>
                        <a href="/agendamentos/{{$agendamento->id}}/declaracoes" class="btn btn-outline-info"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        Recibos de remessa de documentos para docentes USP                    
                    </td>
                    <td>
                        <a href="/agendamentos/{{$agendamento->id}}/recibos" class="btn btn-outline-info"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>