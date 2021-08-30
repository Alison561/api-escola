<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class turma extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome'
    ];

    public function alunos()
    {
        return $this->belongsToMany(User::class, 'aluno_classe', 'turma_id', 'user_id');
    }

    public function turma_materia()
    {
        return $this->belongsToMany(professor_disciplina::class, 'turma_materias', 'turma_id', 'materia_id');
    }

    public static function rules(){
        return [
            'nome' => 'required|max:50',
        ];
    }

    public static function feedback(){
     
        return [
            'required' => 'O campo é requirido',
            'max' => 'A quantidade maxima de caracteres é 50',
        ];
    }
}
