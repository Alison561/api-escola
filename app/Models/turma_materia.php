<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class turma_materia extends Model
{
    use HasFactory;
    protected $fillable = [
        'turma_id',
        'materia_id'
    ];

    

    public static function rules(){
        return [
            'turma_id' => 'required|exists:turmas,id',
            'materia_id' => 'required|exists:professor_disciplina,id'
        ];
    }

    public static function feedback(){
     
        return [
            'required' => 'O campo é requirido',
            'turma_id.exists' => 'A turma selecionado não existe',
            'materia_id.exists' => 'A materia selecionada não existe'
        ];
    }
}