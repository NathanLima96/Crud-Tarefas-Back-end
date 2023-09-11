<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SubTarefa;

class SubTarefaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function getall()
    {
        return response()->json(SubTarefa::all());
    }

    public function get(Request $request, $id)
    {
        try {
            return response()->json(SubTarefa::findOrFail($id)->fill($request->all()));
        } catch (\Throwable $th) {
            return response()->json(["message" => "SubTarefa não encontrada"]);
        }
    }

    public function create(Request $request)
    {
        try {
            $subtarefa = SubTarefa::create([
                'id_tarefa' => $request->input('id_tarefa'),
                'description' => $request->input('description'),
                'status' => $request->input('status'),
            ]);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Erro ao criar SubTarefa"]);
        }

        return response()->json(["message" => "Sub-Tarefa Criada!", "Sub-Tarefa" => $subtarefa]);
    }

    public function update(Request $request, $id)
    {
        try {
            $subtarefa = SubTarefa::findOrFail($id)->fill($request->all());
            $subtarefa->update();
        } catch (\Throwable $th) {
            return response()->json(["message" => "Erro ao atualizar a Subtarefa"]);
        }
        return response()->json(["message" => "Sub-Tarefa Updated!", "Sub-Tarefa" => $subtarefa]);
    }

    public function delete($id)
    {
        try {
            SubTarefa::findOrFail($id)->delete();
        } catch (\Throwable $th) {
            return response()->json(["message" => "SubTarefa não encontrada para deletar"]);
        }
        return response()->json(["message" => "Sub-Tarefa deleted!"]);
    }
}
