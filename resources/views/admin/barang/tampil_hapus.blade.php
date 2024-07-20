@extends('template_backend.home')
@section('halaman', 'Daftar Barang Yang Dihapus')
@section('content')
  @if (Session::has('success'))
    <div class="alert alert-success" role="alert">
      {{ Session('success') }}
    </div>
  @endif

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="welcome-wrapper shadow-reset res-mg-t mg-b-30">
      <a href="{{ route('barang.create') }}" class="btn btn-primary btn-sm">Tambah Post</a><br><br>
      <table class="table table-striped table-hover table-sm table-bordered">
        <tr>
          <th>No</th>
          <th>Nama Post</th>
          <th>Kategori</th>
          <th>Daftar Tags</th>
          <th>Thumbnail</th>
          <th>Action</th>
        </tr>
        @foreach ($barang as $result => $d)
          <tr>
            <td>{{ $result + $barang->firstitem() }}</td>
            <td>{{ $d->merek->name }}</td>
            <td>{{ $d->type }}</td>
            <td>Rp. {{ $d->price }}</td>
            <td>
              <img src="{{ asset( $d->gambar ) }}" class="img-fluid" width="100" alt="">
            </td>
            <td>
              <form action="{{ route('barang.kill', $d->id) }}" method="post">
                @csrf
                @method('delete')
                <a href="{{ route('barang.restore', $d->id) }}" class="btn btn-success btn-sm">Restore</a>
                <button type="submit" class="btn btn-danger btn-sm" name="button">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </table>
      {{ $barang->links() }}
    </div>
  </div>
@endsection
