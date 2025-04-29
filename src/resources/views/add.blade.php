@extends('layouts.app')

@section('content')
<link href="{{ asset('css/add.css') }}" rel="stylesheet">

<div class="container">
    <h2>新規ユーザー登録</h2>

    <form action="/register" method="POST">
        @csrf

        <!-- 名前 -->
        <div class="form-group">
            <label for="name">名前</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- メールアドレス -->
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- パスワード -->
        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- パスワード確認 -->
        <div class="form-group">
            <label for="password_confirmation">パスワード確認</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- 登録ボタン -->
        <button type="submit" class="btn btn-primary">登録</button>
    </form>
    
    <div class="mt-3">
        <a href="{{ route('login') }}">既にアカウントをお持ちですか？ログイン</a>
    </div>
</div>
@endsection
