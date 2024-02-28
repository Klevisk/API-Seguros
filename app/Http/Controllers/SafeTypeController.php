<?php

namespace App\Http\Controllers;

use App\Models\Safe_type;
use App\Http\Requests\Safe\StoreRequest;
use App\Http\Requests\Safe\UpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SafeTypeController extends Controller
{

    public function index()
    {
        $safetypes = Safe_type::all();
        return response()->json(['Tipos de seguros' => $safetypes], 200);
    }



    public function store(StoreRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $safetypes = new Safe_type($validatedData);
            $safetypes->save();

            return response()->json(['message' => 'Tipo de seguro creado con éxito', 'safetypes' => $safetypes], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function update(UpdateRequest $request, $id)
    {

        try {
            $safetypes = Safe_type::findOrFail($id);
            $validatedData = $request->validated();


            $safetypes->fill($validatedData);
            $safetypes->save();

            return response()->json(['message' => 'Tipo de seguro actualizado con éxito', 'safetypes' => $safetypes], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Tipo de seguro no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }


    public function destroy($id)
    {
        try {
            $safetypes = Safe_type::findOrFail($id);

            $safetypes->delete();

            return response()->json(['message' => 'Tipo de seguro eliminado con éxito'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Tipo de seguro no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
