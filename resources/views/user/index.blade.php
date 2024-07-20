@extends('template_frontend.home')
@section('content')
   <!-- Hero section -->
   <section class="hero-section">
      <div class="hero-slider owl-carousel">
         @foreach ($car as $val)
         <div class="hs-item set-bg" data-setbg="{{ asset( $val->gambar) }}">
            <div class="container">
               <div class="row">
                  <div class="col-xl-6 col-lg-7 text-white">
                     <span>Design Produk Terbaru</span>
                     <h2><a href="{{ route('barang.show', $val->id) }}">{{ $val->merek->name }} {{$val->type}}</a> <br></h2>
                     <!-- <p>Produk terpercaya dan bergaransi yang sesuai dengan kebutuhan anda </p> -->
                     <a href="{{ route('barang.show', $val->id) }}" class="site-btn sb-line">Tampilkan</a>
                     @if (Auth::check())
                        @if (!Auth::user()->isAdmin())
                           <a href="{{ url('add-to-cart/'.$val->id) }}" class="site-btn sb-white">Beli Sekarang</a>
                        @endif
                     @else
                        <a href="{{ route('login') }}" class="site-btn sb-white">Login untuk Membeli</a>
                     @endif
                                       </div>
               </div>
            </div>
         </div>
         @endforeach
      </div>
      <div class="container">
         <div class="slide-num-holder" id="snh-1"></div>
      </div>
   </section>
   <!-- Hero section end -->
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
   <!-- letest product section -->
   <section class="top-letest-product-section">
      <div class="container">
         <div class="section-title">
            <h2>Produk Terbaru</h2>
         </div>
         <?php $no=0; ?>
         <div class="product-slider owl-carousel">
            @foreach ($car as $val)
            <div class="product-item">
               <div class="pi-pic">
                  @if ($no == 0)
                  <div class="tag-new">New</div>
                  @else
                  @endif
                  <a href="{{ route('barang.show', $val->id) }}"><img src="{{ asset( $val->gambar ) }}" alt=""></a>
                  <div class="pi-links">
                  @if (Auth::check() && !Auth::user()->isAdmin())
                     <a href="{{ url('add-to-cart/'.$val->id) }}" class="add-card"><i class="flaticon-bag"></i><span><div class="dua">Beli Sekarang</div></span></a>
                     @if ($val->like($val->id))
                        <a href="{{ url('unlike/'.$val->id) }}" class="wishlist-btn"><i class="fa fa-heart"></i></a>
                     @else
                        <a href="{{ url('like/'.$val->id) }}" class="wishlist-btn"><i class="fa fa-heart-o"></i></a>
                     @endif
                  @else
                  <a href="{{ route('login') }}" class="add-card" style="font-size: 14px;"><i class="flaticon-bag"></i><span>Login untuk beli</span></a>
                  @endif

                  </div>
               </div>
               <div class="pi-text">
                  <h6><a href="{{ route('barang.show', $val->id) }}">Rp. {{ number_format($val->price, 0) }}</a></h6>
                  <p><a href="{{ route('barang.show', $val->id) }}">{{ $val->merek->name }} {{$val->type}}</a> <br></p>
               </div>
               <br>
            </div>
            <?php $no++ ?>
            @endforeach
         </div>
      </div>
   </section>
   <!-- letest product section end -->

   <!-- Product filter section -->
   <section class="product-filter-section">
      <div class="container">
         <div class="section-title">
            <h2>Telusuri Penjualan Terbaru</h2>
         </div>
         <?php $no=0; ?>
         <div class="row">
            @foreach ($barang as $val)
            <div class="col-lg-3 col-sm-6">
               <div class="product-item">
                  <div class="pi-pic">
                     @if ($no == 0)
                     <div class="tag-new">Baru</div>
                     @else
                     @endif
                     <a href="{{ route('barang.show', $val->id) }}"><img src="{{ asset( $val->gambar ) }}" alt=""></a>
                     <div class="pi-links">
                  @if (Auth::check() && !Auth::user()->isAdmin())
                     <a href="{{ url('add-to-cart/'.$val->id) }}" class="add-card"><i class="flaticon-bag"></i><span><div class="dua">Beli Sekarang</div></span></a>
                     @if ($val->like($val->id))
                        <a href="{{ url('unlike/'.$val->id) }}" class="wishlist-btn"><i class="fa fa-heart"></i></a>
                     @else
                        <a href="{{ url('like/'.$val->id) }}" class="wishlist-btn"><i class="fa fa-heart-o"></i></a>
                     @endif
                  @else
                  <a href="{{ route('login') }}" class="add-card" style="font-size: 14px;"><i class="flaticon-bag"></i><span>Login untuk beli</span></a>
                  @endif

                     </div>
                  </div>
                  <div class="pi-text">
                     <h6><a href="{{ route('barang.show', $val->id) }}">Rp. {{ number_format($val->price, 0) }}</a></h6>
                     <p><a href="{{ route('barang.show', $val->id) }}">{{ $val->merek->name }} {{$val->type}} </a> </p>
                  </div>
                  <br>
               </div>
            </div>
            <?php $no++ ?>
            @endforeach
         </div>
      </div>
   </section>
   <!-- Product filter section end -->
@endsection
