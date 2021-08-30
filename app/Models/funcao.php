<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class funcao extends Model
{
    use HasFactory;
    protected $table = 'funcao';
    protected $fillable = [
        'nome'
    ];

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
