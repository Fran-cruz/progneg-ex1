<?php

namespace App\Filament\Resources\DetalleVentas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DetalleVentaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('venta_id')
                    ->relationship('venta', 'codigo')
                    ->required(),
                Select::make('producto_id')
                    ->relationship('producto', 'nombre')
                    ->required(),
                TextInput::make('cantidad')
                    ->required()
                    ->numeric()
                    ->default(1),
                TextInput::make('precio_unitario')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('subtotal')
                    ->required()
                    ->numeric()
                    ->default(0.0),
            ]);
    }
}
