<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                <p>Prezado(a) Prof. Dr.(a), <b>{{$nomeCompleto}}</b>, de Nº USP: <b>{{$codpes}}</b>,
                <br><br><br>
                Solicitamos que nos envie o link da sala virtual da defesa de <b>{{$agendamento->nome}}</b>, de Nº USP: <b>{{$codpesAluno}}</b>, intitulado como "<b>{{$agendamento->titulo}}</b>".</p>
                <p>Tipo da defesa: <b>{{$agendamento->tipo}}</b></p>
                <a href="https://www.defesas.fflch.usp.br" class="btn btn-info" target="_blank">Abrir link</a>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
    .card{
        margin-top:1rem;
        box-shadow:2px 2px 4px rgb(0,0,0,0.2);
    }
    .btn-info{
        width:100%;
    }
</style>