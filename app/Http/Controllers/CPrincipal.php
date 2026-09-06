<?php
/* ================================
        CONTROL PRINCIPAL
================================ */

namespace App\Http\Controllers;

use App\Models\MArticulo;
use App\Models\MCategoria;

class CPrincipal extends Controller
{
    public function showVDashboard()
    {
        $articulos = MArticulo::reporteGrafico();
        $cantidadA = MArticulo::all()->where('estado', 1)->count();
        $cantidadC = MCategoria::all()->where('estado', 1)->count();
        return view('principal.VDashboard', [
            'cantidadA' => $cantidadA,
            'cantidadC' => $cantidadC,
            'nombres' => $articulos->pluck('nombre'),
            'stocks' => $articulos->pluck('stock')
        ]);
    }
}
