<?php

namespace App\Http\Controllers;

use App\Models\aluno_classe;
use App\Models\professor_disciplina;
use App\Models\turma;
use App\Models\User;
use Illuminate\Http\Request;

class AlunoClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['msg'=>'pagina não existe'],404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(professor_disciplina::rules(), professor_disciplina::feedback());
        $user = User::where('funcao_id', 1)->find($request->user_id);
        if(empty($user)){
            return response()->json(['msg' => 'Essa ação não é autorizada para esse tipo de usuario'], 401);
        }else {
            aluno_classe::create($request->all('turma_id', 'user_id'));
            return response()->json(['msg' => 'O aluno(a) foi adicionado a classe']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\aluno_classe  $aluno_classe
     * @return \Illuminate\Http\Response
     */
    public function show($aluno_classe)
    {
        $classe = turma::with('alunos:id,name,email')->find($aluno_classe);
        return response()->json($classe);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\aluno_classe  $aluno_classe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $classe = professor_disciplina::find($id);
        $request->validate(professor_disciplina::rules(), professor_disciplina::feedback());
        $user = User::where('funcao_id', 1)->find($request->user_id);
        if(empty($user)){
            return response()->json(['msg' => 'Essa ação não é autorizada para esse tipo de usuario'], 401);
        }else {
            $classe->update($request->all('turma_id', 'user_id'));
            return response()->json(['msg' => 'O aluno(a) foi adicionado a uma nova classe']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\aluno_classe  $aluno_classe
     * @return \Illuminate\Http\Response
     */
    public function destroy($aluno_classe)
    {
        $classe = professor_disciplina::find($aluno_classe);
        $classe->delete();
    }
}
