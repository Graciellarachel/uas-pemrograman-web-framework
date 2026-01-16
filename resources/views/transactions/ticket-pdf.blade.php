<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .ticket-container {
            background: white;
            max-width: 600px;
            margin: 0 auto;
            border: 2px solid #333;
            border-radius: 10px;
            overflow: hidden;
        }
        .ticket-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .ticket-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }
        .ticket-header p {
            margin: 10px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .ticket-body {
            padding: 30px;
        }
        .ticket-info {
            margin-bottom: 20px;
        }
        .info-row {
            display: flex;
            margin-bottom: 15px;
            border-bottom: 1px dashed #ddd;
            padding-bottom: 10px;
        }
        .info-label {
            font-weight: bold;
            width: 150px;
            color: #555;
        }
        .info-value {
            flex: 1;
            color: #333;
        }
        .ticket-footer {
            background-color: #f8f9fa;
            padding: 20px 30px;
            border-top: 2px dashed #ddd;
            text-align: center;
        }
        .ticket-number {
            background-color: #667eea;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            font-weight: bold;
            font-size: 18px;
            margin-top: 10px;
        }
        .qr-placeholder {
            width: 150px;
            height: 150px;
            background-color: #e9ecef;
            margin: 20px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #ddd;
            border-radius: 5px;
        }
        .note {
            font-size: 12px;
            color: #666;
            margin-top: 15px;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="ticket-container">
        <div class="ticket-header">
            <h1>E-TICKET</h1>
            <p>{{ $transaction->ticketType->event->nama_event }}</p>
        </div>

        <div class="ticket-body">
            <div class="ticket-info">
                <div class="info-row">
                    <div class="info-label">Nama Pemegang:</div>
                    <div class="info-value">{{ $transaction->user->name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Email:</div>
                    <div class="info-value">{{ $transaction->user->email }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Nama Event:</div>
                    <div class="info-value">{{ $transaction->ticketType->event->nama_event }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tanggal Event:</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($transaction->ticketType->event->tanggal_event)->format('d F Y') }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Lokasi:</div>
                    <div class="info-value">{{ $transaction->ticketType->event->lokasi }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Jenis Tiket:</div>
                    <div class="info-value">{{ $transaction->ticketType->nama_tiket }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Jumlah Tiket:</div>
                    <div class="info-value">{{ $transaction->quantity }} Tiket</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Total Harga:</div>
                    <div class="info-value">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tanggal Pembelian:</div>
                    <div class="info-value">{{ $transaction->created_at->format('d F Y, H:i') }} WIB</div>
                </div>
            </div>

            <div style="text-align: center; margin: 30px 0;">
                <div style="background-color: #f8f9fa; border: 3px dashed #667eea; padding: 20px; border-radius: 10px; display: inline-block;">
                    <p style="margin: 0 0 10px 0; font-size: 14px; color: #666; font-weight: bold;">KODE VERIFIKASI TIKET</p>
                    <p style="margin: 0; font-size: 32px; font-weight: bold; color: #667eea; letter-spacing: 3px; font-family: 'Courier New', monospace;">
                        {{ strtoupper(substr(md5($transaction->id . $transaction->user_id . $transaction->created_at), 0, 12)) }}
                    </p>
                    <p style="margin: 10px 0 0 0; font-size: 12px; color: #999;">Tunjukkan kode ini saat check-in</p>
                </div>
            </div>

            <div class="ticket-number">
                TICKET #{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}
            </div>
        </div>

        <div class="ticket-footer">
            <p class="note">
                <strong>Catatan Penting:</strong><br>
                • Tunjukkan e-ticket ini saat memasuki venue event<br>
                • E-ticket ini berlaku untuk {{ $transaction->quantity }} orang<br>
                • Simpan e-ticket ini dengan baik hingga hari event<br>
                • Untuk informasi lebih lanjut, hubungi panitia event
            </p>
        </div>
    </div>
</body>
</html>
