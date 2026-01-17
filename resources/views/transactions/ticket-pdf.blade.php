<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>E-Ticket - {{ $transaction->ticketType->event->nama_event }}</title>
    <style>
        @page { margin: 0; }
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 40px;
            line-height: 1.4;
        }
        .container {
            width: 100%;
            border: 1px solid #ddd;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .ticket-table {
            width: 100%;
            border-collapse: collapse;
        }
        .ticket-table td {
            padding: 10px 0;
            vertical-align: top;
            border-bottom: 1px solid #eee;
        }
        .label {
            font-weight: bold;
            width: 30%;
            color: #666;
        }
        .value {
            width: 70%;
            font-weight: bold;
        }
        .verification-box {
            margin-top: 30px;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px dashed #333;
            text-align: center;
        }
        .code {
            font-family: 'Courier New', Courier, monospace;
            font-size: 24px;
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        .footer {
            margin-top: 30px;
            font-size: 11px;
            color: #777;
            text-align: center;
        }
        .ticket-id {
            float: right;
            font-size: 12px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="ticket-id">#{{ str_pad($transaction->id, 8, '0', STR_PAD_LEFT) }}</div>
        <div class="header">
            <h1>E-TICKET</h1>
            <div style="font-size: 14px; color: #555;">{{ $transaction->ticketType->event->nama_event }}</div>
        </div>

        <table class="ticket-table">
            <tr>
                <td class="label">Nama Pemegang</td>
                <td class="value">{{ $transaction->user->name }}</td>
            </tr>
            <tr>
                <td class="label">Email</td>
                <td class="value">{{ $transaction->user->email }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Event</td>
                <td class="value">{{ \Carbon\Carbon::parse($transaction->ticketType->event->tanggal_event)->format('d F Y') }}</td>
            </tr>
            <tr>
                <td class="label">Lokasi</td>
                <td class="value">{{ $transaction->ticketType->event->lokasi }}</td>
            </tr>
            <tr>
                <td class="label">Jenis Tiket</td>
                <td class="value">{{ $transaction->ticketType->nama_tiket }}</td>
            </tr>
            <tr>
                <td class="label">Jumlah Tiket</td>
                <td class="value">{{ $transaction->quantity }} Tiket</td>
            </tr>
            <tr>
                <td class="label">Total Bayar</td>
                <td class="value">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="verification-box">
            <span style="font-size: 12px; text-transform: uppercase; color: #666;">Kode Verifikasi Tiket</span>
            <span class="code">{{ strtoupper(substr(md5($transaction->id . $transaction->user_id . $transaction->created_at), 0, 12)) }}</span>
            <div style="font-size: 10px; margin-top: 10px; color: #888;">Tunjukkan kode ini saat memasuki venue acara</div>
        </div>

        <div class="footer">
            <p>E-Ticket ini dikirimkan secara otomatis. Harap simpan dengan baik.<br>
            Tiket ini berlaku untuk {{ $transaction->quantity }} orang sesuai pesanan.</p>
        </div>
    </div>
</body>
</html>
