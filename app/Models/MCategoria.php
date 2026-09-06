<?php
/* ================================
        MODELO CATEGORIA
================================ */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class MCategoria extends Model
{
    use HasFactory;
    protected $table = 'categoria';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // MÉTODO PARA LA BÚSQUEDA
    public static function allByCriterio($criterio)
    {
        $catetorias = DB::table('categoria as c')
            ->select('*')
            ->where(function ($q) use ($criterio) {
                $q->where('c.nombre', 'LIKE', '%' . $criterio . '%');
                $q->orWhere('c.descripcion', 'LIKE', '%' . $criterio . '%');
                $q->orWhere('c.ubicacion', 'LIKE', '%' . $criterio . '%');
            })
            ->where('c.estado', '=', 1)
            ->get();
        return $catetorias;
    }
}
