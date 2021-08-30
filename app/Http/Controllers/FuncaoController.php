<?php

namespace App\Http\Controllers;

use App\Models\funcao;
use Illuminate\Http\Request;

class FuncaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = funcao::all();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(funcao::rules(), funcao::feedback());
        funcao::create($request->all('nome'));
        return response()->json(['msg'=>'A função foi Criada com sucesso']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\funcao  $funcao
     * @return \Illuminate\Http\Response
     */
    public function show($funcao)
    {
        $funcao = funcao::find($funcao);

        if(empty($funcao)){
            return response()->json(['msg' => 'A função não existe'], 404);
        }else {
            return response()->json($funcao);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\funcao  $funcao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $funcao)
    {
        $funcao = funcao::find($funcao);

        $request->validate(funcao::rules(), funcao::feedback());
        
        if(empty($funcao)){
            return response()->json(['msg' => 'A função não existe'], 404);
        }else {
            $funcao->update($request->all('nome'));
            return response()->json(['msg' => 'A função foi atualizada com sucesso']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\funcao  $funcao
     * @return \Illuminate\Http\Response
     */
    public function destroy($funcao)
    {
        $funcao = funcao::find($funcao);

        if(empty($funcao)){
            return response()->json(['msg' => 'A função não existe'], 404);
        }else {
            $funcao->delete();
            return response()->json(['msg' => 'A função excluida com sucesso']);
        }
    }
}
