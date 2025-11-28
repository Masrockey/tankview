<?php

namespace App\Filament\Resources\Tanks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class TanksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal_masuk')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('nama_konsumen')
                    ->searchable(),
                ImageColumn::make('foto_kondisi')
                    ->imageHeight(50),
                TextColumn::make('plat_no')
                    ->searchable(),
                TextColumn::make('no_mesin')
                    ->searchable(),
                TextColumn::make('no_rangka')
                    ->searchable(),
                TextColumn::make('kesimpulan')
                    ->searchable(),
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
                //
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
