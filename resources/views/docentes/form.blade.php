<div class="form-group row">
    <div class="col-sm">
        <label for="nome">Nome Completo </label> 
        <input type="text" class="form-control" name="nome" value="{{ old('nome', $docente->nome) }}">
    </div>
    <div class="col-sm">
        <label for="n_usp">Número USP </label> 
        <input class="form-control" type="text" name="n_usp" value="{{ old('n_usp', $docente->n_usp) }}">
    </div>
</div>

<div class="form-group row">
    <div class="col-sm">
        <label for="cpf">CPF</label> 
        <input class="form-control" type="text" name="cpf" value="{{ old('cpf', $docente->cpf) }}">
    </div>
    <div class="col-sm">
        <label for="tipo">Tipo de Documento</label> 
        <select name="tipo" class="form-control"> 
            @foreach ($docente->documentoOptions() as $option)
                {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                @if (old('tipo') == '' and isset($docente->tipo))
                <option value="{{$option}}" {{ ( $docente->tipo == $option) ? 'selected' : ''}}>
                    {{$option}}
                </option>
                {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                @else
                <option value="{{$option}}" {{ ( old('tipo') == $option) ? 'selected' : ''}}>
                    {{$option}}
                </option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="col-sm">
        <label for="documento"> Documento </label>  
        <input type="text" class="form-control" name="documento" value="{{ old('documento', $docente->documento) }}">
    </div>
    <div class="col-sm">
        <label for="status">Status</label> 
        <select name="status" class="form-control"> 
            @foreach ($docente->statusOptions() as $option)
                {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                @if (old('status') == '' and isset($docente->status))
                <option value="{{$option['codstatus']}}" {{ ( $docente->status == $option['codstatus']) ? 'selected' : ''}}>
                    {{$option['nomestatus']}}
                </option>
                {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                @else
                <option value="{{$option['codstatus']}}" {{ ( old('status') == $option['codstatus']) ? 'selected' : ''}}>
                    {{$option['nomestatus']}}
                </option>
                @endif
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <div class="col-sm">
        <label for="endereco"> Endereço </label> 
        <input type="text"  class="form-control" name="endereco" value="{{ old('endereco', $docente->endereco) }}">
    </div>
    <div class="col-sm">
        <label for="bairro"> Bairro</label> 
        <input type="text" class="form-control" name="bairro" value="{{ old('bairro', $docente->bairro) }}">
    </div>
    <div class="col-sm">
        <label for="cep">CEP </label> 
        <input type="text" class="form-control" name="cep" value="{{ old('cep', $docente->cep) }}">
    </div>
</div>
 
<div class="form-group row">
    <div class="col-sm">
        <label for="cidade">Cidade </label>  
        <input type="text" class="form-control" name="cidade" value="{{ old('cidade', $docente->cidade) }}">
    </div>
    <div class="col-sm">
        <label for="estado">Estado</label> 
        <input type="text" class="form-control" name="estado" value="{{ old('estado', $docente->estado) }}">  
    </div>
    <div class="col-sm">
        <label for="pais">Pais</label>
        <input type="text" class="form-control" name="pais" value="{{ old('Brasil', $docente->pais) }}">  
    </div>
</div>

<div class="form-group row">
    <div class="col-sm">
        <label for="pis_pasep">PIS PASEP</label> 
        <input type="text" class="form-control" name="pis_pasep" value="{{ old('pis_pasep', $docente->pis_pasep) }}">
    </div>
    <div class="col-sm">
        <label for="banco">Banco</label> 
        <input type="text" class="form-control" name="banco" value="{{ old('banco', $docente->banco) }}"> 
    </div>
    <div class="col-sm">
        <label for="agencia">Agência</label> 
        <input type="text" class="form-control" name="agencia" value="{{ old('agencia', $docente->agencia) }}"> 
    </div>
    <div class="col-sm">
        <label for="c_corrente">Conta Corrente</label> 
        <input type="text" class="form-control" name="c_corrente" value="{{ old('c_corrente', $docente->c_corrente) }}"> 
    </div>
</div>

<div class="form-group row">
    <div class="col-sm">
        <label for="telefone">Telefones </label> 
        <input type="text" class="form-control" name="telefone" value="{{ old('telefone', $docente->telefone) }}">  
    </div>
    <div class="col-sm">
        <label for="email">E-mail </label> 
        <input type="text" class="form-control" name="email" value="{{ old('email', $docente->email) }}">  
    </div>
</div>

<div class="form-group row">
    <div class="col-sm">
        <label for="docente_usp">Docente USP?</label> 
        <select name="docente_usp" class="form-control"> 
            @foreach ($docente->docenteUspOptions() as $option)
                {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                @if (old('docente_usp') == '' and isset($docente->docente_usp))
                <option value="{{$option['codoption']}}" {{ ( $docente->docente_usp == $option['codoption']) ? 'selected' : ''}}>
                    {{$option['nomeoption']}}
                </option>
                {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                @else
                <option value="{{$option['codoption']}}" {{ ( old('docente_usp') == $option['codoption']) ? 'selected' : ''}}>
                    {{$option['nomeoption']}}
                </option>
                @endif
            @endforeach
        </select>
    </div> 
    <div class="col-sm">
        <label for="lotado"> Nome e sigla da Universidade na qual tem vínculo profissional </label> 
        <input type="text"  class="form-control" name="lotado" value="{{ old('lotado', $docente->lotado) }}">
    </div>
</div>
<button type="submit" class="btn btn-success">Enviar</button>