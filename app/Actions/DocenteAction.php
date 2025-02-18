<?php

namespace App\Actions;
use App\Models\Docente;
use Uspdev\Replicado\Pessoa;

class DocenteAction
{
    /**
     * Create a new class instance.
     */
    public static function handle(int $codpes, string $nompes)
    {
        $docenteExiste = Docente::where('n_usp',$codpes)->exists();
        if(!$docenteExiste){ //inserindo novo docente, caso ele não haja na table
            $docente = new Docente;
            $docente->nome = $nompes;
            $docente->n_usp = $codpes;
            $docente->email = Pessoa::email($codpes);
            $docente->save();
        }
    }
}
