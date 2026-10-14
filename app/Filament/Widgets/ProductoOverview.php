<?php

namespace App\Filament\Widgets;

use App\Models\Producto;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProductoOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $total = Producto::count();
        return [
            Stat::make('Productos', $total)->description('Numero total de Productos'),
        ];
    }
}
