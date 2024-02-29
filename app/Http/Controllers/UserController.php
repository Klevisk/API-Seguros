<?php

namespace App\Http\Controllers;


use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json(['Usuarios' => $users], 200);
    }

    public function store(StoreRequest $request)
    {
        try {
            $validatedData = $request->validated();


            $users = new User($validatedData);
            $users->save();

            return response()->json(['message' => 'Usuario creado con éxito', 'users' => $users], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateRequest $request, $id){
        try {
            $users = User::findOrFail($id);
            $validatedData = $request->validated();


            $users->fill($validatedData);
            $users->save();

            return response()->json(['message' => 'Usuario actualizado con éxito', 'users' => $users], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        try {
            $users = User::findOrFail($id);

            $users->delete();

            return response()->json(['message' => 'Usuario eliminado con éxito'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
