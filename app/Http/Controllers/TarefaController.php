<?php

namespace App\Http\Controllers;

use App\Models\SubTarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Tarefa;

class TarefaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function getFromId(Request $request, $id)
    {
        try {
            $tarefa = Tarefa::find($id);
            $tarefa->subs;
        } catch (\Throwable $th) {
            return response()->json(["message" => "Tarefa não encontrada"]);
        }
        return $tarefa;
    }



    public function getAll(Request $request)
    {
        $tarefas = Tarefa::all();
        $tarefas->load('subs');
        return $tarefas;
    }

    public function get(Request $request, $id)
    {
        return response()->json(Tarefa::findOrFail($id)->fill($request->all()));
    }


    public function create(Request $request)
    {
        try {
            $tarefa = Tarefa::create([
                'titulo' => $request->input('titulo'),
                'description' => $request->input('description'),
                'data_vencimento' => $request->input('data_vencimento'),
                'status' => $request->input('status'),
            ]);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Erro ao criar tarefa"]);
        }
        return response()->json(["message" => "Tarefa Criada!", "Tarefa" => $tarefa]);
    }

    public function update(Request $request, $id)
    {
        try {
            $tarefa = Tarefa::findOrFail($id)->fill($request->all());
            if ($request->has('status')) {
                $tarefa->subs()->update(["status" => $request->input('status')]);
            }
            $tarefa->update();
        } catch (\Throwable $th) {
            return response()->json(["message" => "Erro ao atualizar a tarefa"]);
        }
        return response()->json(["message" => "Tarefa Updated!", "Tarefa" => $tarefa]);
    }

    public function delete($id)
    {
        try {
            $tarefa = Tarefa::findOrFail($id);
            $tarefa->subs()->delete();
            $tarefa->delete();
        } catch (\Throwable $th) {
            return response()->json(["message" => "Tarefa não encontrada para deletar"]);
        }
        return response()->json(["message" => "Tarefa deleted!"]);
    }

    public function getByDate(Request $request, $date)
    {
        try {
            $tarefas = Tarefa::where('data_vencimento', $date)->get();
            $tarefas->load('subs');
        } catch (\Throwable $th) {
            return response()->json(["message" => "Erro ao buscar tarefas pela data"], 500);
        }
        
        return response()->json($tarefas);
    }
    
}
