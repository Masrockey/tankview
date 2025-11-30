<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Data Tank - {{ $tank->nama_konsumen }}</title>
    <style>
        @media print {
            body {
                margin: 0;
                padding: 20px;
                font-family: 'Arial', sans-serif;
            }
            
            .no-print {
                display: none !important;
            }
            
            .print-header {
                text-align: center;
                margin-bottom: 30px;
                border-bottom: 2px solid #333;
                padding-bottom: 20px;
            }
            
            .print-content {
                margin: 20px 0;
            }
            
            .info-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 20px;
                margin-bottom: 30px;
            }
            
            .info-section {
                background: #f9f9f9;
                padding: 15px;
                border-radius: 8px;
                border: 1px solid #ddd;
            }
            
            .photo-section {
                text-align: center;
                margin: 20px 0;
            }
            
            .photo-section img {
                max-width: 400px;
                max-height: 300px;
                border: 2px solid #333;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            }
            
            .info-item {
                margin: 10px 0;
                display: flex;
                justify-content: space-between;
            }
            
            .info-label {
                font-weight: bold;
                color: #333;
            }
            
            .info-value {
                color: #666;
            }
            
            .kesimpulan-section {
                background: #f0f8ff;
                padding: 20px;
                border-radius: 8px;
                border-left: 4px solid #007bff;
                margin-top: 20px;
            }
            
            .footer {
                margin-top: 50px;
                text-align: center;
                font-size: 12px;
                color: #666;
                border-top: 1px solid #ddd;
                padding-top: 20px;
            }
        }
        
        @media screen {
            body {
                font-family: 'Arial', sans-serif;
                margin: 20px;
                background: #f5f5f5;
            }
            
            .print-container {
                background: white;
                max-width: 800px;
                margin: 0 auto;
                padding: 40px;
                box-shadow: 0 0 20px rgba(0,0,0,0.1);
                border-radius: 10px;
            }
            
            .print-button {
                background: #007bff;
                color: white;
                padding: 12px 30px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
                margin: 20px 0;
                display: inline-block;
            }
            
            .print-button:hover {
                background: #0056b3;
            }
        }
    </style>
</head>
<body>
    <div class="print-container">
        <!-- Print Button (only visible on screen) -->
        <div class="no-print" style="text-align: center; margin-bottom: 30px;">
            <button onclick="window.print()" class="print-button">
                🖨️ Cetak Dokumen
            </button>
        </div>
        
        <!-- Print Header -->
        <div class="print-header">
            <h1 style="margin: 0; color: #333; font-size: 28px;">
                DATA KONDISI TANK
            </h1>
            <p style="margin: 10px 0 0 0; color: #666; font-size: 14px;">
                Laporan Pemeriksaan Tank
            </p>
        </div>
        
        <!-- Print Content -->
        <div class="print-content">
            <!-- Photo Section (QR Code) -->
            <div class="photo-section">
                <h3 style="margin-bottom: 15px; color: #333;">Scan Foto Kondisi</h3>
                <div style="display: inline-block; padding: 10px; border: 1px solid #ddd; background: white;">
                    {!! $qrCode !!}
                </div>
                <p style="margin-top: 10px; font-size: 12px; color: #666;">
                    Scan QR Code di atas untuk melihat foto kondisi tank
                </p>
            </div>
            
            <!-- Information Grid -->
            <div class="info-grid">
                <!-- Informasi Umum -->
                <div class="info-section">
                    <h3 style="margin-top: 0; color: #333; border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                        Informasi Umum
                    </h3>
                    <div class="info-item">
                        <span class="info-label">Tanggal Masuk:</span>
                        <span class="info-value">{{ $tank->tanggal_masuk ? $tank->tanggal_masuk->format('d/m/Y H:i') : '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Nama Konsumen:</span>
                        <span class="info-value">{{ $tank->nama_konsumen }}</span>
                    </div>
                </div>
                
                <!-- Identifikasi Tank -->
                <div class="info-section">
                    <h3 style="margin-top: 0; color: #333; border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                        Identifikasi Tank
                    </h3>
                    <div class="info-item">
                        <span class="info-label">Plat Nomor:</span>
                        <span class="info-value">{{ $tank->plat_no }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Nomor Mesin:</span>
                        <span class="info-value">{{ $tank->no_mesin }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Nomor Rangka:</span>
                        <span class="info-value">{{ $tank->no_rangka }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Kesimpulan Section -->
            <div class="kesimpulan-section">
                <h3 style="margin-top: 0; color: #333;">Kesimpulan Pemeriksaan</h3>
                <div style="margin: 10px 0; line-height: 1.6; color: #666;">
                    {!! $tank->kesimpulan !!}
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p style="margin: 0;">
                Dokumen ini dicetak pada tanggal {{ now()->format('d/m/Y H:i') }}<br>
                Sistem Manajemen Tangki - TangkiView
            </p>
        </div>
    </div>
    
    <script>
        // Auto print after page loads (optional)
        // window.onload = function() {
        //     setTimeout(() => {
        //         window.print();
        //     }, 1000);
        // };
        
        // Close window after printing (optional)
        window.onafterprint = function() {
            // window.close(); // Uncomment if you want to close after print
        };
    </script>
</body>
</html>