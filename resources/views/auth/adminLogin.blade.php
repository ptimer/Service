@extends('layouts.app')

@section('content')
<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Авторизация') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.login.submit') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail адрес') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" v-model="search" @keyup="searchit" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
                        <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
                          <!--Content-->
                          <div class="modal-content">
                            <!--Body-->
                            <div class="modal-body text-center mb-1">

                              <h5 class="mt-1 mb-2">Введите пароль</h5>

                              <div class="md-form ml-0 mr-0">
                                <input id="password" type="password" class="form-control ml-0" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Введите пароль">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            
                              </div>
                              {{--
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Запомнить меня') }}
                                    </label>
                                --}}
                              <div class="text-center mt-4">

                                <button type="submit" class="btn btn-primary">
                                    {{ __('Войти') }}
                                </button>
                              </div>
                            </div>

                          </div>
                          <!--/.Content-->
                        </div>
                      </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('admin.password.request') }}">
                                        {{ __('Забыли пароль?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
