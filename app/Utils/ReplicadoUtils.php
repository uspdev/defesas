<?php

namespace App\Utils;
use Uspdev\Replicado\DB as DBreplicado;
use Uspdev\Replicado\Uteis;
use Uspdev\Replicado\Posgraduacao;
use Uspdev\Replicado\Pessoa;

class ReplicadoUtils {

    // Função criada para buscar o pis/pasep de determinada pessoa - usada no EmailController/exibirEmailDocente()
    public static function pisPasep($codpes){
        $query = "SELECT p.numpispsp
                    FROM COMPLPESSOA p
                    WHERE codpes = convert(int,:codpes)";
        $param = [
            'codpes' => $codpes,
        ];
        $result = DBreplicado::fetch($query, $param);
        if(!empty($result)) {
            $result = Uteis::utf8_converter($result);
            $result = Uteis::trim_recursivo($result);
            return $result;
        }
        return false;
    }

    // Função para verificar a partir do código da Área qual é o coordenador - usado na geração dos PDFs PROAP e PROEX
    public static function coordenadorArea($codare){
        $codundclgi = getenv('REPLICADO_CODUNDCLG');
        $query = "SELECT DISTINCT (l.nompes), a.codare from R10DOCCOOCUR rd INNER JOIN LOCALIZAPESSOA l ON l.codpes = rd.codpes INNER JOIN AREA a ON rd.codcur = a.codcur where codundclg = convert(int, :codundclgi) and a.codare = convert(int, :codare) and fncpescur = 'COO' and sitatl = 'A' and nomfnc = 'Coord Prog Pg'";
        $param = [
            'codare' => $codare,
            'codundclgi' => $codundclgi,
        ];
        $result = DBreplicado::fetch($query, $param);
        if(!empty($result)) {
            $result = Uteis::utf8_converter($result);
            $result = Uteis::trim_recursivo($result);
            return $result;
        }
        return false;
    }

    public static function nomeAreaPrograma($codare)
    {
        $codundclgi = getenv('REPLICADO_CODUNDCLG');
        //obtém programas
        $query = "SELECT DISTINCT (n.nomare) FROM AREA a inner join CURSO c
                  ON a.codcur = c.codcur INNER JOIN NOMEAREA n
                  on n.codare = a.codare INNER JOIN CREDAREA ca
                  ON a.codare = ca.codare
                  where c.codclg = convert(int,:codundclgi) and n.dtafimare = NULL and a.codare = convert(int,:codare)";
        $param = [
            'codundclgi' => $codundclgi,
            'codare' => $codare,
        ];
        $result = DBreplicado::fetchAll($query, $param);
        if(!empty($result)) {
            $result = Uteis::utf8_converter($result);
            $result = Uteis::trim_recursivo($result);
            return $result[0]['nomare'];
        }
        return ' ';
    }

    public static function nomeAreaProgramaEmIngles($codare)
    {
        $codundclgi = getenv('REPLICADO_CODUNDCLG');
        //obtém programas
        $query = "SELECT DISTINCT (n.nomareigl), (a.codare) FROM AREA a inner join CURSO c ON a.codcur = c.codcur INNER JOIN NOMEAREA n on n.codare = a.codare INNER JOIN CREDAREA ca ON a.codare = ca.codare where c.codclg = convert(int,:codundclgi) and n.dtafimare = NULL and a.codare = convert(int,:codare)";
        $param = [
            'codundclgi' => $codundclgi,
            'codare' => $codare,
        ];
        $result = DBreplicado::fetchAll($query, $param);
        if(!empty($result)) {
            $result = Uteis::utf8_converter($result);
            $result = Uteis::trim_recursivo($result);
            return $result[0]['nomareigl'];
        }
        return false;
    }

    public static function nomeOrganizacao($codpes){
        $query = "SELECT o.sglorg FROM HISTPES hp INNER JOIN ORGANIZACAO o ON hp.codorg = o.codorg WHERE hp.codpes = convert(int, :codpes)";
        $param = [
            'codpes' => $codpes,
        ];
        $result = DBreplicado::fetch($query, $param);
        if(!empty($result)) {
            $result = Uteis::utf8_converter($result);
            $result = Uteis::trim_recursivo($result);
            return $result;
        }
        else{
            $query = "SELECT o.sglorg FROM VINCULOPESSOAUSP v INNER JOIN ORGANIZACAO o ON v.codund = o.codorg where v.codpes = convert(int, :codpes)";

            $param = [
                'codpes' => $codpes,
            ];
            $result = DBreplicado::fetch($query, $param);
            if(!empty($result)) {
                $result = Uteis::utf8_converter($result);
                $result = Uteis::trim_recursivo($result);
                return $result;
            }
        }
        return false;
    }

    public static function departamentoPrograma($codpes)
    {
        //Através dele localiza-se seu cadastro e assim conseguimos o departamento do qual ele pertence
        $query = "SELECT TOP 1 l.nomset FROM fflch.dbo.LOCALIZAPESSOA l WHERE l.codpes = convert(int, :codpes)";
        $param = [
            'codpes' => $codpes,
        ];
        $result = DBreplicado::fetchAll($query, $param);
        if(!empty($result)) {
            $result = Uteis::utf8_converter($result);
            $result = Uteis::trim_recursivo($result);
            return $result[0];
        }

        return $result[] = ['nomset' => ' '];
    }

    public static function programasPosUnidade()
    {
        $codundclgi = getenv('REPLICADO_CODUNDCLG');
        //obtém programas
        $query = "SELECT DISTINCT (n.nomare), (a.codare) FROM AREA a inner join CURSO c ON a.codcur = c.codcur INNER JOIN NOMEAREA n on n.codare = a.codare INNER JOIN CREDAREA ca ON a.codare = ca.codare where c.codclg = convert(int, :codundclgi) and n.dtafimare = NULL";
        $param = [
            'codundclgi' => $codundclgi,
        ];
        $result = DBreplicado::fetchAll($query, $param);
        if(!empty($result)) {
            $result = Uteis::utf8_converter($result);
            $result = Uteis::trim_recursivo($result);
            return $result;
        }
        return false;
    }

    public static function retornarDadosJanus($codpes){
        $query = "SELECT A.codpes, A.codare, A.nivpgm, A.numseqpgm, P.nompes, T.tittrb, T.rsutrb, T.palcha,
                  T.tittrbigl, T.rsutrbigl, T.palchaigl, R.codpes as orientador
                  FROM AGPROGRAMA AS A INNER JOIN DDTDEPOSITOTRABALHO AS D
                  ON A.codpes = D.codpes
                  INNER JOIN DDTENTREGATRABALHO AS T
                  ON D.coddpodgttrb = T.coddpodgttrb
                  INNER JOIN R39PGMORIDOC R
                  ON A.codpes = R.codpespgm AND A.numseqpgm = R.numseqpgm AND A.codare = R.codare
                  INNER JOIN PESSOA AS P
                  ON A.codpes = P.codpes
                  WHERE A.codpes = convert(int, :codpes)
                  AND A.stacsldfatrb = 'N' AND A.dtadpopgm = T.dtacad AND R.tiport = 'ORI' AND R.dtafimort IS NULL";
        $param = [
            'codpes' => $codpes,
        ];

        return DBreplicado::fetch($query, $param);
    }

    public static function retornarDadosComunicacao($codpes){
        $query = "SELECT A.nivpgm, T.rsutrb
                FROM AGPROGRAMA AS A 
                INNER JOIN DDTDEPOSITOTRABALHO AS D
                ON A.codpes = D.codpes
                INNER JOIN DDTENTREGATRABALHO AS T
                ON D.coddpodgttrb = T.coddpodgttrb
                WHERE A.codpes = convert(int, :codpes)";
            $param = [
            'codpes' => $codpes,
            ];

        return DBreplicado::fetch($query, $param);
    }

    public static function retornarDadosBanca(int $codpes, int $numseqpgm){
        $query = "SELECT R.codpesdct, R.vinptpbantrb, P.nompes FROM R48PGMTRBDOC R
        INNER JOIN PESSOA P
        ON R.codpesdct = P.codpes
        WHERE R.codpes = convert(int, :codpes) AND
        R.numseqpgm = convert(int, :numseqpgm)";
        $param = [
            'codpes'    => $codpes,
            'numseqpgm' => $numseqpgm
        ];

        return DBreplicado::fetchAll($query, $param);
    }

}

