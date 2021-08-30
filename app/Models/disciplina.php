<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class disciplina extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'img'];

    public static function rules(){
        return [
            'nome' => 'required|max:50',
            'img' => 'required|mimes:jpg,jpeg,png',
        ];
    }

    public function professores(){
        return $this->belongsToMany(user::class, 'professor_disciplina', 'user_id');
    }

    public static function feedback(){
     
        return [
            'required' => 'O campo é requirido',
            'max' => 'Quantidade mixima é de 50 caracteres',
            'mimes' => 'O formato é invalido',
        ];
    }
}
