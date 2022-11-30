@extends('laravel-usp-theme::master')

@section('content')

    <div class="card">
        <div class="card-header"><h5><b>Cadastrar Status de Defesa</b></h5></div>
            <div class="card-body">
                <form method="POST" action="status/{{$agendamento->id}}" id="formStatus">
                    @csrf
                    @method('patch')
                    <label for="approval_status"><b>Defesa foi aprovada?</b></label>
                    <div class="row">
                        <div class="col-3">
                            <select class="form-control" name="approval_status">
                                <option value="" selected="">- Selecione -</option>
                                @foreach ($agendamento->statusApprovalOptions() as $option)
                                    {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                                    @if (old('approval_status') == '' and isset($agendamento->approval_status))
                                    <option value="{{$option}}" {{ ( $agendamento->approval_status == $option) ? 'selected' : ''}}>
                                        {{$option}}
                                    </option>
                                    {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                                    @else
                                    <option value="{{$option}}" {{ ( old('approval_status') == $option) ? 'selected' : ''}}>
                                        {{$option}}
                                    </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>    
                        <div class="col-auto">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success float-right">Enviar</button>
                            </div> 
                        </div>
                    </div> 
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" style="text-align:center;">
                    <theader>
                        <tr>
                            <th>Data e Horário</th>
                            <th>Título</th>
                            <th>Candidato(a)</th>
                            <th>Nível</th>
                            <th>Local</th>
                            <th>Banca</th>
                        </tr>
                    </theader>
                    <tbody>
                        <tr>
                            <td>{{ Carbon\Carbon::parse($agendamento->data_horario)->format('d/m/Y H:i') }}</td>
                            <td>{{ $agendamento->titulo }}</td>
                            <td>{{ $agendamento->nome }}</td>
                            <td>{{ $agendamento->nivel }}</td>
                            <td>{{ $agendamento->sala }}</td>
                            <td> 
                                @foreach ($agendamento->bancas()->where('tipo', 'Titular')->get() as $banca)
                                    {{ $agendamento->dadosProfessor($banca->codpes)->nome }}({{ $agendamento->dadosProfessor($banca->codpes)->lotado  ?? ''}})@if($loop->count != $loop->iteration), @endif
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div> 
        </div>
    </div>

@endsection('content')