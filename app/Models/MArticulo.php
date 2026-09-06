<?php
/* ================================
        MODELO ARTICULO
================================ */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class MArticulo extends Model
{
    use HasFactory;
    protected $table = 'articulo';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // MÉTODO PARA EL INDEX
    public static function allCompleto()
    {
        $articulos = DB::table('articulo as a')
            ->join('categoria as c', 'c.id', '=', 'a.idCategoria')
            ->select('a.id as id', 'a.foto as foto', 'a.codigo as codigo', 'a.nombre as nombre', 'c.nombre as categoria', 'a.stock')
            ->where('a.estado', '=', 1)
            ->orderBy('id', 'DESC')
            ->paginate(5);
        // ->get();
        return $articulos;
    }

    // MÉTODO PARA LA BÚSQUEDA
    public static function allByCriterio($criterio)
    {
        $articulos = DB::table('articulo as a')
            ->join('categoria as c', 'c.id', '=', 'a.idCategoria')
            ->select('a.id as id', 'a.foto as foto', 'a.codigo as codigo', 'a.nombre as nombre', 'c.nombre as categoria', 'a.stock')
            ->where(function ($q) use ($criterio) {
                $q->orWhere('a.codigo', 'LIKE', '%' . $criterio . '%');
                $q->orWhere('a.nombre', 'LIKE', '%' . $criterio . '%');
                $q->orWhere('a.stock', 'LIKE', '%' . $criterio . '%');
                $q->orWhere('c.nombre', 'LIKE', '%' . $criterio . '%');
            })
            ->where('a.estado', '=', 1)
            ->paginate(5);
        // ->get();
        return $articulos;
    }


    /* -----------------------
            REPORTES
    ----------------------- */

    // CONSULTA PARA EL DASHBOARD
    public static function reporteGrafico()
    {
        $articulos = DB::table('articulo')
            ->select('nombre', 'stock')
            ->where('estado', '=', 1)
            ->orderBy('stock', 'asc')
            ->take(8)
            ->get();
        return $articulos;
    }

    // CONSULTA PARA EL REPORTE PDF
    public static function reporteStock()
    {
        $articulos = DB::table('articulo')
            ->select('nombre', 'stock')
            ->where('estado', '=', 1)
            ->orderBy('stock', 'asc')
            ->get();
        return $articulos;
    }
}
