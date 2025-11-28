<?php

namespace App\Filament\Resources\Tanks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
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
                    ->label('Foto')
                    ->size(50)
                    ->circular()
                    ->getStateUsing(fn ($record) => $record->foto_kondisi),
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
                Action::make('print')
                    ->label('Print')
                    ->icon('heroicon-o-printer')
                    ->url(fn ($record) => route('tanks.print', $record))
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
