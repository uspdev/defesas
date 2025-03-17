<?php

namespace App\Services;

use Uspdev\Replicado\DB as DBreplicado;

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
        $query = "SELECT nomare from NOMEAREA
                  WHERE codare = convert(int, :codare)
                  AND dtafimare IS NULL";

        $param = [
            'codare' => $codare
        ];

        return DBreplicado::fetch($query, $param);
    }

    public static function getOrientador(int $codpespgm, int $codare, int $numseqpgm) {
        $query = "SELECT P.nompesttd FROM R39PGMORIDOC R
                  INNER JOIN PESSOA P ON (R.codpes = P.codpes)
                  WHERE R.codpespgm = convert(int, :codpespgm) AND
                  R.codare = convert(int, :codare) AND
                  R.numseqpgm = convert(int, :numseqpgm) AND
                  R.tiport = 'ORI' AND
                  R.dtafimort IS NULL";
        $param = [
            'codpespgm' => $codpespgm,
            'codare'    => $codare,
            'numseqpgm' => $numseqpgm
        ];

        return DBreplicado::fetch($query, $param);
    }

    public static function getBanca(int $codpes, int $codare, int $numseqpgm) {
        $query = "SELECT R.codpesdct, R.vinptpbantrb, R.staptp, P.nompes FROM R48PGMTRBDOC R
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

    public static function getTrabalho(int $codpes, $dtacad) {
        $query = "SELECT T.tittrb, T.rsutrb, T.palcha, T.tittrbigl, T.rsutrbigl, T.palchaigl
                FROM DDTENTREGATRABALHO T INNER JOIN DDTANDAMENTODEPOSITO A
                ON T.coddpodgttrb = A.coddpodgttrb INNER JOIN DDTDEPOSITOTRABALHO D
                ON T.coddpodgttrb = D.coddpodgttrb
                WHERE D.codpes = convert(int, :codpes) AND
                A.sitanddpo = 'HOMOLOGADO' AND
                T.dtacad = :dtacad";
        $param = [
            'codpes' => $codpes,
            'dtacad' => $dtacad
        ];

        return DBreplicado::fetch($query, $param);
    }

}
