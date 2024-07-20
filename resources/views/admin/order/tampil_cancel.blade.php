@extends('template_backend.home')
@section('halaman', 'Pesanan Dibatalkan')
@section('content')
  @if (Session::has('success'))
    <div class="alert alert-success" role="alert">
      {{ Session('success') }}
    </div>
  @endif
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="welcome-wrapper shadow-reset res-mg-t mg-b-30">
      <table class="table table-striped table-hover table-sm table-bordered text-center">
        <tr>
          <th>No</th>
          <th>ID Pesanan</th>
          <th>Nama Pembeli</th>
          <th>Tipe Barang</th>
          <th>Jumlah</th>
          <th>Harga</th>
          <th>Status Pembayaran</th>
          <th>Waktu Pesanan</th>
          <th>Pilihan</th>
        </tr>
        @foreach ($order as $result => $data)
          @if ($data->payment_status == 'Dicancel')
            <tr>
              <td>{{ $result + $order->firstitem() }}</td>
              <td>{{ $data->id}}</td>
              <td>{{ $data->user->name }}</td>
              <td>{{ $data->namaBarang($data->barang_id) }}</td>
              <td>{{ $data->quantity }}</td>
              <td>Rp. {{ number_format($data->total, 0) }}</td>
              <td><h6 class="post-title"><span class="badge badge-dangerr">{{ $data->payment_status }}</span></h6></td>
              <td>{{ $data->created_at->format('l, H:i:s d M Y') }}</td>
              <td><a href="{{ route('order.show', $data->id) }}" class="btn btn-primary btn-sm">Tampilkan</a></td>
            </tr>
          @endif
        @endforeach
      </table>
      {{ $order->links() }}
    </div>
  </div>
@endsection