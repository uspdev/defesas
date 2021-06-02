<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Uspdev\Replicado\DB;

class DevController extends Controller
{
    public function bancas_aprovadas(){
        $this->authorize('admin');
        $query = "
        SELECT DISTINCT l.codpes,l.nompes,a.dtaaprbantrb FROM LOCALIZAPESSOA l
        INNER JOIN AGPROGRAMA a ON l.codpes = a.codpes
        WHERE
         l.tipvin = 'ALUNOPOS'
        AND l.codpes > 8974982
        AND l.codundclg=8
        AND a.dtaaprbantrb IS NOT NULL
        ";

        $bancas_aprovadas =  DB::fetchAll($query);

        return view('dev.bancas_aprovadas',[
            'bancas_aprovadas' => $bancas_aprovadas
        ]);
    }
}
