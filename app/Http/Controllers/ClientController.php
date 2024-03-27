<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\StoreRequest;
use App\Http\Requests\Client\UpdateRequest;
use App\Models\Client;
use App\Models\Dato;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::with('datos')->get();

        // dd($clients);
        return response()->json(['clients' => $clients], 200);
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

            $client = Client::create([
                'user_id' => $validatedData['user_id'],
                'dato_id' => $dato->id,
            ]);

            return response()->json(['message' => 'Cliente creado con éxito', 'clients' => $client], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $client = Client::findOrFail($id);
            $validatedData = $request->validated();
            // dd($validatedData);
            $client->update([
                'user_id' => $validatedData['user_id'],
            ]);


            if (isset($validatedData['name']) || isset($validatedData['document']) || isset($validatedData['city']) || isset($validatedData['phone']) || isset($validatedData['email']) || isset($validatedData['address'])) {

                $client->datos()->update([
                    'name' => $validatedData['name'],
                    'document' => $validatedData['document'],
                    'city' => $validatedData['city'],
                    'phone' => $validatedData['phone'],
                    'email' => $validatedData['email'],
                    'address' => $validatedData['address'],
                ]);
            }

            return response()->json(['message' => 'Cliente actualizado con éxito', 'client' => $client], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        try {
            $client = Client::findOrFail($id);

            $client->datos()->delete();

            $client->delete();

            return response()->json(['message' => 'Cliente eliminado con éxito'], 200);
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'Cliente no encontrado'], 404);
        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
