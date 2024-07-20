<!-- Mobile Menu start -->
<div class="mobile-menu-area">
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="mobile-menu">
          <nav id="dropdown">
            <ul class="mobile-menu-nav">
              <li class="nav-item"><a href="/" >Halaman Awal <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a></li>
              <li class="nav-item">
                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-car"></i> <span class="mini-dn">Pesanan</span> </span></a>
                <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                  <a href="{{ route('order.tampil_pending') }}" class="dropdown-item">Daftar Pesanan Tertunda</a>
                  <a href="{{ route('order.index') }}" class="dropdown-item">Daftar Pesanan Selesai</a>
                  <a href="{{ route('order.tampil_cancel') }}" class="dropdown-item">Daftar Pesanan Dibatalkan</a>
                </div>
              </li>
              <li class="nav-item"><a href="{{ route('barang.index') }}" ><i class="fa big-icon fa-clipboard"></i> <span class="mini-dn">Daftar Stiker</span> </i></span></a></li>
              <li class="nav-item"><a href="{{ route('merek.index') }}" ><i class="fa big-icon fa-clipboard"></i> <span class="mini-dn">Bahan</span> </i></span></a></li>
              <li class="nav-item"><a href="{{ route('akun.index') }}" ><i class="fa big-icon fa-user"></i> <span class="mini-dn">Akun</span> </i></span></a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Mobile Menu end -->
<!-- Breadcome start-->
<div class="breadcome-area des-none">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="breadcome-list map-mg-t-40-gl shadow-reset">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <div class="breadcome-heading">

              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <ul class="breadcome-menu">
                <li><a href="#">Halaman Awal</a> <span class="bread-slash">/</span></li>
                <li><span class="bread-blod">@yield('halaman')</span></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Breadcome End-->
