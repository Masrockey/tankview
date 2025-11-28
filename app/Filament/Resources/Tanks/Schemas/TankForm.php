<?php

namespace App\Filament\Resources\Tanks\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use emmanpbarrameda\FilamentTakePictureField\Forms\Components\TakePicture;

class TankForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Umum')
                    ->description('Data dasar tank dan konsumen')
                    ->schema([
                        DateTimePicker::make('tanggal_masuk')
                            ->label('Tanggal Masuk')
                            ->required(),
                        TextInput::make('nama_konsumen')
                            ->label('Nama Konsumen')
                            ->required()
                            ->columnSpan(2),
                    ])
                    ->columns(3),
                
                Section::make('Foto Kondisi Tank')
                    ->description('Ambil foto kondisi tank saat ini menggunakan kamera')
                    ->schema([
                        TakePicture::make('foto_kondisi')
                            ->label('Foto Kondisi Tank')
                            ->helperText('Pastikan pencahayaan baik dan tank terlihat jelas')
                            ->disk('public')
                            ->directory('uploads/foto_kondisi')
                            ->visibility('public')
                            ->useModal(true)
                            ->showCameraSelector(true)
                            ->aspect('16:9')
                            ->imageQuality(90)
                            ->shouldDeleteOnEdit(true)
                            ->required(),
                    ])
                    ->collapsible(false),
                
                Section::make('Detail Identifikasi Tank')
                    ->description('Informasi identifikasi tank')
                    ->schema([
                        TextInput::make('plat_no')
                            ->label('Plat Nomor')
                            ->required(),
                        TextInput::make('no_mesin')
                            ->label('Nomor Mesin')
                            ->required(),
                        TextInput::make('no_rangka')
                            ->label('Nomor Rangka')
                            ->required(),
                    ])
                    ->columns(3),
                
                Section::make('Kesimpulan')
                    ->description('Hasil pemeriksaan tank')
                    ->schema([
                        TextInput::make('kesimpulan')
                            ->label('Kesimpulan Pemeriksaan')
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
