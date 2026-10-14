<?php

namespace App\Filament\Widgets;

use App\Models\Proveedor;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProveedorOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $total = Proveedor::count();
        return [
            Stat::make('Proveedors', $total)->description('Numero total de Proveedors'),
        ];
    }
}


