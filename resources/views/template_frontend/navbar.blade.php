<!-- Header section -->
<header class="header-section">
  <div class="header-top">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 col-lg-5">
          <a class="navbar-brand" href="{{ url('/') }}">
            <img src="https://images2.imgbox.com/fb/a4/cl8uCVQl_o.png" alt="Fine-B Sticker" height="30" style="margin-right: 10px;">
            Fine-B Sticker
          </a>
        </div>
        <div class="col-lg-2 text-center"></div>
        <div class="col-xl-4 col-lg-5">
          <div class="user-panel">
            <div class="up-item">
              @if (Auth::check())
                <div class="shopping-card">
                  <i class="flaticon-bag"></i>
                  <span>{{ count((array) session('cart')) }}</span>
                </div>
                <a href="{{ route('cart') }}">Keranjang Belanja</a>
              @endif
            </div>
            @if (Auth::check())
              <div class="up-item ml-4">
                <i class="flaticon-profile"></i>
                <a href="{{ route('profil', Auth::user()->id) }}">Profil</a>
              </div>
            @else
            <div class="up-item ml-4">
                <i class="flaticon-profile"></i>
                <a href="{{ route('login') }}">Login</a>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <nav class="main-navbar">
    <div class="container">
      <!-- menu -->
      <ul class="main-menu">
        <li><a href="/">Home</a></li>
        <li><a href="#">Produk</a>
          <ul class="sub-menu">
            @foreach ($merek as $data)
              <li><a href="{{ route('category', $data->id) }}">{{ $data->name }}</a></li>
            @endforeach
          </ul>
        </li>
        @if (Auth::check())
          <li><a href="{{ route('history') }}">Riwayat Pemesanan</a></li>
          <li><a href="{{ route('favorite') }}">Daftar favorit</a></li>
        @endif
      </ul>
    </div>
  </nav>
</header>
<!-- Header section end -->
