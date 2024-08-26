<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    {!! App\Models\Config::configMailSalaVirtual($agendamento, $agendamento->docenteNome) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .card{
        margin-top:1rem;
        box-shadow:2px 2px 4px rgb(0,0,0,0.2);
    }
    .btn-info{
        width:100%;
    }
</style>