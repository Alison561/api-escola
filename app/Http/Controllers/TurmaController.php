<?php

namespace App\Http\Controllers;

use App\Models\turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TurmaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(turma::all());
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
        $request->validate(turma::rules(), turma::feedback());
        turma::create($request->all('nome'));
        return response()->json(['msg'=>'A turma foi Criada com sucesso']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\turma  $turma
     * @return \Illuminate\Http\Response
     */
    public function show($turma)
    {
        $tm = turma::find($turma);

        if(empty($tm)){
            return response()->json(['msg' => 'Turma não existe'], 404);
        }else {
            return response()->json($tm);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\turma  $turma
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $turma)
    {
        $tm = turma::find($turma);

        $request->validate(turma::rules(), turma::feedback());
        
        if(empty($tm)){
            return response()->json(['msg' => 'Turma não existe'], 404);
        }else {
            $tm->update($request->all('nome'));
            return response()->json(['msg' => 'Turma atualizada com sucesso']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\turma  $turma
     * @return \Illuminate\Http\Response
     */
    public function destroy($turma)
    {
        Gate::authorize('adm');

        $tm = turma::find($turma);

        if(empty($tm)){
            return response()->json(['msg' => 'Turma não existe'], 404);
        }else {
            $tm->delete();
            return response()->json(['msg' => 'Turma excluida com sucesso']);
        }
    }
}
