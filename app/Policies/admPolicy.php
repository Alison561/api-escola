<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class admPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    // autorização só para usuario do tipo admin
    public function autorizacaoAdmin(User $user){
        return $user->funcao_id === 3 ? Response::allow()
        : Response::deny('Você não é autorizado');
    }
}
