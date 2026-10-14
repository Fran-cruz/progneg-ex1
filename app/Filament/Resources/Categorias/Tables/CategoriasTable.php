<?php

namespace App\Filament\Resources\Categorias\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CategoriasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')
                    ->searchable(),
                TextColumn::make('estado')
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('estado')
                    ->options([
                        'activo' => 'Activo',
                        'inactivo' => 'Inactivo',
                    ])
                    ->label('Estado'),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')
                            ->label('Fecha desde'),
                        DatePicker::make('created_until')
                            ->label('Fecha hasta'),
                    ])
                    ->query(function ($query, array $data): void {
                        $query->when(
                            $data['created_from'] ?? null,
                            fn ($query, $date) => $query->whereDate('created_at', '>=', $date),
                        )->when(
                            $data['created_until'] ?? null,
                            fn ($query, $date) => $query->whereDate('created_at', '<=', $date),
                        );
                    })
                    ->label('Fecha de creación'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
