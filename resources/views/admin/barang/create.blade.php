@extends('template_backend.home')
@section('halaman', 'Tambah Barang')
@section('content')
  @if (count($errors)>0)
    @foreach ($errors->all() as $error)
      <div class="alert alert-danger" role="alert">
        {{ $error }}
      </div>
    @endforeach
  @endif

  @if (Session::has('success'))
    <div class="alert alert-success" role="alert">
      {{ Session('success') }}
    </div>
  @endif

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="welcome-wrapper shadow-reset res-mg-t mg-b-30">
      <form action="{{ route('barang.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label>Bahan</label>
          <div class="chosen-select-single mg-b-20">
            <select class="select2_demo_3 form-control" name="merek_id">
              <option value="" holder>Pilih Bahan</option>
              @foreach ($merek as $d)
                <option value="{{ $d->id }}">{{ $d->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <label>Nama Barang</label>
          <input type="text" class="form-control" name="type" placeholder="Nama Barang" autocomplete="off">
        </div>
        <div class="form-group">
          <label>Harga</label>
          <input type="number" class="form-control" name="price" placeholder="Price Barang">
        </div>
        <div class="form-group">
          <label>Jumlah Stok</label>
          <input type="number" class="form-control" name="stock" placeholder="Stock Barang">
        </div>
        <div class="form-group">
          <label for="exampleInputFile">Foto Barang</label>
          <div class="file-upload-inner ts-forms">
              <div class="input prepend-big-btn">
                  <label class="icon-right" for="prepend-big-btn">
                      <i class="fa fa-download"></i>
                  </label>
                  <div class="file-button">
                      Telusuri
                      <input type="file" name="gambar" onchange="document.getElementById('prepend-big-btn').value = this.value;">
                  </div>
                  <input type="text" id="prepend-big-btn" name="gambar" placeholder="no file selected">
              </div>
          </div>
        </div><br>

        <div class="form-group">
          <button class="btn btn-primary btn-block">Simpan</button>
        </div>
      </form>
    </div>
  </div>
@endsection
