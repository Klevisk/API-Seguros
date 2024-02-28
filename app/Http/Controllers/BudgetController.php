<?php

namespace App\Http\Controllers;

use App\Models\budget;
use App\Http\Requests\Budget\StoreRequest;
use App\Http\Requests\Budget\UpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BudgetController extends Controller
{
    public function index()
    {
        $budgets = Budget::all();
        return response()->json(['Presupuestos' => $budgets], 200);
    }

    public function store(StoreRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $budgets = new Budget($validatedData);
            $budgets->save();

            return response()->json(['message' => 'Presupuesto creado con éxito', 'budgets' => $budgets], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateRequest $request, $id){
        try {
            $budgets = Budget::findOrFail($id);
            $validatedData = $request->validated();


            $budgets->fill($validatedData);
            $budgets->save();

            return response()->json(['message' => 'Presupuesto actualizado con éxito', 'budgets' => $budgets], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Presupuesto no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        try {
            $budgets = Budget::findOrFail($id);

            $budgets->delete();

            return response()->json(['message' => 'Presupuesto eliminado con éxito'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Presupuesto no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
