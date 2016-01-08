ALTER TABLE candidato ADD regimento VARCHAR(100);
UPDATE candidato SET regimento='antigo';

ALTER TABLE candidato ADD orientador_votante VARCHAR(10);
UPDATE candidato SET orientador_votante='sim';

ALTER TABLE candidato ADD titular1 INTEGER;
UPDATE candidato SET titular1=orientador;

DROP VIEW viewcandidato;

--  Visões 
CREATE VIEW viewcandidato AS SELECT
	candidato.id_candidato,
	candidato.codpes,
	candidato.nome,
	candidato.regimento,
	candidato.orientador_votante,
	candidato.area,
	candidato.sexo_pessoa,
	candidato.nivel,
	candidato.titulo,
	candidato.data_horario,
	candidato.sala,
	candidato.orientador,
        candidato.titular1,
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



