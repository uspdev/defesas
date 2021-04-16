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

    // Função personalizada, a do Uspdev/Replicado retorna um array com array dentro, aqui ele já devolve um array varrido com apenas o Código da Área e Nome da Área Correspondente
    public static function areasProgramas()
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

    // Função criada para facilitação na validação do AgendamentoRequest, retorna apenas um array com o código das áreas
    public static function codAreasProgramas()
    {
        $codundclgi = getenv('REPLICADO_CODUNDCLG');
        //obtém programas
        $query = "SELECT DISTINCT a.codare FROM AREA a inner join CURSO c ON a.codcur = c.codcur INNER JOIN NOMEAREA n on n.codare = a.codare INNER JOIN CREDAREA ca ON a.codare = ca.codare where c.codclg = convert(int, :codundclgi) and n.dtafimare = NULL";
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
        $areasProgramas = ReplicadoUtils::areasProgramas();
        foreach($areasProgramas as $area){
            if($area['codare'] == $codare){
                return $area['nomare'];
            }
        }
        return '';
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
        return false;
    }
} 