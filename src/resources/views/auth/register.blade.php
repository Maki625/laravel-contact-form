@extends('layouts.app')

@section('content')
<link href="{{ asset('css/register.css') }}" rel="stylesheet">



<div class="register-container">
    <h2 class="register-title">Register</h2>

    <div class="register-box">
        <form class="form" method="POST" action="/register">
            @csrf

            <!-- お名前 -->
            <div class="form-group">
                <label for="name">お名前</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="例：山田  太郎">
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- メールアドレス -->
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="例：test@example.com">
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- パスワード -->
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" name="password" required placeholder="例：coachtech1106">
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- 登録ボタン -->
            <div class="form-group">
                <button type="submit" class="register-button">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection