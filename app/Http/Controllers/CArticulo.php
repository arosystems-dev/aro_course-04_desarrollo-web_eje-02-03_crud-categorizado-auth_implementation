<?php
/* ================================
        CONTROL ARTICULO
================================ */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RArticulo;
use App\Models\MArticulo;
use App\Models\MCategoria;
use Illuminate\Support\Facades\Redirect;

class CArticulo extends Controller
{
    public function index()
    {
        $articulos = MArticulo::allCompleto();
        return view('gestion.articulo.VIndex', ['articulos' => $articulos]);
    }


    public function search(Request $request)
    {
        $articulos = MArticulo::allByCriterio($request->criterio);
        return view('gestion.articulo.VIndex', ['articulos' => $articulos]);
    }


    public function create()
    {
        $categorias = MCategoria::all()->where('estado', 1);
        return view('gestion.articulo.VCreate', ['categorias' => $categorias]);
    }


    public function store(RArticulo $request)
    {
        $articulo = new MArticulo();
        $articulo->codigo = $request->codigo;
        $articulo->nombre = $request->nombre;
        $articulo->idCategoria = $request->categoria;
        $articulo->stock = $request->stock;

        $file = $request->foto;
        if ($file) {
            $nombre = $file->getClientOriginalName();
            $file->move('img/articulos', $nombre);
            $articulo->foto = $nombre;
        }
        $articulo->estado = 1;
        $articulo->save();
        return Redirect::to('/articulo/index');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $articulo = MArticulo::find($id);
        $categorias = MCategoria::all()->where('estado', 1);
        return view('gestion.articulo.VEdit', ['articulo' => $articulo, 'categorias' => $categorias]);
    }


    public function update(RArticulo $request, string $id)
    {
        $articulo = MArticulo::find($id);
        $articulo->codigo = $request->codigo;
        $articulo->nombre = $request->nombre;
        $articulo->idCategoria = $request->categoria;
        $articulo->stock = $request->stock;

        $file = $request->foto;
        if ($file) {
            $nombre = $file->getClientOriginalName();
            $file->move('img/articulos', $nombre);
            $articulo->foto = $nombre;
        }
        $articulo->estado = 1;
        $articulo->update();
        return Redirect::to('/articulo/index');
    }


    public function destroy(string $id)
    {
        $articulo = MArticulo::find($id);
        $articulo->estado = 0;
        $articulo->update();
        return Redirect::to('/articulo/index');
    }
}
