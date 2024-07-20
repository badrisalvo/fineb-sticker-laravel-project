@extends('template_frontend.home')
@section('content')
    <!-- Page info -->
    <div class="page-top-info">
        <div class="container">
            <h4>Halaman Produk</h4>
            <div class="site-pagination">
                <a href="{{ route('home') }}">Home</a> /
                <a href="#">{{ $judul->name }}</a>
            </div>
        </div>
    </div>
    <!-- Page info end -->
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
    <!-- Category section -->
    <section class="category-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-2 order-lg-1">
                    <div class="filter-widget">
                        <h2 class="fw-title">Bahan</h2>
                        <ul class="category-menu">
                            @foreach ($merek as $data)
                                <li><a href="{{ route('category', $data->id) }}">{{ $data->name }}<span>({{ $data->jumlah($data->id) }})</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
                    <div class="row">
                        @forelse ($barang as $data)
                            <div class="col-lg-4 col-sm-6">
                                <div class="product-item">
                                    <div class="pi-pic">
                                        @if ($data->id == $new->id)
                                            <div class="tag-new">New</div>
                                        @endif
                                        <img src="{{ asset( $data->gambar ) }}" alt="">
                                        <div class="pi-links">
                                            @if (Auth::check())
                                                @if (!Auth::user()->isAdmin())
                                                    <a href="{{ url('add-to-cart/'.$data->id) }}" class="add-card"><i class="flaticon-bag"></i><span>Beli Sekarang</span></a>
                                                    @if ($data->like($data->id))
                                                        <a href="{{ url('unlike/'.$data->id) }}" class="wishlist-btn"><i class="fa fa-heart"></i></a>
                                                    @else
                                                        <a href="{{ url('like/'.$data->id) }}" class="wishlist-btn"><i class="fa fa-heart-o"></i></a>
                                                    @endif
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
                                    <br>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center">
                                <h2>Tidak ada barang</h2>
                            </div>
                        @endforelse
                        {{ $barang->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Category section end -->
@endsection
