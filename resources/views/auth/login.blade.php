@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- /.login-logo -->
            <div class="card">
              <div class="card-body login-card-body bg-blue">
                <p class="login-box-msg text-white"><b>{{ __('Login') }}</b></p>

                <form action="{{ route('login') }}" method="post">
                  @csrf
                  <div class="input-group mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
                    <div class="col-md-6">
                      <div class="input-group mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                          </div>
                        </div>
                        @error('email')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="input-group mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <span class="fas fa-eye" id="eye-icon"></span>
                                </button>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                  <div class="row">
                    <div class="col-7 pl-3">
                      <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember">
                          {{ __('Ingatkan Login') }}
                        </label>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-5">
                      <button type="submit" class="btn bg-dark btn-block">
                        {{ __('Login') }}
                      </button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>


                <p class="mb-1">
                  @if (Route::has('password.request'))
                    <a class="btn text-black" href="{{ route('password.request') }}">
                      {{ __('Lupa Password Anda?') }}
                    </a>
                  @endif
                </p>
              </div>
              <!-- /.login-card-body -->
            </div>
            <!-- /.login-box -->
        </div>
    </div>
</div>
@endsection
