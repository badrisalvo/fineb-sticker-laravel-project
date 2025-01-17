@extends('template_backend.home')
@section('halaman', 'Daftar Bahan')
@section('content')
  @if (Session::has('success'))
    <div class="alert alert-success" role="alert">
      {{ Session('success') }}
    </div>
  @endif

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="welcome-wrapper shadow-reset res-mg-t mg-b-30">
      <a href="{{ route('merek.create') }}" class="btn btn-primary btn-sm">Tambah Bahan</a><br><br>
      <table class="table table-striped table-hover table-sm table-bordered text-center">
        <tr>
          <th>No</th>
          <th>Nama Bahan</th>
          <th>Aksi</th>
        </tr>
        @foreach ($merek as $result => $d)
          <tr>
            <td>{{ $result + $merek->firstitem() }}</td>
            <td>{{ $d->name }}</td>
            <td>
              <form action="{{ route('merek.destroy', $d->id) }}" method="post">
                @csrf
                @method('delete')
                <a href="{{ route('merek.edit', $d->id) }}" class="btn btn-success btn-sm">Perbarui</a>
                <!-- <button type="submit" class="btn btn-danger btn-sm" name="button">Delete</button> -->
              </form>
            </td>
          </tr>
        @endforeach
      </table>
      {{ $merek->links() }}
    </div>
  </div>
@endsection
