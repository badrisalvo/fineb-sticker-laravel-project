<?php
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
  return view('welcome');
});
Route::get('/search', function () {
  return view('search_order');
});



Route::post('payments/{paymentId}/complete', [PaymentController::class, 'completePayment']);
Route::get('forgot-password', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('forgot-password', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('reset-password/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
Route::post('reset-password', 'ResetPasswordController@reset')->name('password.update');
Route::get('/barang/{id}', 'BarangController@show')->name('barang.show');
Route::get('/category/{id}', 'BarangController@category')->name('category');
Route::get('/cart', 'BarangController@cart')->name('cart');
Route::get('/add-to-cart/{id}', 'BarangController@addToCart')->name('add-to-cart');
Route::patch('/update_cart', 'BarangController@update_cart')->name('update_cart');
Route::delete('/remove', 'BarangController@remove')->name('remove');
Route::get('/', 'BarangController@home')->name('home');
Route::get('/home', 'BarangController@home')->name('home');

Route::get('/clear-cache', function () {
  Artisan::call('config:clear');
  Artisan::call('cache:clear');
  Artisan::call('config:cache');
  return 'DONE';
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
  // Rute yang diizinkan untuk role 'user'
  Route::middleware(['role:user'])->group(function () {
      Route::get('/favorite', 'BarangController@favorite')->name('favorite');
      Route::get('/like/{id}', 'BarangController@like')->name('like');
      Route::get('/unlike/{id}', 'BarangController@unlike')->name('unlike');
      
      Route::post('/proses_cekout/{id}', 'BarangController@proses_cekout')->name('proses_cekout');
      Route::get('/cekout', 'BarangController@cekout')->name('cekout');
      Route::get('/cetak-bukti-pembayaran/{id}', 'OrderController@cetakBuktiPembayaran')->name('order.cetak');
      
  });

  // Rute yang diizinkan untuk role 'admin'
  Route::middleware(['role:admin'])->group(function () {
      Route::resource('/barang', 'BarangController');
      Route::get('/Barang/tampil_hapus', 'BarangController@tampil_hapus')->name('barang.tampil_hapus');
      Route::delete('/barangkill/{id}', 'BarangController@kill')->name('barang.kill');
      Route::get('/Barang/create', 'BarangController@create')->name('barang.create');
      Route::get('/Barang/restore/{id}', 'BarangController@restore')->name('barang.restore');
      Route::resource('/merek', 'MerekController')->names('merek'); 
      Route::get('/Merek/index', 'MerekController@index')->name('merek.index');
      Route::resource('/order', 'OrderController');
      Route::get('/Order/tampil_cancel', 'OrderController@tampil_cancel')->name('order.tampil_cancel');
      Route::get('/Order/tampil_bayar', 'OrderController@tampil_bayar')->name('order.tampil_bayar');
      Route::get('/Order/tampil_pending', 'OrderController@tampil_pending')->name('order.tampil_pending');
      Route::resource('/akun', 'AkunController');
      Route::get('/searchOrder', [OrderController::class, 'searchOrder'])->name('searchOrder');
      Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik.index');
      Route::get('/pdf', 'PDFController@generatePDF')->name('pdf.generate');



      
  });


  Route::get('/profil/{id}', 'AkunController@profil')->name('profil');
  Route::get('/edit_profil/{id}', 'AkunController@edit_profil')->name('edit_profil');
  Route::post('/akun/simpan/{id}', 'AkunController@simpan')->name('akun.simpan');
  Route::delete('/Order/{id}', 'OrderController@destroy')->name('order.destroy');
  Route::get('/history', 'OrderController@history')->name('history');
  Route::get('/pembayaran/success', 'OrderController@success')->name('pembayaran.success');
  Route::get('/pembayaran/{id}', 'OrderController@pembayaran')->name('pembayaran');
  Route::patch('/proses_pembayaran/{id}', 'OrderController@proses_pembayaran')->name('proses_pembayaran');
});

Route::middleware(['web', 'guest'])->group(function () {
  // ... rute lainnya ...
});