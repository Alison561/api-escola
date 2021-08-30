<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\disciplina;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class disciplinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return response()->json(disciplina::all());
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
        $img = $request->file('img');
        
        $request->validate(disciplina::rules(), disciplina::feedback());
        
        $img = $img->store('disciplinas');

        disciplina::create([
            'nome' => $request->nome,
            'img' => $img
        ]);

        return response()->json(['msg' => 'disciplina cadastrada']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(disciplina $disciplina)
    {
        return response()->json($disciplina);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, disciplina $disciplina)
    {
        Gate::authorize('adm');
        $img = $request->file('img'); 

        $request->validate(disciplina::rules(), disciplina::feedback());

        if($img != null){

            Storage::disk('local')->delete($disciplina->img);

            $img = $img->store('disciplinas');

            $disciplina->update([
                'nome' => $request->nome,
                'img' => $img
            ]);

            return response()->json(['msg' => 'disciplina atualizada']);

        }else {

            $disciplina->update([
                'nome' => $request->nome,
                'img' => $disciplina->img
            ]);

            return response()->json(['msg' => 'disciplina atualizada']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(disciplina $disciplina)
    {
        Gate::authorize('adm');
        Storage::disk('local')->delete($disciplina->img);
        $disciplina->delete();
        return response()->json(['msg'=>'disciplina escluida com sucesso']);
    }
}
