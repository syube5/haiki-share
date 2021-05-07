@extends('layouts.conveniencestore.app_only_content')

@section('title')
    パスワードリセットリクエスト
@endsection

@section('content')
    <div class="container">
        <div class="p-form">
            <div class="p-form__body">
                <div class="p-form__title">パスワードをお忘れの方</div>

                <form method="POST" action="{{ route('conveniencestore.password.email') }}" class="u-p9">
                    @if (session('status'))
                        <div class="p-alert p-alert--success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @csrf

                    <div class="form-group u-mb3">
                        <label for="email" class="c-label">メールアドレス</label>
                        <input id="email" type="email" class="p-form__control @error('email') error @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="abc@example.com">

                        @error('email')
                        <span class="p-form--feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group u-mb0">
                        <button type="submit" class="c-button c-button__block c-button--blue">
                            送信する
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
