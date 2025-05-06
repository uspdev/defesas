<?php

namespace App\Services;

use Uspdev\Replicado\DB as DBreplicado;
use Uspdev\Replicado\Pessoa;

class ReplicadoService
{
    public static function getAlunoPos(int $codpes) {
        $codundclgi = getenv('REPLICADO_CODUNDCLG');

        $query = "SELECT A.codpes, A.codare, A.nivpgm, A.numseqpgm, A.dtadpopgm, P.nompesttd
                  FROM AGPROGRAMA AS A INNER JOIN LOCALIZAPESSOA L
                  ON (A.codpes = L.codpes) INNER JOIN PESSOA P
                  ON (A.codpes = P.codpes)
                  WHERE A.codpes = convert(int, :codpes) AND
                  A.stacsldfatrb = 'N' AND
                  L.tipvin = 'ALUNOPOS' AND
                  L.sitatl = 'A' AND
                  L.codundclg = convert(int, :codundclg)";
        $param = [
            'codpes'    => $codpes,
            'codundclg' => $codundclgi
        ];

        return DBreplicado::fetch($query, $param);

    }

    public static function getNomeArea(int $codare) {
        $query = "SELECT nomare, nomareigl from NOMEAREA
                  WHERE codare = convert(int, :codare)
                  AND dtafimare IS NULL";

        $param = [
            'codare' => $codare
        ];
        $result = DBreplicado::fetch($query, $param);

        return [
            'nomare' => $result['nomare'] <> '' ? $result['nomare'] : null,
            'nomareigl' => $result['nomareigl'] <> '' ? $result['nomareigl'] : null
        ];
    }

    public static function getOrientador(int $codpespgm, int $codare, int $numseqpgm) {
        $query = "SELECT P.codpes, P.nompesttd FROM R39PGMORIDOC R
                  INNER JOIN PESSOA P ON (R.codpes = P.codpes)
                  WHERE R.codpespgm = convert(int, :codpespgm) AND
                  R.codare = convert(int, :codare) AND
                  R.numseqpgm = convert(int, :numseqpgm) AND
                  R.tiport = 'ORI'";
        $param = [
            'codpespgm' => $codpespgm,
            'codare'    => $codare,
            'numseqpgm' => $numseqpgm
        ];

        return DBreplicado::fetch($query, $param);
    }

    public static function getBanca(int $codpes, int $codare, int $numseqpgm) {
        $query = "SELECT R.codpesdct, R.vinptpbantrb, R.staptp, P.nompesttd FROM R48PGMTRBDOC R
        INNER JOIN PESSOA P
        ON R.codpesdct = P.codpes
        WHERE R.codpes = convert(int, :codpes) AND
        R.codare = convert(int, :codare) AND
        R.numseqpgm = convert(int, :numseqpgm)";
        $param = [
            'codpes'    => $codpes,
            'codare'    => $codare,
            'numseqpgm' => $numseqpgm
        ];

        return DBreplicado::fetchAll($query, $param);
    }

    public static function getTituloTrabalho(int $codpes, int $codare, int $numseqpgm) {
        $query = "SELECT T.tittrb, T.tittrbigl
                FROM TRABALHOPROG T
                WHERE T.codpes = convert(int, :codpes) AND
                T.codare = convert(int, :codare) AND
                T.numseqpgm = convert(int, :numseqpgm)";
        $param = [
            'codpes' => $codpes,
            'codare' => $codare,
            'numseqpgm' => $numseqpgm
        ];
        $result =  DBreplicado::fetch($query, $param);

        return [
            'tittrb' => $result['tittrb'] <> '' ? $result['tittrb'] : null,
            'tittrbigl' => $result['tittrbigl'] <> '' ? $result['tittrbigl'] : null
        ];
    }

    public static function getComplementoTrabalho(int $codpes, $dtacad) {
        $query = "SELECT T.rsutrb, T.palcha, T.rsutrbigl, T.palchaigl
                FROM DDTENTREGATRABALHO T INNER JOIN DDTDEPOSITOTRABALHO D
                ON T.coddpodgttrb = D.coddpodgttrb
                WHERE D.codpes = convert(int, :codpes) AND
                T.dtaultalt = :dtacad";
        $param = [
            'codpes' => $codpes,
            'dtacad' => $dtacad
        ];

        $result = DBreplicado::fetch($query, $param);

        return $result ? $result :
            [
                'rsutrb' => null,
                'palcha' => null,
                'rsutrbigl' => null,
                'palchaigl' => null,
            ];
    }

    public static function getNome(int $codpes) {
        $query = "SELECT P.nompesttd
                  FROM PESSOA P
                  WHERE P.codpes = convert(int, :codpes)";
        $param = [
            'codpes' => $codpes,
        ];

        $result = DBreplicado::fetch($query, $param);

        return $result['nompesttd'];
    }

    public static function getDataDepositoTrabalho(int $codpes, int $codare, string $nivpgm, int $numseqpgm) {
        $query = "SELECT A.dtadpopgm
                  FROM AGPROGRAMA AS A
                  WHERE A.codpes = convert(int, :codpes) AND
                  A.codare = convert(int, :codare) AND
                  A.nivpgm = :nivpgm AND
                  A.numseqpgm = convert(int, :numseqpgm)";
        $param = [
            'codpes'    => $codpes,
            'codare'    => $codare,
            'nivpgm'    => $nivpgm,
            'numseqpgm' => $numseqpgm
        ];

        $result =  DBreplicado::fetch($query, $param);

        return $result['dtadpopgm'];
    }

    public static function getVinculo(int $codpes) {
        $query = "SELECT V.tipvin
                  FROM VINCULOPESSOAUSP as V
                  WHERE V.codpes = convert(int, :codpes)
                  AND V.tipvin = 'SERVIDOR' AND V.tipfnc = 'Docente' AND V.sitatl <> 'D'";
        $param = [
            'codpes' => $codpes,
        ];

        $result = DBreplicado::fetch($query, $param);

        return $result['tipvin'] ?? 'EXTERNO';
    }

    public static function getNomeSetor(int $codpes, string $tipvin) {
        if($tipvin == 'SERVIDOR') {
            $query = "SELECT L.nomset, L.sglclgund
                    FROM LOCALIZAPESSOA L
                    WHERE L.codpes = convert(int, :codpes)
                    AND L.tipvin = :tipvin";
            $param = [
                'codpes' => $codpes,
                'tipvin' => $tipvin
            ];

            return DBreplicado::fetch($query, $param);
        }
        else {
            $query = "SELECT TOP 1 O.sglorg, O.nomrazsoc
                    FROM HISTPES H INNER JOIN ORGANIZACAO O
                    ON (H.codorg = O.codorg)
                    WHERE H.codpes = convert(int, :codpes)
                    AND H.tipfnc = 'Docente'
                    ORDER BY H.dtainifnchst DESC";
            $param = [
                'codpes' => $codpes,
            ];
            $result = DBreplicado::fetch($query, $param);

            return [
                'nomset' => $result['nomrazsoc'],
                'sglclgund' => $result['sglorg']
            ];
        }

    }

    public static function getCoordenadorArea(int $codare, int $codundclg) {
        $query = "SELECT L.nompes FROM LOCALIZAPESSOA L INNER JOIN R10DOCCOOCUR R
                  on (L.codpes = R.codpes) INNER JOIN AREA A
                  on (A.codcur = R.codcur)
                  WHERE L.codundclg = convert(int, :codundclg) AND L.nomfnc = 'Coord Prog Pg'
                  AND L.sitatl = 'A' AND A.codare = convert(int, :codare)";
        $param = [
            'codare' => $codare,
            'codundclg' => $codundclg
        ];

        $result = DBreplicado::fetch($query, $param);
        return $result['nompes'];
    }

    public static function getSetorOrientador(int $codpes) {
        $query = "SELECT L.nomset from LOCALIZAPESSOA L
                  WHERE L.codpes = convert(int, :codpes)
                  AND L.tipvinext = 'Docente'";
        $param = [
            'codpes' => $codpes
        ];

        $result = DBreplicado::fetch($query, $param);

        return  $result ? $result : ['nomset' => ''];
    }

    public static function getEndereco(int $codpes) {
        return Pessoa::obterEndereco($codpes);
    }

    public static function getEmail(int $codpes) {
        return Pessoa::email($codpes);
    }

    public static function getTelefones(int $codpes) {
        return Pessoa::telefones($codpes);
    }

    public static function getDocumentos(int $codpes, array $documentos) {
        $query = "SELECT P.numpispsp FROM COMPLPESSOA P
                  WHERE P.codpes = convert(int, :codpes)";
        $param = [
            'codpes' => $codpes
        ];
        $pispasep = DBreplicado::fetch($query, $param);

        return array_merge($pispasep, Pessoa::dump($codpes, $documentos));
    }

    public static function getNomes($codpes) {
        $query = "SELECT P.codpes, P.nompesttd FROM PESSOA P
                  WHERE P.codpes in ($codpes)";

        return DBreplicado::fetchAll($query) ?? [];
    }

}
