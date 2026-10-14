<?php

namespace App\Filament\Widgets;

use App\Models\Cliente;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ClienteOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $total = Cliente::count();
        return [
            Stat::make('Clientes', $total)->description('Numero total de Clientes'),
        ];
    }
}
