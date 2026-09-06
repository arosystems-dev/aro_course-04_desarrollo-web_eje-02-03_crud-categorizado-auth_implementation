<?php
/* ================================
        CONTROL REPORTE
================================ */

namespace App\Http\Controllers;

use App\Models\MArticulo;
use FPDF as Fpdf;

class CReporte extends Controller
{
    public function reporteStock()
    {
        $pdf = new Fpdf('P', 'mm', 'Letter');
        $articulos = MArticulo::reporteStock();
        return view('reporte.VReportStock', ['pdf' => $pdf, 'articulos' => $articulos]);
    }
}
