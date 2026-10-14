<?php

namespace App\Filament\Resources\Ventas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class VentaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('codigo')
                    ->required(),
                Select::make('cliente_id')
                    ->relationship('cliente', 'nombre')
                    ->required(),
                DatePicker::make('fecha_venta')
                    ->required(),
                Select::make('estado')
                    ->options(['pendiente' => 'Pendiente', 'completada' => 'Completada', 'anulada' => 'Anulada'])
                    ->default('pendiente')
                    ->required(),
                TextInput::make('total')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Textarea::make('observaciones')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
