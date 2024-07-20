@extends('template_frontend.home')
@section('content')
	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Halaman Produk</h4>
			<div class="site-pagination">
				<a href="{{ route('home') }}">Home</a> /
				<a href="#">Toko</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- product section -->
	<section class="product-section">
		<div class="container">
			<div class="back-link">
				<a href="{{ route('home') }}"> &lt;&lt; Kembali Ke halaman awal</a>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="product-pic-zoom">
						<img class="product-big-img" src="{{ asset( $barang->gambar ) }}" alt="">
					</div>
				</div>
				<div class="col-lg-6 product-details">
					<h2 class="p-title">{{ $barang->type }}</h2>
					<h3 class="p-price">Rp. {{ number_format($barang->price, 0) }}</h3>
					<h2 class="p-title">Bahan : <span>{{ $barang->merek->name }}</span></h2>
					<h4 class="p-stock">Stock: <span>{{$barang->stock}}</span></h4>
					<div class="p-rating">
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
					</div>
					@if (Auth::check() && !Auth::user()->isAdmin())
							@if ($barang->stock > 0)
								<a href="{{ url('add-to-cart/'.$barang->id) }}" class="site-btn">Beli Sekarang</a>
							@else
								<p>Stok barang sudah habis.</p>
							@endif
					@else
						<a href="{{ route('login') }}" class="site-btn">Login untuk Membeli</a>
					@endif
				</div>
			</div>
		</div>
	</section>
	<!-- product section end -->
	
	<!-- RELATED PRODUCTS section -->
	<section class="related-product-section">
		<div class="container">
			<div class="section-title">
				<h2>Produk Terkaits</h2>
			</div>
			<div class="product-slider owl-carousel">
				@foreach ($produk as $data)
					<div class="product-item">
						<div class="pi-pic">
							<img src="{{ asset( $data->gambar ) }}" alt="">
							<div class="pi-links">
								@if (Auth::check() && !Auth::user()->isAdmin())
									<a href="{{ url('add-to-cart/'.$data->id) }}" class="add-card"><i class="flaticon-bag"></i><span><div class="dua">Beli Sekarang</div></span></a>
									@if ($barang->like($barang->id))
										<a href="{{ url('unlike/'.$data->id) }}" class="wishlist-btn"><i class="fa fa-heart"></i></a>
									@else
										<a href="{{ url('like/'.$data->id) }}" class="wishlist-btn"><i class="fa fa-heart-o"></i></a>
									@endif
								@else
								<a href="{{ route('login') }}" class="add-card" style="font-size: 14px;"><i class="flaticon-bag"></i><span>Login untuk beli</span></a>
								@endif
									</div>
						</div>
						<div class="pi-text">
							<h6>Rp. {{ number_format($data->price, 0) }}</h6>
							<p><a href="{{ url('barang/'.$data->id) }}"> {{ $data->merek->name }} {{$data->type}}</a></p>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>
	<!-- RELATED PRODUCTS section end -->
@endsection
