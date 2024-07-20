@extends('template_frontend.home')
@section('content')
  	<!-- Product filter section -->
	
  	<section class="product-filter-section mt-5">
		<style type="text/css">
   .satu {
   font-size: 12px;
   }
   .dua {
   font-size: 8px;
   }
   .tiga {
   font-size: 8px;
   }
</style>
  		<div class="container">
  			<div class="section-title">
  				<h2>Daftar Favorit Anda</h2>
  			</div>
  			<div class="row">
          		@foreach ($like as $data)
    				<div class="col-lg-3 col-sm-6">
    					<div class="product-item">
    						<div class="pi-pic">
                                @if ($data->barang->id == $new->id)
                                    <div class="tag-new">New</div>
                                @else
                                @endif
                  				<a href="{{ route('barang.show', $data->barang->id) }}"><img src="{{ asset( $data->barang->gambar ) }}" alt=""></a>
    							<div class="pi-links">
									<a href="{{ url('add-to-cart/'.$data->barang->id) }}" class="add-card"><i class="flaticon-bag"></i><span><div class="dua">Beli Sekarang</div></span></a>
									@if ($data->barang->like($data->barang->id))
										<a href="{{ url('unlike/'.$data->barang->id) }}" class="wishlist-btn"><i class="fa fa-heart"></i></a>
									@else
										<a href="{{ url('like/'.$data->barang->id) }}" class="wishlist-btn"><i class="fa fa-heart-o"></i></a>
									@endif
    							</div>
    						</div>
    						<div class="pi-text">
                  				<h6><a href="{{ route('barang.show', $data->barang->id) }}">Rp. {{ number_format($data->barang->price, 0) }}</a></h6>
      							<p><a href="{{ route('barang.show', $data->barang->id) }}">{{ $data->barang->merek->name }} {{$data->barang->type}}</a></p>
    						</div>
    					</div>
    				</div>
          		@endforeach
  			</div>
  		</div>
  	</section>
  	<!-- Product filter section end -->
@endsection
