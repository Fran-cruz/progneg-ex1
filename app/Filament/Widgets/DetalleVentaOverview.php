<?php

namespace App\Filament\Widgets;

use App\Models\DetalleVenta;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DetalleVentaOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $total = DetalleVenta::count();
        return [
            Stat::make('Detalle Ventas', $total)->description('Numero total de Detalle Ventas'),
        ];
    }
}
