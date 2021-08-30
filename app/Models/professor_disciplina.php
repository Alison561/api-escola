<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class professor_disciplina extends Model
{
    use HasFactory;
    
    protected $table = 'professor_disciplina';
    
    protected $fillable = [
        'user_id',
        'disciplina_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function disciplina()
    {
        return $this->belongsTo(disciplina::class, 'disciplina_id', 'id');
    }

    public static function rules(){
        return [
            'user_id' => 'required|exists:users,id',
            'disciplina_id' => 'required|exists:disciplinas,id'
        ];
    }

    public static function feedback(){
     
        return [
            'required' => 'O campo é requirido',
            'user_id.exists' => 'A usuario selecionado não existe',
            'disciplina_id.exists' => 'A disciplina selecionada não existe'
        ];
    }
}
