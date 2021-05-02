@extends('layouts.app_only_content')

@section('title')
    会員登録
@endsection

@section('content')
<div class="container">
    <div class="p-form">
        <div class="p-form__body">
            <div class="p-form__title">会員情報登録</div>

            <form method="POST" action="{{ route('register') }}" class="u-p3rem">
                @csrf

                <div class="form-group u-mb3">
                    <label for="name" class="c-label">ニックネーム</label>
                    <input id="name" type="text" class="p-form__control @error('name') error @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="田中太郎">
                    @error('name')
                        <span class="p-form--feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group u-mb3">
                    <label for="email" class="c-label">メールアドレス</label>
                    <input id="email" type="email" class="p-form__control @error('email') error @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="abc@example.com">
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

                <div class="form-group u-mb3">
                    <button type="submit" class="c-button c-button__block c-button--blue">
                        会員登録
                    </button>
                </div>

                <div>
                    アカウントをお持ちの方は<a href="{{ route('login') }}">こちら</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
