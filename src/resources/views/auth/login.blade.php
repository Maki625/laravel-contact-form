@extends('layouts.app')

@section('content')
<link href="{{ asset('css/login.css') }}" rel="stylesheet">

<div class="login-container">
    <h2 class="login-title">Login</h2>

    <div class="login-box">
    <form class="form" method="POST" action="/login">
    @csrf

<!-- メールアドレス -->
    <div class="form-group">
    <label for="email">メールアドレス</label>
    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="例: test@example.com">
    @error('email')
    <div class="error-message">{{ $message }}</div>
@enderror
</div>

<!-- パスワード -->
<div class="form-group">
<label for="password">パスワード</label>
<input type="password" id="password" name="password" required placeholder="例: coachtech1106">
@error('password')
<div class="error-message">{{ $message }}</div>
@enderror
</div>

<!-- ログインボタン -->
<button type="submit">ログイン</button>
</form>
</div>
</div>
@endsection
