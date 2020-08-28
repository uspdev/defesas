<?php

namespace App\Utils;
use Uspdev\Replicado\DB as DBreplicado;
use Uspdev\Replicado\Uteis;
use Uspdev\Replicado\Posgraduacao;

class ReplicadoUtils {

    // Função criada para buscar o pis/pasep de determinada pessoa - usada no EmailController/emailDocente()
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

    // Função criada para verificar se o codpes informado corresponde a algum docente externo
    public static function verificaprofessorExterno($codpes){
        # A definição de quem é externo é mais complexa... por enquanto, vamos deixar asism por ora
        return true;
        /*
        $query = "SELECT * FROM fflch.dbo.LOCALIZAPESSOA l WHERE l.codpes = convert(int, :codpes) and l.tipvin = 'EXTERNO' and l.sitatl = 'A'";
        $param = [
            'codpes' => $codpes,
        ];
        $result = DBreplicado::fetch($query, $param);
        if($result) {
            return true;
        }
        return false;
        */
    }

    // Função para verificar a partir do código da Área qual é o coordenador - usado na geração dos PDFs PROAP e PROEX
    public static function coordenadorArea($codare){
        $query = "SELECT DISTINCT (l.nompes), a.codare from fflch.dbo.R10DOCCOOCUR rd INNER JOIN fflch.dbo.LOCALIZAPESSOA l ON l.codpes = rd.codpes INNER JOIN fflch.dbo.AREA a ON rd.codcur = a.codcur where codundclg = 8 and a.codare = convert(int, :codare) and fncpescur = 'COO' and sitatl = 'A' and nomfnc = 'Coord Prog Pg'";
        $param = [
            'codare' => $codare,
        ];
        $result = DBreplicado::fetch($query, $param);
        if(!empty($result)) {
            $result = Uteis::utf8_converter($result);
            $result = Uteis::trim_recursivo($result);
            return $result;
        }
        return false;
    }

    // Função personalizada, a do Uspdev/Replicado retorna um array com array dentro, aqui ele já devolve um array varrido com apenas o Código da Área e Nome da Área Correspondente
    public static function areasProgramas(int $codundclgi)
    {
        //obtém programas
        $query = "SELECT DISTINCT (n.nomare), a.codare FROM fflch.dbo.AREA a inner join fflch.dbo.CURSO c ON a.codcur = c.codcur INNER JOIN fflch.dbo.NOMEAREA n on n.codare = a.codare INNER JOIN fflch.dbo.CREDAREA ca ON a.codare = ca.codare where c.codclg = convert(int, :codundclgi) AND ca.dtadtvare IS NULL";
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

    // Função criada para facilitação na validação do AgendamentoRequest, retorna apenas um array com o código das áreas
    public static function codAreasProgramas(int $codundclgi)
    {
        //obtém programas
        $query = "SELECT DISTINCT a.codare FROM fflch.dbo.AREA a inner join fflch.dbo.CURSO c ON a.codcur = c.codcur INNER JOIN fflch.dbo.NOMEAREA n on n.codare = a.codare INNER JOIN fflch.dbo.CREDAREA ca ON a.codare = ca.codare where c.codclg = convert(int, :codundclgi) AND ca.dtadtvare IS NULL";
        $param = [
            'codundclgi' => $codundclgi,
        ];
        $result = DBreplicado::fetchAll($query, $param);
        if(!empty($result)) {
            $result = Uteis::utf8_converter($result);
            $result = Uteis::trim_recursivo($result);
            foreach($result as $r){
                $codareas[] = $r['codare'];
            }
            return $codareas;
        }
        return false;
    }

    public static function nomeAreaPrograma($codare)
    {
        $query = "SELECT DISTINCT (na.nomare), na.codare from fflch.dbo.NOMEAREA na where na.codare = convert(int, :codare)";
        $param = [
            'codare' => $codare,
        ];
        $result = DBreplicado::fetch($query, $param);
        if(!empty($result)) {
            $result = Uteis::utf8_converter($result);
            $result = Uteis::trim_recursivo($result);
            return $result['nomare'];
        }
        return false;
    }
} 