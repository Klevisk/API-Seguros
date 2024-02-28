<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Http\Requests\Provider\StoreRequest;
use App\Http\Requests\Provider\UpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProviderController extends Controller
{

    public function index()
    {
        $perPage = 10; // Número de elementos por página

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

            $providers = new Provider($validatedData);
            $providers->save();

            return response()->json(['message' => 'Proveedor creado con éxito', 'providers' => $providers], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $providers = Provider::findOrFail($id);
            $validatedData = $request->validated();


            $providers->fill($validatedData);
            $providers->save();

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

            $provider->delete();

            return response()->json(['message' => 'Proveedor eliminado con éxito'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Proveedor no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
