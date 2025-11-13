<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // LISTAR CATEGORÍAS
    public function index()
    {
        $categorias = Categoria::orderBy('id', 'desc')->get();

        return view('admin.categorias.index', compact('categorias'));
    }

    // MOSTRAR FORMULARIO DE CREACIÓN
    public function create()
    {
        return view('admin.categorias.create');
    }

    // GUARDAR NUEVA CATEGORÍA
    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'activo'      => 'nullable|boolean',
        ]);

        Categoria::create([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
            'activo'      => $request->has('activo'),
        ]);

        return redirect()->route('admin.categorias.index')
            ->with('success', 'Categoría creada correctamente.');
    }

    // MOSTRAR FORMULARIO DE EDICIÓN
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('admin.categorias.edit', compact('categoria'));
    }

    // ACTUALIZAR CATEGORÍA
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre'      => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'activo'      => 'nullable|boolean',
        ]);

        $categoria = Categoria::findOrFail($id);

        $categoria->update([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
            'activo'      => $request->has('activo'),
        ]);

        return redirect()->route('admin.categorias.index')
            ->with('success', 'Categoría actualizada correctamente.');
    }
    // ELIMINAR CATEGORÍA
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('admin.categorias.index')
            ->with('success', 'Categoría eliminada correctamente.');
    }
}
