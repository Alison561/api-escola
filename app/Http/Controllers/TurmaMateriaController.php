<?php

namespace App\Http\Controllers;

use App\Models\disciplina;
use App\Models\professor_disciplina;
use App\Models\turma;
use Illuminate\Support\Facades\Gate;
use App\Models\turma_materia;
use Illuminate\Http\Request;

class TurmaMateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $turm = turma::with('turma_materia')->get();

        return response()->json($turm);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(turma_materia::rules(), turma_materia::feedback());
        turma_materia::create($request->all(['turma_id', 'materia_id']));
        return response()->json(['msg' => 'A materia foi adicionada na turma']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\turma_materia  $turma_materia
     * @return \Illuminate\Http\Response
     */
    public function show($turma)
    {
        $tm = turma::with('turma_materia')->find($turma);
        $data = array();
        foreach ($tm->turma_materia as $key => $value) {
            $pd = professor_disciplina::with(['user', 'disciplina'])->find($value->id);
            array_push($data, $pd);
        }
        $tm->turmas = array($data);
        unset($tm->turma_materia);
        // array_push($tm->turma_materia, $data);
        return response()->json($tm);
    }


    public function update(Request $request, $turma_materia)
    {
        $tm = turma_materia::find($turma_materia);
        $tm->update($request->all('turma_id', 'materia_id'));
        return response()->json(['msg' => 'A turma e a disciplina foi atualizada']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\turma_materia  $turma_materia
     * @return \Illuminate\Http\Response
     */
    public function destroy($turma_materia)
    {
        $tm = turma_materia::find($turma_materia);
        $tm->delete();
    }
}
