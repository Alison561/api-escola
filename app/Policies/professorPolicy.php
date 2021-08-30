<?php

namespace App\Policies;

use App\Models\professor_disciplina;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class professorPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */

    public function autorizacaoMaterialAulas(User $user, professor_disciplina $materia)
    {
        return $user->id === $materia->user_id ? Response::allow()
        : Response::deny('Você não é autorizado para realizar essa função');
    }
}