@extends('template_backend.home')
@section('halaman', 'Statistik')
@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="welcome-wrapper shadow-reset res-mg-t mg-b-30">
        <h2>Produk Terlaris - Bulan {{ $bulanNames[$selectedMonth] }} Tahun {{ $selectedYear }}</h2>
        <div class="row">
            <div class="col-md-6">
                <canvas id="myPieChart"></canvas>
            </div>
            <div class="col-md-6">
                <form action="{{ route('statistik.index') }}" method="get">
                <div class="form-group">
                    <label for="bulan">Pilih Bulan</label>
                    <select name="bulan" class="form-control">
                        @foreach ($bulanNames as $key => $value)
                            <option value="{{ $key }}"{{ $selectedMonth === $key ? ' selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tahun">Input Tahun Manual</label>
                    <select name="tahun" class="form-control">
                        @for ($year = date('Y'); $year >= 2020; $year--)
                            <option value="{{ $year }}"{{ $selectedYear == $year ? ' selected' : '' }}>{{ $year }}</option>
                        @endfor
                    </select>
                </div>

                <div class="form-group">
                    <label for="merek">Pilih Merek</label>
                    <select name="merek" class="form-control">
                        <option value=""{{ $selectedMerek === '' ? ' selected' : '' }}>Tampilkan Semua Data</option>
                        @foreach ($merekOptions as $merekOption)
                            <option value="{{ $merekOption }}"{{ $selectedMerek === $merekOption ? ' selected' : '' }}>
                                {{ $merekOption }}
                            </option>
                        @endforeach
                    </select>
                </div>
                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                </form>
                <table class="table table-striped table-hover table-sm table-bordered text-center mt-3">
                    <tr>
                        <th>No</th>
                        <th>Merek Barang</th>
                        <th>Jumlah Terjual</th>
                    </tr>
                    @foreach ($salesData as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->brand_name }}</td>
                            <td>{{ $item->total_quantity }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

<a href="{{ route('pdf.generate', ['bulan' => $selectedMonth, 'tahun' => $selectedYear, 'merek' => $selectedMerek]) }}" class="btn btn-primary">Download Laporan Penjualan</a>


<!-- Include the chart script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Process data from the server
    const data = @json($salesData);
    const labels = [];
    const dataValues = [];

    data.forEach(item => {
        labels.push(item.brand_name);
        dataValues.push(item.total_quantity);
    });

    // Create the pie chart
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: dataValues,
                backgroundColor: ['red', 'green', 'blue', 'yellow', 'gray', 'pink', 'purple', 'orange'],
                hoverBackgroundColor: ['red', 'green', 'blue', 'yellow', 'gray', 'pink', 'purple', 'orange'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });

</script>
@endsection
