<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aluno_classe extends Model
{
    use HasFactory;
    protected $table = 'aluno_classe';
    protected $fillable = [
        'turma_id',
        'user_id'
    ];

    public static function rules(){
        return [
            'turma_id' => 'required|exists:turmas,id',
            'user_id' => 'required|exists:aluno_classe,id'
        ];
    }

    public static function feedback(){
     
        return [
            'required' => 'O campo é requirido',
            'turma_id.exists' => 'A turma selecionado não existe',
            'user_id.exists' => 'O aluno selecionado(a) não existe'
        ];
    }
}
