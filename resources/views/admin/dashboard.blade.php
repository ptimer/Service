@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Управление сайтом</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <h4>Администраторы</h4>
                            <ul class="list-group list-group-flush">
                                @foreach($admins as $admin)
                                    <li class="list-group-item">{{ $admin->email }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <div class="container">
                                
                                <div class="row">
                                    <div class="col-md-8"><h4>Операторы</h4></div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            

                            {{-- MODAL FOR REGISTERING NEW OPERATOR --}}
                            <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content p-5">
                                         
                                        <form method="POST" action="{{ route('operator.register') }}">
                                            @csrf

                                            <div class="form-group row">
                                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>

                                                <div class="col-md-6">
                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail адрес') }}</label>

                                                <div class="col-md-6">
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Пароль') }}</label>

                                                <div class="col-md-6">
                                                    <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Подтвердить пароль') }}</label>

                                                <div class="col-md-6">
                                                    <input id="password-confirm" type="text" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Зарегистрировать оператора') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                 </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach($operators as $operator)

                                    <li class="list-group-item">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h6>Имя: </h6> {{$operator->name}}
                                                    <h6>Email: </h6> {{ $operator->email }}
                                                </div>
                                    
                                                <div class="col-md-4">

                                                    <button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-toggle="modal" data-target=".delete-modal{{$operator->id}}">
                                                            <i class="fa fa-trash"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-toggle="modal" data-target=".update-modal{{$operator->id}}">
                                                            <i class="fa fa-edit"></i>
                                                    </button>
                                                </div>
                                    </li>
                                    {{-- MODAL FOR DELETING --}}
                                   <div class="modal fade delete-modal{{$operator->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content p-5">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Удаление {{ $operator->email }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <p><span style="font-size: 15px; font-weight: bold;">Вы действительно хотите удалить оператора ? </span></p>
                                            <p> ID: {{ $operator->id }} </p>
                                            <p> EMAIL: {{ $operator->email }} </p>
                                            <p> Имя: {{ $operator->name }} </p>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                                            <form method="POST" action="{{ route('admin.destroyOperator', ['id' => $operator->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $operator->id }}">
                                                <button type="submit" class="btn btn-primary">Подтвердить удаление</button>
                                            </form>
                                          </div>
                                        </div>
                                    </div>
                                    </div>

                                    {{-- MODAL FOR UPDATING --}}

                                    <div class="modal fade update-modal{{$operator->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content p-5">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Изменение {{ $operator->email }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">

                                            <form method="POST" action="{{ route('admin.updateOperator', ['id' => $operator->id]) }}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="id" value="{{ $operator->id }}">
                                                <div class="form-group row">
                                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $operator->name }}" required autocomplete="name" autofocus>

                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail адрес') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $operator->email }}" required autocomplete="email">

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Пароль') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Подтвердить пароль') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="password-confirm" type="text" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                                                    <button type="submit" class="btn btn-primary">{{ __('Сохранить изменения') }}</button>
                                                </div>
                                            </form>
                                          </div>
                                        </div>
                                    </div>
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h4>Клиенты</h4>
                            <ul class="list-group list-group-flush">
                                @foreach($clients as $client)
                                    <li class="list-group-item">{{ $client->email }}</li>
                                @endforeach
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
