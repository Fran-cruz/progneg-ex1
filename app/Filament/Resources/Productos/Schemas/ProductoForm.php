<?php

namespace App\Filament\Resources\Productos\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProductoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('codigo')
                    ->required(),
                TextInput::make('nombre')
                    ->required(),
                Textarea::make('descripcion')
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('categoria_id')
                    ->relationship('categoria', 'nombre')
                    ->required(),
                Select::make('proveedor_id')
                    ->relationship('proveedor', 'nombre')
                    ->required(),
                TextInput::make('precio_compra')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('precio_venta')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->default(0),
                Select::make('estado')
                    ->options(['activo' => 'Activo', 'inactivo' => 'Inactivo'])
                    ->default('activo')
                    ->required(),
            ]);
    }
}
