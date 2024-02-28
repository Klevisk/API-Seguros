<?php

namespace App\Http\Controllers;

use App\Models\Family_client;
use App\Http\Requests\Family\StoreRequest;
use App\Http\Requests\Family\UpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FamilyClientController extends Controller
{

    public function index()
    {
        $family = Family_client::all();
        return response()->json(['Familiares' => $family], 200);
    }


    public function store(StoreRequest $request)
    {

        try {
            $validatedData = $request->validated();

            $family = new Family_client($validatedData);
            $family->save();

            return response()->json(['message' => 'Familiar creado con éxito', 'family' => $family], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $family = Family_client::findOrFail($id);
            $validatedData = $request->validated();


            $family->fill($validatedData);
            $family->save();

            return response()->json(['message' => 'Familiar actualizado con éxito', 'family' => $family], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Familiar no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $family = Family_client::findOrFail($id);

            $family->delete();

            return response()->json(['message' => 'Familiar eliminado con éxito'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Familiar no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
