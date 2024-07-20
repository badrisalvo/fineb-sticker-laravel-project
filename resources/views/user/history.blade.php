@extends('template_frontend.home')
@section('css')
	<link type="text/css" rel="stylesheet" href="http://localhost/blog/public/css/style.css" />
@endsection
@section('content')
	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Pembayaran</h4>
			<div class="site-pagination">
				<a href="{{ route('home') }}">Home</a> /
				<a href="#">Pembayaran</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->

	<!-- checkout section  -->
	<section class="section spad">
		<div class="container">
        @foreach ($order as $data)
            <div id="hot-post" class="row hot-post">
                <div class="col-12 hot-post-left">
                    <div class="post post-row">
                        <a class="post-img"><img src="{{ asset($data->barang->gambar) }}" alt=""></a>
                        <div class="post-body">
                            <h6 class="post-title">ID Pesanan : {{ $data->id }}</h6>
                            <h5 class="post-title"><a href="{{ route('barang.show', $data->barang->id) }}"> {{ $data->namaBarang($data->barang->id)}}</h5>
                            <h6 class="post-title">Jumlah: {{ $data->quantity }}</h6>
                            <h6 class="post-title">Total: Rp. {{ number_format( $data->total , 0) }}</h6>
                            <h6 class="post-title">Status: 
                                @if ($data->payment_status == 'Sudah Dibayar')
                                    <span class="badge badge-success">{{ $data->payment_status }}</span>
                                @elseif ($data->payment_status == 'Belum Dibayar')
                                    <span class="badge badge-danger">{{ $data->payment_status }}</span>
                                @elseif ($data->payment_status == 'Dicancel')
                                    <span class="badge badge-danger text-white">{{ $data->payment_status }}</span>
                                @elseif ($data->payment_status == 'Dipending')
                                    <span class="badge badge-warning text-white">Menunggu Konfirmasi Admin</span>
                                @endif
                            </h6>
                            <!-- @if ($data->payment_status == 'Belum Dibayar')
                                <h5 class="post-title">Durasi Pembayaran: 
                                <div class="countdown" data-end="{{ $data->created_at->addHours(3)->format('Y-m-d H:i:s') }}"></div>
                                </h5>
                            @endif -->
                            <ul class="post-meta">
                                <li>{{ $data->created_at->format('l, H:i:s d M Y') }}</li>
                            </ul>
                            @if ($data->payment_status == 'Belum Dibayar')
                                <form action="{{ route('order.destroy', $data->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <a href="{{ route('pembayaran', $data->id) }}" class="btn btn-primary btn-sm mr-2" style="width: 100px;">Bayar</a>
                                    <button type="submit" class="btn btn-danger btn-sm" style="width: 100px;" name="button" onclick="return confirm('Pesanan akan dicancel?');">Cancel</button>
                                </form>
                            @elseif ($data->payment_status == 'Dipending')
                              
                            @else
                            @endif
                            @if ($data->payment_status == 'Sudah Dibayar')
                            <a href="{{ route('order.cetak', ['id' => $data->id]) }}" class="btn btn-primary btn-sm">Lihat Laporan</a>
                            <tr>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
		</div>
	</section>
	<!-- checkout section end -->
@endsection
        <script src="{{ asset('user/js/main.js') }}"></script>
        <script src="{{ asset('resource/js/moment.js') }}"></script>
    