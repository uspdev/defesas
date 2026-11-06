<?php

namespace App\Services;

use Uspdev\Replicado\Pessoa;
use Illuminate\Support\Collection;
use Uspdev\Replicado\Posgraduacao;

class ReplicadoService
{
    public static function getAlunoPos(int $codpes) {
        $codundclgi = getenv('REPLICADO_CODUNDCLG');

        return Posgraduacao::obterAlunoPos($codpes, $codundclgi);
    }

    public static function getNomeArea(int $codare) {
        $result = Posgraduacao::obterNomeArea($codare);

        return [
            'nomare' => $result['nomare'] <> '' ? $result['nomare'] : null,
            'nomareigl' => $result['nomareigl'] <> '' ? $result['nomareigl'] : null
        ];
    }

    public static function getOrientador(int $codpespgm, int $codare, int $numseqpgm) {

        return Posgraduacao::obterOrientador($codpespgm, $codare, $numseqpgm);
    }

    public static function getBanca(int $codpes, int $codare, int $numseqpgm) {
        $result = Posgraduacao::listarBanca($codpes, $codare, $numseqpgm);

        [$suplentes, $titulares] = collect($result)->partition(function ($item) {
            return $item['vinptpbantrb'] === 'SUP';
        })->toArray();

        return array_merge($titulares, $suplentes);
    }

    public static function getTituloTrabalho(int $codpes, int $codare, int $numseqpgm) {
        $result =  Posgraduacao::obterTituloTrabalho($codpes, $codare, $numseqpgm);

        return [
            'tittrb' => isset($result['tittrb']) ? $result['tittrb'] : null,
            'tittrbigl' => isset($result['tittrbigl']) ? $result['tittrbigl'] : null
        ];
    }

    public static function getComplementoTrabalho(int $codpes, $dtacad) {
        $result = Posgraduacao::obterComplementoTrabalho($codpes, $dtacad);

        return $result ? $result :
            [
                'rsutrb' => null,
                'palcha' => null,
                'rsutrbigl' => null,
                'palchaigl' => null,
            ];
    }

    public static function getNome(int $codpes) {
        $result = Pessoa::dump($codpes, ['nompesttd']);

        return $result['nompesttd'] ?? null;
    }

    public static function getDataDepositoTrabalho(int $codpes, int $codare, string $nivpgm, int $numseqpgm) {
        $result =  Posgraduacao::obterDataDepositoTrabalho($codpes, $codare, $nivpgm, $numseqpgm);

        return $result['dtadpopgm'];
    }

    public static function getVinculo(int $codpes) {
        $result = Posgraduacao::obterVinculoDocente($codpes);

        return $result['tipvin'] ?? 'EXTERNO';
    }

    public static function getNomeSetor(int $codpes, string $tipvin) {

        if($tipvin == 'SERVIDOR' || $tipvin == 'Docente') {
            $result =  Posgraduacao::obterNomeSetor($codpes, $tipvin);

            return  $result ? $result : ['nomset' => ''];
        }
        else {
            $result = Posgraduacao::obterOrganizacaoDocente($codpes);

            return [
                'nomset' => $result['nomrazsoc'] ?? '',
                'sglclgund' => $result['sglorg'] ?? ''
            ];
        }

    }

    public static function getCoordenadorArea(int $codare, int $codundclg) {
        $result = Posgraduacao::obterCoordenadorArea($codare, $codundclg);

        return $result['nompes'] ?? '';
    }

    public static function getEndereco(int $codpes) {
        $result =  Pessoa::obterEndereco($codpes);

        return $result ? $result : [
            'nomtiplgr' => null,
            'epflgr' => null,
            'numlgr' => null,
            'cpllgr' => null,
            'nombro' => null,
            'cidloc' => null,
            'sglest' => null,
            'codendptl' => null
        ];
    }

    public static function getEmail(int $codpes) {
        return Pessoa::email($codpes);
    }

    public static function getTelefones(int $codpes) {
        return Pessoa::telefones($codpes);
    }

    public static function getDocumentos(int $codpes, array $documentos) {
        $result = Pessoa::obterNumeroPis($codpes);

        $pispasep = $result ? $result : [
            'numpispsp' => null
        ];

        return array_merge($pispasep, Pessoa::dump($codpes, $documentos));
    }

    public static function getNomes($codpes) {
        return Pessoa::obterNome($codpes) ?? [];
    }

    public static function getProgramas() {
        $codundclgi = getenv('REPLICADO_CODUNDCLG');

        return Posgraduacao::listarAreas($codundclgi);

    }

    public static function getEmailsBanca(Collection $banca): array {
        $codpes = $banca->map(function ($item) {
            return $item['codpesdct'];
        })->toArray();

        $result = Pessoa::listarEmails($codpes);

        $emails_banca = collect($result)->mapWithKeys(function ($item) {
            return [
                $item['codpes'] => $item['codema']
            ];
        });

        [$suplentes, $titulares] = $banca->partition(function ($item) {
            return $item['vinptpbantrb'] === 'SUP';
        });

        $suplentes = $suplentes->map(function ($item) use ($emails_banca) {
            return $emails_banca->get($item['codpesdct']);
        })->filter()->implode(';');

        $titulares = $titulares->map(function ($item) use ($emails_banca) {
            return $emails_banca->get($item['codpesdct']);
        })->filter()->implode(';');

        return [
            'titulares' => $titulares,
            'suplentes' => $suplentes
        ];

    }

    public static function getPorCodigoOuNome(string $busca) {
        return Pessoa::listarPorCodigoOuNome($busca);
    }

    public static function getPorNome(string $busca) {
        return Pessoa::procurarPorNome($busca, false, false);
    }

    public static function getBancasProfessor($codpes) {
        return Posgraduacao::listarBancasProfessor($codpes);
    }

}
