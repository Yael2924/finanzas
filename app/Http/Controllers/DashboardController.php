<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $tablesExist = Schema::hasTable('ingresos')
            && Schema::hasTable('egresos')
            && Schema::hasTable('meta_ahorro')
            && Schema::hasTable('cat_ingresos')
            && Schema::hasTable('cat_egresos');

        if (! $tablesExist) {
            return view('dashboard', [
                'totalIngresos' => 0,
                'totalEgresos' => 0,
                'totalMetas' => 0,
                'totalCategoriasIngresos' => 0,
                'totalCategoriasEgresos' => 0,
                'ultimosMovimientos' => collect(),
                'metas' => collect(),
                'limites' => collect(),
                'resumenPorCategoria' => collect(),
            ]);
        }

        $totalIngresos = (float) DB::table('ingresos')->sum('monto');
        $totalEgresos = (float) DB::table('egresos')->sum('monto');
        $totalMetas = (float) DB::table('meta_ahorro')->sum('saldo');
        $totalCategoriasIngresos = DB::table('cat_ingresos')->count();
        $totalCategoriasEgresos = DB::table('cat_egresos')->count();

        $ultimosMovimientos = collect();
        $ingresos = DB::table('ingresos')
            ->select('monto', 'concepto as nombre', 'fecha', DB::raw("'INGRESO' as tipo"))
            ->get();
        $egresos = DB::table('egresos')
            ->select('monto', 'concepto as nombre', 'fecha', DB::raw("'EGRESO' as tipo"))
            ->get();

        foreach ($ingresos as $item) {
            $ultimosMovimientos->push($item);
        }

        foreach ($egresos as $item) {
            $ultimosMovimientos->push($item);
        }

        $ultimosMovimientos = $ultimosMovimientos
            ->sortByDesc('fecha')
            ->take(6)
            ->values();

        $metas = DB::table('meta_ahorro')
            ->select('id', 'nombre', 'monto_meta', 'saldo')
            ->orderBy('id')
            ->get();

        $limites = DB::table('limite as l')
            ->join('cat_egresos as c', 'c.id', '=', 'l.id_cat')
            ->select('l.id', 'l.monto', 'l.mes', 'c.nombre as categoria')
            ->orderBy('l.mes', 'desc')
            ->get();

        $resumenPorCategoria = DB::table('cat_egresos as c')
            ->leftJoin('egresos as e', 'e.id_cat', '=', 'c.id')
            ->select('c.nombre as categoria', DB::raw('COALESCE(SUM(e.monto), 0) as total'))
            ->groupBy('c.id', 'c.nombre')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalIngresos',
            'totalEgresos',
            'totalMetas',
            'totalCategoriasIngresos',
            'totalCategoriasEgresos',
            'ultimosMovimientos',
            'metas',
            'limites',
            'resumenPorCategoria'
        ));
    }
}
