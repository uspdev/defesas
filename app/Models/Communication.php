<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Agendamento;
use App\Models\Docente;

class Communication extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function agendamento(){
        return $this->hasMany(Agendamento::class, 'id','agendamento_id');
    }

    

}
