@extends('layouts.conveniencestore.app_only_content')

@section('title')
    パスワードリセット
@endsection

@section('content')
<div class="container">
    <div class="p-form">
        <div class="p-form__body">
            <div class="p-form__title">パスワード再設定</div>

                <form method="POST" action="{{ route('conveniencestore.password.update') }}" class="u-p9">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group u-mb3">
                        <label for="email" class="c-label">メールアドレス</label>
                        <input id="email" type="email" class="p-form__control @error('email') error @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="p-form--feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group u-mb3">
                        <label for="password" class="c-label">パスワード</label>
                        <input id="password" type="password" class="p-form__control @error('password') error @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="p-form--feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group u-mb3">
                        <label for="password-confirm" class="c-label">パスワード再入力</label>
                        <input id="password-confirm" type="password" class="p-form__control" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="form-group u-mb0">
                        <button type="submit" class="c-button c-button__block c-button--blue">
                            パスワードを再設定する
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
