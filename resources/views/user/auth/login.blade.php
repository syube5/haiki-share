@extends('layouts.user.app_only_content')

@section('title')
    ログイン
@endsection

@section('content')
<div class="container">
    <div class="p-form">
        <div class="p-form__body">
            <div class="p-form__title">ログイン</div>

            <form method="POST" action="{{ route('user.login') }}" class="u-p9">
                @csrf

                <div class="form-group u-mb3">
                    <label for="email" class="c-label">メールアドレス</label>
                    <input id="email" type="email" class="p-form__control @error('email') error @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="p-form--feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group u-mb3">
                    <label for="password" class="c-label">パスワード</label>
                    <input id="password" type="password" class="p-form__control @error('password') error @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="p-form--feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group u-mb3">
                    <div class="p-form__check">
                        <input class="p-form__check--input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label c-label" for="remember">
                            ログイン状態を保存する
                        </label>
                    </div>
                </div>

                <div class="form-group u-mb3">
                    <button type="submit" class="c-button c-button__block c-button--blue">
                        ログイン
                    </button>
                </div>

                <div>
                    アカウントをお持ちでない方は<a href="{{ route('user.register') }}">こちら</a>
                </div>
                <div class="u-mt1">
                    パスワードをお忘れの方は<a href="{{ route('user.password.request') }}">こちら</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
