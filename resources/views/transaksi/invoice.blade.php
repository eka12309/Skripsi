@php
    $konf = DB::table('settings')->first();
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .invoice {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .invoice-header, .invoice-footer {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-header h1 {
            margin: 0;
            color: #4CAF50;
        }

        .invoice-details, .invoice-items, .invoice-summary {
            margin-bottom: 20px;
        }

        .invoice-details h2, .invoice-items h2, .invoice-summary {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
            border-bottom: 2px solid #ddd;
        }

        .invoice-items table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-items table, .invoice-items th, .invoice-items td {
            border: 1px solid #ddd;
        }

        .invoice-items th, .invoice-items td {
            padding: 10px;
            text-align: left;
        }

        .invoice-items th {
            background-color: #f4f4f4;
        }

        .invoice-summary {
            text-align: right;
        }

        .invoice-summary .summary-item {
            font-size: 1.2em;
            font-weight: bold;
        }

        .invoice-footer {
            font-size: 0.9em;
        }

        .status-green {
            display: inline-block;
            padding: 5px 10px;
            color: #fff;
            background-color: #4CAF50;
            border-radius: 5px;
            font-weight: bold;
        }

    </style>

</head>
<body onload="window.print()">
    <div class="invoice">
        <header class="invoice-header">
            <h1>Invoice Qurban</h1>
            <p><strong>Nomor Invoice:</strong> {{$transaksi->invoice_number}}</p>
            <p><strong>Tanggal:</strong> {{\Carbon\Carbon::parse($transaksi->created_at)->format('d F Y H:i')}}</p>
        </header>

        <section class="invoice-details">
            <h2>Detail Pembeli</h2>
            <p><strong>Nama:</strong> {{$transaksi->name = ucwords($transaksi->name)}}</p>
            <p><strong>Email:</strong> {{$transaksi->email}}</p>
            <p><strong>Alamat:</strong> {{$transaksi->alamat_ts = ucwords($transaksi->alamat_ts)}}</p>
            <p><strong>Masjid:</strong> {{$transaksi->masjid_ts = ucwords($transaksi->masjid_ts)}}</p>
        </section>

        <section class="invoice-items">
            <h2>Detail Item</h2>
            <table>
                <thead>
                    <tr>
                        <th>Deskripsi</th>
                        <th>Seller</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Hewan Qurban ({{$transaksi->tipe_hewan}}) </td>
                        <td>{{$transaksi->seller_name  = ucwords($transaksi->seller_name)}}</td>
                        <td>1</td>
                        <td>Rp {{number_format($transaksi->harga_per_orang)}}</td>
                        <td><span class="status-green">{{$transaksi->status}}</span></td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section class="invoice-summary">
            <div class="summary-item">
                <strong>Total</strong>
                <span>Rp {{number_format($transaksi->harga_per_orang)}}</span>
            </div>
        </section>

        <footer class="invoice-footer">
            <p>Terima kasih atas transaksi Anda!</p>
            <p>Jika Anda memiliki pertanyaan, silakan hubungi kami di {{$konf->no_hp_setting}}</p>
        </footer>
    </div>
</body>
</html>
