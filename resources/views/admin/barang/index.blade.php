@extends('template_backend.home')
@section('halaman', 'List Barang')
@section('content')
  @if (Session::has('success'))
    <div class="alert alert-success" role="alert">
      {{ Session('success') }}
    </div>
  @endif

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="welcome-wrapper shadow-reset res-mg-t mg-b-30 ">
      <a href="{{ route('barang.create') }}" class="btn btn-primary btn-sm">Tambah barang</a><br><br>
      <table class="text-center table table-striped table-hover table-sm table-bordered">
        <tr >
          <th class="text-center">No</th>
          <th class="text-center">Merek barang</th>
          <th class="text-center">Tipe barang</th>
          <th class="text-center">Harga</th>
          <th class="text-center">Thumbnail</th>
          <th class="text-center">Jumlah Stok</th>
          <th class="text-center">Aksi</th>
        </tr>
        @foreach ($barang as $result => $d)
          <tr class="text-center">
            <td>{{ $result + $barang->firstitem() }}</td>
            <td>{{ $d->merek->name }}</td>
            <td>{{ $d->type }}</td>
            <td>Rp. {{ $d->price }}</td>
            <td>
              <img src="{{ asset( $d->gambar ) }}" class="img-fluid" width="100" alt="">
            </td>
            <td>{{ $d->stock}}</td>
            <td>
              <form action="{{ route('barang.destroy', $d->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <a href="{{ route('barang.edit', $d->id) }}" class="btn btn-success btn-sm">Perbarui Barang</a>
                <!-- <button type="submit" class="btn btn-danger btn-sm" name="button">Delete</button> -->
              </form>
            </td>
          </tr>
        @endforeach
      </table>
      {{ $barang->links() }}
    </div>
  </div>
@endsection
