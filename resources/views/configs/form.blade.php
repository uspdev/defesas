<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="sitename">Nome do sistema</label>
		<input type="text" class="form-control" name="sitename" value="{{$config->sitename}}">
	</div>
	<div class="form-group col-sm">
		<label class="config" for="rodape_site">Rodapé do sistema</label> 
		<input type="text" class="form-control" name="rodape_site" value="{{$config->rodape_site}}">
	</div>
</div>
	
<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="rodape_oficios">Rodapé (ofício titular, suplente e declaração)</label>  
		<textarea rows="10" class="form-control" cols="70" name="rodape_oficios">{{$config->rodape_oficios}}</textarea>
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="footer">Footer (Invite and Statement)</label>  
		<textarea rows="10" class="form-control" cols="70" name="footer">{{$config->footer}}</textarea>
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="importante_oficio">Mensagem Importante no Ofício dos titulares</label>  
		<textarea rows="10" class="form-control" cols="70" name="importante_oficio">{{$config->importante_oficio}}</textarea>
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="regimento">Regimento - Artigo no Ofício dos titulares</label>  
		<textarea rows="10" class="form-control" cols="70" name="regimento">{{$config->regimento}}</textarea>
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="oficio_suplente">Ofício Suplente </label>  
		<textarea rows="10" class="form-control" cols="70" name="oficio_suplente">{{$config->oficio_suplente}}</textarea> 
		<span class="badge badge-warning">Token de substituição: %data_oficio_suplente, %nome_sala, %predio </span> 
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="declaracao">Declaração de participação</label>  
		<textarea rows="10" class="form-control" cols="70" name="declaracao">{{$config->declaracao}}</textarea>
		<span class="badge badge-warning">Token de substituição: %docente_nome, %nivel, %candidato_nome, %titulo, %area, %orientador </span> 
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="statement">Statement of Participation</label>  
		<textarea rows="10" class="form-control" cols="70" name="statement">{{$config->statement}}</textarea>
		<span class="badge badge-warning">Token de substituição: %docente_nome, %nivel, %candidato_nome, %titulo, %area, %orientador, %data </span> 
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config">Valores para diárias de professor externo</label>
		<table cellpadding="5">
			<tr>
				<td><i>Diária simples:</i> <input class="form-control" type="text" size="6" name="diaria_simples" value="{{$config->diaria_simples}}" /> </td>
				<td><i>Diária Completa:</i> <input class="form-control" type="text" size="6" name="diaria_completa" value="{{$config->diaria_completa}}" /> </td>
				<td><i>2 diárias:</i> <input class="form-control" type="text" size="6" name="duas_diarias" value="{{$config->duas_diarias}}"  /> </td>
			</tr>
		</table>
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config">Valores para diárias PROAP</label>
		<table cellpadding="5">
			<tr>
				<td><i>Diária sem pernoite:</i> <input class="form-control" type="text" size="6" name="diaria_sem_pernoite" value="{{$config->diaria_sem_pernoite}}" /> </td>
				<td><i>Diária com pernoite:</i> <input class="form-control" type="text" size="6" name="diaria_com_pernoite" value="{{$config->diaria_com_pernoite}}" /> </td>
				<td><i>2 diárias:</i> <input class="form-control" type="text" size="6" name="duas_diarias_proap" value="{{$config->duas_diarias_proap}}"  /> </td>
		</table>
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="agencia_viagem">Agência de Viagens </label>  
		<textarea rows="10" cols="70" class="form-control" name="agencia_viagem">{{$config->agencia_viagem}}</textarea>
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="agencia_texto">Ofício Agência de Viagens </label>  
		<textarea rows="10" class="form-control" cols="70" name="agencia_texto">{{$config->agencia_texto}}</textarea>
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="faturar_para"> Faturar para: Agência de Viagens </label>  
		<input type="text" class="form-control" name="faturar_para" value="{{$config->faturar_para}}" />
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="mail_docente"> E-mails para docente </label>  
		<textarea rows="10" cols="70" class="form-control" name="mail_docente">{{$config->mail_docente}}</textarea> 
		<span class="badge badge-warning">Token de substituição: %docente_nome, %candidato_nome, %data_defesa, %local_defesa </span>
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="obs_passagem"> Observação passagem </label>  
		<textarea rows="10" class="form-control" cols="70" name="obs_passagem">{{$config->obs_passagem}}</textarea>
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="header_auxilio"> Cabeçalho da compra via auxílo </label>  
		<textarea rows="10" class="form-control" cols="70" name="header_auxilio">{{$config->header_auxilio}}</textarea>
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="capes_proap"> CAPES/PROAP </label>  
		<textarea rows="10" class="form-control" cols="70" name="capes_proap">{{$config->capes_proap}}</textarea>
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="mail_dados_prof_externo"> Mensagem de Email para Confirmação de Dados de Professor Externo </label>  
		<textarea rows="10" class="form-control" cols="70" name="mail_dados_prof_externo">{{$config->mail_dados_prof_externo}}</textarea>
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="mail_passagem"> Mensagem de Email para Passagem </label>  
		<textarea rows="10" class="form-control" cols="70" name="mail_passagem">{{$config->mail_passagem}}</textarea>
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="mail_pro_labore"> Mensagem de Email para Pró-Labore </label>  
		<textarea rows="10" class="form-control" cols="70" name="mail_pro_labore">{{$config->mail_pro_labore}}</textarea>
	</div>
</div>

<div class="form-group row">
	<div class="form-group col-sm">
		<label class="config" for="mail_recibo_externo"> Mensagem de Email para Recibo Externo </label>  
		<textarea rows="10" class="form-control" cols="70" name="mail_recibo_externo">{{$config->mail_recibo_externo}}</textarea>
	</div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-success float-right">Salvar</button> 
</div> 
