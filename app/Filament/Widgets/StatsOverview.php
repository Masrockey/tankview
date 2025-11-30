<?php

namespace App\Filament\Widgets;

use App\Models\Tank;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Tangki', Tank::count())
                ->description('Total tangki yang terdaftar')
                ->descriptionIcon('heroicon-m-truck')
                ->color('primary'),
            
            Stat::make('Tangki Masuk Bulan Ini', Tank::whereMonth('tanggal_masuk', now()->month)->count())
                ->description('Peningkatan bulan ini')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
                
            Stat::make('Tangki Masuk Hari Ini', Tank::whereDate('tanggal_masuk', today())->count())
                ->description('Data hari ini')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info'),
        ];
    }
}
