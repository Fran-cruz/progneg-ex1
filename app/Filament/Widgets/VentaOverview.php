<?php

namespace App\Filament\Widgets;

use App\Models\Venta;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class VentaOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $total = Venta::count();
        $completadas = Venta::where('estado', 'completada')->count();
        $pendiente = Venta::where('estado', 'pendiente')->count();
        return [
            Stat::make('Ventas', $total)->description('Numero total de Ventas'),
            Stat::make('Ventas', $completadas)->description('Ventas Completadas'),
            Stat::make('Ventas', $pendiente)->description('Ventas Pendiente'),
        ];
    }
}


