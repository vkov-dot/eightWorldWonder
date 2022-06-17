@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-sm-12">
                <div class="card">
                    <div class="card-header">{{ __('Підтвердження адреси електронної пошти') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif
                        <form class="d-inline" action="{{ route('verification.activate') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('POST')

                            <input type="hidden" name="id" value="{{ $userId }}">
                            <div class="row mb-3">
                                <label for="verify_code" class="col-md-4 col-form-label text-md-end">{{ __('Код підтвердження') }}</label>

                                <div class="col-md-6">
                                    <input class="form-control w-100 @error('email') is-invalid @enderror"
                                           type="number" name="verify_code" required>

                                    @error('verify_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Підтвердити
                                    </button>
                                </div>
                            </div>
                        </form>
                            <form action="{{ route('verification.reset') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="id" value="{{ $userId }}">

                                <button class="btn verify-reset-submit" type="submit">
                                    {{ __('Надіслати ще раз') }}
                                </button>
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
