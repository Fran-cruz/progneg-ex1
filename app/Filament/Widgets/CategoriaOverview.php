<?php

namespace App\Filament\Widgets;

use App\Models\Categoria;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CategoriaOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $total = Categoria::count();
        return [
            Stat::make('Categorias', $total)->description('Numero total de categorias'),
        ];
    }
}
