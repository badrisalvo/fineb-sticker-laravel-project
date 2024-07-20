<div class="left-sidebar-pro">
  <nav id="sidebar">
    <div class="sidebar-header">
      <a href="{{ route('profil', Auth::user()->id) }}">
        @if ( Auth::user()->gambar )
          <img style="width: 100px; height:100px;" class="rounded-circle img-thumbnail" src="{{ asset(Auth::user()->gambar) }}" alt="" />
        @else
          <img class="rounded-circle img-thumbnail" src="{{ asset('admin/img/message/1.jpg') }}" alt="" />
        @endif
      </a>
      <h3 style="text-transform: uppercase;" class="text-white">{{ Auth::user()->name }}</h3>
      <p style="text-transform: uppercase;" class="text-white"><b>
        @if ( Auth::user()->pekerjaan )
          {{ Auth::user()->pekerjaan }}
        @else
          N/A
        @endif
      </b>
      </p>
      <strong class="text-white">AK</strong>
    </div>
    <div class="left-custom-menu-adp-wrap">
      <ul class="nav navbar-nav left-sidebar-menu-pro">
        <li class="nav-item"><a href="/"><i class="fa big-icon fa-home"></i> <span class="mini-dn">Halaman Awal</span></i></span></a></li>
        <li class="nav-item">
          <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-shopping-bag"></i> <span class="mini-dn">Pesanan</span> <span class="indicator-right-menu mini-dn"></i></span></a>
          <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
            <a href="{{ route('order.tampil_pending') }}" class="dropdown-item">Pesanan Tertunda</a>
            <a href="{{ route('order.index') }}" class="dropdown-item">Pesanan Selesai</a>
            <a href="{{ route('order.tampil_cancel') }}" class="dropdown-item">Pesanan Dibatalkan</a>
          </div>
        </li>
        <li class="nav-item"><a href="{{ route('barang.index') }}" ><i class="fa big-icon fa-star"></i> <span class="mini-dn">Daftar Stiker</span> </i></span></a></li>
        <li class="nav-item"><a href="{{ route('merek.index') }}" ><i class="fa big-icon fa-clipboard"></i> <span class="mini-dn">Daftar Bahan</span> </i></span></a></li>
        <li class="nav-item"><a href="{{ route('akun.index') }}" ><i class="fa big-icon fa-user"></i> <span class="mini-dn">Kelola Akun</span> </i></span></a></li>
        <li class="nav-item"><a href="{{ route('statistik.index') }}" ><i class="fa big-icon fa-square"></i> <span class="mini-dn">Statistik Penjualan</span> </i></span></a></li>
      </ul>
    </div>
  </nav>
</div>
