--Apagando tudo antes
------------------------------------------------------
DROP VIEW viewcandidato;
DROP TABLE candidato;
DROP TABLE sala;
DROP TABLE docente;
DROP TABLE configdocs;
DROP TABLE area;
DROP TABLE users;
------------------------------------------------------

--Criando o banco
SET client_encoding = 'UTF8';

CREATE TABLE  users (
	codpes INTEGER UNIQUE,
	nome VARCHAR(200) ,
	password VARCHAR(60) ,
	email VARCHAR(100) ,
	permission INTEGER DEFAULT 1,
	created_at TIMESTAMP DEFAULT CURRENT_DATE,
	updated_at TIMESTAMP DEFAULT CURRENT_DATE
);

ALTER TABLE ONLY users
    ADD CONSTRAINT codpes_pk PRIMARY KEY (codpes);

CREATE TABLE  area (
	code_area SERIAL,
	nome_area VARCHAR(1000) ,
	coordenador VARCHAR(1000) ,
	departamento VARCHAR(1000) ,
	created_at TIMESTAMP DEFAULT CURRENT_DATE,
	updated_at TIMESTAMP DEFAULT CURRENT_DATE
); 
ALTER TABLE ONLY area
    ADD CONSTRAINT code_area_pk PRIMARY KEY (code_area);

CREATE TABLE  sala (
	code_sala SERIAL,
	nome_sala VARCHAR(1000) ,
	predio VARCHAR(1000) ,
	created_at TIMESTAMP DEFAULT CURRENT_DATE,
	updated_at TIMESTAMP DEFAULT CURRENT_DATE
); 
ALTER TABLE ONLY sala
    ADD CONSTRAINT code_sala_pk PRIMARY KEY (code_sala);

CREATE TABLE  candidato (
	id_candidato SERIAL,
	codpes VARCHAR(1000),
	nome VARCHAR(1000) ,
	area INTEGER ,
	sexo_pessoa VARCHAR(1000) ,
	nivel VARCHAR(1000) ,
	titulo VARCHAR(1000) ,
	data_horario TIMESTAMP  , 
	sala INTEGER,
	orientador INTEGER ,
	titular2 INTEGER,
	titular3 INTEGER,
	titular4 INTEGER,
	titular5 INTEGER,
	suplente1 INTEGER,
	suplente2 INTEGER,
	node_nid INTEGER,
	created_at TIMESTAMP DEFAULT CURRENT_DATE,
	updated_at TIMESTAMP DEFAULT CURRENT_DATE,
	last_user INTEGER
); 

ALTER TABLE ONLY candidato
    ADD CONSTRAINT id_candidato_pk PRIMARY KEY (id_candidato);

CREATE TABLE docente (
	id_docente SERIAL,
	nome VARCHAR(1000),
	endereco VARCHAR(1000),
	bairro VARCHAR(1000),
  cep VARCHAR(1000),
  cidade VARCHAR(1000),
  estado VARCHAR(1000),
	email VARCHAR(1000),
  telefone VARCHAR(1000),
  lotado VARCHAR(1000),
  n_usp VARCHAR(1000),
  pis_pasep VARCHAR(1000),
  pais VARCHAR(1000), 
  tipo VARCHAR(1000),
  documento VARCHAR(1000),
  cpf VARCHAR(1000),
  banco VARCHAR(1000),
  agencia VARCHAR(1000),
  c_corrente VARCHAR(1000),
  status VARCHAR(1000) DEFAULT 'B',
  docente_usp VARCHAR(1000) DEFAULT 'sim',
	created_at TIMESTAMP DEFAULT CURRENT_DATE,
	updated_at TIMESTAMP DEFAULT CURRENT_DATE,
	last_user INTEGER
);
ALTER TABLE ONLY docente
    ADD CONSTRAINT id_docente_pk PRIMARY KEY (id_docente);

CREATE TABLE configdocs(
	id_config SERIAL,
	sitename TEXT,
	rodape_site TEXT,
	oficio_suplente TEXT,
	declaracao TEXT,
	regimento TEXT,
	importante_oficio TEXT,
	diaria_simples VARCHAR(1000),
	diaria_completa VARCHAR(1000),
	duas_diarias VARCHAR(1000),
	diaria_sem_pernoite VARCHAR(1000),
	diaria_com_pernoite VARCHAR(1000),
	duas_diarias_proap VARCHAR(1000),
	agencia_viagem TEXT,
	agencia_texto TEXT,
	faturar_para VARCHAR(1000),
	mail_docente TEXT,
	obs_passagem TEXT,
	capes_proap TEXT,
	header_auxilio TEXT,
	rodape_oficios TEXT,
	updated_at TIMESTAMP DEFAULT CURRENT_DATE
);
ALTER TABLE ONLY configdocs
    ADD CONSTRAINT configdocs_pk PRIMARY KEY (id_config);

-- Chave estrangeira para programa
CREATE INDEX area_idx ON candidato (area);
ALTER TABLE ONLY candidato
    ADD CONSTRAINT candidato_area FOREIGN KEY (area) REFERENCES area(code_area);

-- Chave estrangeira para sala
CREATE INDEX sala_idx ON candidato (sala);
ALTER TABLE ONLY candidato
    ADD CONSTRAINT candidato_sala FOREIGN KEY (sala) REFERENCES sala(code_sala);

-- Chave estrangeira para docentes da banca
CREATE INDEX orientador_idx ON candidato (orientador);
CREATE INDEX titular2_idx ON candidato (titular2);
CREATE INDEX titular3_idx ON candidato (titular3);
CREATE INDEX titular4_idx ON candidato (titular4);
CREATE INDEX titular5_idx ON candidato (titular5);
CREATE INDEX suplente1_idx ON candidato (suplente1);
CREATE INDEX suplente2_idx ON candidato (suplente2);

ALTER TABLE ONLY candidato
    ADD CONSTRAINT candidato_orientador FOREIGN KEY (orientador) REFERENCES docente(id_docente);
ALTER TABLE ONLY candidato
    ADD CONSTRAINT candidato_titular2 FOREIGN KEY (titular2) REFERENCES docente(id_docente);
ALTER TABLE ONLY candidato
    ADD CONSTRAINT candidato_titular3 FOREIGN KEY (titular3) REFERENCES docente(id_docente);
ALTER TABLE ONLY candidato
    ADD CONSTRAINT candidato_titular4 FOREIGN KEY (titular4) REFERENCES docente(id_docente);
ALTER TABLE ONLY candidato
    ADD CONSTRAINT candidato_titular5 FOREIGN KEY (titular5) REFERENCES docente(id_docente);
ALTER TABLE ONLY candidato
    ADD CONSTRAINT candidato_suplente1 FOREIGN KEY (suplente1) REFERENCES docente(id_docente);
ALTER TABLE ONLY candidato
    ADD CONSTRAINT candidato_suplente2 FOREIGN KEY (suplente2) REFERENCES docente(id_docente);

-- Chave estrangeira 	modificação no cadastro do docente
CREATE INDEX who_idx ON docente (last_user);
ALTER TABLE ONLY docente
    ADD CONSTRAINT docente_who_fk FOREIGN KEY (last_user) REFERENCES users (codpes);

-- Chave estrangeira 	modificação no cadastro do candidato
CREATE INDEX who_alter_candidato ON candidato (last_user);
ALTER TABLE ONLY candidato
    ADD CONSTRAINT candidato_who_fk FOREIGN KEY (last_user) REFERENCES users (codpes);

--  Visões 
CREATE VIEW viewcandidato AS SELECT
	candidato.id_candidato,
	candidato.codpes,
	candidato.nome,
	candidato.area,
	candidato.sexo_pessoa,
	candidato.nivel,
	candidato.titulo,
	candidato.data_horario,
	candidato.sala,
	candidato.orientador,
	candidato.titular2,
	candidato.titular3,
	candidato.titular4,
	candidato.titular5,
	candidato.suplente1,
	candidato.suplente2,
	candidato.created_at,
	candidato.updated_at,
	area.code_area,
	area.nome_area,
	area.coordenador,
	area.departamento,
	sala.code_sala,
	sala.nome_sala, 
	sala.predio
	FROM candidato 
		INNER JOIN area ON (candidato.area = area.code_area)
	  INNER JOIN sala ON (candidato.sala = sala.code_sala);

----------------------------------------------------------------------------------------------

 
--usuário padrão
 
INSERT INTO users(codpes,nome,password,email,permission) VALUES ('123','Fulano','202cb962ac59075b964b07152d234b70','teste@usp.br',1);

INSERT INTO configdocs(sitename,
											rodape_site,
										 	oficio_suplente,
											declaracao,
											importante_oficio,
											regimento,
											diaria_simples,
											diaria_completa,	
											duas_diarias,
											agencia_viagem,
											agencia_texto,
											faturar_para,
											mail_docente,
											obs_passagem,
											capes_proap,
											header_auxilio,	
											rodape_oficios,
											diaria_sem_pernoite,
											diaria_com_pernoite,	
											duas_diarias_proap
											) 
VALUES 
('Defesas',
'FFLCH',
'<p> Venho, pelo presente, informar que seu nome foi aprovado pela Comissão de Pós-Graduação para, na qualidade de <b>membro suplente</b>, integrar a banca examinadora do(a) aluno(a) supracitado(a).</p> 
<p> A defesa está prevista para o dia <b>%data_oficio_suplente</b>, no (a) %nome_sala do %predio.<br><br> </p> 
<p>Na impossibilidade do comparecimento de um dos membros titulares, V. Sa. será convidado a integrar a referida banca, motivo pelo qual, segue em anexo um exemplar do trabalho.</p>',
'Declaro, para os devidos fins, que o(a) Prof(a) Dr(a) %docente_nome participou, nesta data, da defesa do trabalho de %nivel do(a) Sr(a) %candidato_nome, intitulado: "%titulo", na área %area, sob a presidência do(a) Prof.(a) Dr.(a) %orientador, integrando a Comissão Julgadora, composta pelos Professores Doutores:',
'<b> <center> <b>IMPORTANTE!</b> <br> <br> Junto com este ofício, V.Sa está recebendo o EXEMPLAR ORIGINAL do trabalho depositado pelo(a) aluno(a) dentro do prazo regimental e que deverá servir de instrumento para as arguições feitas a(o) candidato(a) no ato da defesa </b></center>',
' <center>  <b> Artigo 95 do Regimento de Pós-Graduação da USP </b> <br><br>	O julgamento da dissertação de mestrado e da tese de doutorado será realizado de acordo com critérios previamente estabelecidos pela respactiva CPG. <br> § 1º - A arguição, após exposição de no máximo 60 minutos realizada pelo candidato, ocorrerá em sessão pública, e não deverá exceder o prazo de três horas para o mestrado e cinco horas para o doutorado. </center></b>',
'R$ 111,68',
'R$ 279,20',
'R$ 558,40',
'<b>LINEX - Travel Viagens e Turismo Ltda.<br> 
Tel: 3129 4753/3257 5468 - Fax: 3257 2704<br> 
E-mail: sofia@linextravel.com.br<br>
Att. Sofia',
'<p> Prezada Senhora: </p>
<p>Venho pelo presente solicitar a compra de uma passagem aérea (ida e volta), para o(a) Prof(a). Dr(a). abaixo relacionado(a), que participará de Banca Examinadora nesta Faculdade: </p> ',
'Sara Albieri/CAPES <br> CNPJ/CPF: 301.167.088-91',
'<hr>
<p> <b> e-mail para dados de passagem </b> </p> <br>
<p>Prezado(a) Prof.(a) Dr.(a): %docente_nome, </p>
<p>Solicito a gentileza de nos responder, o mais breve possível, às consultas abaixo, visando sua participação como membro da Comissão Julgadora abaixo explicitada: </p>
<br>
<p>Candidato: <b> %candidato_nome </b></p>
<p>Data da defesa: %data_defesa <p>
<p>Local: %local_defesa <p>
<br>
<p>1. Pretende almoçar no Clube dos Professores? </p>
[ ] SIM                         [ ] NÃO
<p> Favor confirmar o interesse com antecedência – não será possível fazer o pedido no dia da defesa. </p>
<br>
<p> 2.  Qual será seu meio de Transporte: </p>
<p>[   ]  Carro –   não há reembolso de combustível</p>
<p>[   ]  Ônibus –  há reembolso de passagens após a defesa)</p>
<p>[   ]  Aéreo – passagem comprada pelo Serviço de Pós-Graduação. </p>
<br>
<p>Favor preencher os dados abaixo:</p>
<br>
<p>Ida: ____________________________________ / São Paulo (Capital) </p>
<p>Data: _____/_____             Horário aproximado (a  variação poderá ser de até 2 horas a mais ou a menos)  ______:______ </p>
Volta: São Paulo (Capital) / _____________________________________
Data: _____/_____             Horário aproximado (a  variação poderá ser de até 2 horas a mais ou a menos)   
<br>
<p>Atenção:</p>
<p>Depois de compradas as passagens, qualquer multa decorrente de alterações de datas e horários de viagem será de responsabilidade do próprio passageiro.</p>
<br>
<p>3.  Hospedagem</p>
<p>[    ]   No Hotel  conveniado  (reserva feita pelo Serviço de Pós). </p>
<p>Favor informar: Data do check in:  _______/_______    Data do check out: ______/_______</p>
<p>[    ]   A reserva será feita por mim, em Hotel de minha preferência</p>
<p>Favor informar: Data do check in:  _______/_______    Data do check out: ______/_______</p>
<p>[    ]   Não preciso de hospedagem</p>
<br>
<p>Aguardo e desde já agradeço seu retorno.</p>
<br>
<hr>
<p><b>e-mail para seguir com a reserva de hotel: </b></p>
<br>
<p>Prezado(a) Prof.(a) Dr.(a): %docente_nome, </p>
<br>
<p>Seguem anexadas as reservas de pernoite. </p>
<p>O pagamento dos pernoites será efetuado pelos próprios hóspedes, que serão ressarcidos, por depósito bancário, cujos dados serão recolhidos após o término da defesa.</p>
<br>
<p>Qualquer dúvida entre em contato.</p>
<br>
<hr>
<p><b>e-mail para atualização e confirmação de dados cadastrais  de professor externo: </b></p>
<br>
<p>Prezado(a) Prof.(a) Dr.(a): %docente_nome, </p>
<br>
<p>Tendo em vista sua indicação como membro titular de banca de desta faculdade, peço-lhe, por favor, que confirme os dados abaixo para envio da dissertação / tese: </p>
<br>
<p>Endereço: </p>
<p>Telefones (residencial e celular): </p>
<br>
<p>Desde já lhe agradeço e aguardo o retorno.</p>
<hr>
<p><b>e-mail para almoço no Clube dos Professores: </b></p>
<br>
Solicito autorização para que a professora citada abaixo possa utilizar o restaurante Clube do Professores no dia 09/03/2012. O pagamento deverá ser feito por transposição orçamentária. Motivo: participação em banca examinadora.
<br>
<p>Prof.(a) Dr.(a): %docente_nome </p>
<hr>
<p><b>e-mail com o formulário de autorização para almoçar no clube dos professores</b></p>
<br>
<p>Prezado(a) Prof.(a) Dr.(a): %docente_nome, </p>
<br>
<p>Segue anexada a autorização para o almoço que deverá ser impressa e apresentada no restaurante do Clube dos Professores no dia da defesa.</p>
<br>
<p>Qualquer dúvida entre em contato.</p>',
'<p>OBS: A cada solicitação de passagem, deverão ser encaminhados orçamentos das CIAS AÉREAS, inclusive todos os benefícios e vantagens oferecidas pelas mesmas, e garantir o atendimento por aquelas de menor custo disponível para o dia/hora/destino requisitado, para que esta Administração confirme a emissão do bilhete mais vantajoso, conforme Cláusula Terceira, Item 3.1.3 do Contrato. </p> <b> <p>
Deverá ser observado: ITEM 3.2.7 - Letra “c” :  Encaminhar a Contratante, no prazo de 02 (duas) horas a contar da solicitação, um levantamento das empresas de transporte aéreo que mantém vôos para a localidade indicada, com os respectivos horários de partida e chegada, escalas e conexões, preços e demais informações que possam interessar à Administração. </p></b> Sem mais',
'Conforme Regulamento CAPES/PROAP, Portaria 64/2010 - em seu Artigo 7º, item XIII - A participação de professores convidados em Bancas Examinadoras de dissertações, teses e exames de qualificação receberão passagens e diárias, estabelecidas conforme legislação federal em vigor.',
'<b>A <br>
Linex Travel Viagens e Turismo Ltda.<br>
A/C. Sra. Luiza. <br>
Fone: 3257-5468/Fax: 3257-2704 <br>
<u>REF.: Cotização de Passagem Aérea. </u> </b> <br>',
'<hr> Serviço de Pós-Graduação <br> mail@gmail.com / 3091-4626 <br>
Prédio da Administração da FFLCH-USP <br>
Rua do Lago 717, sala 118 - CEP 05508-080',
'R$ 50,00',
'R$ 10,00',
'R$ 20,00'
);
