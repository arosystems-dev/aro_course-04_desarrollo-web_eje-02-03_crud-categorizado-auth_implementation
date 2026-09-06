<?php
/* ================================
        CONTROL CATEGORIA
================================ */

namespace App\Http\Controllers;

use App\Http\Requests\RCategoria;
use Illuminate\Http\Request;
use App\Models\MCategoria;
use Illuminate\Support\Facades\Redirect;

class CCategoria extends Controller
{

    public function index()
    {
        $categorias = MCategoria::where('estado', 1)->orderBy('id', 'DESC')->get();;
        return view('gestion.categoria.VIndex', ['categorias' => $categorias]);
    }


    public function search(Request $request)
    {
        $categorias = MCategoria::allByCriterio($request->criterio);
        return view('gestion.categoria.VIndex', ['categorias' => $categorias]);
    }


    public function create()
    {
        return view('gestion.categoria.VCreate');
    }


    public function store(RCategoria $request)
    {
        $categoria = new MCategoria();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->ubicacion = $request->ubicacion;
        $categoria->estado = 1;
        $categoria->save();
        return Redirect::to('/categoria/index');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $categoria = MCategoria::find($id);
        return view('gestion.categoria.VEdit', ['categoria' => $categoria]);
    }


    public function update(RCategoria $request, string $id)
    {
        $categoria = MCategoria::find($id);
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->ubicacion = $request->ubicacion;
        // $categoria->estado = 1;
        $categoria->update();
        return Redirect::to('/categoria/index');
    }


    public function destroy(string $id)
    {
        $categoria = MCategoria::find($id);
        $categoria->estado = 0;
        $categoria->update();
        return Redirect::to('/categoria/index');
    }
}
