<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\StoreRequest;
use App\Http\Requests\Client\UpdateRequest;
use App\Models\Client;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::all();
        return response()->json(['clients' => $clients], 200);
    }

    public function store(StoreRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $clients = new Client($validatedData);
            $clients->save();

            return response()->json(['message' => 'Cliente creado con éxito', 'clients' => $clients], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateRequest $request, $id){
        try {
            $clients = Client::findOrFail($id);
            $validatedData = $request->validated();


            $clients->fill($validatedData);
            $clients->save();

            return response()->json(['message' => 'Cliente actualizado con éxito', 'clients' => $clients], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        try {
            $client = Client::findOrFail($id);

            $client->delete();

            return response()->json(['message' => 'Cliente eliminado con éxito'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'cliente no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
