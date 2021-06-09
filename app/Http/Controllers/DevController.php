<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Uspdev\Replicado\DB;

class DevController extends Controller
{
    public function bancas_aprovadas(){
        $this->authorize('admin');
        $query = "
        SELECT V.codpes, V.nompes, A.dtaaprbantrb FROM VINCULOPESSOAUSP V
        INNER JOIN AGPROGRAMA A ON V.codpes = A.codpes
        WHERE
        V.tipvin = 'ALUNOPOS'
        AND V.codclg=45
        AND A.dtaaprbantrb IS NOT NULL
        AND A.dtadfapgm IS NULL
        ";

        $bancas_aprovadas =  DB::fetchAll($query);

        return view('dev.bancas_aprovadas',[
            'bancas_aprovadas' => $bancas_aprovadas
        ]);
    }
}
