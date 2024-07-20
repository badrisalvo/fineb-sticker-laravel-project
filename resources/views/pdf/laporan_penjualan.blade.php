<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan Fine-B Sticker</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
        }
        img {
            height: 60px;
            margin-right: 10px;
            vertical-align: middle;
            position: absolute;
            top: 10px; 
            left: 40px; 
            filter: grayscale(100%);
        }
        header {
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }


        h2 {
            display: inline-block;
            color: black;
            text-align: center;
            margin: 0;
        }

        address {
            text-align: center;
            color: black;
            margin-bottom: 10px;
        }

        address:after {
            content: "";
            display: block;
            width: 100%;
            height: 1px;
            background-color: #000;
            margin-top: 5px;
        }

        table {
            width: calc(100% - 40px);
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        th {
            background-color: black;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        p {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: 40;
            right: 50;
            margin: 10px;
            font-weight: bold;
            text-align: right;
            font-size: 16px;
        }

        .signature {
            margin-top: 40px;
        }
    </style>
</head>
<body>
<header>
<img src="https://images2.imgbox.com/fb/a4/cl8uCVQl_o.png" alt="Logo Fine-B Sticker">
<h2>Laporan Penjualan Fine-B Sticker</h2>
</header>
    <address>
        Jl. Dr. Sutomo No.55, Simpang Haru<br>
        Kec. Padang Timur, Kota Padang, Sumatera Barat<br>
    </address>
    <div>
        <p>Laporan Periode : {{ $selectedMonth }}/{{ $selectedYear }}<br>
Merek: {{ $selectedMerek ? $selectedMerek : 'Semua Merek' }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Pesanan</th>
                <th>Nama Pembeli</th>
                <th>Tipe Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Status Pembayaran</th>
                <th>Waktu Pesanan</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($orders as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->user->name }}</td>
                    <td>{{ $data->namaBarang($data->barang_id) }}</td>
                    <td>{{ $data->tipeBarang($data->barang_id) }}</td>
                    <td>{{ $data->quantity }}</td>
                    <td>Rp. {{ number_format ($data ->hargaBarang($data->barang_id), 0, ',', '.')}}
                    <td>{{ $data->payment_status }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->created_at)->locale('id')->formatLocalized('%d %B %Y %H:%M:%S') }}</td>
                    <td>Rp. {{ number_format($data->total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tr>
            <td></td>
            <td>Total Penjualan</td> 
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Rp.{{ number_format($totalPenjualan, 0, ',', '.') }}</td></tr>
    </table>
    <div class="footer">
    <p>{{ \Carbon\Carbon::now()->locale('id')->formatLocalized('Padang, %d %B %Y') }}</p>
       <br>
       <br>
       <br>
       <br>
        <p>Sulistio Endo</p>
    </div>

</body>
</html>
