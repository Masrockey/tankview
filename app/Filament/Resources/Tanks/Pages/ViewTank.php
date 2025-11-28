<?php

namespace App\Filament\Resources\Tanks\Pages;

use App\Filament\Resources\Tanks\TankResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;

class ViewTank extends ViewRecord
{
    protected static string $resource = TankResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('print')
                ->label('Print')
                ->icon('heroicon-o-printer')
                ->url(fn () => route('tanks.print', $this->record))
                ->openUrlInNewTab(),
        ];
    }
}