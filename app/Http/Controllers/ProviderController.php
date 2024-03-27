<?php

namespace App\Http\Controllers;

use App\Models\Dato;
use App\Models\Provider;
use App\Http\Requests\Provider\StoreRequest;
use App\Http\Requests\Provider\UpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProviderController extends Controller
{

    public function index()
    {
        $perPage = 10; // Número de elementos por página

        $dato = Provider::with('datos')->get();
        $providers = Provider::paginate($perPage);

        return response()->json([
            'Proveedores' => $providers->items(),
            'total' => $providers->total(),
            'pagina_actual' => $providers->currentPage(),
        ], 200);
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

            $provider = Provider::create([

                'dato_id' =>$dato->id,
            ]);



            return response()->json(['message' => 'Proveedor creado con éxito', 'providers' => $provider], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }





    public function update(UpdateRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();

            $providers = Provider::findOrFail($id);


            $providers->dato->update([
                'name' => $validatedData['name'],
                'document' => $validatedData['document'],
                'city' => $validatedData['city'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'address' => $validatedData['address'],
            ]);

            return response()->json(['message' => 'Proveedor actualizado con éxito', 'providers' => $providers], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Proveedor no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        try {
            $provider = Provider::findOrFail($id);

            $provider->datos()->delete();
            $provider->delete();

            return response()->json(['message' => 'Proveedor eliminado con éxito'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Proveedor no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
