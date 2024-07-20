@extends('template_frontend.home')
@section('content')
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
  <div class="col-md-8">
    <div class="row">
      <div class="col-md-12">
        <div class="section-title">
          <h2 class="title">Recent posts</h2>
        </div>
        <div class="col-lg-6 col-sm-6 col-6 main-section">
          <div class="dropdown">
            @if (Auth::user())
              <button type="button" class="btn btn-info" data-toggle="dropdown">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
              </button>
            @endif
            <div class="dropdown-menu">
              <div class="row total-header-section">
                <div class="col-lg-6 col-sm-6 col-6">
                  <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                </div>
                @foreach((array) session('cart') as $id => $details)
                @endforeach
                <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                  <p>Total: <span class="text-info">Rp. </span></p>
                </div>
              </div>

              @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                  <div class="row cart-detail">
                    <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                      <img width="80" src="{{ $details['photo'] }}" />
                    </div>
                    <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                      <p style="text-transform: uppercase;">{{ $details['name'] }}</p>
                      <span class="price text-info"> ${{ $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                    </div>
                  </div>
                @endforeach
              @endif
              <div class="row">
                <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                  <a href="{{ url('cart') }}" class="btn btn-primary btn-block">View all</a>
                </div>
              </div>
            </div>
          </div>
        </div><br><br>
      </div>
      <!-- post -->
      @php
        $i = 1;
      @endphp
      @foreach ($blog as $val)
      <div class="col-md-6">
        <div class="post">
          <a class="post-img" href="{{ route('blog.tampil_data', $val->id) }}"><img src="{{ asset( $val->gambar ) }}"></a>
          <div class="post-body">
            <div class="post-category">
              <a href="{{ route('blog.tampil_data', $val->id) }}">{{$val->category->name}}</a>
            </div>
            <h3 class="post-title"><a href="{{ route('blog.tampil_data', $val->id) }}">{!!$val->content!!}</a></h3>
            <ul class="post-meta">
              <li><a href="{{ route('blog.tampil_data', $val->id) }}">{{$val->title}}</a></li>
              <li>{{$val->created_at}}</li>
            </ul>
          </div>
          <p class="btn-holder"><a href="{{ url('add-to-cart/'.$val->id) }}" class="btn btn-warning btn-block text-center" role="button">Beli Sekarang</a> </p>
        </div>
      </div>
      @if ($i % 2 == 0)
        <div class="clearfix visible-md visible-lg"></div>
      @endif
      @php
        $i++;
      @endphp
      @endforeach
      <!-- /post -->
    </div>
    {{ $blog->links() }}
  </div>
    <!-- /category widget -->
  </div>
  <!-- /row -->
@endsection
