<div class="row">
    <div class="col">
        <label for="codpes">Insira o número USP</label>
        <input type="text" class="form-control" name="codpes" value="{{ old('codpes') }}" placeholder="Insira o número USP">
    </div>
</div>

<div class="row">
    <div class="col">
        <label for="sala">Sala</label>
        <input type="text" class="form-control" name="sala" id="sala" value="{{ old('sala') }}" placeholder="Insira a sala">
    </div>
    <div class="col">
    <label for="tipo_defesa">Tipo da Defesa</label>
        <select class="form-control" name="tipo_defesa" id="tipo_defesa">
            @foreach($agendamento::tipos() as $option)
                <option value="{{$option}}">{{$option}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row">
    <div class="col">
        <label for="data_horario">Data</label>
        <input class="form-control datepicker data" type="text" autocomplete="off" name="data" placeholder="Insira o dia da defesa">
    </div>
    <div class="col">
        <label for="data_horario">Horário</label>
        <input class="form-control horario" type="text" name="horario" placeholder="Insira o horário">
    </div>
</div>

<div class="row">
    <div class="col">
        <button type="submit" class="btn btn-success">Cadastrar Defesa</button>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        let container = document.createElement('input');
        let tipoDefesaSelect = document.getElementById('tipo_defesa');

        tipoDefesaSelect.addEventListener('change', function() {
            if (tipoDefesaSelect.value === 'Virtual') {
                createInput();
            } else {
                removeInput();
            }
        });

        function createInput() {
            let div = document.createElement('div');
            let row = document.createElement('div');
            let label = document.createElement('label');
            label.innerHTML = 'Link da sala virtual';
            container.classList.add('form-control');
            container.name = 'sala_virtual';
            container.placeholder = 'Insira o link da sala virtual';
            row.id = 'sala_virtual';
            row.classList.add('col');
            div.appendChild(label);
            row.appendChild(div);
            div.appendChild(container);
            let parentDiv = tipoDefesaSelect.closest('.row');

            if (!document.querySelector('input[name="sala_virtual"]')) {
                parentDiv.appendChild(row);
            }
        }

        function removeInput() {
            let div = document.querySelector('div[id="sala_virtual"]');
            if(document.querySelector('div[class="row"')){
                div.remove();
            }
        }
    });
</script>

<style>
    .row{
        margin-top:5px;
    }
</style>
