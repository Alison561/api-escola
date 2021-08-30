<?php

namespace App\Http\Controllers;

use App\Models\material_aulas;
use App\Models\professor_disciplina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

// classe que cria os materiais de aulas para os alunos

class MaterialAulasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ainda não tem precisão de listar todos os materiais de aulas de todas as disciplinas
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
        $profDisci = professor_disciplina::find($request->materia_id);

        $arq = $request->file('arquivo');
        $request->validate(material_aulas::rules(), material_aulas::feedback());
       
        Gate::authorize('prof', $profDisci);

        $arq = $arq->store('material_aulas');
        material_aulas::create(['nome' => $request->nome,
                                'arquivo' => $arq, 
                                'materia_id' => $request->materia_id
                                ]);
        return response()->json(['msg'=>'A atividade foi adicionada co sucesso']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\material_aulas  $material_aulas
     * @return \Illuminate\Http\Response
     */
    public function show($material_aulas)
    {
        // lista todos os materiais de aula de uma determinada disciplina
        $tm = material_aulas::where('materia_id', $material_aulas)->get();

        if(empty($tm)){
            return response()->json(['msg' => 'materia não existe'], 404);
        }else {
            return response()->json($tm);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\material_aulas  $material_aulas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $material_aulas)
    {
        $profDisci = professor_disciplina::find($request->materia_id);
        $arq = $request->file('arquivo');
        $tm = material_aulas::find($material_aulas);
        $request->validate(material_aulas::rules(), material_aulas::feedback());
        
        Gate::authorize('prof', $profDisci);
        
        if(empty($tm)){
            return response()->json(['msg' => 'Atividade não existe'], 404);
        }else {

            if ($arq != null) {

                Storage::disk('local')->delete($tm->arquivo);
                $arq = $arq->store('material_aulas');

                $tm->update([   'nome' => $request->nome,
                                'arquivo' => $arq, 
                                'materia_id' => $request->materia_id
                            ]);

                return response()->json(['msg' => 'Atividade atualizada com sucesso']);
            } else {
                
                $tm->update([   'nome' => $request->nome,
                                'arquivo' => $tm->arquivo, 
                                'materia_id' => $request->materia_id
                            ]);
                return response()->json(['msg' => 'Atividade atualizada com sucesso']);
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\material_aulas  $material_aulas
     * @return \Illuminate\Http\Response
     */
    public function destroy($material_aulas)
    {
        $tm = material_aulas::find($material_aulas);

        if(empty($tm)){
            return response()->json(['msg' => 'Atividade não existe'], 404);
        }else {
            $profDisci = professor_disciplina::find($tm->materia_id);

            Gate::authorize('prof', $profDisci);
            $tm->delete();
            return response()->json(['msg' => 'Atividade excluida com sucesso']);
        }
    }
}
