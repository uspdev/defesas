<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Docente;
use App\Models\Agendamento;

class Banca extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function agendamento()
    {
        return $this->belongsTo(Agendamento::class);
    }

}
