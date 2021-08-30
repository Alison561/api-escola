<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\professor_disciplina;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\disciplina;

// classe que cria o relacionamento entre disciplinas e professores

class professorDisciplinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pd = user::with('disciplina:id,nome,img')->select(['id', 'name', 'email'])->where('funcao_id', 2)->get();
        return response()->json($pd);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('adm');
        $request->validate(professor_disciplina::rules(), professor_disciplina::feedback());

        $user = user::where('funcao_id', 2)->find($request->user_id);
        if(empty($user)){
            return response()->json(['msg' => 'Essa ação não é autorizada para esse tipo de usuario'], 401);
        }else {
            professor_disciplina::create($request->all());
            return response()->json(['msg' => 'materia cadastrada com sucesso']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        Gate::authorize('adm');
        $disciplina = disciplina::with('professores:id,name,email')->find($id);
        return response()->json($disciplina);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('adm');
        $profdisc = professor_disciplina::find($id);
        $request->validate(professor_disciplina::rules(), professor_disciplina::feedback());
        $user = user::where('funcao_id', 2)->find($request->user_id);
        if(empty($user)){
            return response()->json(['msg' => 'Essa ação não é autorizada para esse tipo de usuario'], 401);
        }else {
            $profdisc->update($request->all('user_id', 'disciplina_id'));
            return response()->json(['msg' => 'materia Atualizada com sucesso']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('adm');
        $profdisc = professor_disciplina::find($id);
        $profdisc->delete();
    }
}
