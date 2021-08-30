<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class material_aulas extends Model
{
    use HasFactory;

    protected $table = 'material_aulas';
    protected $fillable = ['nome', 'materia_id', 'arquivo'];


    

    public static function rules(){
        return [
            'nome' => 'required|max:100',
            'arquivo' => 'required|mimes:cvs,pdf,docx',
            'materia_id' => 'required|exists:professor_disciplina,id'
        ];
    }

    public static function feedback(){
     
        return [
            'required' => 'O campo é requirido',
            'max' => 'Quantidade mixima é de 100 caracteres',
            'mimes' => 'O formato é invalido',
            'exists' => 'A disciplina selecionada não existe'
        ];
    }
    
}
