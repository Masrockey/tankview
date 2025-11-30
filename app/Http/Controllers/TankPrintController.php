<?php

namespace App\Http\Controllers;

use App\Models\Tank;
use Illuminate\Http\Request;

use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class TankPrintController extends Controller
{
    public function print(Tank $tank)
    {
        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        
        // Use the photo URL or a placeholder if empty
        $qrContent = 'No Photo Available';
        
        if ($tank->foto_kondisi) {
            if (str_starts_with($tank->foto_kondisi, 'http') || str_starts_with($tank->foto_kondisi, '//')) {
                $qrContent = $tank->foto_kondisi;
            } else {
                // Remove 'storage/' from the beginning if it exists to avoid duplication
                $path = ltrim($tank->foto_kondisi, '/');
                if (str_starts_with($path, 'storage/')) {
                    $path = substr($path, 8);
                }
                $qrContent = asset('storage/' . $path);
            }
        }

        $qrCode = $writer->writeString($qrContent);

        return view('tanks.print', compact('tank', 'qrCode'));
    }
}