<?php

namespace App\Filament\Resources\Tanks\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;
use emmanpbarrameda\FilamentTakePictureField\Forms\Components\TakePicture;

class TankForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Umum')
                    ->description('Data konsumen')
                    ->schema([
                        DateTimePicker::make('tanggal_masuk')
                            ->label('Tanggal Masuk')
                            ->required(),
                        TextInput::make('nama_konsumen')
                            ->label('Nama Konsumen')
                            ->required()
                            ->columnSpan(2),
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
                
                Section::make('Foto Kondisi Tangki')
                    ->description('Ambil foto kondisi tangki saat ini menggunakan kamera')
                    ->schema([
                        TakePicture::make('foto_kondisi')
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
                
                Section::make('Kesimpulan')
                    ->description('Hasil pemeriksaan tangki')
                    ->schema([
                        RichEditor::make('kesimpulan')
                            ->label('Kesimpulan Pemeriksaan')
                            ->required()
                            ->toolbarButtons([
                                ['bold', 'italic', 'underline', 'strike'],
                                ['h2', 'h3', 'alignCenter'],
                                ['blockquote', 'bulletList', 'orderedList'],
                                ['undo', 'redo']
                            ])
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
