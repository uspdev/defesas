<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class File extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function agendamento()
    {
        return $this->belongsTo(Agendamento::class);
    }

    public function nomeUsuario($id){
        return User::where('id',$id)->first()->name;
    }
}
