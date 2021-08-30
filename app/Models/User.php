<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    public function disciplina(){
        return $this->belongsToMany(disciplina::class, 'professor_disciplina', 'disciplina_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'funcao_id',
        'serei'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public static function rules(){
        return [
            'name' => 'required|max:200',
            'email' => 'required|email',
            'password' => 'required|min:4',
            'funcao_id' => 'required|exists:funcao,id',
            'serei' => 'interge',
        ];
    }

    public static function feedback(){
     
        return [
            'required' => 'O campo é requirido',
            'email' => 'O campo tem que ser um email',
            'min' => 'A quantindade minima de caracteres é 4',
            'max' => 'A quantindade maxima de caracteres é 200',
            'exists' => 'A função selecionada não existe'
        ];
    }
}
