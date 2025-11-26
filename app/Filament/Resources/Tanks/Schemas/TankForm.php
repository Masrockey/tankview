<?php

namespace App\Filament\Resources\Tanks\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use emmanpbarrameda\FilamentTakePictureField\Forms\Components\TakePicture;

class TankForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DateTimePicker::make('tanggal_masuk'),
                TextInput::make('nama_konsumen')
                    ->required(),
                TakePicture::make('foto_kondisi')
                    ->label('Ambil Foto')
                    ->disk('public')
                    ->directory('uploads/foto_kondisi')
                    ->visibility('public')
                    ->useModal(true)
                    ->showCameraSelector(true)
                    ->aspect('16:9')
                    ->imageQuality(100)
                    ->shouldDeleteOnEdit(false)
                    ->required(),
                TextInput::make('plat_no')
                    ->required(),
                TextInput::make('no_mesin')
                    ->required(),
                TextInput::make('no_rangka')
                    ->required(),
                TextInput::make('kesimpulan')
                    ->required(),
            ]);
    }
}
