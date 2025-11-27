<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Cupon;
use Illuminate\Http\Request;

class CuponController extends Controller
{
    // LISTAR CUPONES
    public function index(Request $request)
    {
        $search = $request->input('search');

        $cupones = Cupon::when($search, function ($query) use ($search) {
            $query->where('codigo', 'like', "%$search%")
                  ->orWhere('descripcion', 'like', "%$search%");
        })->orderBy('id', 'desc')->get();

        return view('admin.cupones.index', compact('cupones', 'search'));
    }

    // FORMULARIO CREAR
    public function create()
    {
        return view('admin.cupones.create');
    }

    // GUARDAR
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:cupones,codigo',
            'tipo' => 'required|in:porcentaje,monto',
            'valor' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string|max:255',
            'compra_minima' => 'nullable|numeric|min:0',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'limite_uso' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        $data['activo'] = $request->has('activo');
        Cupon::create($data);

        return redirect()->route('admin.cupones.index')
            ->with('success', 'Cupón creado correctamente.');
    }

    // FORMULARIO EDITAR
    public function edit($id)
    {
        $cupon = Cupon::findOrFail($id);
        return view('admin.cupones.edit', compact('cupon'));
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
    {
        $cupon = Cupon::findOrFail($id);

        $request->validate([
            'codigo' => 'required|unique:cupones,codigo,' . $cupon->id,
            'tipo' => 'required|in:porcentaje,monto',
            'valor' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string|max:255',
            'compra_minima' => 'nullable|numeric|min:0',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'limite_uso' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        $data['activo'] = $request->has('activo');
        $cupon->update($data);

        return redirect()->route('admin.cupones.index')
            ->with('success', 'Cupón actualizado correctamente.');
    }

    // ELIMINAR
    public function destroy($id)
    {
        $cupon = Cupon::findOrFail($id);
        $cupon->delete();

        return redirect()->route('admin.cupones.index')
            ->with('success', 'Cupón eliminado correctamente.');
    }

    //  ACTIVAR / DESACTIVAR
    public function toggleActivo($id)
    {
        $cupon = Cupon::findOrFail($id);
        $cupon->activo = !$cupon->activo;
        $cupon->save();

        return back();
    }
}
