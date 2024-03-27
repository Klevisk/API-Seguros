<?php

namespace App\Http\Controllers;

use App\Models\Dato;
use App\Models\Client;
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

            $dato = Dato::create([
                'name' => $validatedData['name'],
                'document' => $validatedData['document'],
                'city' => $validatedData['city'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'address' => $validatedData['address'],
            ]);

            $family = Family_client::create([

                'client_id' => $validatedData['client_id'],
                'relationship' => $validatedData['relationship'],
                'dato_id' => $dato->id,

            ]);

            return response()->json(['message' => 'Familiar creado con éxito', 'family' => $family], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();

            $family = Family_client::findOrFail($id);

            $family->dato->update([
                'name' => $validatedData['name'],
                'document' => $validatedData['document'],
                'city' => $validatedData['city'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'address' => $validatedData['address'],
            ]);

            $family->update([
                'client_id' => $validatedData['client_id'],
                'relationship' => $validatedData['relationship'],
            ]);

            return response()->json(['message' => 'Familiar actualizado con éxito', 'family' => $family], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
{
    try {
        $family = Family_client::findOrFail($id);
        // $family->dato->delete();
        // $family->client->delete();
        $family->delete();

        return response()->json(['message' => 'Familiar eliminado con éxito'], 200);
    } catch (ModelNotFoundException $e) {
        return response()->json(['error' => 'Familiar no encontrado'], 404);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
}
